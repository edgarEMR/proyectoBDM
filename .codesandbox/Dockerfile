# CodeSandbox supports debian and ubuntu based images
FROM debian:bullseye

# Install htop by default
RUN apt update -y && apt install -y htop

# Install PHP & Composer
RUN apt update -y && DEBIAN_FRONTEND=noninteractive apt install -y curl php-cli php-mbstring git unzip && \
  cd ~ && \
  curl -sS https://getcomposer.org/installer -o composer-setup.php && \
  php composer-setup.php --install-dir=/usr/local/bin --filename=composer && \
  composer --version


# Install Node v16 and NPM
RUN apt update -y && apt install -y curl && \
  curl -sL https://deb.nodesource.com/setup_16.x | bash - && \
  apt update -y && apt install -y nodejs
