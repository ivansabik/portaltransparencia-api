#!/usr/bin/php -q
<?php

# laetzter: 4200126021

require 'vendor/autoload.php';

define('URL_CONTRATO', 'http://portaltransparencia.gob.mx/pot/contrataciones/consultarContrato.do?method=consultaContrato');

$id_contrato = 4200126000;
$id_institucion = 18572;

$conexionMongo = new Mongo();
$mongodb = $conexionMongo->transparencia;
$mongocol = $mongodb->pgpb;

$contfail = 1;
foreach(range($id_contrato, $id_contrato + 5000000) as $id_contrato) {
    if($contfail) {
	    print 'Estoy en el contrato ' . $id_contrato . PHP_EOL;
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
	    if($hunted['numero_contrato']) {
		$mongocol->save($hunted);
		file_put_contents('json/' . $id_contrato . '.json', json_encode($hunted, JSON_FORCE_OBJECT));
		print 'Listo  ' . $id_contrato . '.json';
	    } else {
		print 'No se pudo obtener contrato ' . $id_contrato;
		#$contfail++;
	    }
	    print PHP_EOL;
    } else {
        exit('Finisheado por muchos fails, ' . PHP_EOL);
    }
}
