# BSCCS409 การประมวลผลกลุ่ม เมฆ Cloud Computing
- by jeerasak ananta ss4 CSRMUTL NAN this repository is for educational purpose only of Cloud Computing course at RMUTL Nan Cloud Computing setup and configuration for Ubuntu Web Server, MySQL, Node.js, Flask, and PHP. for web development with MySQL database.

## Content of this repository 
- [BSCCS409 การประมวลผลกลุ่ม เมฆ Cloud Computing](#bsccs409-การประมวลผลกลุ่ม-เมฆ-cloud-computing)
  - [Content of this repository](#content-of-this-repository)
  - [Setup Ubuntu Web Server](#setup-ubuntu-web-server)
    - [Set Up a Firewall](#set-up-a-firewall)
  - [install Apache server](#install-apache-server)
  - [Setup Ubuntu MySQL Server](#setup-ubuntu-mysql-server)
  - [Setup phpMyAdmin](#setup-phpmyadmin)
  - [Setup Node.js](#setup-nodejs)
  - [Create MySQL Database](#create-mysql-database)
- [Reference](#reference)

## Setup Ubuntu Web Server 
- Update system  
```sh 
sudo apt update && sudo apt upgrade -y
```
- Configure timezone
```sh
sudo timedatectl set-timezone Asia/Bangkok
```
### Set Up a Firewall
- Install UFW
```sh
sudo apt install ufw
```
- Allow SSH port
```sh
sudo ufw allow ssh
```
- Enable UFW
```sh
sudo ufw enable
```
## install Apache server
- Allow Apache port
```sh
sudo ufw allow http
```

- Install Apache server
```sh 
sudo apt install apache2 -y
```
- Check Apache status 
```sh
sudo systemctl status apache2
```
- Check Apache version 
```sh
sudo systemctl restart apache2 
```

## Setup Ubuntu MySQL Server
- Allow MySQL port 
```sh
sudo ufw allow mysql
```
- Install MySQL server  
```sh
sudo apt install mysql-server -y
```
- Check MySQL status 
```sh 
sudo systemctl status mysql 
```

## Setup phpMyAdmin
- Allow phpMyAdmin port
```sh 
sudo ufw allow 80/tcp
```
- Install PHP 
```sh 
sudo apt-get install php libapache2-mod-php php-mysql -y
```
- Install phpMyAdmin
```sh
sudo apt install phpmyadmin php-mbstring php-zip php-gd php-json php-curl -y
```
- Configure phpMyAdmin with Apache
```sh 
sudo systemctl restart apache2
```
- Configure MySQL and phpMyAdmin
```sh 
sudo mysql -u root -p 
```
```sql
SELECT user, authentication_string, plugin, host FROM mysql.user;
```
- Change root password
```sql 
ALTER USER 'root'@'localhost' IDENTIFIED WITH caching_sha2_password BY 'admin2004';
FLUSH PRIVILEGES;
```
- Create new user 
```sh 
sudo mysql -u root -p 
```
```sql
CREATE USER 'adminweb'@'localhost' IDENTIFIED BY 'adminadmin';
GRANT ALL PRIVILEGES ON *.* TO 'adminweb'@'localhost' WITH GRANT OPTION;
exit;
```

## Setup Node.js
- Install Node.js 
```sh
sudo apt install nodejs
```
- Install npm
```sh
sudo apt install npm
```
- Install required packages
```sh
npm install express mysql2 body-parser
```

## Create MySQL Database 
- Create database 
```sql
CREATE DATABASE restaurant_db;
```
- Use database
```sql 
USE restaurant_db;
```
- Create table
```sql
CREATE TABLE menu (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```
- Insert data
```sql 
INSERT INTO menu (name, description, price) VALUES 
('ข้าวผัดกระเพรา', 'ข้าวผัดกับเนื้อหมูหรือไก่ และผักกระเพราสับ', 60.00),
('ต้มยำกุ้ง', 'ซุปต้มยำที่มีรสเผ็ดและเปรี้ยว ทำจากกุ้งสด', 120.00),
('ผัดไทย', 'เส้นก๋วยเตี๋ยวผัดกับกุ้ง ไข่ และถั่วลิสง', 70.00),
('แกงเขียวหวาน', 'แกงที่มีรสชาติเค็มและเผ็ดกับเนื้อปลา', 90.00),
('ส้มตำไทย', 'สลัดมะละกอสุกที่มีรสเผ็ดรู้จักกันดี', 50.00),
('ข้าวมันไก่', 'ข้าวมันน้ำมันไก่พร้อมด้วยซุปไก่', 80.00),
('กุ้งทอดกระเทียม', 'กุ้งทอดกรอบกับกระเทียมเจียว', 100.00),
('ทอดมันปลา', 'ทอดมันปลากับน้ำจิ้มอร่อย', 70.00),
('ปอเปี๊ยะสด', 'ปอเปี๊ยะสดที่มีผักและกุ้ง', 60.00),
('ขนมจีนน้ำยา', 'ขนมจีนเสิร์ฟกับน้ำยาปลาหรือกะทิ', 75.00),
('หอยทอด', 'หอยทอดกรอบทานคู่กับน้ำจิ้ม', 80.00),
('ปลาทอดสมุนไพร', 'ปลาทอดกรอบโรยด้วยสมุนไพร', 120.00),
('ข้าวเหนียวมะม่วง', 'ข้าวเหนียวหวานกับมะม่วงสุก', 55.00),
('เนื้อย่าง', 'เนื้อย่างร้อนๆ ทานคู่กับน้ำจิ้ม', 130.00),
('หมูปิ้ง', 'หมูปิ้งย่างร้อนที่มีรสชาติหวาน', 20.00),
('ซุปเห็ด', 'ซุปเห็ดที่มีรสชาติกลมกล่อม', 65.00),
('ข้าวซอย', 'ข้าวซอยเส้นหมี่กับซุปกะทิ', 85.00),
('ข้าวเปล่าหมูทอด', 'ข้าวพร้อมหมูทอดกรอบเสิร์ฟ', 55.00),
('ปลาหมึกย่าง', 'ปลาหมึกย่างกับน้ำจิ้มซีฟู้ด', 95.00),
('ไข่เจียว', 'ไข่เจียวที่มีรสชาติอร่อย', 40.00);
```
- Check SQL query in `db.sql`
```sql
SELECT * FROM menu;
```
# Reference 
- [How To Install Linux, Apache, MySQL, PHP (LAMP) stack on Ubuntu 20.04](https://www.digitalocean.com)
- [How To Install MySQL on Ubuntu 20.04](https://www.digitalocean.com)
- [How To Install phpMyAdmin with LAMP on Ubuntu 20.04](https://www.digitalocean.com)
