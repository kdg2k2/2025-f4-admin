# 1. chạy lệnh với cmd hoặc powershell
    - cmd:
        copy .env.example .env & composer install & php artisan db:drop & php artisan db:create & php artisan migrate:fresh --seed & php artisan optimize:clear & php artisan config:cache
    - shell:
        copy .env.example .env ; composer install ; php artisan db:drop ; php artisan db:create ; php artisan migrate:fresh --seed ; php artisan optimize:clear ; php artisan config:cache

# 2. tải và cài ImageMagick PHP extension cho Windows
    - note: khi upload document sẽ dùng thư viện này đọc pdf thành ảnh
    - link: https://mlocati.github.io/articles/php-windows-imagick.html