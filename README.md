## Профиланс - тестовое задание

### Установка

1. скопируйте .env.example в .env
2. поменяйте значения:
```dotenv
APP_URL={адрес текущего приложения}
# актуальные данные MySQL (или другой драйвер)
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=profilans
DB_USERNAME=root
DB_PASSWORD=password
```
3. composer install
4. php artisan key:generate
5. php artisan migrate
