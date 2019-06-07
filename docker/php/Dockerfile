FROM php:7.2-fpm-alpine


# persistent / runtime deps
RUN apk add --no-cache \
        acl \
        file \
        gettext \
        git \
    ;

ARG APCU_VERSION=5.1.16
RUN set -eux; \
    apk add --no-cache --virtual .build-deps \
        $PHPIZE_DEPS \
        icu-dev \
        libzip-dev \
        zlib-dev \
    ; \
    \
    docker-php-ext-configure zip --with-libzip; \
    docker-php-ext-install -j$(nproc) \
        intl \
        pdo \
        mysqli \
        pdo_mysql \
        zip \
        bcmath \
    ; \
    pecl install \
        apcu-${APCU_VERSION} \
    ; \
    pecl clear-cache; \
    docker-php-ext-enable \
        apcu \
        opcache \
    ; \
    \
    runDeps="$( \
        scanelf --needed --nobanner --format '%n#p' --recursive /usr/local/lib/php/extensions \
            | tr ',' '\n' \
            | sort -u \
            | awk 'system("[ -e /usr/local/lib/" $1 " ]") == 0 { next } { print "so:" $1 }' \
    )"; \
    apk add --no-cache --virtual .api-phpexts-rundeps $runDeps; \
    \
    apk del .build-deps

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN mkdir /var/www/.composer || echo "Already exists" && chown www-data:www-data /var/www/.composer

ADD php.ini /usr/local/etc/php/conf.d/40-custom.ini

WORKDIR /var/www/

ARG UID
ARG GUID

RUN echo http://dl-2.alpinelinux.org/alpine/edge/community/ >> /etc/apk/repositories
RUN apk --no-cache add shadow && usermod -u $UID www-data && groupmod -g $GUID www-data


CMD ["php-fpm"]