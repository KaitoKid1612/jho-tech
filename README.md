# 🚀 Jho-Tech - Hướng Dẫn Cài Đặt & Chạy Dự Án với Docker  

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
