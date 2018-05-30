FROM ubuntu:latest

RUN rm /bin/sh && ln -s /bin/bash /bin/sh

ENV TZ=America/Los_Angeles
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

RUN apt-get -y update
RUN apt-get -y install zip
RUN apt-get -y install curl
RUN apt-get -y install build-essential
RUN apt-get -y install libpng-dev git
RUN apt-get -y install php php-xml php-mbstring

RUN rm -rf ./vendor/

WORKDIR /app

COPY . /app

RUN curl -sS https://getcomposer.org/installer | php; mv composer.phar /usr/local/bin/composer

RUN cd /app; composer install --verbose

EXPOSE 80

CMD ["/usr/bin/php", "-S", "0.0.0.0:80", "/app/public/index.php"]

