``` bash
composer create-project laravel/laravel=6.* 002 --prefer-dist
cd 002
composer install
cp .env.example .env
php artisan key:generate
sudo vim /etc/nginx/sites-available/projects.conf
# 加上以下這一行：
include sites-available/002.conf

cd /etc/nginx/sites-available/
sudo cp 001.conf 002.conf
sudo vim 002.conf
# 確認 listen 是 8002，以及資料夾都改成 002
sudo nginx -s reload
```

## 資料庫

``` sql
mysql -u root -p
CREATE DATABASE project_002 CHARACTER SET utf8mb4;
GRANT ALL PRIVILEGES ON project_002.* TO 'project'@'localhost';
FLUSH PRIVILEGES;
exit
```

## 設定 .env

```
cd ~/projects/002
vim .env
# 設定成以下這樣：
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=project_002
DB_USERNAME=project
DB_PASSWORD='密碼' # 修改成真正的密碼

php artisan migrate
```
