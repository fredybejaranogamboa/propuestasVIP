<?php

App::import('Vendor', 'tcpdf/tcpdf');
App::import('Vendor', 'EnLetras', array('file' => 'EnLetras.class.php'));

$pdf = new TCPDF("P", 'mm', "LETTER", true, 'UTF-8', false);
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->SetMargins(10, 10, 25);
$pdf->SetFont('Trebuchet', '', 12);
$V = new EnLetras();

$pdf->AddPage();

$sumaPagos = 0;
$pagosHechos = 0;

$codigo = $proyecto['Proyect']['codigo'];
$convocatoria = $proyecto['Call']['nombre'];
$fecha_res = $V->obtenerMes($resolucion['Resolution']['fecha']);
$annio_res = $V->obtenerAnnio($resolucion['Resolution']['fecha']);
$annio_convenio = $V->obtenerAnnio($resolucion['Resolution']['fecha_convenio']);
$num_res = $resolucion['Resolution']['numero'];

if ($pago['Payment']['asociation_id'] == 0 or is_null($pago['Payment']['asociation_id'])) {
    $nombre_representante = $beneficiario = $representante['Beneficiary']['nombres'] . " " . $representante['Beneficiary']['primer_apellido'] . " " . $representante['Beneficiary']['segundo_apellido'];
    $numero_identificacion_rep = $cedula = $nro_ident = $representante['Beneficiary']['numero_identificacion'];
    $telefono_rep = $representante['Beneficiary']['telefono'];
    $direccion_rep = $representante['Beneficiary']['direccion'] . "-" . $departamento . "-" . $representante['City']['name'];
} else {
    $beneficiario = $asociacion['Asociation']['nombre'];
    $nro_ident = $asociacion['Asociation']['nit'];
    $cedula = $asociacion['Asociation']['cedula_rep'];
    $nombre_representante = $asociacion['Asociation']['nombre_rep'] . " " . $asociacion['Asociation']['primer_apellido_rep'] . " " . $asociacion['Asociation']['segundo_apellido_rep'];
    $numero_identificacion_rep = $asociacion['Asociation']['cedula_rep'];
    $telefono_rep = $asociacion['Asociation']['telefono'];
    $direccion_rep = $asociacion['Asociation']['direccion'];
}


$nro_cuenta = $pago['Payment']['numero_cuenta'];
$banco = $pago['Payment']['nombre_banco'];
$tipo_cuenta = $pago['Payment']['tipo_cuenta'];

$objeto = "";
if ($proyecto['Proyect']['tipo'] == 'F') {
    if ($pago['Certification']['poblacion'] == 'PDRET') {
        $objeto = "POBLACIÓN PDRET - APOYO PROYECTOS DE DESARROLLO RURAL CON ENFOQUE TERRITORIAL, NIVEL NACIONAL. PROYECTO $codigo";
    } else {
        $objeto = "POBLACIÓN DESPLAZADA - ASISTENCIA Y ATENCIÓN A LA POBLACIÓN VICTIMA DEL DESPLAZAMIENTO CON PROYECTOS DE DESARROLLO RURAL A NIVEL NACIONAL. PROYECTO $codigo";
    }
} else {
    if ($pago['Certification']['poblacion'] == 'PDRET') {
        $objeto = "POBLACIÓN PDRET - APOYO PROYECTOS DE DESARROLLO RURAL CON ENFOQUE TERRITORIAL, NIVEL NACIONAL. PROYECTO $codigo, Convenio interadministrativo No. {$resolucion['Resolution']['numero_convenio']} de $annio_convenio";
    } else {
        $objeto = "POBLACIÓN DESPLAZADA - ASISTENCIA Y ATENCIÓN A LA POBLACIÓN VICTIMA DEL DESPLAZAMIENTO CON PROYECTOS DE DESARROLLO RURAL A NIVEL NACIONAL. PROYECTO $codigo, Convenio interadministrativo No. {$resolucion['Resolution']['numero_convenio']} de $annio_convenio";
    }
}


$formato = 'number_format';
$supervisor = $pago['Certification']['supervisor'];
$dependencia = $pago['Certification']['dependencia'];

$tbl = <<<EOD
<table cellpadding="2px" border="1" >
     <tr style="font-size:10">
        <td rowspan="3" width="130" align="center" ><img src="../webroot/img/logo_izq.jpg" /></td>
        <td width="180" align="left">MACROPROCESO: ADMINISTRATIVO Y FINANCIERO</td>
        <td width="110" align="center">CÓDIGO:<br>F7-AF-GRF-07</td>
        <td width="150" align="center" rowspan="3"><img src="../webroot/img/logo_der.jpg" /></td>
    </tr>
    <tr style="font-size:10">
        <td align="left">PROCESO:GESTIÓN RECURSOS FINANCIEROS</td>
        <td align="center">FECHA EDICIÓN:<br>10/12/2015</td>
    </tr>
    <tr style="font-size:10">
        <td align="left">FORMATO: CERTIFICACIÓN ESTÁNDAR - CENTRAL CUENTAS</td>
        <td align="center">Página:1 de 1</td>
    </tr>
    <tr style="font-size:12">
        <td colspan="4"><b>INFORMACIÓN BÁSICA</b></td>
    </tr>
    <tr style="background-color:#CCCCCC;font-size:10;">
        <td><b>ACTO ADMINTIVO No.</b></td>
        <td colspan="2" align="center"><b>BENEFICIARIO</b></td>
        <td align="center" ><b>NIT O CEDULA </b></td>
    </tr>
    <tr style="font-size:8">
        <td align="center">$num_res de $annio_res</td>
        <td colspan="2" align="center">$beneficiario</td>
        <td align="center" >$nro_ident</td>
    </tr>
    <tr style="text-align:center; background-color:#CCCCCC;font-size:10;">
        <td>No DE FACTURA</td>
        <td>FECHA DE LA FACTURA</td>
        <td>VALOR</td>
        <td>PERIODO</td>
    </tr>
    <tr style="font-size:10;text-align:center">
        <td>N/A</td>
        <td>N/A</td>
        <td>N/A</td>
        <td>N/A</td>
    </tr>
    <tr>
        <td align="center" style="background-color:#CCCCCC;font-size:10">CONCEPTO</td>
        <td colspan="3" align="center"></td>
    </tr>
    <tr style="font-size:10">
        <td colspan="4" align="left">$objeto</td>
    </tr>
    <tr style="background-color:#CCCCCC ;font-size:10" >
        <td align="center">INTERVENTOR</td>
        <td align="center">SUPERVISOR</td>
        <td colspan="2" align="left"> DEPENDENCIA</td>
    </tr>
    <tr style="font-size:10">
        <td  align="left" style="font-size:8" colspan="1" ></td>
        <td  align="left" style="font-size:9" colspan="1" >$supervisor</td>
        <td colspan="2" align="left">$dependencia</td>
    </tr>
    <tr style="background-color:#CCCCCC;font-size:10">
        <td colspan="4" align="center">CUENTA BANCARIA - Registrada en el SIIF</td>
    </tr>
    <tr style="font-size:10">
        <td align="center">No.$nro_cuenta</td>
        <td align="center"> Banco: $banco</td>
        <td colspan="2" align="center">Cuenta: $nro_cuenta $tipo_cuenta</td>
    </tr>
    <tr style="font-size:10" align="left" >
        <td colspan="2" align="left">CONTROL SALDOS DEL CONTRATO</td>
        <td align="center"> </td>
        <td align="center"></td>
    </tr>
    <tr style="font-size:10" align="left" >
        <td colspan="2" align="left"></td>
        <td align="center">CDP</td>
        <td align="center">RP</td>
    </tr>
    <tr align="left" style="font-size:10" >
        <td colspan="2" align="left"></td>
        <td align="center">{$pago['Certification']['cdp']}</td>
        <td align="center">{$pago['Certification']['rp']}</td>
    </tr>
     <tr align="left" style="font-size:10">
        <td colspan="2" align="left" style="border-bottom: hidden"></td>
        <td align="center"><b>CONTRATO</b></td>
        <td align="center"><b>ANTICIPO</b></td>
    </tr>
     <tr align="left"  style="font-size:10">
        <td colspan="2" align="left" style="font-size: 10;border-bottom-color:#ffffff">VALORES INICIALES</td>
        <td align="center">$ {$formato($evaluacion['Evaluation']['cofinanciacion'], 2, ',', '.')} </td>
        <td align="center" style="font-size: 10;border">$0</td>
    </tr>
    <tr align="left" style="font-size:10">
        <td align="left" colspan="2" style="font-size: 9;border-color:#ffffff">+ADICIONES </td>
        <td align="center">$0</td>
        <td align="center">$0</td>
    </tr>
   <tr align="left" style="font-size:10">
        <td align="left" colspan="2" style="font-size: 9;border-color:#ffffff"><b>= VALORES TOTALES</b></td>
        <td style="background-color:#CCCCCC" align="center">$ {$formato($evaluacion['Evaluation']['cofinanciacion'], 2, ',', '.')}</td>
        <td align="center">$0</td>
    </tr>
    <tr align="left" style="font-size:10">
        <td align="left" colspan="2" style="font-size:9;border-color:#ffffff">- TOTAL PAGOS Y/O AMORTIZACIONES ANTES DE ESTA FACTURA </td>
        <td align="center">$ {$formato($pagosAnteriores, 2, ',', '.')}</td>
        <td align="center">$0</td>
    </tr>
    <tr align="left" style="font-size:10" >
        <td align="left" colspan="2" style="font-size: 9;border-color:#ffffff">- PAGADO Y/O AMORTIZADO EN LA FECHA</td>
        <td align="center">$ {$formato($pago['Certification']['valor'], 2, ',', '.')}</td>
        <td align="center">$0</td>
    </tr>
    <tr align="left" style="font-size:10">
        <td align="left" colspan="2" style="font-size: 9;border-color:#ffffff">= VALORES TOTALES PAGADOS Y/O AMORTIZADO A LA FECHA </td>
        <td style="background-color:#CCCCCC" align="center">$ {$formato($pago['Certification']['valor'] + $pagosAnteriores, 2, ',', '.')}</td>
        <td align="center">$0</td>
    </tr>
    <tr align="left" style="font-size:10">
        <td align="left" colspan="2" style="font-size: 9;border-color:#ffffff">= SALDOS ACTUALES (DESPUÉS DE ESTA FACTURA).</td>
        <td style="background-color:#CCCCCC" align="center">$ {$formato($evaluacion['Evaluation']['cofinanciacion'] - $pago['Certification']['valor'] - $pagosAnteriores, 2, ',', '.')}</td>
        <td align="center">$0</td>
    </tr>
    <tr align="left" style="font-size:10" >
        <td align="center" colspan="4"></td>
    </tr>
    <tr align="left" style="font-size:10" >
        <td align="left" colspan="4"><b> OBSERVACIONES:</b></td>
    </tr>
    <tr align="left" style="font-size:8">
        <td align="left" colspan="4">
                    Nombre del representante: $nombre_representante<br>
                    Número de identificación: $numero_identificacion_rep <br>
                    Teléfono contacto: $telefono_rep  <br>
                    Dirección: $direccion_rep
        </td>
    </tr>
    <tr style="font-size:8">
        <td align="left" rowspan="2" colspan="2"></td>
        <td   colspan="2" style="font-size: 8 ;text-align:justify;" >a. Cumplimiento del objeto del contrato: Es recibir a entera satisfacción los servicios contratados. </td>
    </tr>
    <tr style="font-size:8">
        <td  rowspan="2" colspan="2" style="font-size: 8;text-align:justify; "> b. Calidad del servicio: Es la evaluación de los recursos humanos, técnicos, financieros y materiales indispensables para la prestación óptima del servicio.</td>
    </tr>
    <tr style="font-size:8">
        <td align="center" colspan="2" >INTERVENTOR</td>
    </tr> 
   <tr style="font-size:8">
        <td colspan="2" ><br><br><br></td>
        <td colspan="2" rowspan="2" style="font-size: 8;text-align:justify;">c. Cumplimiento de las obligaciones contractuales: Es la realización de los deberes y funciones propias del objeto contractual. (Tareas, Responsabilidades, Trabajos, Relaciones interpersonales, entre otros) </td>
    </tr>
   <tr style="font-size:9">
        <td align="center" colspan="2">SUPERVISOR</td>
    </tr>
</table>
       
EOD;

$pdf->writeHTML($tbl, true, false, false, false, '');

//$pdf->Image("../webroot/img/image_demo.jpg", 15, 140, 75, 113, 'JPG', 'http://www.tcpdf.org', '', true, 150, '', false, false, 1, false, false, false);
// Set some content to print
// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('certificacion_notarial_' . $codigo . '.pdf', 'I');
?>