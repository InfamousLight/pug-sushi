############################################################
# Dockerfile to build Nginx Installed Containers
# Based on Ubuntu
############################################################

# Set the base image to Ubuntu
FROM ubuntu:16.04

# ensure UTF-8
ENV LANG       en_US.UTF-8
ENV LC_ALL     en_US.UTF-8

# File Author / Maintainer
MAINTAINER ResponseGenius

COPY ./ var/www
RUN mkdir /var/run/php
RUN chmod 777 /var/run
RUN chmod -R o+w var/www/storage
RUN chmod 755 -R var/www

# Update commands
RUN apt-get update
RUN apt-get install -y language-pack-en-base
RUN apt-get install -y software-properties-common
RUN LC_ALL=en_US.UTF-8 add-apt-repository ppa:ondrej/php
RUN apt-get update

# Add application repository URL to the default sources
RUN add-apt-repository "deb http://archive.ubuntu.com/ubuntu $(lsb_release -sc) universe"

# Update the repository
RUN apt-get update

# Install necessary tools
RUN apt-get install -y nano wget dialog net-tools vim locate git curl

# Download and Install Nginx
RUN apt-get install -y nginx

# Remove the default Nginx configuration file
RUN rm -v /etc/nginx/sites-enabled/default

# Copy a configuration file from the current directory
ADD nginx.conf /etc/nginx/sites-enabled/default

# Append "daemon off;" to the beginning of the configuration
RUN echo "daemon off;" >> /etc/nginx/nginx.conf

# install php7.0
RUN apt-get install -y php7.0-fpm
RUN apt-get install -y php7.0-mysql
RUN apt-get install -y php7.0-mbstring
RUN apt-get install -y phpunit
RUN apt-get install -y php7.0-zip
RUN apt-get install -y php7.0-curl

#composer install
RUN curl -sS https://getcomposer.org/installer | php
RUN mv composer.phar /usr/local/bin/composer

# Expose ports
EXPOSE 80

# Set the default command to execute
# when creating a new container
CMD service nginx start
#CMD /etc/init.d/php7.0-fpm restart

# Starting Directory on SSH
WORKDIR /var/www/
RUN updatedb
#RUN composer install
