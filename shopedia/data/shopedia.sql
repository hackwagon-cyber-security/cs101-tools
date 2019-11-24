

DROP DATABASE IF EXISTS shopedia;
CREATE DATABASE shopedia;

USE shopedia;


CREATE TABLE orders (
  userId int(11) NOT NULL,
  creditCardNumber text NOT NULL,
  cvvNumber text NOT NULL,
  expiryDate text NOT NULL,
  fullName text NOT NULL,
  cartItems text NOT NULL,
  orderId int(11) NOT NULL,
  amountPaid float NOT NULL,
  UNIQUE KEY orderId (orderId)
);


CREATE TABLE products (
  id INT(6) AUTO_INCREMENT PRIMARY KEY, 
  productName varchar(512) NOT NULL,
  productDesc text NOT NULL,
  cost float NOT NULL,
  createdAt timestamp NOT NULL DEFAULT current_timestamp(),
  status varchar(255) NOT NULL,
  belongsTo int(255) NOT NULL,
  imgPath text NOT NULL,
  productCategory text NOT NULL
);


INSERT INTO products VALUES (17,'Blue Bag','Super awesome bag',45.3,'2018-09-06 08:48:40','draft',5,'/uploads/0H2wY1lys6jPb93hi.jpg','Bag'),(18,'Nike Flex','Awesome shoes',69.99,'2018-09-06 08:49:32','draft',5,'/uploads/QKTExDXuAGkj429md.jpeg','Shoes'),(19,'Basket Ball Shoes','Pair of NIKE basketball shoes',120,'2018-09-06 09:58:49','draft',5,'/uploads/y9L2lvNdfuGWseTxA.jpg','Shoes'),(20,'Bagpipes','Musical Instrument',34.99,'2018-09-06 10:02:03','draft',5,'/uploads/9Qkutrbwesa57p8VT.jpg','Music Instrument');

CREATE TABLE users (
  id INT(10) AUTO_INCREMENT PRIMARY KEY,
  email varchar(256) NOT NULL,
  password varchar(256) NOT NULL,
  accountType varchar(256) NOT NULL,
  createdAt timestamp NOT NULL DEFAULT current_timestamp()
);

INSERT INTO users VALUES
(1,'1@gmail.com','123123','merchant','2018-09-03 08:19:00'),(2,'2@gmail.com','123123','merchant','2018-09-03 08:21:07'),(3,'3@gmail.com','123123','merchant','2018-09-03 08:22:47');
