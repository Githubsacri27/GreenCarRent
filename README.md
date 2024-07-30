## Video de Demostración

[![Video de Demostración](https://github.com/user-attachments/assets/11bf36eb-05cb-4d14-b1e6-cadd36df9bd9)](https://youtu.be/0oZgeypOtnU?si=9oMpefkBrKrMpu-u)


## Instrucciones

``` instalar/descomprimir proyecto```

``` Crear base de datos```CREATE DATABASE greencarrent;

``` composer install ```

``` renombrar archivo .env.example a .env ```

Abrir el archivo `.env` y configurar campos `DB_DATABASE = greencarrent`, `DB_CONECTION = mysql` , `DB_HOST`, `DB_PORT = 3306`, `DB_USERNAME` y `DB_PASSWORD` con la configuración propia que se tenga del acceso a la base de datos.

``` composer require laravel/sanctum ```

``` php artisan key:generate ```

``` php artisan storage:link ```

``` php artisan migrate --seed ```Solo usar este comando sino dispone de la base de datos

``` php artisan serve ```

## Niveles de Acceso & Permisos


### Cliente:

- **Nombre de usuario:** ``` clientecliente ```

- **Contraseña:** ``` Focr12345@ ```

### Empleado:

- **Nombre de usuario:** ``` empleadoempleado ```

- **Contraseña:** ``` Focr12345@ ```

### Administrador:

- **Nombre de usuario:** ``` adminadmin ```

- **Contraseña:** ``` Focr12345@ ```

## Documentación:##

- **Consultar documentación técnica**
``` https://githubsacri27.github.io/DocuGCR/ ```

## Test
Para ejecutar las pruebas, hay que crear una base de datos nueva y usar el archivo env.testing
- **Nombre de Base de datos para el test** ``` testgreencarrent ```
- **conf:** ``` env.testing ```
- **Lanzar migraciones Test** ``` php artisan migration --env=testing     ```
- **Lanzar sedeers Test** ``` php artisan db:seed --env=testing      ```
- **Ejecutar Test** ``` php artisan test --env=testing    ```

