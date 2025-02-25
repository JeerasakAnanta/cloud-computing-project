# คู่มือการ Deploy แอปพลิเคชัน Flask บน DigitalOcean

- คู่มือนี้ จะทำการ deploy แอปพลิเคชัน Flask ที่ใช้ Machine Learning Model (iris_model.sav) บน DigitalOcean โดยใช้ Gunicorn และ Nginx

- อัปเดตระบบ
```bash
sudo apt update && sudo apt upgrade -y
```
- ติดตั้ง Python และ Pip
```bash
sudo apt install python3 python3-pip -y
```

ติดตั้ง Git:

```bash
sudo apt install git -y
```
โคลน Repository 
```bash
git clone https://github.com/JeerasakAnanta/cloud-computing-project.git
cd cloud-computing-project
```
ติดตั้ง dependencies 
```bash
pip3 install -r requirements.txt
```
- ติดตั้ง Gunicorn
```bash  
apt install python3.12-venv
```

- create a virtual environment
```
python3 -m venv .env_iris
```
- activate the virtual environment 
```
source .env_iris/bin/activate
```

- install  requirements 
```
pip install -r requirements.txt
```

## ขั้นตอน : ติดตั้ง Gunicorn และ  setup Nginx
- ติดตั้ง Gunicorn: Gunicorn เป็น WSGI server สำหรับรันแอป Flask
```bash
pip3 install gunicorn
```
- ทดสอบ Gunicorn รันแอปด้วย Gunicorn เพื่อทดสอบ
```bash
gunicorn --workers 3 app:app
```
หยุดด้วย Ctrl+C

ติดตั้ง Nginx Nginx ทำหน้าที่เป็น reverse proxy 
- ติดตั้ง Nginx 
```bash
sudo apt install nginx -y
```

### ตั้งค่า Nginx 

- สร้างไฟล์ configuration สำหรับ Nginx
```bash
sudo nano /etc/nginx/sites-available/iris_app
```
- เพิ่มการตั้งค่าดังต่อไปนี้ เปลี่ยน your-droplet-ip เป็น IP server เครื่องของคุณ:
```
nginx
server {
    listen 80;
    server_name your-droplet-ip;

    location / {
        proxy_pass http://127.0.0.1:8000;
        proxy_set_header Host $host;
        proxy_set_header X-Real-IP $remote_addr;
        proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
        proxy_set_header X-Forwarded-Proto $scheme;
    }
}
```
- บันทึกและออก (Ctrl+O, Enter, Ctrl+X)

- เปิดใช้งานการตั้งค่า:
```bash
sudo ln -s /etc/nginx/sites-available/iris_app /etc/nginx/sites-enabled/
```

- ทดสอบการตั้งค่า Nginx
```bash
sudo nginx -t
```

- รีสตาร์ท Nginx:
```bash
sudo systemctl restart nginx
```

## ขั้นตอน : รันแอปด้วย Gunicorn
- รันแอปด้วย Gunicorn และ บนพอร์ต 8000 
```bash  
gunicorn --workers 3 app:app &
```
- เปิดเบราว์เซอร์และเข้าไปที่ http://your-droplet-ip 