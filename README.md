# BSCCS409 การประมวลผลกลุ่มเมฆ Cloud Computing
- จัดทำโดย จีรศักดิ์ อนันต๊ะ SS4 CSRMUTL น่าน ที่เก็บนี้มีวัตถุประสงค์เพื่อ การศึกษาสำหรับรายวิชา การประมวลผลกลุ่มเมฆที่ RMUTL น่าน การตั้งค่า และ การกำหนดค่าสำหรับ รายวิชา Cloud Computing สำหรับ **Ubuntu Web Server**,**MySQL**, **Node JS**, **Flask**, และ **PHP** สำหรับการพัฒนาเว็บการเชื่อมต่อฐานข้อมูล ด้วย  **MySQL** 

## เนื้อหาการตั้งค่า 
- [BSCCS409 การประมวลผลกลุ่มเมฆ Cloud Computing](#bsccs409-การประมวลผลกลุ่มเมฆ-cloud-computing)
  - [เนื้อหาการตั้งค่า](#เนื้อหาการตั้งค่า)
  - [คู่มือการติดตั้งเพิ่มเติม](#คู่มือการติดตั้งเพิ่มเติม)
  - [ตั้งค่า Ubuntu WebServer](#ตั้งค่า-ubuntu-webserver)
    - [ตั้งค่าไฟร์วอลล์](#ตั้งค่าไฟร์วอลล์)
  - [ติดตั้ง Apache server](#ติดตั้ง-apache-server)
  - [ตั้งค่า Ubuntu MySQL Server](#ตั้งค่า-ubuntu-mysql-server)
  - [ตั้งค่า phpMyAdmin](#ตั้งค่า-phpmyadmin)
  - [ตั้งค่า Node.js](#ตั้งค่า-nodejs)
  - [สร้างฐานข้อมูล MySQL](#สร้างฐานข้อมูล-mysql)
- [อ้างอิง](#อ้างอิง)

## คู่มือการติดตั้งเพิ่มเติม
- [Wordpress กับ MySQL]()
- [PHP กับ MySQL](https://github.com/JeerasakAnanta/cloud-computing-project/tree/main/php_mysql)
  
- [Node.js กับ MySQL](https://github.com/JeerasakAnanta/cloud-computing-project/tree/main/nodejs_mysql)
- [Flask กับ MySQL](https://github.com/JeerasakAnanta/cloud-computing-project/tree/main/flask_mysql) 
- [Deploy iris model](https://github.com/JeerasakAnanta/cloud-computing-project/tree/main/iris_model)
---
## ตั้งค่า Ubuntu WebServer
- อัปเดตระบบ  
```sh 
sudo apt update && sudo apt upgrade -y
```
- ตั้งค่าเวลา
```sh
sudo timedatectl set-timezone Asia/Bangkok
```
### ตั้งค่าไฟร์วอลล์
- ติดตั้ง UFW
```sh
sudo apt install ufw
```
- เปิดใช้งาน UFW
```sh
sudo ufw enable
```
- อนุญาตพอร์ต SSH
```sh
sudo ufw allow ssh
```
- ตัวสอบ FUW
```sh
sudo ufw status
```


## ติดตั้ง Apache server
- อนุญาตพอร์ต Apache
```sh
sudo ufw allow http
```

- ติดตั้ง Apache server
```sh 
sudo apt install apache2 -y
```
- ตรวจสอบสถานะ Apache 
```sh
sudo systemctl status apache2
```
- ตรวจสอบเวอร์ชัน Apache 
```sh
sudo systemctl restart apache2 
```

## ตั้งค่า Ubuntu MySQL Server
- อนุญาตพอร์ต MySQL 
```sh
sudo ufw allow mysql
```
- ติดตั้ง MySQL server  
```sh
sudo apt install mysql-server -y
```
- ตรวจสอบสถานะ MySQL 
```sh 
sudo systemctl status mysql 
```

## ตั้งค่า phpMyAdmin
- อนุญาตพอร์ต phpMyAdmin
```sh 
sudo ufw allow 80/tcp
```
- ติดตั้ง PHP 
```sh 
sudo apt-get install php libapache2-mod-php php-mysql -y
```
- ติดตั้ง phpMyAdmin
```sh
sudo apt install phpmyadmin php-mbstring php-zip php-gd php-json php-curl -y
```
- กำหนดค่า phpMyAdmin กับ Apache
```sh 
sudo systemctl restart apache2
```
- กำหนดค่า MySQL และ phpMyAdmin
```sh 
sudo mysql -u root -p 
```
```sql
SELECT user, authentication_string, plugin, host FROM mysql.user;
```
- เปลี่ยนรหัสผ่าน root
```sql 
ALTER USER 'root'@'localhost' IDENTIFIED WITH caching_sha2_password BY 'admin2004';
FLUSH PRIVILEGES;
```
- สร้างผู้ใช้ใหม่ 
```sh 
sudo mysql -u root -p 
```
```sql
CREATE USER 'adminweb'@'localhost' IDENTIFIED BY 'adminadmin';
GRANT ALL PRIVILEGES ON *.* TO 'adminweb'@'localhost' WITH GRANT OPTION;
exit;
```

## ตั้งค่า Node.js
- ติดตั้ง Node.js 
```sh
sudo apt install nodejs
```
- ติดตั้ง npm
```sh
sudo apt install npm
```
- ติดตั้งแพ็คเกจที่จำเป็น
```sh
npm install express mysql2 body-parser
```

## สร้างฐานข้อมูล MySQL 
- สร้างฐานข้อมูล 
```sql
CREATE DATABASE restaurant_db;
```
- ใช้ฐานข้อมูล
```sql 
USE restaurant_db;
```
- สร้างตาราง
```sql
CREATE TABLE menu (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```
- เพิ่มข้อมูล
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
- ตรวจสอบคำสั่ง SQL ใน `db.sql`
```sql
SELECT * FROM menu;
```
# อ้างอิง 
- [How To Install Linux, Apache, MySQL, PHP (LAMP) stack on Ubuntu 20.04](https://www.digitalocean.com)
- [How To Install MySQL on Ubuntu 20.04](https://www.digitalocean.com)
- [How To Install phpMyAdmin with LAMP on Ubuntu 20.04](https://www.digitalocean.com)