FROM bkimminich/juice-shop as temp

FROM ubuntu:20.04
ARG DEBIAN_FRONTEND=noninteractive
COPY files/* /root/
COPY --from=temp /juice-shop /juice-shop
WORKDIR /juice-shop
RUN apt update && \
    apt install -y apache2 php libapache2-mod-php curl && \
    rm /var/www/html/index.html && \
    curl -fsSL https://deb.nodesource.com/setup_16.x | bash && \
    apt-get install -y nodejs && \
    chmod +x /root/init.sh

ENTRYPOINT ["/bin/bash"]
CMD ["/root/init.sh"]