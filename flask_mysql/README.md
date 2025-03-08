# คู่มือการติดตั้ง และใช้งาน Flask กับ MySQL บน Ubuntu Server 24.10

--- 
## ติดตั้ง Flask และ MySQL

## ตั้งค่า Ubuntu WebServer
- อัปเดตระบบ  
```sh 
sudo apt update && sudo apt upgrade -y
```
- ตั้งค่าเวลาของ server
```sh
sudo timedatectl set-timezone Asia/Bangkok
```
### ตั้งค่าไฟร์วอลล์ server 
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
- ตรวจสอบสถานะ Apache webserver 
```sh
sudo systemctl status apache2
```
- restart Apache server 
```sh
sudo systemctl restart apache2 
```

## ติดตั้งและตั้งค่า  MySQL Server
- อนุญาตพอร์ต สำหรับ MySQL 
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

## ติดตั้ง และตั้งค่า phpMyAdmin
- อนุญาตพอร์ต phpMyAdmin
```sh 
sudo ufw allow 80/tcp
```
- ติดตั้ง PHP 
```sh 
sudo apt-get install php libapache2-mod-php php-mysql -y
```
- ตวจสอบเวอร์ชั่น PHP
```sh
php -v
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
- สร้างฐานข้อมูลสำหรับ phpMyAdmin 
```sql
SELECT user, authentication_string, plugin, host FROM mysql.user;
```
- เปลี่ยนรหัสผ่าน root
```sql 
ALTER USER 'root'@'localhost' IDENTIFIED WITH caching_sha2_password BY 'admin2004';
FLUSH PRIVILEGES;
```
- สร้างผู้ใช้ใหม่ 

```sql
CREATE USER 'adminweb'@'localhost' IDENTIFIED BY 'adminadmin';
GRANT ALL PRIVILEGES ON *.* TO 'adminweb'@'localhost' WITH GRANT OPTION;
exit;
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
- เพิ่มข้อมูล mockup
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

# ติดตั้ง โปรเจค Flask 
## clone  โปรเจค จาก GitHub
```sh
git clone https://github.com/JeerasakAnanta/cloud-computing-project.git

cd cloud-computing-project/flask_mysql
```
- list ไฟล์
```sh
ls
```
- install virtualenv
```sh
sudo apt install python3-venv -y
```
- สร้าง virtualenv
```sh
python3 -m venv .env_flask_mysql
```
- เปิดใช้งาน virtualenv
```sh
source venv/bin/activate
```
- ติดตั้ง independent package
```sh
pip install -r requirements.txt
```
- ทำสอบ pip list
```bash
pip list 
```
- สร้างไฟล์ `.env`
```sh
touch .env
```
- เเก้ไขไฟล์ `.env` ใช้งาน vim 
```bash
vim .env
```

## เปลี่ยน  environment variable 
```bash
DB_HOST='10.50.80.97'
DB_USER='root'
DB_PASSWORD='admin2004'
DB_NAME='restaurant_db'
```
## start app with flask
```sh
flask run --host=0.0.0.0 
```

# คู่มือการติดตั้ง และใช้งาน Flask กับ MySQL บน Digital Ocean Ubuntu Server 24.10

---
## ติดตั้ง Flask และ MySQL

## ตั้งค่า Ubuntu WebServer
- อัปเดตระบบ  
```sh
sudo apt update && sudo apt upgrade -y
```
- ตั้งค่าเวลาของ server
```sh
sudo timedatectl set-timezone Asia/Bangkok
```
### ตั้งค่าไฟร์วอลล์ server
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
- ตรวจสอบสถานะ Apache webserver
```sh
sudo systemctl status apache2
```
- restart Apache server
```sh
sudo systemctl restart apache2
```

## ติดตั้งและตั้งค่า  MySQL Server
- อนุญาตพอร์ต สำหรับ MySQL
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

## ติดตั้ง และตั้งค่า phpMyAdmin
- อนุญาตพอร์ต phpMyAdmin
```sh
sudo ufw allow 80/tcp
```
- ติดตั้ง PHP
```sh
sudo apt-get install php libapache2-mod-php php-mysql -y
```
- ตวจสอบเวอร์ชั่น PHP
```sh
php -v
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
- สร้างฐานข้อมูลสำหรับ phpMyAdmin
```sql
SELECT user, authentication_string, plugin, host FROM mysql.user;
```
- เปลี่ยนรหัสผ่าน root
```sql
ALTER USER 'root'@'localhost' IDENTIFIED WITH caching_sha2_password BY 'admin2004';
FLUSH PRIVILEGES;
```
- สร้างผู้ใช้ใหม่

```sql
CREATE USER 'adminweb'@'localhost' IDENTIFIED BY 'adminadmin';
GRANT ALL PRIVILEGES ON *.* TO 'adminweb'@'localhost' WITH GRANT OPTION;
exit;
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
- เพิ่มข้อมูล mockup
```sql
INSERT INTO menu (name, description, price) VALUES
('ข้าวผัดกระเพรา', 'ข้าวผัดกับเนื้อหมูหรือไก่ และผักกระเพราสับ', 60.00),
('ต้มยำกุ้ง', 'ซุปต้มยำที่มีรสเผ็ดและเปรี้ยว ทำจากกุ้งสด', 120.00),
('ผัดไทย', 'เส้นก๋วยเตี๋ยวผัดกับกุ้ง ไข่ และถั่วลิสง', 70.00),
('แกงเขียวหวาน', 'แกงที่มีรสชาติเค็มและเผ็ดกับเนื้อปลา', 90.00),
('ส้มตำไทย', 'สลัดมะละกอสุกที่มีรสเผ็ดรู้จักกันดี', 50.00);
```
- ตรวจสอบคำสั่ง SQL ใน `db.sql`
```sql
SELECT * FROM menu;
```

# ติดตั้ง โปรเจค Flask
## clone  โปรเจค จาก GitHub
```sh
git clone https://github.com/JeerasakAnanta/cloud-computing-project.git

cd cloud-computing-project/flask_mysql
```
- list ไฟล์
```sh
ls
```
- install virtualenv
```sh
sudo apt install python3-venv -y
```
- สร้าง virtualenv
```sh
python3 -m venv .env_flask_mysql
```
- เปิดใช้งาน virtualenv
```sh
source venv/bin/activate
```
- ติดตั้ง independent package
```sh
pip install -r requirements.txt
```
- ทำสอบ pip list
```bash
pip list
```
- สร้างไฟล์ `.env`
```sh
touch .env
```
- เเก้ไขไฟล์ `.env` ใช้งาน vim
```bash
vim .env
```

## เปลี่ยน  environment variable
```bash
DB_HOST='10.50.80.97'
DB_USER='root'
DB_PASSWORD='admin2004'
DB_NAME='restaurant_db'
```
## start app with flask
```sh
flask run --host=0.0.0.0
```

# Install Project on Digital Ocean
