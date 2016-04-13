API del Portal de Transparencia Mx
================
[![Build Status](https://travis-ci.org/ivansabik/portaltransparencia-api.svg)](https://travis-ci.org/ivansabik/portaltransparencia-api)

## Instituciones y sectores

### /instituciones
```javascript
[
  {
    "clave_institucion": "25101",
    "nombre_institucion": "ADMINISTRACIÓN FEDERAL DE SERVICIOS EDUCATIVOS EN EL DISTRITO FEDERAL"
  },
  {
    "clave_institucion": "09176",
    "nombre_institucion": "ADMINISTRACIÓN PORTUARIA INTEGRAL DE ALTAMIRA, S.A. DE C.V."
  },
  {
    "clave_institucion": "09183",
    "nombre_institucion": "ADMINISTRACIÓN PORTUARIA INTEGRAL DE COATZACOALCOS, S.A. DE C.V."
  },
  {
    "clave_institucion": "09180",
    "nombre_institucion": "ADMINISTRACIÓN PORTUARIA INTEGRAL DE DOS BOCAS"
  }
```

### /sectores
```javascript
[
  {
    "clave_sector": "1",
    "nombre_sector": "Agricultura, Ganadería, Desarrollo Rural, Pesca y Alimentación"
  },
  {
    "clave_sector": "3",
    "nombre_sector": "Consejería Jurídica del Ejecutivo Federal"
  },
  {
    "clave_sector": "4",
    "nombre_sector": "Consejo Nacional de Ciencia y Tecnología"
  },
  {
    "clave_sector": "5",
    "nombre_sector": "Defensa Nacional"
  }
]
```
## Contrataciones

### /contrataciones?clave_institucion=[CLAVE INSTITUCION]

```javascript
{
  "nombre_institucion": "BANCO NACIONAL DE COMERCIO EXTERIOR, S.N.C.",
  "contrataciones": [
    {
      "clave": "201602001",
      "procedimiento": "ADJUDICACI...",
      "asignado": "Gándara, A...",
      "fecha": "01/02/2016",
      "objeto": "Servicios ...",
      "monto": 80000,
      "modificatorio": "NO",
      "url_info": "http://portaltransparencia.gob.mx/pot/contrataciones/consultarContrato.do?method=consultaContrato&id.idContrato=201602001&_idDependencia=06305",
      "url_api": "consulta?tipo=contrataciones&institucion=06305&contrato=201602001"
    },
    {
      "clave": "20120213",
      "procedimiento": "INVITACION...",
      "asignado": "SISTEMA IN...",
      "fecha": "29/06/2012",
      "objeto": "SUMINISTRO...",
      "monto": 300000,
      "modificatorio": "NO",
      "url_info": "http://portaltransparencia.gob.mx/pot/contrataciones/consultarContrato.do?method=consultaContrato&id.idContrato=20120213&_idDependencia=06305",
      "url_api": "consulta?tipo=contrataciones&institucion=06305&contrato=20120213"
    },
    {
      "clave": "20120214",
      "procedimiento": "ADJUDICACI...",
      "asignado": "PRODUCTIVI...",
      "fecha": "02/07/2012",
      "objeto": "SERVICIOS ...",
      "monto": 69900,
      "modificatorio": "NO",
      "url_info": "http://portaltransparencia.gob.mx/pot/contrataciones/consultarContrato.do?method=consultaContrato&id.idContrato=20120214&_idDependencia=06305",
      "url_api": "consulta?tipo=contrataciones&institucion=06305&contrato=20120214"
    }
  ]
}
```
### /contrataciones?clave_institucion=[CLAVE CONTRATO]&clave_contrato=[CLAVE CONTRATO]

```javascript
{
    "nombre_institucion": "BANCO NACIONAL DE COMERCIO EXTERIOR, S.N.C.",
    "sector_presupuestal": "Hacienda y Crédito Público",
    "siglas": "BANCOMEXT",
    "fecha_actualizacion": "08/04/2016",
    "numero_contrato": "20120219",
    "unidad_administrativa": "DIRECCIÓN DE RECURSOS HUMANOS MATERIALES Y SERVICIOS",
    "procedimiento_contratacion": "OTROS",
    "denominacion_asignado": "FONDO DE INFORMACIÓN Y DOCUMENTACIÓN PARA LA INDUSTRIA INFOTEC",
    "fecha_contrato": "12/07/2012",
    "objeto_contrato": "SERVICIOS TECNOLÓGICOS DE DESARROLLO Y MANTENIMIENTO DE SISTEMAS",
    "monto_contrato": 102487,
    "moneda": "PESOS",
    "fecha_inicio": "12/07/2012",
    "fecha_fin": "31/12/2012",
    "documento": "N/A",
    "clave_institucion": "06305",
    "url_info": "http://portaltransparencia.gob.mx/pot/contrataciones/consultarContrato.do?method=consultaContrato&id.idContrato=20120219&_idDependencia=06305"
}
```

### Instrucciones en Mint/Ubuntu

```bash
sudo apt-get install curl libcurl3 libcurl3-dev php5-curl
git clone https://github.com/mexicapis/portaltransparencia-api.git
curl -s https://getcomposer.org/installer | php
php composer.phar install
php -S localhost:8000
```

### TODO

 - Filtrado
 - Mas info
 - Remuneraciones
 - Búsqueda en directorio
 - Búsque de institución por nombre

Fuente de la info: http://portaltransparencia.gob.mx/
