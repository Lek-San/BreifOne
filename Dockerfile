FROM php:8.1-cli
COPY . /usr/src/BreifOne
WORKDIR /usr/src/BreifOne
CMD [ "php", "./public/index.php" ]