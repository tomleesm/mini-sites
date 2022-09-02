# 安裝

除了一般的程序外，還有幾個地方要做的

``` bash
# 增加檔案上傳限制
# nginx client_max_body_size 100M;
sudo vim /etc/php/7.4/fpm/php.ini
# 確認 memory_limit (一個 php 程式可用的記憶體) 的值大於 post_max_size
# post_max_size = 100M # POST 請求的最大檔案大小
# upload_max_filesize = 10M # 上傳檔案每個最多 10 MB
# max_file_uploads = 50 # 最多 50 個
sudo service php7.4-fpm restart

# 安裝 ImageMagick
sudo apt install imagemagick

# Storage::url() 的回傳值以 /storage 開頭
cd public; ln -s ../storage/app/public/ storage; cd -

# .env 的 QUEUE_CONNECTION=database

# 安裝設定 supervisor
sudo apt install supervisor
sudo vim /etc/supervisor/conf.d/projects-003.conf
# 設定如下
[program:projects-003]
process_name=%(program_name)s_%(process_num)02d
command=php /home/azure/projects/003/artisan queue:work --tries=3
autostart=true
autorestart=true
user=azure
numprocs=1
redirect_stderr=true
stdout_logfile=/home/azure/projects/003/storage/logs/worker.log
stopwaitsecs=3600

# 啓動 supervisor
sudo supervisorctl reread
sudo supervisorctl update
sudo supervisorctl start projects-003:*
```
