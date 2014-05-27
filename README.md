API del Portal de Transparencia Mx
================
[![Build Status](https://travis-ci.org/mexicapis/portaltransparencia-api.svg)](https://travis-ci.org/mexicapis/portaltransparencia-api)

Para probar: http://mexicapis.org.mx/apis/portaltransparencia/

### Instituciones y sectores

| Endpoint                                   | Ejemplo                              |
| ------------------------------------------ | ------------------------------------ |
| /instituciones                             | http://mexicapis.org.mx/apis/portaltransparencia/instituciones                       |
| /instituciones?nombre=[NOMBRE INSTITUCION] | http://mexicapis.org.mx/apis/portaltransparencia/instituciones?nombre=casa+de+moneda |
| /sectores                                  | http://mexicapis.org.mx/apis/portaltransparencia/sectores                            |

### Contrataciones

| Endpoint                                                                           | Ejemplo                                                       |
| ---------------------------------------------------------------------------------- | ------------------------------------------------------------- |
| /contrataciones?clave_institucion=[CLAVE INSTITUCION]                              | http://mexicapis.org.mx/apis/portaltransparencia/consulta?tipo=contrataciones&institucion=06305               |
| /contrataciones?clave_institucion=[CLAVE CONTRATO]&clave_contrato=[CLAVE CONTRATO] | http://mexicapis.org.mx/apis/portaltransparencia/consulta?tipo=contrataciones&institucion=06305&contrato=1/12 |

### Remuneraciones

| Endpoint                                                    | Ejemplo                                    |
| ----------------------------------------------------------- | ------------------------------------------ |
| /remuneraciones?clave_institucion=[CLAVE INSTITUCION]       | http://mexicapis.org.mx/apis/portaltransparencia/contrataciones?clave_institucion=06305    |
| /remuneraciones?clave_institucion=[NOMBRE INSTITUCION]      | http://mexicapis.org.mx/apis/portaltransparencia/contrataciones?nombre_institucion=hacienda |

### Deployea tu copia

En Ubuntu por ejemplo:

1. Instalar cURL para PHP 
``` sudo apt-get install curl libcurl3 libcurl3-dev php5-curl```
2. Clonar repo
```git clone https://github.com/mexicapis/portaltransparencia-api.git ```
3. Instalar composer
``` $ curl -s https://getcomposer.org/installer | php ```
Si no con wget
``` $ wget http://getcomposer.org/composer.phar ```
O con
```php -r "readfile('https://getcomposer.org/installer');" | php ```
4. Instalar dependencias con Composer
```php composer.phar install```
5. Listo para usar en http://localhost/portaltransparencia-api/index.php/portaltransparencia/
6. Modifica el archivo .htaccess si quieres la ruta sin el /index.php, agrega
```
DirectoryIndex index.php
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteRule ^$ index.php [QSA,L]
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteRule ^(.*)$ index.php [QSA,L]
</IfModule>
<ifModule mod_php5.c>
    php_flag display_errors Off
</IfModule>
```

### TODO

 - Filtrado
 - Mas info

##### Fuente de la info: http://portaltransparencia.gob.mx/
