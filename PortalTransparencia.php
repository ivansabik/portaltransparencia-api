<?php

require 'vendor/autoload.php';

class PortalTransparencia {
    # Endpoint de /listado?tipo=sectores
    # Endpoint de /listado?tipo=instituciones
    # Endpoint de /listado?tipo=areas
    public function listado($tipo) {
		if($tipo == 'sectores') {
		} elseif($tipo == 'instituciones') {
		} elseif($tipo == 'areas') {
		} else {
		}
    }
    
    # Endpoint de /consulta?tipo=contrataciones
    # Endpoint de /consulta?tipo=concesiones
    # Endpoint de /consulta?tipo=subsidios
    public function consulta($tipo, ) {
		if($tipo == 'contrataciones') {
		} elseif($tipo == 'concesiones') {
		} elseif($tipo == 'subsidios') {
		} else {
		}
    }
?>
