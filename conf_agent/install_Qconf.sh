#!/bin/bash
# ========================================== #
# install Qconf_agent on host machine        #
# Version: for CentOS 6.x                    #
# ========================================== #

cd /usr/local/src

wget -c --no-cookies "https://github.com/Qihoo360/QConf/archive/1.0.2.tar.gz" --output-document="qconf-1.0.2.tar.gz"

[ ! -d /tmp/qconf-1.0.2 ] && mkdir -p /tmp/qconf-1.0.2

tar -xzf qconf-1.0.2.tar.gz -C /tmp/qconf-1.0.2

mv /tmp/qconf-1.0.2/* /usr/local/src/qconf-1.0.2

cd /usr/local/src/qconf-1.0.2

mkdir build && cd build
cmake ..
make
make install

# need to change your zk server host
sed -ri '/^zookeeper.test/c \zookeeper\.test=192\.168\.184\.43:2181' /usr/local/qconf/conf/idc.conf

chmod +x /usr/local/qconf/bin/*

echo "/bin/sh  /usr/local/qconf/bin/agent-cmd.sh start" >> /etc/rc.d/rc.local

/usr/local/qconf/bin/agent-cmd.sh start
