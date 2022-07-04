FROM alpine:latest
RUN mkdir /app && apk add --update python3 py3-pip && pip3 install flask
WORKDIR /app
COPY app/ /app/
ENV PORT 80
CMD ["python3", "server.py"]