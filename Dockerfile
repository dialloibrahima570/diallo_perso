# Dockerfile Laravel 12 pour Render avec Apache

# 1️⃣ Base PHP + Apache
FROM php:8.5-apache

# 2️⃣ Installer les extensions PHP nécessaires pour Laravel
RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    git \
    curl \
    && docker-php-ext-install pdo pdo_mysql zip

# 3️⃣ Activer mod_rewrite pour Laravel
RUN a2enmod rewrite

# 4️⃣ Copier le projet Laravel dans le container
COPY . /var/www/html

# 5️⃣ Définir DocumentRoot sur le dossier public
RUN sed -i 's#/var/www/html#/var/www/html/public#g' /etc/apache2/sites-available/000-default.conf

# 6️⃣ Installer Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# 7️⃣ Installer les dépendances Laravel
RUN composer install --no-dev --optimize-autoloader

# 8️⃣ Donner les droits sur storage et bootstrap/cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# 9️⃣ Exposer le port 80
EXPOSE 80

# 10️⃣ Lancer Apache en avant-plan
CMD ["apache2-foreground"]
