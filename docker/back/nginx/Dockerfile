FROM nginx:1.25-alpine

WORKDIR /var/www/html

ENV TZ='Asia/Tokyo'

RUN apk update \
    && apk add \
    bash \
    make \
    gcc \
    g++

# copy nginx config file
COPY ./docker/back/nginx/*.conf /etc/nginx/conf.d/
