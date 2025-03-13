# 🚀 Jho-Tech - Hướng Dẫn Cài Đặt & Chạy Dự Án với Docker  

## Cách 1 - Sử Dụng DockerFile & Docker Compose
## 📌 1. Clone Repository  
Trước tiên, bạn cần clone dự án từ GitHub:  
```bash
git clone git@github.com:KaitoKid1612/jho-tech.git
cd jho-tech
```

## 📌 2. Cấu hình .env
Sao chép tệp .env.example thành .env:
```bash
cp .env.example .env
```

## 📌 3. Cài Đặt Docker & Docker Compose
✅ Bước 1: Build Docker Image  
```bash
docker compose build
```
✅ Bước 2: Chạy Docker Container  
```bash
docker compose up -d
```

## 📌 4. Thiết lập trong Container
✅ Bước 1: Truy cập vào container của Laravel  
```bash
docker exec -it jho-tech sh
```
✅ Bước 2: Cài đặt các thư viện cần thiết  
```bash
composer install
```
✅ Bước 3: Cấp quyền cho thư mục storage
```bash
chmod -R 777 storage
```
✅ Bước 4: Chạy migration và seed dữ liệu
```bash
php artisan migrate --seed
```
✅ Bước 5: Thoát khỏi container
```bash
exit
```

-----------------------------

## Cách 2 - Sử Dụng Docker & Docker Compose bằng Laradock (Khuyến khích sử dụng vì build nhanh hơn bằng Laradock)
## 📌 1. Clone Repository  
Trước tiên, bạn cần clone dự án từ GitHub:  
```bash
git clone git@github.com:KaitoKid1612/jho-tech.git
cd jho-tech
```

## 📌 2. Cấu hình .env
Sao chép tệp .env.example thành .env:
```bash
cp .env.example .env
```

## 📌 3. Clone Laradock về trong thư mục dự án:
```bash
git clone https://github.com/Laradock/laradock.git
cd laradock
cp .env.example .env
```

## 📌 4. Cấu hình Laradock
✅ Bước 1: Mở file .env trong thư mục laradock và sửa một số thiết lập quan trọng.
```bash
MYSQL_VERSION=8.0
MYSQL_DATABASE=jho_tech
MYSQL_USER=admin
MYSQL_PASSWORD=123456
MYSQL_ROOT_PASSWORD=123456
```
✅ Bước 2: Cấu hình Apache
```bash
WORKSPACE_INSTALL_APACHE=true
APACHE_DOCUMENT_ROOT=/var/www/html/public
```
✅ Bước 3: Cấu hình ElasticSearch
```bash
ELASTICSEARCH_VERSION=8.12.0
```
✅ Bước 4: Cấu hình PHPMyAdmin:
```bash
PMA_DB_ENGINE=mysql
PMA_HOST=mysql
```
## 📌 5. Cấu hình Laradock
✅ Khởi động các service cần thiết (PHP, MySQL, Nginx, Elasticsearch, Kibana, PHPMyAdmin):
```bash
docker-compose up -d nginx mysql phpmyadmin workspace elasticsearch kibana
```
## 📌 6. Cấu hình Laravel để chạy trong Docker
✅ Vào container workspace:
```bash
docker-compose exec workspace bash
```
✅ Cài đặt các thư viện cần thiết:
```bash
composer install
npm install
```
✅ Cấp quyền cho thư mục storage:
```bash
chmod -R 775 storage
```
✅ Chỉnh sửa .env trong Laravel để trỏ database về mysql:
```bash
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=jho_tech
DB_USERNAME=admin
DB_PASSWORD=123456
```
✅ Chạy migration và seed dữ liệu
```bash
php artisan migrate --seed
```
✅ Chạy lệnh npm run dev để build frontend
```bash
npm run dev
```

## 📌 7. Truy cập vào ứng dụng
Mở trình duyệt và truy cập vào địa chỉ: http://localhost:8765
Email: admin0@gmail.com
Password: password


```bash
CRM API
│── Authentication
│   ├── Login (POST /api/login)
│   ├── Register (POST /api/register)
│   ├── Logout (POST /api/logout)
│   ├── User Info (GET /api/user)
│
│── Contacts
│   ├── Get Contacts (GET /api/contacts)
│   ├── Create Contact (POST /api/contacts)
│   ├── Get Contact by ID (GET /api/contacts/{id})
│   ├── Update Contact (PUT /api/contacts/{id})
│   ├── Delete Contact (DELETE /api/contacts/{id})
│   ├── Filter Contacts (GET /api/contacts/filter)
│   ├── Export Contacts (GET /api/contacts/export)
│
│── Opportunities
│   ├── Get Opportunities (GET /api/opportunities)
│   ├── Create Opportunity (POST /api/opportunities)
│   ├── Get Opportunity by ID (GET /api/opportunities/{id})
│   ├── Update Opportunity (PUT /api/opportunities/{id})
│   ├── Delete Opportunity (DELETE /api/opportunities/{id})
│   ├── Filter Opportunities (GET /api/opportunities/filter)
│   ├── Pipeline Opportunities (GET /api/opportunities/pipeline)
│
│── Tasks
│   ├── Get Tasks (GET /api/tasks)
│   ├── Create Task (POST /api/tasks)
│   ├── Get Task by ID (GET /api/tasks/{id})
│   ├── Update Task (PUT /api/tasks/{id})
│   ├── Delete Task (DELETE /api/tasks/{id})
│   ├── Filter Tasks (GET /api/tasks/filter)
│
│── Tags
│   ├── Get Tags (GET /api/tags)
│   ├── Create Tag (POST /api/tags)
│   ├── Assign Tag (POST /api/tags/assign)
│   ├── Delete Tag (DELETE /api/tags/{id})
│
│── Search (Elasticsearch)
│   ├── Search Contacts (GET /api/search/contacts)
│   ├── Search Opportunities (GET /api/search/opportunities)
│   ├── Search Tasks (GET /api/search/tasks)

```
