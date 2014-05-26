<?php

define('URL_INSTITUCIONES', 'http://portaltransparencia.gob.mx/buscador/search/search.do?method=begin');
define('URL_SECTORES', 'http://portaltransparencia.gob.mx/pot/informacion/buscarGrupoDependencia.do?method=mostrarGrupoDep');
define('URL_CONTRATACIONES', 'http://portaltransparencia.gob.mx/pot/contrataciones/contrataciones.do?method=buscar&_idDependencia=');
define('URL_REMUNERACIONES', 'http://portaltransparencia.gob.mx/pot/remuneracionMensual/remuneracionMensual.do?method=buscar&_idDependencia=');
define('URL_CONTRATO', 'http://portaltransparencia.gob.mx/pot/contrataciones/consultarContrato.do?method=consultaContrato');

# Esta fracción no le aplica a la institución

require 'vendor/autoload.php';

class PortalTransparencia {
    # Endpoint de /listado?tipo=sectores,
    # Endpoint de /listado?tipo=instituciones
    # Endpoint de /listado?tipo=areas

    public function listado($tipo = NULL) {
        if (!$tipo) {
            return array('mensaje_error' => 'Falta el parametro "tipo"', 'error' => 1);
        }
        if ($tipo == 'sectores') {
            return $this->buscar_sectores();
        } elseif ($tipo == 'instituciones') {
            return $this->buscar_instituciones();
        } elseif ($tipo == 'areas') {
            return 'Falta implementierung! X_X';
        } else {
            return array('mensaje_error' => '"tipo" es invalido', 'error' => 2);
        }
    }

    # Endpoint de /consulta?tipo=contrataciones
    # Endpoint de /consulta?tipo=concesiones
    # Endpoint de /consulta?tipo=subsidios
    # Endpoint de /consulta?tipo=remuneraciones

    public function consulta($tipo = NULL, $institucion = NULL, $contrato = NULL) {
        if (!$tipo) {
            return array('mensaje_error' => 'Falta el parametro "tipo"', 'error' => 3);
        }
        if (!$institucion) {
            return array('mensaje_error' => 'Falta el parametro "institucion"', 'error' => 4);
        }
        # Busca ID institucion para cuando da el nombre no el ID de la H inst
        if (!preg_match("/[0-9]{5}/", $institucion)) {
            $institucion = $this->buscar_id_institucion();
        }
        if ($tipo == 'contrataciones') {
            # Listar contrataciones de una institucion
            if ($contrato) {
                return $this->buscar_contratacion($institucion, $contrato);
            } else {
                return $this->buscar_contrataciones($institucion);
            }
            # Listar contracacion especifica
        } elseif ($tipo == 'concesiones') {
            return 'Falta implementierung! X_X';
        } elseif ($tipo == 'subsidios') {
            return 'Falta implementierung! X_X';
        } elseif ($tipo == 'remuneraciones') {
            return $this->buscar_remuneraciones($institucion);
        } else {
            return array('mensaje_error' => '"tipo" es invalido', 'error' => 5);
        }
    }

    # Endpoint de /busqueda?tipo=contrataciones
    # Endpoint de /busqueda?tipo=concesiones
    # Endpoint de /busqueda?tipo=subsidios
    # Endpoint de /busqueda?tipo=remuneraciones

    public function busqueda($tipo = NULL) {
        if (!$tipo) {
            return array('mensaje_error' => 'Falta el parametro "tipo"', 'error' => 6);
        }
        if ($tipo == 'contrataciones') {
            return 'Falta implementierung! X_X';
        } elseif ($tipo == 'concesiones') {
            return 'Falta implementierung! X_X';
        } elseif ($tipo == 'subsidios') {
            return 'Falta implementierung! X_X';
        } elseif ($tipo == 'remuneraciones') {
            return 'Falta implementierung! X_X';
        } else {
            return 'Falta implementierung! X_X';
        }
    }

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
        $columnas = array('clave', 'procedimiento', 'asignado', 'fecha', 'objeto', 'monto', 'modificatorio');
        $presas[] = array('contrataciones', new \Ivansabik\DomHunter\Tabla(array('id_nodo' => 'contratoLista'), $columnas));
        $hunter->arrPresas = $presas;
        $hunted = $hunter->hunt();
        $contrataciones = $hunted['contrataciones'];

        for ($i = 0; $i < count($contrataciones); $i++) {
            $contrataciones[$i]['url_info'] = URL_CONTRATO . '&id.idContrato=' . $contrataciones[$i]['clave'] . '&_idDependencia=' . $id_institucion;
            $contrataciones[$i]['url_api'] = 'consulta?tipo=contrataciones&institucion=' . $id_institucion . '&contrato=' . $contrataciones[$i]['clave'];
        }

        return $contrataciones;
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
        $hunter = new \Ivansabik\DomHunter\DomHunter(URL_CONTRATO . '&id.idContrato=' . $id_contrato . '&_idDependencia=' . $id_institucion);
        $presas = array();
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
        return $hunted;
    }

    private function buscar_id_institucion() {
        return 'Falta implementierung! X_X';
    }

}

?>