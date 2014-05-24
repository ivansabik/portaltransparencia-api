<?php

define('URL_LISTA_INSTITUCIONES', 'http://portaltransparencia.gob.mx/buscador/search/search.do?method=begin');
define('URL_SECTORES', 'http://portaltransparencia.gob.mx/pot/informacion/buscarGrupoDependencia.do?method=mostrarGrupoDep');

require 'vendor/autoload.php';

class PortalTransparencia {
    # Endpoint de /listado?tipo=sectores
    # Endpoint de /listado?tipo=instituciones
    # Endpoint de /listado?tipo=areas

    public function listado($tipo) {
        if ($tipo == 'sectores') {
            return $this->buscar_sectores();
        } elseif ($tipo == 'instituciones') {
            return $this->buscar_instituciones();
        } elseif ($tipo == 'areas') {
            
        } else {
            
        }
    }

    # Endpoint de /consulta?tipo=contrataciones
    # Endpoint de /consulta?tipo=concesiones
    # Endpoint de /consulta?tipo=subsidios

    public function consulta($tipo) {
        if ($tipo == 'contrataciones') {
            
        } elseif ($tipo == 'concesiones') {
            
        } elseif ($tipo == 'subsidios') {
            
        } else {
            
        }
    }

    private function buscar_instituciones() {
        $hunter = new \Ivansabik\DomHunter\DomHunter(URL_LISTA_INSTITUCIONES);
        $presas = array();
        $presas[] = array('instituciones', new \Ivansabik\DomHunter\SelectOptions(array('id_nodo' => 'comboDependencia'), 'id_institucion', 'nombre_institucion', 1));
        $hunter->arrPresas = $presas;
        $hunted = $hunter->hunt();
        return $hunted['instituciones'];
    }
    
    private function buscar_sectores() {
        $hunter = new \Ivansabik\DomHunter\DomHunter(URL_SECTORES);
        $presas = array();
        $presas[] = array('sectores', new \Ivansabik\DomHunter\SelectOptions(array('id_nodo' => 'idSector'), 'id_sector', 'nombre_sector', 1));
        $hunter->arrPresas = $presas;
        $hunted = $hunter->hunt();
        return $hunted['sectores'];
    }

}

?>