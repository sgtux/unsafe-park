FROM ubuntu:20.04
ARG DEBIAN_FRONTEND=noninteractive
COPY files/* /root/
RUN apt update && \
    apt install -y wget gnupg && \
    wget -qO - https://evebox.org/files/GPG-KEY-evebox | apt-key add - && \
    echo "deb http://evebox.org/files/debian stable main" | tee /etc/apt/sources.list.d/evebox.list && \
    apt update && \
    apt install -y apache2 evebox && \
    cp /root/000-default.conf /etc/apache2/sites-available && \
    a2enmod proxy proxy_http && \
    chmod +x /root/init.sh && \
    mv /root/evebox.yaml /etc/evebox/
ENTRYPOINT ["/bin/bash"]
CMD ["/root/init.sh"]