FROM php:7.4-cli

RUN apt-get update && apt-get install -y \
    libpq-dev \
    wget \
    zlib1g-dev \
    libmcrypt-dev \
    libzip-dev \
    git

RUN docker-php-ext-install pdo pdo_mysql

RUN wget https://getcomposer.org/installer -O - -q | php -- --install-dir=/bin --filename=composer --quiet

WORKDIR /symfony

COPY docker/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh
ENTRYPOINT ["/entrypoint.sh"]
CMD ["true"]