# blogflix
Symfony 6 test :)


# NOTAS

Soy consciente de que hay margen de mejora, es una primera aproximación de una POC de un par de días.

A grandes rasgos implementé.

- Web que muestra listado de post, detalle y permite la creación de un nuevo post.
- Api Rest para obtener listado de post y creación de uno nuevo.
- Le añadí una pequeña documentación con swagger (seguramente se podrá completar más las cabeceras).
- Metí unos cuantos test unitarios para los casos de uso, comprobación de que cargan la web etc.. 

Como comentarios generales que puedo hacer del código.. destacaría.

- El objeto user tiene más campos como por ejemplo los de la dirección, compañía.. No se han añadido más entidades por simplificar el ejemplo.

- Carga lento el listado, ya que por Post se trae su user de la API. Se podría hacer una caché interna, o traer el listado de user en una primera llamada y utilizar esos valores y de esa forma serían solo 2 llamadas a la API externa. Pero bueno, a modo de ejemplo te trae los datos. 

- Repasaría a fondo todos los comentarios de las cabeceras de las clases / funciones

- Respecto a la parte gráfica.. he metido lo más sencillo de bootstrap por simplificar. Aquí se podría meter cosas más elaboradas.
Cuando trabajaba con symfony 2/3 generalmente las plantillas las hacía prácticamente en twig. Después de eso trabajé con Angular.
Me gusta bastante Angular. Si empezase algo de 0.. quizá haria todo el backend con Symfony y a través de una API lo conectaría con 
una web más dinámica con Angular. 

- Probablemente hay margen de mejora con las novedades de symfony 6, he metido lo que me ha dado tiempo / he visto más curioso.
Me parece bastante interesante el tema de las autoinyecciones, me recuerda un poco a .net. 

- Respecto a los repositorios habría que meterle más campos de búsqueda etc.. 


# Notas personales

Estas notas son personales. De comandos que uso con frecuencia o links que encontré de utilidad etc etc.

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
composer require annotations
composer require --dev symfony/test-pack

composer require api
composer require nelmio/api-doc-bundle
composer require twig asset

Lanzar test:
php bin/phpunit



php bin/console doctrine:database:create
php bin/console doctrine:schema:create
php bin/console debug:router

php bin/console make:migration ???


php bin/console make:entity Posts
php bin/console make:entity "App\Domain\Entity\User"


Enlaces a API: 

https://jsonplaceholder.typicode.com/posts/
https://jsonplaceholder.typicode.com/posts/1
https://jsonplaceholder.typicode.com/users/
https://jsonplaceholder.typicode.com/users/1

