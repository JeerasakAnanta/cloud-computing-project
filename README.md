# BSCCS409 การประมวลผลกลุ่ม เมฆ Cloud Computing


## 1. php +  Mysql  
## 2. nodejs + Mysql

## 3. flask + Mysql

## setup ubuntu web server 
- Update system  
```sh 
sudo apt update && sudo apt upgrade -y
```
- Configure timezone
```
sudo timedatectl set-timezone Asia/Bangkok
```

- Set Up a Firewall
```
sudo apt install ufw
sudo ufw allow ssh
sudo ufw enable
```
- install apache2
```
sudo apt install apache2
```
## setup ubuntu mysql server
- 
## setup phpmyadmin
- 
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