# blogflix
Symfony 6 test :)

First commit


Comandos symfony 6
Start app:
symfony server:start

Clear caché:
php bin/console cache:pool:clear cache.global_clearer
php bin/console cache:clear
php bin/console cache:clear --env=prod
Info: https://lindevs.com/methods-to-clear-cache-using-console-command-in-symfony

Paquetes instalados:
composer require --dev symfony/maker-bundle
composer require symfony/orm-pack
composer require annotations     ??????????'

php bin/console doctrine:database:create
php bin/console doctrine:schema:create
php bin/console debug:router

php bin/console make:migration ???


php bin/console make:entity Posts

Enlaces a API: 

https://jsonplaceholder.typicode.com/posts/
https://jsonplaceholder.typicode.com/posts/1

{
    "userId": 1,
    "id": 1,
    "title": "sunt aut facere repellat provident occaecati excepturi optio reprehenderit",
    "body": "quia et suscipit\nsuscipit recusandae consequuntur expedita et cum\nreprehenderit molestiae ut ut quas totam\nnostrum rerum est autem sunt rem eveniet architecto"
},

https://jsonplaceholder.typicode.com/users/
https://jsonplaceholder.typicode.com/users/1

 {
    "id": 1,
    "name": "Leanne Graham",
    "username": "Bret",
    "email": "Sincere@april.biz",
    "address": {
      "street": "Kulas Light",
      "suite": "Apt. 556",
      "city": "Gwenborough",
      "zipcode": "92998-3874",
      "geo": {
        "lat": "-37.3159",
        "lng": "81.1496"
      }
    },
    "phone": "1-770-736-8031 x56442",
    "website": "hildegard.org",
    "company": {
      "name": "Romaguera-Crona",
      "catchPhrase": "Multi-layered client-server neural-net",
      "bs": "harness real-time e-markets"
    }
},





Links útiles: 

https://apiumhub.com/es/tech-blog-barcelona/aplicando-arquitectura-hexagonal-proyecto-symfony/
https://jnjsite.com/como-implementar-una-arquitectura-hexagonal-con-symfony-flex/
https://www.juannicolas.eu/el-metodo-invoke-en-php/







Output instalaciones: 

To enable PHP in Apache add the following to httpd.conf and restart Apache:
    LoadModule php_module /opt/homebrew/opt/php/lib/httpd/modules/libphp.so

    <FilesMatch \.php$>
        SetHandler application/x-httpd-php
    </FilesMatch>

Finally, check DirectoryIndex includes index.php
    DirectoryIndex index.php index.html

The php.ini and php-fpm.ini file can be found in:
    /opt/homebrew/etc/php/8.2/

To restart php after an upgrade:
  brew services restart php
