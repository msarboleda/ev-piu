#!/usr/bin/env bash

Update () {
  echo ""
  echo "======================================="
  echo "|             Initializing            |"
  echo "======================================="
  echo ""

  echo ""
  echo "Updating Linux..."
  sudo apt-get update
  sudo apt-get upgrade
}

restartApache() {
  echo ""
  echo "Restarting Apache..."
  sudo /etc/init.d/apache2 restart
}

Update

echo ""
echo "Installing common packages..."
sudo apt-get install -y --force-yes vim htop curl build-essential python-software-properties git

echo ""
echo "... configuring Locales"
sudo locale-gen es_CO.UTF-8
sudo dpkg-reconfigure locales

echo ""
echo "Installing Apache..."
sudo apt-get install -y --force-yes apache2

echo ""
echo "Installing MariaDB..."
sudo debconf-set-selections <<< "maria-db-server-10.1 mysql-server/root_password password root"
sudo debconf-set-selections <<< "maria-db-server-10.1 mysql-server/root_password_again password root"
sudo apt-get install -y --force-yes mariadb-server

echo ""
echo "... configuring and securing MariaDB ..."
sudo systemctl enable mysql
sudo systemctl start mysql
echo "DELETE FROM mysql.user WHERE User='';" | mysql -uroot -proot
echo "DELETE FROM mysql.user WHERE User='root' AND Host NOT IN ('localhost', '127.0.0.1', '::1');" | mysql -uroot -proot
echo "DROP DATABASE IF EXISTS test;" | mysql -uroot -proot
echo "DELETE FROM mysql.db WHERE Db='test' OR Db='test\\_%';" | mysql -uroot -proot
echo "FLUSH PRIVILEGES;" | mysql -uroot -proot
sudo systemctl reload mysql

echo ""
echo "Installing PHP 7.0..."
sudo apt-get install -y --force-yes php7.0-common php7.0-dev php7.0-json php7.0-opcache php7.0-cli libapache2-mod-php7.0 php7.0 php7.0-mysql php7.0-fpm php7.0-curl php7.0-gd php7.0-mcrypt mcrypt php-mbstring php7.0-mbstring php7.0-bcmath php7.0-zip php7.0-xmlrpc php-pear php-memcached
Update

echo ""
echo "Configuring PHP & Apache..."
sed -i "s/error_reporting = .*/error_reporting = E_ALL/" /etc/php/7.0/apache2/php.ini
sed -i "s/display_errors = .*/display_errors = On/" /etc/php/7.0/apache2/php.ini
sudo a2enmod rewrite

echo ""
echo "Creating virtual hosts..."
sudo ln -fs /vagrant/webroot/ /var/www/ev-piu
cat << EOF | sudo tee -a /etc/apache2/sites-available/default.conf
<Directory "/var/www/">
    AllowOverride All
</Directory>
<VirtualHost *:80>
    DocumentRoot /var/www/ev-piu/public
    ServerName ev-piu.local
    ServerAlias www.ev-piu.local
</VirtualHost>
<VirtualHost *:80>
    DocumentRoot /var/www/phpmyadmin
    ServerName phpmyadmin.local
    ServerAlias www.phpmyadmin.local
</VirtualHost>
EOF
sudo a2dissite 000-default.conf
sudo a2ensite default.conf
restartApache

echo ""
echo "Installing Composer..."
curl -s https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
sudo chmod +x /usr/local/bin/composer

echo ""
echo "Installing PHPUnit ..."
sudo wget https://phar.phpunit.de/phpunit.phar
sudo chmod +x phpunit.phar
sudo mv phpunit.phar /usr/local/bin/phpunit

echo ""
echo "Installing phpMyAdmin ..."
sudo debconf-set-selections <<< "maria-db-server-10.1 mysql-server/root_password password root"
sudo debconf-set-selections <<< "maria-db-server-10.1 mysql-server/root_password_again password root"
sudo debconf-set-selections <<< "phpmyadmin phpmyadmin/dbconfig-install boolean true"
sudo debconf-set-selections <<< "phpmyadmin phpmyadmin/app-password-confirm password root"
sudo debconf-set-selections <<< "phpmyadmin phpmyadmin/mysql/admin-pass password root"
sudo debconf-set-selections <<< "phpmyadmin phpmyadmin/mysql/app-pass password root"
sudo debconf-set-selections <<< "phpmyadmin phpmyadmin/reconfigure-webserver multiselect none"
sudo apt-get install -y --force-yes phpmyadmin

echo ""
echo "... configuring phpMyAdmin..."
sudo ln -sf /usr/share/phpmyadmin /var/www/phpmyadmin
echo "GRANT ALL PRIVILEGES ON *.* TO 'phpmyadmin'@'localhost' WITH GRANT OPTION;" | mysql -uroot -proot
echo "FLUSH PRIVILEGES;" | mysql -uroot -proot
sudo systemctl reload mysql

echo ""
echo "Installing pre-requisites for SQL Drivers..."
curl -sS https://packages.microsoft.com/keys/microsoft.asc | apt-key add - | php
curl -sS https://packages.microsoft.com/config/ubuntu/16.04/prod.list > /etc/apt/sources.list.d/mssql-release.list | php
sudo apt-get update
sudo ACCEPT_EULA=Y apt-get install -y --force-yes msodbcsql mssql-tools
sudo apt-get install -y --force-yes unixodbc-dev
echo 'export PATH="$PATH:/opt/mssql-tools/bin"' >> ~/.bash_profile
echo 'export PATH="$PATH:/opt/mssql-tools/bin"' >> ~/.bashrc
source ~/.bashrc

echo ""
echo "Installing SQL Drivers..."
sudo pear config-set php_ini `php --ini | grep "Loaded Configuration" | sed -e "s|.*:\s*||"` system
sudo pecl install sqlsrv
sudo pecl install pdo_sqlsrv

echo ""
echo "... assigning permissions to config files..."
sudo chmod 0436 /etc/php/7.0/apache2/php.ini
sudo chmod 0436 /etc/php/7.0/fpm/php.ini
sudo chmod 0436 /etc/php/7.0/cli/php.ini

echo ""
echo "... configuring SQL Drivers..."
sudo a2dismod mpm_event
sudo a2enmod mpm_prefork
sudo a2enmod php7.0
sudo echo "extension=/usr/lib/php/20151012/sqlsrv.so" >> /etc/php/7.0/apache2/php.ini
sudo echo "extension=/usr/lib/php/20151012/pdo_sqlsrv.so" >> /etc/php/7.0/apache2/php.ini
sudo echo "extension=/usr/lib/php/20151012/sqlsrv.so" >> /etc/php/7.0/fpm/php.ini
sudo echo "extension=/usr/lib/php/20151012/pdo_sqlsrv.so" >> /etc/php/7.0/fpm/php.ini
sudo echo "extension=/usr/lib/php/20151012/sqlsrv.so" >> /etc/php/7.0/cli/php.ini
sudo echo "extension=/usr/lib/php/20151012/pdo_sqlsrv.so" >> /etc/php/7.0/cli/php.ini

echo ""
echo "... restoring permissions..."
sudo chmod 0644 /etc/php/7.0/apache2/php.ini
sudo chmod 0644 /etc/php/7.0/fpm/php.ini
sudo chmod 0644 /etc/php/7.0/cli/php.ini
sudo systemctl reload php7.0-fpm
restartApache

echo ""
echo "======================================="
echo "|            Setup Complete           |"
echo "======================================="
echo ""
echo "http://ev-piu.local (192.168.100.100)"
echo ""
echo "phpMyAdmin"
echo "http:/ev-piu.local/phpmyadmin"
echo "User: phpmyadmin"
echo "Pass: root"
echo ""
echo "======================================="
echo ""
