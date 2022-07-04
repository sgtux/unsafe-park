FROM sgtux/netcorewebgoat
ARG DEBIAN_FRONTEND=noninteractive
COPY files/* /root/
RUN add-apt-repository ppa:oisf/suricata-stable && \
    apt install -y suricata && \
    chmod +x /root/init.sh
ENTRYPOINT ["/bin/bash"]
CMD ["/root/init.sh"]