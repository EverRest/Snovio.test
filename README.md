# Snovio.test
1. docker-compose up -d
2. docker ps
3.
sudo chown -R $USER:www-data storage
sudo chown -R $USER:www-data bootstrap/cache
chmod -R 775 storage
chmod -R 775 bootstrap/cache
4. cp .env.example to .env
5. php artisan key:generate
6. npm install