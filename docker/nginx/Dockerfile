FROM nginx:stable

RUN apt-get update \
    && apt-get install -y gnupg curl \
    && curl -sL https://deb.nodesource.com/setup_8.x | bash - \
        && apt-get update \
    && apt-get install -y nodejs npm libpng-dev nasm \
    && apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* \
    && ln -sf /dev/stdout /var/log/nginx/access.log \
	&& ln -sf /dev/stderr /var/log/nginx/error.log

WORKDIR /app

COPY docker/nginx/config/default.conf /etc/nginx/sites-enabled/default
COPY docker/nginx/config/nginx.conf /etc/nginx/nginx.conf
COPY docker/nginx/config/custom.conf /etc/nginx/conf.d/custom.conf
COPY docker/nginx/config/conf.d/mapping.conf /etc/nginx/conf.d/mapping.conf
COPY docker/nginx/config/conf.d/buffer.conf /etc/nginx/conf.d/buffer.conf
COPY docker/nginx/config/conf.d/timeouts.conf /etc/nginx/conf.d/timeouts.conf
RUN rm /etc/nginx/conf.d/default.conf

COPY . /app

EXPOSE 80
CMD ["nginx", "-g", "daemon off;"]