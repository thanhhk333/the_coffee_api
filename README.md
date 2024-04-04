-   Open xampp: Start Apache + MySql
-   Create new database on phpMyAdmin : link(http://localhost/phpmyadmin/). Set my defaul name ("the_coffee_shop_api") or whatever you want.
    On root project:
    -   Run migrate file : php artisan migrate
    -   Run migrate data : php artisan db:seed
    -   Run project : php artisan serve

Use browser or postman to get data.
Please see route address in file route/api.
