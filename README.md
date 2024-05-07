## Instrucciones

``` instalar/descomprimir proyecto```

``` composer install ```

``` cp .env.example .env ```

``` php artisan key:generate ```

Abrir el archivo `.env` y configurar `database` con el nombre `name`, `host`, y `password`

``` php artisan storage:link ```

``` php artisan migrate --seed ```

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
- **Generar con comando**
```php C:\xampp\htdocs\phpDocumentor.phar run -d C:\xampp\htdocs\GreenCarRent -t C:\xampp\htdocs\doc --ignore="vendor"```


## Test
- **Nombre de Base de datos para el test** ``` testgreencarrent ```
- **conf:** ``` env.testing ```
- **Comando Test** ``` php artisan test --env=testing    ```
- **Pruebas Unitarias** ``` carpeta Unit ```
