FROM composer as builder
WORKDIR /app/
COPY composer.* ./
RUN composer install

FROM php:8.1-cli

WORKDIR /usr/src/myapp

COPY . /usr/src/myapp
COPY --from=builder /app/vendor /usr/src/myapp/vendor

ENTRYPOINT php index.php