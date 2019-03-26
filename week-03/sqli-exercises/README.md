
``` sql

create database sqldemo;
use database sqldemo;

CREATE TABLE `user` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`username` VARCHAR(128) NOT NULL,
	`password` VARCHAR(128) NOT NULL,
	PRIMARY KEY (`id`)
);
insert into user (username, password) values ('user1','v4fZELEU3NVSxxs41t9K');
insert into user (username, password) values ('user2','mYXmsSAkcFfogodCCNPX');
insert into user (username, password) values ('user3','GCalap4FI0e9XmIs2swT');
insert into user (username, password) values ('user4','xRBPdFViCsDTkShpIoYR');
insert into user (username, password) values ('user5','fJBCjYQXpQwIH65z4k5J');

CREATE TABLE `product` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`product_name` VARCHAR(64),
	`category` VARCHAR(64),
	PRIMARY KEY (`id`)
);

insert into product (product_name, category) values ('apple','fruits');
insert into product (product_name, category) values ('pear','fruits');
insert into product (product_name, category) values ('pineapple','fruits');
insert into product (product_name, category) values ('xiao bai cai','vegetables');
insert into product (product_name, category) values ('broccoli','vegetables');
insert into product (product_name, category) values ('coke','drinks');
insert into product (product_name, category) values ('100 plus','drinks');

```