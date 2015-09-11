#!/bin/bash
# ========================================== #
# install zookeeper on server machine        #
# Version: for CentOS 6.x                    #
# ========================================== #

cd /usr/local/src

wget -c --no-cookies --header "Cookie: gpw_e24=http%3A%2F%2Fwww.oracle.com%2Ftechnetwork%2Fjava%2Fjavase%2Fdownloads%2Fjdk8-downloads-2133151.html;oraclelicense=accept-securebackup-cookie" "http://download.oracle.com/otn-pub/java/jdk/8u45-b14/jdk-8u45-linux-x64.rpm"
--output-document="jdk-8u45-linux-x64.rpm"

rpm -ivh --prefix /usr/java jdk-8u45-linux-x64.rpm

export JAVA_HOME=/usr/java/jdk1.8.0_45
export CLASSPATH=.:$JAVA_HOME/lib/dt.jar:$JAVA_HOME/lib/tools.jar
export PATH=$PATH:$JAVA_HOME/bin
export JAVA_HOME CLASSPATH PATH


wget http://mirror.bit.edu.cn/apache/zookeeper/zookeeper-3.3.6/zookeeper-3.3.6.tar.gz --output-document="zookeeper-3.3.6.tar.gz"

tar -xzf zookeeper-3.3.6.tar.gz -C /usr/local/

[ !-d /data/zookeeper-data ] && mkdir -p /data/zookeeper-data

cd /usr/local/src/zookeeper-3.3.6/src/c

./configure --prefix=/usr/local/zookeeper

make && make install

cp /usr/local/zookeeper-3.3.6/conf/zoo_sample.cfg /usr/local/zookeeper-3.3.6/conf/zoo.cfg
sed -i '/^dataDir/c \dataDir=\/data\/zookeeper-data' /usr/local/zookeeper-3.3.6/conf/zoo.cfg

/usr/local/zookeeper/bin/zkServer.sh start
