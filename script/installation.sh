#!/bin/bash
apt-get update -y
apt install apache2 mysql-server php libapache2-mod-php php-mysql -y
systemctl start apache2 mysql
systemctl enable apache2 mysql
cd ~/Desktop && git clone https://github.com/hackwagon-cyber-security/cs101-tools.git
rm -rf /var/www/html/* && cp -r cs101-tools/shopedia-source-code/* /var/www/html/
mysql -u root < cs101-tools/shopedia-source-code/database/shopedia.sql
chown -R ubuntu:ubuntu /var/www/html/
sh -c "echo '127.0.0.1 shopedia.com' >> /etc/hosts"
sh -c "echo '127.0.0.1 www.shopedia.com' >> /etc/hosts"
