# 1. chạy lệnh với cmd hoặc powershell

    - cmd:
        copy .env.example .env & composer install & php artisan db:drop & php artisan db:create & php artisan migrate:fresh --seed & php artisan optimize:clear & php artisan config:cache
    - shell:
        copy .env.example .env ; composer install ; php artisan db:drop ; php artisan db:create ; php artisan migrate:fresh --seed ; php artisan optimize:clear ; php artisan config:cache

# 2. tải và cài ImageMagick PHP extension cho Windows

    - note: khi upload document sẽ dùng thư viện này đọc pdf thành ảnh
    - Cài đặt Qgis (https://download.osgeo.org/qgis/windows/QGIS-OSGeo4W-3.16.16-1.msi) rồi gắn /bin của Qgis vào PATH để sử dụng ghostScript (ImageMagick cần dùng ghostScript)
    - Doc ImageMagick: https://mlocati.github.io/articles/php-windows-imagick.html

# 3. đặt lại APP_URL trong .env

    - khi lên môi trường production cần gắn lại domain chuẩn cho APP_URL trong .env
