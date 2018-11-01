FROM linode/lamp:latest

# Create app directory
WORKDIR /var/www/html

COPY ./Ecom_store/* ./

RUN service apache2 start && service mysql start
