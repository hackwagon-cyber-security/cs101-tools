# Shopedia Source Code

**Warning**

*Shopedia is a vulnerable web application for learning purposes only. This is a vulnerable web application used in Hackwagon's Cybersecurity 101 course to demonstrate certain concepts. Please do not use this web application in any production environment.*

Any actions and or activities related to the material contained within this course is solely your responsibility.The misuse of the information in this course can result in criminal charges brought against the persons in question. Hackwagon will not be held responsible in the event any criminal charges be brought against any individuals misusing the information in this course to break the law.

## Deployment Guide

### Database

Shopedia is developed using the LAMP stack. The database script is in the "database" folder which has to be imported into the MySQL database.

You have to create a database called "shopedia". The credentials to access the database can be found in "auth/config.php".

### Web Deployment
Please place the shopedia source code in the "/var/www/html" directory (for Apache deployment).