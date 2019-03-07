#!/bin/bash
cd ~/Desktop
wget https://github.com/hackwagon-cyber-security/cs101-tools/raw/master/script/upload.zip
unzip upload.zip -d .
cd ~/Desktop/upload/
cp -R * /var/www/
rm -R ~/Desktop/upload
rm ~/Desktop/upload.zip
mysql -uroot -p'password' <<EOF
use shopedia;
alter table products modify column id int auto_increment;
EOF
exit