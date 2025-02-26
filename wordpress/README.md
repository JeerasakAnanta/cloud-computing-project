# ⚙️ คู่มือการติดตั้ง WordPress บน Ubuntu Server

---

## 👉 ความต้องการ

- WordPress เป็น CMS ที่ได้รับความนิยมมากที่สุดในโลก
- พัฒนาด้วย PHP และ MySQL
- มีปลั๊กอินและธีมให้ใช้ฟรี
- ใช้งานง่าย ปรับแต่งได้ และสามารถเผยแพร่ไปยังเซิร์ฟเวอร์จริงได้ง่าย
- ในคู่มือนี้ เราจะติดตั้ง WordPress บน Ubuntu 20.04
- จะใช้ Apache2, MySQL และ PHP

---

### **ขั้นตอนที่ 1: อัปเดตระบบของคุณ**

ตรวจสอบให้แน่ใจว่าระบบของคุณเป็นเวอร์ชันล่าสุด:

```bash
sudo apt update && sudo apt upgrade -y
```

### **ขั้นตอนที่ 2: ติดตั้ง Apache Web Server**

Apache เป็นเว็บเซิร์ฟเวอร์ยอดนิยมที่จะใช้โฮสต์เว็บไซต์ WordPress ของคุณ

```bash
sudo apt install apache2 -y
```

- เริ่มต้นและเปิดใช้งาน Apache:

  ```bash
  sudo systemctl start apache2
  sudo systemctl enable apache2
  ```

- ตรวจสอบว่า Apache กำลังทำงาน:

  ```bash
  sudo systemctl status apache2
  ```

---

### **ขั้นตอนที่ 3: ติดตั้ง MySQL Database**

MySQL จะใช้เก็บข้อมูลของ WordPress

```bash
sudo apt install mysql-server -y
```

- ปรับแต่งความปลอดภัยของ MySQL:

  ```bash
  sudo mysql_secure_installation
  ```

  ทำตามคำแนะนำเพื่อตั้งรหัสผ่าน root และปรับแต่งความปลอดภัยของฐานข้อมูล

---

### ติดตั้งแพ็คเกจที่จำเป็น

```bash
sudo apt install apache2 \
                 ghostscript \
                 libapache2-mod-php \
                 mysql-server \
                 php \
                 php-bcmath \
                 php-curl \
                 php-imagick \
                 php-intl \
                 php-json \
                 php-mbstring \
                 php-mysql \
                 php-xml \
                 php-zip -y 
```

---

### **ขั้นตอนที่ 4: ติดตั้ง PHP**

WordPress สร้างขึ้นด้วย PHP ดังนั้นคุณต้องติดตั้ง PHP และส่วนขยายที่เกี่ยวข้อง

```bash
sudo apt install php libapache2-mod-php php-mysql -y
```

- ตรวจสอบการติดตั้ง PHP:

```bash
php -v
```

---

### **ขั้นตอนที่ 5: สร้างฐานข้อมูล MySQL สำหรับ WordPress**

1. เข้าสู่ระบบ MySQL:

   ```bash
   sudo mysql -u root -p
   ```

2. สร้างฐานข้อมูลสำหรับ WordPress:

   ```sql
   CREATE DATABASE wordpress;
   ```

3. สร้างผู้ใช้ MySQL และให้สิทธิ์:

   ```sql
   CREATE USER 'user'@'localhost' IDENTIFIED BY 'admin2020';
   GRANT ALL PRIVILEGES ON wordpress.* TO 'user'@'localhost';
   FLUSH PRIVILEGES;
   ```

4. ออกจาก MySQL:

   ```sql
   EXIT;
   ```

### **ถ้าไม่สามารถสร้างฐานข้อมูลได้: ติดตั้ง phpMyAdmin**

```bash
sudo apt install phpmyadmin -y
```

- สร้างฐานข้อมูลสำหรับ WordPress:

  - ไปที่ http://your_domain_or_IP/phpmyadmin
  - คลิก **New** และป้อนชื่อฐานข้อมูล
  - คลิก **Create**
  - คลิก **Privileges** และ **Add user account**
  - ป้อนชื่อผู้ใช้และรหัสผ่าน
  - ให้สิทธิ์ทั้งหมดและคลิก **Go**

- สร้างผู้ใช้ MySQL และให้สิทธิ์:

  ```sql
  CREATE USER 'user'@'localhost' IDENTIFIED BY 'admin2020';
  GRANT ALL PRIVILEGES ON wordpress.* TO 'user'@'localhost';
  FLUSH PRIVILEGES;
  ```

- ออกจาก phpMyAdmin

---

### **ขั้นตอนที่ 6: ดาวน์โหลดและตั้งค่า WordPress**

1. ดาวน์โหลดเวอร์ชันล่าสุดของ WordPress:

   ```bash
   cd /tmp
   wget https://wordpress.org/latest.tar.gz
   ```

2. แยกไฟล์ WordPress:

   ```bash
   tar -xvzf latest.tar.gz
   ```

3. ย้ายไฟล์ไปยังไดเรกทอรีเว็บของคุณ:

   ```bash
   sudo mv wordpress /var/www/html/
   ```

4. ตั้งค่าสิทธิ์ให้ถูกต้อง:

   ```bash
   sudo chown -R www-data:www-data /var/www/html/wordpress
   sudo chmod -R 755 /var/www/html/wordpress
   ```

---

### **ขั้นตอนที่ 7: ตั้งค่า Apache สำหรับ WordPress**

1. สร้างไฟล์การตั้งค่า Apache ใหม่สำหรับ WordPress:

   ```bash
   sudo vim /etc/apache2/sites-available/wordpress.conf
   ```

2. เพิ่มการตั้งค่าต่อไปนี้:

   ```apache
   <VirtualHost *:80>
       ServerAdmin admin@example.com
       DocumentRoot /var/www/html/wordpress
       ServerName your_domain_or_IP

       <Directory /var/www/html/wordpress>
           AllowOverride All
       </Directory>

       ErrorLog ${APACHE_LOG_DIR}/error.log
       CustomLog ${APACHE_LOG_DIR}/access.log combined
   </VirtualHost>
   ```

3. เปิดใช้งานเว็บไซต์และโมดูล rewrite:

   ```bash
   sudo a2ensite wordpress.conf
   sudo a2enmod rewrite
   ```

4. รีสตาร์ท Apache:

   ```bash
   sudo systemctl restart apache2
   ```

---

### **ขั้นตอนที่ 8: ติดตั้ง WordPress ผ่านเว็บเบราว์เซอร์**

1. เปิดเบราว์เซอร์และไปที่:

   ```
   http://your_domain_or_IP
   ```

2. เลือกภาษาของคุณและคลิก **Continue**

3. ป้อนรายละเอียดฐานข้อมูล:

   - ชื่อฐานข้อมูล: `wordpress`
   - ชื่อผู้ใช้: `wordpressuser`
   - รหัสผ่าน: `your_password`
   - โฮสต์ฐานข้อมูล: `localhost`
   - คำนำหน้าตาราง: `wp_` (ค่าเริ่มต้น)

4. คลิก **Submit** จากนั้นคลิก **Run the Installation**

5. ป้อนชื่อเว็บไซต์ ชื่อผู้ดูแลระบบ รหัสผ่าน และอีเมล

6. คลิก **Install WordPress**

---

### **ขั้นตอนที่ 9: ปรับแต่งความปลอดภัยสำหรับ WordPress**

- ติดตั้งใบรับรอง SSL โดยใช้ Let’s Encrypt:

  ```bash
  sudo apt install certbot python3-certbot-apache -y
  sudo certbot --apache -d your_domain
  ```

- อัปเดต WordPress, ธีม, และปลั๊กอินเป็นประจำ

---

### **ขั้นตอนที่ 10: เข้าสู่แดชบอร์ด WordPress**

เยี่ยมชมแผงควบคุมผู้ดูแลระบบ WordPress:

```
http://your_domain_or_IP/wp-admin
```

---

Ref:

- [ติดตั้ง WordPress](https://ubuntu.com/tutorials/install-and-configure-wordpress#1-overview)
