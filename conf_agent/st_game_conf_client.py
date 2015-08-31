#!/usr/bin/env python
# -*- coding: utf-8 -*-
__author__ = 'verne'

import sys,os,time,atexit
import subprocess
import socket
import hashlib

import logging
from signal import SIGTERM
import getopt


#################################################################################
def usage():
    print "Usage:"
    print "python %s start|stop|restart " % sys.argv[0]
    print
    print "Configuration:"
    print "start: start the config client"
    print "stop: stop the config client"
    print "restart: restart the config client"
    print "-h, --help display this help and exit"

    print """
_________________________________________________________________________
 @desc script
 To Sync the st game cpp application config file
    from st_game_conf_center.
_________________________________________________________________________
"""
#################################################################################


def initLog(logfile):
    _logfile_ = logfile
    logger = logging.getLogger() #
    # log_handle = logging.FileHandler(_logfile_)
    # formatter = logging.Formatter('[%(asctime)s] [%(levelname)s] %(message)s')
    # log_handle.setFormatter(formatter)
    # logger.addHandler(log_handle)
    # logger.setLevel(logging.NOTSET)
    logging.basicConfig(
        filename=_logfile_,
        level=logging.NOTSET,
        format='%(asctime)s %(levelname)s: %(message)s',
        datefmt='%Y-%m-%d %H:%M:%S'
    )
    return logger


def die(msg, ex=None):
    print msg
    if ex: print ex
    sys.exit(1)


def md5hex(word):
    """ MD5加密算法，返回32位小写16进制符号 """
    if isinstance(word, unicode):
        word = word.encode("utf-8")
    elif not isinstance(word, str):
        word = str(word)
    m = hashlib.md5()
    m.update(word)
    return m.hexdigest()


def md5sum(fname):
    """ 计算文件的MD5值 """
    def read_chunks(fh):
        fh.seek(0)
        chunk = fh.read(8096)
        while chunk:
            yield chunk
            chunk = fh.read(8096)
        else: #最后要将游标放回文件开头
            fh.seek(0)
    m = hashlib.md5()
    if isinstance(fname, basestring) and os.path.exists(fname):
        with open(fname, "rb") as fh:
            for chunk in read_chunks(fh):
                m.update(chunk)
    #上传的文件缓存 或 已打开的文件流
    elif fname.__class__.__name__ in ["StringIO", "StringO"] \
            or isinstance(fname, file):
        for chunk in read_chunks(fname):
            m.update(chunk)
    else:
        return ""
    return m.hexdigest()


class MyDaemon:
    def __init__(self,pidfile,stdin='/dev/null',stdout='/dev/null',stderr='/dev/null'):
        self.stdin = stdin
        self.stdout = stdout
        self.stderr = stderr
        self.pidfile = pidfile

    def _daemonize(self):
        try:
            pid = os.fork()
            if pid > 0:
                sys.exit(0)
        except OSError, e:
            msg = 'fork #1 failed: %d (%s)\n' % (e.errno,e.strerror)
            sys.stderr.write(msg)
            sys.exit(1)
        os.setsid()
        os.chdir('/')
        os.umask(0)
        try:
            pid = os.fork()
            if pid > 0:
                sys.exit(0)
        except OSError, e:
            msg = 'fork #2 failed: %d (%s)\n' % (e.errno,e.strerror)
            sys.stderr.write(msg)
            sys.exit(1)

        sys.stdout.flush()
        sys.stderr.flush()

        si = file(self.stdin, 'r')
        so = file(self.stdout, 'a+')
        se = file(self.stderr, 'a+', 0)
        os.dup2(si.fileno(), sys.stdin.fileno())
        os.dup2(so.fileno(), sys.stdout.fileno())
        os.dup2(se.fileno(), sys.stderr.fileno())

        atexit.register(self.delPid)
        pid = str(os.getpid())
        file(self.pidfile,'w+').write('%s\n' % pid)

    def delPid(self):
        if os.path.isfile(self.pidfile):
            os.remove(self.pidfile)

    def start(self):
        if os.path.isfile(self.pidfile):
            pf = file(self.pidfile,'r')
            try:
                pid = int(pf.read().strip())
                pf.close()
            except IOError:
                pid = None
            if bool(pid):
                msg = 'pidfile %s already exist. process already running?\n'
                sys.stderr.write(msg % self.pidfile)
                sys.exit(1)

        self._daemonize()
        self.run()

    def stop(self):
        if os.path.isfile(self.pidfile):
            pf = file(self.pidfile,'r')
            try:
                pid = int(pf.read().strip())
                pf.close()
            except IOError:
                pid = None

            if not bool(pid):
                message = 'pidfile %s does not exist. process not running?\n'
                sys.stderr.write(message % self.pidfile)
                return
            try:
                os.kill(pid,SIGTERM)
                #if need kill all
                self.delPid()
            except OSError,err:
                err = str(err)
                if err.find('No such process') > 0:
                    if os.path.exists(self.pidfile):
                        os.remove(self.pidfile)
                else:
                    sys.stderr.write(str(err))
                    sys.exit(1)
        else:
            message = 'pidfile %s does not exist. process not running?\n'
            sys.stderr.write(message % self.pidfile)
            return


    def restart(self):
        self.stop()
        self.start()

    def run(self):
        """ run fun [well extend and be recreate]"""


class ConfClient(MyDaemon):
    def get_st_game_conf(self):
        global st_game_config_md5s
        global st_game_config_files
        global qconf_st_game_config_paths
        global hostname
        hostname = socket.getfqdn(socket.gethostname())
        if os.path.exists(cpp_conf_dir):
            for path_root,dirs,files in os.walk(cpp_conf_dir,True):
                for _file in files:
                    _file_path = os.path.join(path_root,_file)
                    if os.path.isfile(_file_path):
                        st_game_config_files.append(_file_path)
                        st_game_config_md5s[_file_path] = md5sum(_file_path)


    def syncConf(self):
        #读出qconf
        if any(st_game_config_files):
            for local_conf_path in st_game_config_files:
                if local_conf_path in st_game_config_md5s.keys():
                    if bool(hostname) and bool(local_conf_path):
                        qconf_conf_path = '/' + hostname + local_conf_path
                        qconf_conf_content = ''
                        try:
                            shell_obj = subprocess.Popen("%s %s  |grep -iv 'Failed to get conf' "% (qconf_bin_and_command,qconf_conf_path),shell=True,stdout=subprocess.PIPE)
                            qconf_conf_content = shell_obj.stdout.read()
                        except Exception,e:
                            pass

                        if bool(qconf_conf_content):
                            # 取值md5
                            qconf_conf_content_md5 = md5hex(qconf_conf_content)

                            #比较字典中的md5
                            if st_game_config_md5s[local_conf_path] != qconf_conf_content_md5:

                                #写log
                                logger.info('The config file %s  has changed!' % local_conf_path)

                                # 备份旧配置
                                if not os.path.exists(st_game_config_file_bak_dir):
                                    os.mkdir(st_game_config_file_bak_dir)
                                #     这个备份有重名覆盖的问题
                                # qconf_conf_path_dir,qconf_conf_path_file = os.path.split(qconf_conf_path)
                                # conf_bak_file = st_game_config_file_bak_dir + '/' + qconf_conf_path_file + '_' +  time.strftime('%Y%m%d%H%M%S')
                                # os.rename(local_conf_path,conf_bak_file)

                                #最后推荐完整压缩包备份
                                back_conf_zip = st_game_config_file_bak_dir + '/' + time.strftime('%Y%m%d%H%M%S') + '.zip'
                                zip_command = "zip -qr %s %s " % ( back_conf_zip, cpp_conf_dir )

                                try:
                                    subprocess.call(zip_command,shell=True)
                                except Exception,e:
                                    pass

                                # 新配置写文件
                                file_handle = file(local_conf_path,"w+")
                                file_handle.write(qconf_conf_content)
                                file_handle.close()


    def run(self):
        global st_game_config_files
        global st_game_config_md5s
        while True:
            self.get_st_game_conf()
            self.syncConf()
            st_game_config_files = []
            st_game_config_md5s = {}
            time.sleep(10)


if __name__ == "__main__":
    app_dir = '/data/apps'
    log_dir = '/data/logs'
    hostname = ''

    cpp_conf_dir = app_dir + '/' + 'cpp-configs'

    logfile = log_dir + '/' + 'st_game_config_change.log'

    lock_file = '/var/lock/subsys/st_game_conf_client'

    pid_file = '/tmp/st_game_conf_client.pid'

    logger = initLog(logfile)

    st_game_config_file_bak_dir = '/tmp/st_game_conf_client_bak'

    st_game_config_files = []

    st_game_config_md5s = {}

    qconf_bin_and_command = '/usr/local/qconf/bin/qconf get_conf '

    verne_conf_client=ConfClient(pid_file)


    if len(sys.argv) > 1:
        args = sys.argv[1]
        try:
            if args in ('-h', '-?', '--help'):
                usage()
                sys.exit(0)
            if args == 'start':
                logger.info('st_game_conf_client running start!')
                verne_conf_client.start()
            if args == 'stop':
                logger.info('st_game_conf_client be shut!')
                verne_conf_client.stop()
            if args == 'restart':
                logger.info('st_game_conf_client be restart!')
                verne_conf_client.restart()
        except Exception,e:
            pass
    else:
        print "\nInvalid command line option detected."
        usage()
        sys.exit(1)
