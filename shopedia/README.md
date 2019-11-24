# Shopedia Source Code

**Warning**

*Shopedia is a vulnerable web application for learning purposes only. This is a vulnerable web application used in Hackwagon's Cybersecurity 101 course to demonstrate certain concepts. Please do not use this web application in any production environment.*

Any actions and or activities related to the material contained within this course is solely your responsibility.The misuse of the information in this course can result in criminal charges brought against the persons in question. Hackwagon will not be held responsible in the event any criminal charges be brought against any individuals misusing the information in this course to break the law.

## Deployment Guide

You can use either Docker or the given virtual machines to setup your environment.

### Using Docker
1. First download and install [Docker Desktop here](https://www.docker.com/products/docker-desktop).
2. Open terminal (Mac or Linux), command prompt or Powershell (Windows) and navigate to this directory `cs101-tools/shopedia`.
3. Run `docker-compose build`.
4. Run `docker-compose up`.
5. Fire up Shopedia in your browser at `localhost:8080`.

#### Docker Troubleshooting
If you're getting this error when running `docker-compose up`:
> Error starting userland proxy: listen tcp 0.0.0.0:33060: bind: An attempt was made to access a socket in a way forbidden by its access permissions.

1. Run `netsh interface ipv4 show excludedportrange protocol=tcp`.
2. In `docker-compose.yml > services > db > ports`, change the port number on the left to a number that is not in the output range for the command above. E.g. `33060:3306` to `10101:3306`.
3. Run `docker-compose down`.
4. Run `docker-compose build`.
5. Run `docker-compose up`.

### Using the given virtual machine

#### Database

Shopedia is developed using the LAMP stack. The database script is in the "database" folder which has to be imported into the MySQL database.

You have to create a database called "shopedia". The credentials to access the database can be found in "auth/config.php".

### Web Deployment
Please place the shopedia source code in the "/var/www/html" directory (for Apache deployment).