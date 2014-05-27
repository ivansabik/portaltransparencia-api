API del Portal de Transparencia Mx
================
[![Build Status](https://travis-ci.org/mexicapis/portaltransparencia-api.svg)](https://travis-ci.org/mexicapis/portaltransparencia-api)

### Instituciones y sectores

| Endpoint                                   | Ejemplo                              |
| ------------------------------------------ | ------------------------------------ |
| /instituciones                             | /instituciones                       |
| /instituciones?nombre=[NOMBRE INSTITUCION] | /instituciones?nombre=casa+de+moneda |
| /sectores                                  | /sectores                            |

### Contrataciones

| Endpoint                                                                           | Ejemplo                                                       |
| ---------------------------------------------------------------------------------- | ------------------------------------------------------------- |
| /contrataciones?clave_institucion=[CLAVE INSTITUCION]                              | /consulta?tipo=contrataciones&institucion=06305               |
| /contrataciones?clave_institucion=[CLAVE CONTRATO]&clave_contrato=[CLAVE CONTRATO] | /consulta?tipo=contrataciones&institucion=06305&contrato=1/12 |

### Remuneraciones

| Endpoint                                                    | Ejemplo                                 |
| ----------------------------------------------------------- | --------------------------------------- |
| /contrataciones?clave_institucion=[CLAVE INSTITUCION]       | /contrataciones?clave_institucion=06305 |

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

### TODO

 - Filtrado
 - Mas info

##### Fuente de la info: http://portaltransparencia.gob.mx/