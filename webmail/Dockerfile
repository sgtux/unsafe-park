FROM ubuntu:20.04
ARG DEBIAN_FRONTEND=noninteractive
COPY files/* /root/ 
RUN apt update && apt install -y net-tools unzip apache2 php dovecot-imapd dovecot-pop3d postfix openssh-server mailutils && \
  unzip /root/squirrelmail.zip && \
  rm /root/squirrelmail.zip && \
  apt remove --purge -y unzip && \
  mkdir -p /var/www/html/ && \
  mv squirrelmail-webmail-1.4.22 /var/www/html/squirrelmail && \ 
  chown -R www-data:www-data /var/www/html/squirrelmail && \
  chmod 755 -R /var/www/html/squirrelmail && \
  mv /root/newuser.sh /usr/bin/newuser && \
  chmod +x /usr/bin/newuser && \
  /usr/bin/newuser admin admin && \
  /usr/bin/newuser vitima vitima && \
  /usr/bin/newuser atacante atacante && \
  mkdir -p /var/local/squirrelmail/data/ && \
  mkdir /var/local/squirrelmail/attach/ && \
  chown -R www-data:www-data /var/local/squirrelmail && \
  mv /root/config.php /var/www/html/squirrelmail/config/config.php && \
  cp /root/logo.png /var/www/html/squirrelmail/favicon.ico && \
  mv /root/logo.png /var/www/html/squirrelmail/images && \
  mv /root/main.cf /etc/postfix/main.cf && \
  apt clean && \
  chmod +x /root/init.sh && \
  mv /root/squirrelmail.conf /etc/apache2/sites-available/
ENTRYPOINT ["/bin/bash"]
CMD ["/root/init.sh"]