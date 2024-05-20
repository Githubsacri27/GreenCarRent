## Instrucciones

``` instalar/descomprimir proyecto```

``` composer install ```

``` copiar archivo .env.example y renombrar a .env ```

Abrir el archivo `.env` y configurar `DB_DATABASE` con el nombre `greencarrent`, `DB_HOST`, `DB_USERNAME` y `DB_PASSWORD` con la configuración propia que se tenga del acceso a la base de datos.

``` php artisan key:generate ```

``` php artisan storage:link ```

``` php artisan migrate --seed ```

``` composer require laravel/sanctum ```

``` php artisan serve ```

## Niveles de Acceso & Permisos


### Cliente:

- **Nombre de usuario:** ``` clientecliente ```

- **Contraseña:** ``` Focr12345p ```

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
Para ejecutar las pruebas, hay que crear una base de datos nueva y un nuevo archivo env.testing
- **Nombre de Base de datos para el test** ``` testgreencarrent ```
- **conf:** ``` env.testing ```
- **Lanzar migraciones Test** ``` php artisan migration --env=testing     ```
- **Lanzar sedeers Test** ``` php artisan db:seed --env=testing      ```
- **Ejecutar Test** ``` php artisan test --env=testing    ```

