# -----------------------------------------------------------------------------
# Stage 1: Vendor (Composer dependencies)
# -----------------------------------------------------------------------------
FROM composer:2 AS vendor

WORKDIR /app

COPY composer.json composer.lock ./

ARG INSTALL_DEV=true
RUN composer install \
    $( [ "$INSTALL_DEV" = "true" ] || echo "--no-dev" ) \
    --no-interaction \
    --no-autoloader \
    --no-scripts \
    --prefer-dist

COPY . .

RUN composer dump-autoload --optimize

# -----------------------------------------------------------------------------
# Stage 2: Assets (Frontend compilation with Node & Vite)
# -----------------------------------------------------------------------------
FROM node:22-alpine AS assets

WORKDIR /app

COPY package.json package-lock.json ./
RUN npm ci

COPY vite.config.js tailwind.config.js postcss.config.js ./
COPY resources ./resources
COPY public ./public

RUN npm run build

# -----------------------------------------------------------------------------
# Stage 3: Runtime (FrankenPHP)
# -----------------------------------------------------------------------------
FROM dunglas/frankenphp:php8.4 AS runtime

# Install PHP extensions required for Laravel & MySQL
RUN install-php-extensions \
    pdo_mysql \
    bcmath \
    opcache \
    intl \
    zip \
    pcntl \
    gd \
    curl

# Copy custom PHP and Caddy configuration
COPY docker/php.ini $PHP_INI_DIR/conf.d/99-app.ini
COPY docker/Caddyfile /etc/caddy/Caddyfile

WORKDIR /app

# Copy application source code
COPY . .

# Copy compiled vendor and frontend assets from previous stages
COPY --from=vendor /app/vendor ./vendor
COPY --from=assets /app/public/build ./public/build

# Set permissions for storage and bootstrap cache
RUN chown -R www-data:www-data /app/storage /app/bootstrap/cache \
    && chmod -R 775 /app/storage /app/bootstrap/cache

# Configure FrankenPHP Caddy server
ENV SERVER_NAME=":8080"
ENV FRANKENPHP_CONFIG="worker ./public/index.php"

EXPOSE 8080

HEALTHCHECK --interval=30s --timeout=5s --start-period=10s --retries=3 \
    CMD curl -fsS http://localhost:8080/up || exit 1

CMD ["frankenphp", "run", "--config", "/etc/caddy/Caddyfile"]
