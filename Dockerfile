FROM php:8.1-fpm-alpine

ARG user
ARG uid
ENV TZ="Asia/Jakarta"
WORKDIR /var/www

RUN apk --update --no-cache add \
    freetype libpng libjpeg-turbo unzip zip tzdata \
    && apk add --no-cache --virtual .build-deps \
    pcre-dev $PHPIZE_DEPS \
    && pecl install redis xdebug \
    && apk del .build-deps \
    && rm -rf /var/cache/apk/* \
    && rm -rf /tmp/*

RUN docker-php-ext-install \
	bcmath pdo_mysql \
    && docker-php-ext-enable \
    redis xdebug

RUN apk add --no-cache --virtual .build-gd-deps \
    freetype-dev libpng-dev libjpeg-turbo-dev \
    && docker-php-ext-configure gd --enable-gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && apk del .build-gd-deps \
    && rm -rf /var/cache/apk/* \
    && rm -rf /tmp/*

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
COPY php/conf.d/php.ini /usr/local/etc/php/conf.d/php.ini

RUN addgroup \
	--system \
    --gid "$uid" \
	"$user" \
    && adduser \
    --gecos "" \
    --uid "$uid" \
    --ingroup "$user" \
    --disabled-password \
    "$user"

USER $user
EXPOSE 9000
