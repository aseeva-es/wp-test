FROM php:8.3.13-cli
COPY . /app
WORKDIR /app

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    && rm -rf /var/lib/apt/lists/*
RUN composer install --no-dev --optimize-autoloader

CMD [ "php", "app.php" ]
