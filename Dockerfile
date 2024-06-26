FROM dunglas/frankenphp:latest-php8.3-alpine

ENV SERVER_NAME=:80

RUN install-php-extensions \
    curl \
	gd \
	intl \
	opcache \
	pdo_mysql \
    redis \
	zip

# ARG USER=www-data

# RUN \
#     # Use "adduser -D ${USER}" for alpine based distros
#     useradd -D ${USER}; \
#     # Add additional capability to bind to port 80 and 443
#     setcap CAP_NET_BIND_SERVICE=+eip /usr/local/bin/frankenphp; \
#     # Give write access to /data/caddy and /config/caddy
#     chown -R ${USER}:${USER} /data/caddy && chown -R ${USER}:${USER} /config/caddy

# USER ${USER}

COPY . /app
