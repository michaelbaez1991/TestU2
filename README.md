# TestU2
Prueba PHP (Laravel)

- Crear la BD de datos en en phpmyadmin con el nombre de testu2.

- Los datos de conexion a la base de datos son los basico para MySql:
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=testu2
    DB_USERNAME=root
    DB_PASSWORD=

- Ejecutar migraciones -> php artisan migrate

- Ejecutar seed -> php artisan db:seed

- Ahora activamos el servidor de laravel -> php artisan serve

- Una vez se levante el servidor, ya podemos hacer uso de la funcionalidad del test:
    Login
    Registro de nuevos usuarios
    Consulta de informacion y funciones segun perfil
    CRUD de pasatiempos: Crear, consultar, editar y eliminar los pasatiempos.
    Validaciones de formularios
