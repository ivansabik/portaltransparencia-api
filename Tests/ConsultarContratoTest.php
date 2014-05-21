<?php

use Ivansabik\DomHunter\DomHunter;
use Ivansabik\DomHunter\KeyValue;
use Ivansabik\DomHunter\IdUnico;
use Ivansabik\DomHunter\NodoDom;
use Ivansabik\DomHunter\Tabla;

class ConsultarContratoTest extends PHPUnit_Framework_TestCase {

    private $_hunter, $_hunted;
    private static $_assert = array(
        
    );

    protected function setUp() {
        $html = '<table width="100%"><tbody><tr><td><table cellpadding="0" cellspacing="0" width="100%"><!--Se agrego width--><tbody><tr class="posicion"><td scope="col" align="left" height="83" valign="top" width="100%"><p class="style1" align="center"><span class="style10">INSTITUTO NACIONAL DE CARDIOLOGÍA IGNACIO CHÁVEZ</span></p><p class="style1"><span class="style2">SECTOR PRESUPUESTAL:</span><span><i>Salud</i><br></span><span class="style2">SIGLAS:</span><span>I.N.C.I.CH.<br><br></span><span><!-- Informacion de subtitulo -->XIII. CONTRATACIONES</span></p></td><!--<td scope="col" align="center" valign="top" width="146"><img alt="Logo" src="http://portaltransparencia.gob.mx/pdf/imagenes/12220" height="78" >--><!--<img alt="logo" src="/pot/imagenes/12220" height="78" ></td>--></tr><!-- Inicio cambio - Incidencia 10 --><tr class="posicion"><td colspan="2"><p class="style3"><span>Última fecha de actualización<img alt="flecha" src="/pot/resources/images/icon_flecha.gif" width="7" height="7">12/05/2014</span></p></td></tr><!-- Fin cambio - Incidencia 10 --></tbody></table></td></tr><tr><td><table width="100%"><tbody><tr><td class="areaPrincipal"><!-- Informacion de contenido --><!-- Inicio cambio - Incidencia 10 --><!-- Fin cambio - Incidencia 10 --><link rel="stylesheet" type="text/css" href="/pot/resources/css/calendario/calendar-system.css"><script type="text/javascript" src="/pot/resources/js/calendario/calendar.js"></script><script type="text/javascript" src="/pot/resources/js/calendario/lang/calendar-es.js"></script><script type="text/javascript" src="/pot/resources/js/calendario/calendar-setup.js"></script><script type="text/javascript" src="/pot/resources/js/vfecha.js"></script><form name="contratoForm" method="post" action="/pot/contrataciones/saveContrato.do?method=save&amp;_idDependencia=12220" onsubmit="return validateContratoForm(this)" id="contratoForm"><div id="overDiv" style="position:absolute; visibility:hide;z-index:9;"></div><input type="hidden" name="id.idDependencia" value="12220"><!-- Content information --><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"><tbody><tr class="trC"><td colspan="2" class="td9"><table width="100%" border="0" cellspacing="0" cellpadding="0"><tbody><tr><td bgcolor="#FFFFFF" class="contenidoportlet2"><table width="100%" border="0" cellspacing="0" cellpadding="0"><tbody><tr><td><table width="100%" align="center" cellpadding="0" cellspacing="0"><tbody><tr><td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0"><tbody><tr><td colspan="2"><table width="18%" border="0" cellspacing="0" cellpadding="0"><tbody><tr valign="top"><td height="1"><img alt=" " src="/pot/resources/images/img_transparent" width="1" height="1"></td><td height="1" style="background-image:url(/pot/resources/images/line_dash_horiz.gif)"><img alt="Punto" src="/pot/resources/images/line_dash_horiz.gif" width="6" height="1"></td><td height="1"><img alt=" " src="/pot/resources/images/img_transparent" width="1" height="1"></td></tr><tr><td width="1" valign="top" style="background-image:url(/pot/resources/images/line_dash_vert.gif)"><img alt="Punto" src="/pot/resources/images/line_dash_vert.gif" width="1" height="6"></td><td><table width="100%" border="0" cellspacing="0" cellpadding="0"><tbody><tr><td width="99%" class="contenidoayudainstruccion" colspan="2"><a class="contenido_link_bold" href="javascript:openWindow(\'ayudaDetalle.jsp\')">Ayuda en línea</a></td></tr></tbody></table></td><td width="1" valign="top" style="background-image:url(/pot/resources/images/line_dash_vert.gif)"><img alt="Punto" src="/pot/resources/images/line_dash_vert.gif" width="1" height="6"></td></tr><tr valign="top"><td height="1"><img alt=" " src="/pot/resources/images/img_transparent" width="1" height="1"></td><td height="1" style="background-image:url(/pot/resources/images/line_dash_horiz.gif)"><img alt="Punto" src="/pot/resources/images/line_dash_horiz.gif" width="6" height="1"></td><td height="1"><img alt=" " src="/pot/resources/images/img_transparent" width="1" height="1"></td></tr></tbody></table></td></tr></tbody></table></td></tr><tr><td width="100%" valign="middle" class="datosformaDetalleTitulo" colspan="2">Detalle del Contrato</td></tr><tr><td width="25%" valign="middle" class="datosforma">Número de Contrato<img alt="flecha" src="/pot/resources/images/icon_flecha.gif" width="7" height="7"></td><td width="27%" valign="middle" class="contentabla">130767<input type="hidden" name="id.idContrato" value="130767"></td></tr><tr><td valign="middle" class="datosforma">Unidad administrativa que celebró el contrato<img alt="flecha" src="/pot/resources/images/icon_flecha.gif" width="7" height="7"></td><td valign="middle" class="contentabla">SUBDIRECCIÓN DE RECURSOS MATERIALES</td></tr><tr><td valign="middle" class="datosforma">Procedimiento de contratación<img alt="flecha" src="/pot/resources/images/icon_flecha.gif" width="7" height="7"></td><td valign="middle" class="contentabla">ADJUDICACION DIRECTA</td></tr><tr><td valign="middle" class="datosforma">Nombre de la persona física o denominación o razón social de la persona moral a que se asignó el contrato<img alt="flecha" src="/pot/resources/images/icon_flecha.gif" width="7" height="7"></td><td valign="middle" class="contentabla">QUIMICA AVANZADA EN TRATAMIENTO DE AGUAS, S.A. DE C.V.</td></tr><tr><td valign="middle" class="datosforma">Fecha de celebración del contrato<img alt="flecha" src="/pot/resources/images/icon_flecha.gif" width="7" height="7"></td><td valign="middle" class="contentabla">11/11/2013</td></tr><tr><td valign="middle" class="datosforma">Objeto de contrato<img alt="flecha" src="/pot/resources/images/icon_flecha.gif" width="7" height="7"></td><td valign="middle" class="contentabla">Material de limpieza</td></tr><tr><td valign="middle" class="datosforma">Monto del contrato<img alt="flecha" src="/pot/resources/images/icon_flecha.gif" width="7" height="7"></td><td valign="middle" class="contentabla">$124,830.13</td></tr><tr><td valign="middle" class="datosforma">Tipo de Moneda<img alt="flecha" src="/pot/resources/images/icon_flecha.gif" width="7" height="7"></td><td valign="middle" class="contentabla">PESOS</td></tr><tr><td valign="middle" class="datosforma">&nbsp;</td><td valign="middle" class="contentabla">Tipo de cambio de referencia:$1.00<br>Monto en Pesos:$124,830.13</td></tr><tr><td valign="middle" class="datosforma">Fecha de inicio del contrato<img alt="flecha" src="/pot/resources/images/icon_flecha.gif" width="7" height="7"></td><td valign="middle" class="contentabla">15/11/2013</td></tr><tr><td valign="middle" class="datosforma">Fecha de terminación del contrato<img alt="flecha" src="/pot/resources/images/icon_flecha.gif" width="7" height="7"></td><td valign="middle" class="contentabla">30/12/2013</td></tr><tr><td valign="middle" class="datosforma">Documento del Contrato<img alt="flecha" src="/pot/resources/images/icon_flecha.gif" width="7" height="7"></td><td valign="middle" class="contentabla">N/A</td></tr><!--Indicar cuando se tiene convenio modificatorio y no se ha cargado la información TVC 28/07/09--><tr><td>&nbsp;</td></tr><tr><td colspan="2" align="center" class="downttabla"><table width="90" border="0" cellspacing="0" cellpadding="0"><tbody><tr><td style="width: 9" nowrap=""><span class="style1"><a href="javascript:history.go(-1)" onmouseover="MM_swapImage(\'Image2\',\'\',\'/pot/resources/images/buttons/regresar2.gif\',1)" onmouseout="MM_swapImgRestore()"><img alt="Regresar" src="/pot/resources/images/buttons/regresar1.gif" name="Image2" border="0" id="Image2"></a></span></td></tr></tbody></table></td></tr></tbody></table></td></tr><tr><td colspan="2">&nbsp;</td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></form></td></tr></tbody></table></td></tr></tbody></table>';

        $this->_hunter = new DomHunter();
        $this->_hunter->strHtmlObjetivo = $html;

        $presas[] = array('sector_presupuestal', new KeyValue('SECTOR PRESUPUESTAL'));
        $presas[] = array('siglas', new KeyValue('SIGLAS'));
        $presas[] = array('fecha_actualizacion', new KeyValue('Última fecha de actualizaci'));
        $presas[] = array('numero_contrato', new KeyValue('mero de Contrato'));
        $presas[] = array('unidad_administrativa', new KeyValue('Unidad administrativa que celebr'));
        $presas[] = array('procedimiento_contratacion', new KeyValue('Procedimiento de contrataci'));
        $presas[] = array('denominacion_asignado', new KeyValue('n social de la persona moral a que se asig'));
        $presas[] = array('fecha_contrato', new KeyValue('Fecha de celebraci'));
        $presas[] = array('objeto_contrato', new KeyValue('Objeto de contrato'));
        $presas[] = array('monto_contrato', new KeyValue('Monto del contrato'));
        $presas[] = array('moneda', new KeyValue('Tipo de Moneda'));
        $presas[] = array('fecha_inicio', new KeyValue('Fecha de inicio del contrato'));
        $presas[] = array('fecha_fin', new KeyValue('Fecha de terminaci'));
        $presas[] = array('documento', new KeyValue('Documento del Contrato'));

        $this->_hunter->arrPresas = $presas;
        $this->_hunted = $this->_hunter->hunt();
    }

    public function testSectorPresupuestal() {
        $this->assertEquals(self::$_assert['sector_presupuestal'], $this->_hunted['sector_presupuestal']);
    }

    public function testSiglas() {
        $this->assertEquals(self::$_assert['siglas'], $this->_hunted['siglas']);
    }

    public function testFechaActualizacion() {
        $this->assertEquals(self::$_assert['fecha_actualizacion'], $this->_hunted['fecha_actualizacion']);
    }

    public function testNumeroContrato() {
        $this->assertEquals(self::$_assert['numero_contrato'], $this->_hunted['numero_contrato']);
    }

    public function testUnidadAdministrativa() {
        $this->assertEquals(self::$_assert['unidad_administrativa'], $this->_hunted['']);
    }

    public function testProcedimientoContratacion() {
        $this->assertEquals(self::$_assert['procedimiento_contratacion'], $this->_hunted['procedimiento_contratacion']);
    }

    public function testDenominacionAsignado() {
        $this->assertEquals(self::$_assert['denominacion_asignado'], $this->_hunted['denominacion_asignado']);
    }

    public function testFechaContrato() {
        $this->assertEquals(self::$_assert['fecha_contrato'], $this->_hunted['fecha_contrato']);
    }

    public function testObjetoContrato() {
        $this->assertEquals(self::$_assert['objeto_contrato'], $this->_hunted['objeto_contrato']);
    }

    public function testMontoContrato() {
        $this->assertEquals(self::$_assert['monto_contrato'], $this->_hunted['monto_contrato']);
    }

    public function testMoneda() {
        $this->assertEquals(self::$_assert['moneda'], $this->_hunted['moneda']);
    }

    public function testFechaInicio() {
        $this->assertEquals(self::$_assert['fecha_inicio'], $this->_hunted['fecha_inicio']);
    }

    public function testFechaFin() {
        $this->assertEquals(self::$_assert['fecha_fin'], $this->_hunted['fecha_fin']);
    }

    public function testDocumento() {
        $this->assertEquals(self::$_assert['documento'], $this->_hunted['documento']);
    }

}
