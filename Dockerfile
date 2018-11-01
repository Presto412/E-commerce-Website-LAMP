FROM ubuntu:latest

RUN apt-get update
RUN apt-get install -y apache2
# RUN apt install -y php libapache2-mod-php php-mysql

EXPOSE  80

CMD ["/usr/sbin/apache2ctl", "-D", "FOREGROUND"]
