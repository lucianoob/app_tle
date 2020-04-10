
#!/bin/bash

echo -e "\n### Install App TLE Project ###"

echo -e "\n### Composer Install ###"
composer install

echo -e "\n# Start services (Apache/MySQL)"
sudo service apache2 start
sudo service mysql start

echo -e "\n# Create database..."
echo -e "\n Enter user in mysql: "
read umysql
echo -e "\n Enter password in mysql:"
read pmysql
mysql -u $umysql -p$pmysql <<-EOF
	DROP DATABASE IF EXISTS app_tle;
    CREATE DATABASE app_tle;
EOF

echo -e "\n# Generate key..."
php artisan key:generate

echo -e "\n# Clear database..."
php artisan migrate:refresh

echo -e "\n# Make migrations..."
php artisan migrate

echo -e  "\n# Make seeds..."
php artisan db:seed

echo -e "\n# Execute feature and unit tests..."
phpunit --debug

echo -e "\n### Install Complete !!!\n"
