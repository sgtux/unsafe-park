FROM ubuntu:20.04
COPY files/* /root/
RUN apt update && \
    apt install -y vsftpd python3 && \
    apt clean && \
    mkdir /home/public && \
    chmod 777 /home/public && \
    cp /root/vsftpd.conf /etc && \
    mkdir -p /var/run/vsftpd/empty && \
    useradd -m -p $(openssl passwd -1 password) admin && \
    date | md5sum | cut -d " " -f1 > /home/admin/key.txt
CMD ["/usr/bin/python3", "/root/init.py"]