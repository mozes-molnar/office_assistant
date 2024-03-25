# HW Stúdió
## Installation guide

### Backend
```sh
git clone https://github.com/mozes-molnar/office_assistant.git
cd backend
composer install
Linux or Mac: cp .env.example .env Windows:copy .env.example .env
docker-compose up -d
php artisan migrate --seed
php artisan serve
```
### Frontend
```sh
cd frontend
npm i
npm run dev
Open browser: http://localhost:5173/
```