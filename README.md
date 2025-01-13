# BSCCS409 การประมวลผลกลุ่ม เมฆ Cloud Computing

## setup ubuntu web server 
- Update system  
```sh 
sudo apt update && sudo apt upgrade -y
```
- Configure timezone
```sh
sudo timedatectl set-timezone Asia/Bangkok
```

- Set Up a Firewall
```sh
sudo apt install ufw
sudo ufw allow ssh
sudo ufw enable
```
- install apache server
```sh 
sudo ufw allow http  
```
```sh
sudo apt install apache2 -y 
```
sudo systemctl status apache2
```
sudo systemctl restart apache2 
```

## setup ubuntu mysql server
- allow mysql port 
```sh
sudo ufw allow mysql
```

- install mysql server  
```sh
sudo apt install mysql-server -y
```
- check mysql status 
```sh 
sudo systemctl status mysql 
```

## setup phpmyadmin
- allow phpmyadmin port
```sh 
sudo ufw allow 80/tcp
```
```sh 
sudo apt-get install php libapache2-mod-php php-mysql -y

```
```sh
sudo apt install phpmyadmin php-mbstring php-zip php-gd php-json php-curl -y
```
- web server to configure phpmyadmin  `apach2`
- insall 
```sh 
sudo systemctl restart apache2
```
- กำหนดให้กับ MySQL และ phpmyadmin
```sh 
sudo mysql -u root -p 
```
```sql
SELECT user,authentication_string,plugin,host FROM mysql.user;
```
- เปลี่ยนรหัสผ่าน
```sql 
ALTER USER 'root'@'localhost' IDENTIFIED WITH caching_sha2_password BY 'admin2004';
```
```sql
FLUSH PRIVILEGES;
```
- create new user 
```sh 
sudo mysql -u root -p 
```
```sql
CREATE USER 'adminweb'@'localhost' IDENTIFIED BY 'adminadmin';
```
```sql
GRANT ALL PRIVILEGES ON *.* TO 'your_username'@'localhost' WITH GRANT OPTION;
```
```sql
exit;
```
## 1. php +  Mysql  
## 2. nodejs + Mysql
- install independent package
```
npm install 

```
- run project 
```
npm run dev  
```

## 3. flask + Mysql
## setup nodejs
- install nodejs 
```
sudo apt install nodejs
```
- install npm
```
sudo apt install npm
```
-
```
npm install express mysql2 body-parser
```

## create mysql database 
- creat databaes 
```sql
CREATE DATABASE restaurant_db;
```
- use database
```sql 
USE restaurant_db;
```
- creat table
```sql
CREATE TABLE menu (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```
- insert data
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
- check sql query in `db.sql`
```sql
SELECT * from menu;
```