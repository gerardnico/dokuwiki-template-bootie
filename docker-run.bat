docker run ^
    --name doku-bootie ^
    -d ^
    -p 80:80 ^
    -p 9000:9000 ^
    -v %cd%:/var/www/html/lib/tpl/bootie ^
    gerardnico/dokuwiki:2018-04-22a