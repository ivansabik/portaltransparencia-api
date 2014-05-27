<?php

define('URL_INSTITUCIONES', 'http://portaltransparencia.gob.mx/buscador/search/search.do?method=begin');
define('URL_SECTORES', 'http://portaltransparencia.gob.mx/pot/informacion/buscarGrupoDependencia.do?method=mostrarGrupoDep');
define('URL_CONTRATACIONES', 'http://portaltransparencia.gob.mx/pot/contrataciones/contrataciones.do?method=buscar&_idDependencia=');
define('URL_REMUNERACIONES', 'http://portaltransparencia.gob.mx/pot/remuneracionMensual/remuneracionMensual.do?method=buscar&_idDependencia=');
define('URL_CONTRATO', 'http://portaltransparencia.gob.mx/pot/contrataciones/consultarContrato.do?method=consultaContrato');

# Esta fracción no le aplica a la institución

require 'vendor/autoload.php';

class PortalTransparencia {
    # Endpoint de instituciones

    public function instituciones($nombre = NULL) {
        if (nombre) {
            return $this->buscar_institucion($nombre);
        }
        return $this->buscar_instituciones();
    }

    # Endpoint de sectores

    public function sectores() {
        return $this->buscar_sectores();
    }

    # Endpoint de /contrataciones

    public function contrataciones($clave_institucion = NULL, $clave_contrato = NULL) {
        if (!$clave_institucion) {
            return array('mensaje_error' => 'Falta el parametro "clave_institucion"', 'error' => 1);
        }
        # Listar contrataciones de una institucion o una especifica
        if ($clave_contrato) {
            return $this->buscar_contratacion($clave_institucion, $clave_contrato);
        } else {
            return $this->buscar_contrataciones($clave_institucion);
        }
    }

    # Endpoint de /remuneraciones

    public function remuneraciones() {
        return $this->buscar_remuneraciones($institucion);
    }

    # Metodos que hacen todo

    private function buscar_instituciones() {
        $hunter = new \Ivansabik\DomHunter\DomHunter(URL_INSTITUCIONES);
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

    private function buscar_contrataciones($id_institucion) {
        $hunter = new \Ivansabik\DomHunter\DomHunter(URL_CONTRATACIONES . $id_institucion);
        $presas = array();
        $presas[] = array('nombre_institucion', new \Ivansabik\DomHunter\NodoDom(array('find' => '.style10'), 'plaintext'));
        $columnas = array('clave', 'procedimiento', 'asignado', 'fecha', 'objeto', 'monto', 'modificatorio');
        $presas[] = array('contrataciones', new \Ivansabik\DomHunter\Tabla(array('id_nodo' => 'contratoLista'), $columnas));
        $hunter->arrPresas = $presas;
        $hunted = $hunter->hunt();
        $hunted['clave_institucion'] = $id_institucion;
        $contrataciones = $hunted['contrataciones'];
        for ($i = 0; $i < count($contrataciones); $i++) {
            $contrataciones[$i]['url_info'] = URL_CONTRATO . '&id.idContrato=' . $contrataciones[$i]['clave'] . '&_idDependencia=' . $id_institucion;
            $contrataciones[$i]['url_api'] = 'consulta?tipo=contrataciones&institucion=' . $id_institucion . '&contrato=' . $contrataciones[$i]['clave'];
        }
        $hunted['contrataciones'] = $contrataciones;
        return $hunted;
    }

    private function buscar_remuneraciones($id_institucion) {
        $hunter = new \Ivansabik\DomHunter\DomHunter(URL_REMUNERACIONES . $id_institucion);
        $presas = array();
        $columnas = array('clave_puesto', 'nombre_puesto', 'tipo_personal', 'remuneracion_bruta', 'remuneracion_neta', 'moneda');
        $presas[] = array('remuneraciones', new \Ivansabik\DomHunter\Tabla(array('id_nodo' => 'puestos'), $columnas));
        $hunter->arrPresas = $presas;
        $hunted = $hunter->hunt();
        return $hunted['remuneraciones'];
    }

    private function buscar_contratacion($id_institucion, $id_contrato) {
        $curl_target = URL_CONTRATO . '&id.idContrato=' . $id_contrato . '&_idDependencia=' . $id_institucion;
        $hunter = new \Ivansabik\DomHunter\DomHunter($curl_target);
        $presas = array();
        $presas[] = array('nombre_institucion', new \Ivansabik\DomHunter\NodoDom(array('find' => '.style10'), 'plaintext'));
        $presas[] = array('sector_presupuestal', new \Ivansabik\DomHunter\KeyValue('SECTOR PRESUPUESTAL'));
        $presas[] = array('siglas', new \Ivansabik\DomHunter\KeyValue('SIGLAS'));
        $presas[] = array('fecha_actualizacion', new \Ivansabik\DomHunter\KeyValue('ltima fecha de actualizaci'));
        $presas[] = array('numero_contrato', new \Ivansabik\DomHunter\KeyValue('mero de Contrato'));
        $presas[] = array('unidad_administrativa', new \Ivansabik\DomHunter\KeyValue('Unidad administrativa que celebr'));
        $presas[] = array('procedimiento_contratacion', new \Ivansabik\DomHunter\KeyValue('Procedimiento de contrataci'));
        $presas[] = array('denominacion_asignado', new \Ivansabik\DomHunter\KeyValue('la persona moral a que se asign'));
        $presas[] = array('fecha_contrato', new \Ivansabik\DomHunter\KeyValue('Fecha de celebraci'));
        $presas[] = array('objeto_contrato', new \Ivansabik\DomHunter\KeyValue('Objeto de contrato'));
        $presas[] = array('monto_contrato', new \Ivansabik\DomHunter\KeyValue('Monto del contrato'));
        $presas[] = array('moneda', new \Ivansabik\DomHunter\KeyValue('Tipo de Moneda'));
        $presas[] = array('fecha_inicio', new \Ivansabik\DomHunter\KeyValue('Fecha de inicio del contrato'));
        $presas[] = array('fecha_fin', new \Ivansabik\DomHunter\KeyValue('Fecha de terminaci'));
        $presas[] = array('documento', new \Ivansabik\DomHunter\KeyValue('Documento del Contrato'));
        $hunter->arrPresas = $presas;
        $hunted = $hunter->hunt();
        $hunted['clave_institucion'] = $id_institucion;
        $hunted['url_info'] = $curl_target;
        return $hunted;
    }

    private function buscar_institucion($nombre) {
        return 'Falta implementierung! X_X';
    }

}

?>