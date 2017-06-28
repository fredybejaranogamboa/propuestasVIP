<?php

App::import('Vendor', 'tcpdf/tcpdf');
App::import('Vendor', 'EnLetras', array('file' => 'EnLetras.class.php'));

class MYPDF extends TCPDF {

    var $resolucion;
    var $asociaciones;
    var $flag = 0;

    //Page header
    public function Header() {

        $fecha = $this->resolucion['Resolution']['fecha'];
        $anio = explode("-", $fecha);
        $anio = $anio[0];

        $nombre_asociaciones = "";
        foreach ($this->asociaciones as $asociacion) {
            $nombre_asociaciones .= $asociacion['Asociation']['nombre'] . " NIT - " . $asociacion['Asociation']['nit'] . " ";
        }

        $bMargin = $this->getBreakMargin();
        // get current auto-page-break mode
        $auto_page_break = $this->AutoPageBreak;
        // disable auto-page-break
        $this->SetAutoPageBreak(false, 0);

        $de = str_replace("\n", "", $this->getAliasNbPages());
        $tabla = '<table border="0"><tr><td width="120px">RESOLUCIÓN</td><td width="30px"></td><td>DE ' . $anio . ' </td><td width="100px"></td><td width="150px">HOJA No ' . $this->getAliasNumPage() . ' DE ' . $de . '</td></tr></table>';

        $tx = "";
        if ($this->flag == 1) {
            $tx.= '<span style="text-align:center; font-size:smaller" ><br> Continuación de la Resolución “Por medio de la cual se cofinancia el proyecto de desarrollo rural con enfoque territorial  ' . $this->resolucion['Proyect']['codigo'] . ', presentado por la persona jurídica ' . strtoupper($nombre_asociaciones) . ' en el marco de lo dispuesto por el Acuerdo 344 de 2014 proferido por el Consejo Directivo del INCODER”</span><br>';
        }

        $img_file = '../webroot/img/rectangulo.jpg';
        $this->writeHTML("<br>$tabla", true, false, false, false, '');
        $this->Image($img_file, 10, 10, 200, 300, '', '', '', false, 300, '', false, false, 0);
        $this->writeHTML("<br>$tx", true, false, false, false, '');

        // restore auto-page-break status
        $this->SetAutoPageBreak($auto_page_break, $bMargin);
        // set the starting point for the page content
        $this->setPageMark();
    }

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        // $this->SetY(-20);

        $this->Image('../webroot/img/rectangulo.jpg', 0, 240, 230, 30, 'PNG', 'http://www.tcpdf.org', '', true, 150, '', false, false, 1, false, false, false);
    }

}

$pdf = new MYPDF("P", 'mm', "FOLIO", true, 'UTF-8', false);
$pdf->resolucion = $resolucion;
$pdf->asociaciones = $asociaciones;
$pdf->setPrintFooter(false);
$pdf->SetMargins(25, 32, 25);

$pdf->setPageOrientation("P", true, 25);
$pdf->AddPage();
$pdf->flag = 1;

$anio = "";
$mes = "";
$dia = "";
$anio_acta = "";
$dia_acta = "";
$anio_convenio = "";

$fecha = "";
$fecha_acta = "";
$fecha_convenio = "";

if (is_null($resolucion['Proyect']['nombre'])) {
    $nombre_proyecto = "";
} else {
    $nombre_proyecto = strtoupper($resolucion['Proyect']['nombre']);
}

if (!empty($resolucion['Resolution']['fecha']) and $resolucion['Resolution']['fecha'] != "") {
    $fecha = explode("-", $resolucion['Resolution']['fecha']);
    $anio = $fecha[0];
    $mes = $fecha[1];
    $dia = $fecha[2];
}
if (!empty($resolucion['Resolution']['fecha_acta']) and $resolucion['Resolution']['fecha_acta'] != "") {
    $fecha_acta = explode("-", $resolucion['Resolution']['fecha_acta']);
    $anio_acta = $fecha_acta[0];
    $dia_acta = $fecha_acta[2];
}
if (!empty($resolucion['Resolution']['fecha_convenio']) and $resolucion['Resolution']['fecha_convenio'] != "") {
    $fecha_convenio = explode("-", $resolucion['Resolution']['fecha_convenio']);
    $anio_convenio = $fecha_convenio[0];
}


$pdf->SetFont('Trebuchet', '', 12);
$img_file = '../webroot/img/escudoResolucion.jpg';
$pdf->Image($img_file, 98, 0, 30, 30, '', '', '', false, 300, '', false, false, 0);
$EnLetras = new EnLetras();
$valor_total = $EnLetras->ValorEnLetras($evaluacion['Evaluation']['contrapartida'] + $evaluacion['Evaluation']['cofinanciacion'] + $evaluacion['Evaluation']['otras_fuentes'], 'PESOS');
$cofinanciacion = $EnLetras->ValorEnLetras($evaluacion['Evaluation']['cofinanciacion'], 'PESOS');
$contrapartida = $EnLetras->ValorEnLetras($evaluacion['Evaluation']['contrapartida'], 'PESOS');
$otras_fuentes = $EnLetras->ValorEnLetras($evaluacion['Evaluation']['otras_fuentes'], 'PESOS');
$str = '<br><br><span style="text-align:center;" >INSTITUTO COLOMBIANO DE DESARROLLO RURAL-INCODER - EN LIQUIDACIÓN</span><br>';
$pdf->writeHTML($str, true, false, false, false, '');
$str = 'RESOLUCIÓN NÚMERO                  DE ' . $anio;
$pdf->Cell(0, 0, $str, 0, 1, 'C', 0, '', 0);
$pdf->Cell(0, 0, "(                                         )", 0, 1, 'C', 0, '', 0);
$resolucion['Proyect']['codigo'] = strtoupper($resolucion['Proyect']['codigo']);
$nombre_asociaciones = "";
foreach ($asociaciones as $asociacion) {
    $nombre_asociaciones .= $asociacion['Asociation']['nombre'] . " NIT - " . $asociacion['Asociation']['nit'] . " ";
}

$pdf->SetFont('Trebuchet', '', 10);
$str = '<br><br><span style = "text-align:center;" >"Por medio de la cual se cofinancia el proyecto de desarrollo rural con enfoque territorial  ' . $resolucion['Proyect']['codigo'] . ', presentado por la persona jurídica ' . strtoupper($nombre_asociaciones) . ' en el marco de lo dispuesto por el Acuerdo 344 de 2014 proferido por el Consejo directivo del INCODER y se otorga un incentivo" </span><br>';

$pdf->writeHTML($str, true, false, false, false, '');
$pdf->SetFont('Trebuchet', '', 12);
$str = '<span style = "text-align:center;" >EL DIRECTOR TERRITORIAL ' . strtoupper($departamento) . ' DEL INSTITUTO COLOMBIANO DE DESARROLLO RURAL - INCODER - EN LIQUIDACIÓN, </span><br>';
$pdf->writeHTML($str, true, false, false, false, '');
$pdf->SetFont('Trebuchet', '', 10);
$str = '<span style = "text-align:center;" >En ejercicio de sus facultades legales y en especial las conferidas por la Ley 160 de 1994, Decreto único Reglamentario No. 1071 del 26 de mayo de 2015, Decreto 2365 del 07 de diciembre de 2015, Resolución No. 00007 del 07 de diciembre de 2015, Resolución No. 00015 del 11 de diciembre de 2015, Circular interna No. 005 del 15 de diciembre de 2015 y</span><br>';
$pdf->writeHTML($str, true, false, false, false, '');
$pdf->SetFont('Trebuchet', '', 12);
$str = '<span style = "text-align:center;" >CONSIDERANDO:</span><br>';
$pdf->writeHTML($str, true, false, false, false, '');
$pdf->SetFont('Trebuchet', '', 10);

$str = '<span style = "text-align:justify;font-style:italic" >Que los artículos 2, 13 y 65 de la Constitución Política, establecen que son fines esenciales del Estado, entre otros, promover la prosperidad general brindando especial atención a aquéllas personas que por su condición económica se encuentren en circunstancias de debilidad manifiesta, así como la prioridad del desarrollo integral de las actividades agrícolas, pecuarias, pesqueras, forestales y agroindustriales, con el propósito de incrementar su productividad.</span><br><br>';
$str.='<span style="text-align:justify;" >Que la Constitución Política de Colombia consagra en el artículo 64 como deber del Estado, el promover el acceso progresivo a la propiedad de la tierra de los trabajadores agrarios, en forma individual o asociativa, con el fin de mejorar el ingreso y calidad de vida de los campesinos.</span><br><br>';
$str.='<span style="text-align:justify;" >Que igualmente, el artículo 65 de la Carta Política dispone que la producción de alimentos goza de especial protección del Estado y que para tal efecto, se otorgará prioridad al desarrollo integral de las actividades agrícolas, pecuarias, pesqueras, forestales y agroindustriales, así como también a la construcción de obras de infraestructura física y adecuación de tierras.</span><br><br>';
$str.='<span style="text-align:justify;" >Que el artículo 209 de la Constitución Política de 1991, establece que la función administrativa se desarrolla con fundamento en los principios de igualdad, moralidad, eficacia, economía, celeridad, imparcialidad y publicidad.</span><br><br>';
$pdf->writeHTML($str, true, false, false, false, '');
$str = '<span style="text-align:justify;" >Que conforme a lo dispuesto en el ordinal segundo (2°) del artículo 1° de la Ley 160 de 1994, uno de los objetivos de la norma en cita, consiste en reformar la estructura social agraria por medio de procedimientos encaminados  a eliminar y prevenir la inequitativa concentración de la propiedad rústica o su fraccionamiento antieconómico y dotar de tierras a los hombres y mujeres campesinos de escasos recursos, mayores de 16 años que no la posean, a los minifundistas, mujeres campesinas jefes de hogar, a las comunidades indígenas y a los beneficiarios de los programas especiales que establezca el Gobierno Nacional.</span><br><br>';
$str.='<span style="text-align:justify;" >Que igualmente, el ordinal séptimo (7°) del artículo 1° de la Ley 160 de 1994, establece como objeto de la ley el promover, apoyar y coordinar el mejoramiento económico, social y cultural de la población rural y estimular la participación de las organizaciones campesinas en el proceso integral de la Reforma Agraria y el Desarrollo Rural Campesino para lograr su fortalecimiento.</span><br><br>';
$str.='<span style="text-align:justify;" >Que de acuerdo con el artículo 2º del Decreto 3759 de 2009, el Instituto Colombiano de Desarrollo Rural - INCODER, es el ejecutor de la política agropecuaria y de desarrollo rural que establezca el Gobierno Nacional para el país.</span><br><br>';
$str.='<span style="text-align:justify;" >Que el artículo 4º del Decreto 3759 de 2009, señala como funciones del INCODER, entre otras, las de financiar y cofinanciar planes, programas y proyectos de inversión para la ejecución de programas de desarrollo agropecuario y rural.</span><br><br>';
$str.='<span style="text-align:justify;" >Que el Consejo Directivo del Instituto, profirió el Acuerdo No. 344 de fecha 16 de diciembre de 2014, “Por el cual se reglamenta el programa de financiación y cofinanciación de proyectos Productivos de desarrollo rural con enfoque territorial en las áreas de actuación del INCODER”, el cual tiene como objetivo planificar,financiar o cofinanciar proyectos Productivos a desarrollar en el ámbito rural, los cuales podrán ser agrícolas, pecuarios, forestales, acuícolas, pesqueros o relacionados con el sector rural, '
        . 'ya sea de manera individual o a través de esquemas asociativos dentro de las áreas focalizadas y priorizadas por el Instituto, atendiendo principalmente aquellas que defina el Gobierno Nacional para realizar intervenciones integrales, promoviendo el ordenamiento económico, productivo , social y ambiental de los territorios rurales, con el fin de contribuir a la reducción de la pobreza rural, fortalecer la capacidad de generación de ingresos, situar a la población en las cadenas productivas, mejorar las condiciones de vida de la población rural, y aumentar la competitividad de la producción regional.</span><br><br>';
$pdf->writeHTML($str, true, false, false, false, '');
$str = '<span style="text-align:justify;" >Que la Subgerencia de Gestión y Desarrollo Productivo con el fin de determinar la focalización y la priorización de las áreas de intervención expidió el respectivo documento técnico con base en los lineamientos de política que establezca el Ministerio de Agricultura y Desarrollo Rural el cual fue aprobado por la Gerencia General del INCODER.</span><br><br>';
$str.='<span style="text-align:justify;" >Que de conformidad con lo dispuesto en los artículos Séptimo, Octavo y Décimo del Acuerdo No. 344 de 2014, así como lo contemplado  en el “Manual de financiación y/o cofinanciación para la formulación, ejecución, evaluación y seguimiento de proyectos Productivos del INCODER”, se adelantaron las actuaciones de focalización y priorización de las potenciales personas jurídicas sin ánimo de lucro y los beneficiarios que estas representan para ser adjudicatarias del incentivo para la financiación y/o cofinanciación de sus iniciativas.</span><br><br>';
$str.='<span style="text-align:justify;" >Que con fundamento en los artículos Decimocuarto, Decimoquinto, Vigésimo y siguientes del Acuerdo No. 344 de 2014, en el “Manual de financiación y/o cofinanciación para la formulación, ejecución, evaluación y seguimiento de proyectos Productivos  de desarrollo rural con enfoque territorial”, las personas jurídicas sin ánimo de lucro y/o personas naturales beneficiarios del incentivo para la cofinanciación y/o financiación del proyecto productivo, son sujetos de verificación del cumplimiento de los requisitos para poder acceder al programa.</span><br><br>';
$pdf->writeHTML($str, true, false, false, false, '');
$str = '<span style="text-align:justify;" >Que el INCODER suscribió con el departamento de ' . strtoupper($departamento) . ' el convenio interadministrativo número ' . $resolucion['Resolution']['numero_convenio'] . ' de ' . $anio_convenio . ' para la financiación y/o cofinanciación de proyectos productivos de desarrollo rural con enfoque territorial  y de esta manera aunar esfuerzos y optimizar recursos para la financiación y/o cofinanciación de proyectos productivos de desarrollo rural en el territorio del Departamento de ' . strtoupper($departamento) . ', con el fin de generar las condiciones y capacidades locales para el desarrollo rural.</span><br><br>';
$str.='<span style="text-align:justify;" >Que en el marco del convenio se estableció una instancia técnica administrativa denominada “Comité Técnico Territorial” cuyas funciones se encuentran detalladas en el respectivo convenio, a través de las cuales se realiza la ejecución de las actividades del programa.</span><br><br>';
$str.='<span style="text-align:justify;" >Que el marco del Comité Técnico Territorial, mediante acta de fecha ' . $EnLetras->SubValLetra($dia_acta) . " (" . $dia_acta . ') días del mes de ' . $EnLetras->getMontName($resolucion['Resolution']['fecha_acta']) . ' del ' . $anio_acta . ' INCODER, se seleccionó a la persona jurídica ' . strtoupper($nombre_asociaciones) . ', teniendo en cuenta los requisitos establecidos para estos fines en el Acuerdo 344 de 2014.</span><br><br>';
$str.='<span style="text-align:justify;" >Que de acuerdo a lo establecido en el artículo Decimocuarto y Decimoquinto del Acuerdo No. 344 de 2014, respecto a las calidades de las personas jurídicas sin ánimo de lucro y las personas naturales que éstas representan, se verificó y determinó que no incurren en ninguna de las prohibiciones ni restricciones para la elegibilidad, aspecto sobre el cual el Director Territorial y el Coordinador Técnico certificaron la calidad de las personas jurídicas y/o los beneficiarios y los predios en los cuales se desarrollará el respectivo proyecto productivo.</span><br><br>';
$pdf->writeHTML($str, true, false, false, false, '');
$str = '<span style="text-align:justify;" >Que dentro del procedimiento realizado por el INCODER, la persona jurídica ' . strtoupper($nombre_asociaciones) . ' presentó el proyecto denominado ' . $nombre_proyecto . ', para ser revisado, formulado, evaluado y determinar su viabilidad y ser cofinanciado con los recursos que para tales efectos les asignara el INCODER.</span><br><br>';
$str.='<span style="text-align:justify;" >Que adicionalmente, se adelantaron las actuaciones previstas en el parágrafo 2º del artículo Decimoséptimo del Acuerdo No. 344 de 2014, en el “Manual de financiación y/o cofinanciación para la formulación, ejecución, evaluación y seguimiento de proyectos Productivos del INCODER”,  respecto de la verificación de las condiciones jurídicas y técnicas del (los) predio (s) en donde se implementará el proyecto productivo.</span><br><br>';
$pdf->writeHTML($str, true, false, false, false, '');
$str='<span style="text-align:justify;" >Que con sustento en los artículos Decimoctavo, Decimonoveno, Vigésimo Primero y Vigésimo Segundo del Acuerdo No. 344 de 2014, en el “Manual de financiación y/o cofinanciación para la formulación, ejecución, evaluación y seguimiento de proyectos Productivos del INCODER”, se efectuaron las actividades de caracterización y formulación del proyecto productivo objeto del incentivo, el cual fue sometido a la respectiva evaluación por parte del Equipo Técnico de Evaluación y Viabilización de Proyectos Productivos.</span><br><br>';
$str.='<span style="text-align:justify;" >Que una vez surtidas las actuaciones administrativas de caracterización, verificación, formulación y evaluación, se determinó la viabilidad del otorgamiento del incentivo para el proyecto productivo denominado “' . $nombre_proyecto . '”, correspondiente a la focalización y priorización de la vigencia 2015.</span><br><br>';
$str.='<span style="text-align:justify;" >Que como resultado del proyecto se estableció que este tendrá un costo total de ' . $valor_total . ' MONEDA LEGAL COLOMBIANA ($' . number_format($evaluacion['Evaluation']['contrapartida'] + $evaluacion['Evaluation']['cofinanciacion'] + $evaluacion['Evaluation']['otras_fuentes'], 2, ",", ".") . ') de los cuales el INCODER cofinanciará a través del incentivo la suma de ' . $cofinanciacion . ' MONEDA LEGAL COLOMBIANA ($' . number_format($evaluacion['Evaluation']['cofinanciacion'], 2, ",", ".") . '), los beneficiarios aportarán como contrapartida en bienes y servicios, la suma de ' . $contrapartida . ' MONEDA LEGAL COLOMBIANA ($' . number_format($evaluacion['Evaluation']['contrapartida'], 2, ",", ".") . ') ';
if ($evaluacion['Evaluation']['otras_fuentes'] > 0) {
    $str.=' y los recursos de otras fuentes ascienden a la suma de ' . $otras_fuentes . ' MONEDA LEGAL COLOMBIANA ($' . number_format($evaluacion['Evaluation']['otras_fuentes'], 2, ",", ".") . ')(Estos recursos provienen de ' . $evaluacion['Evaluation']['cofinanciador'] . ')';
}
$str.='</span><br><br>';
$str.='<span style="text-align:justify;" >Que el inciso 2° del Artículo 3° del  Decreto 2365 de 2015 “Por el cual se suprime el Instituto Colombiano de Desarrollo Rural Incoder, se ordena su liquidación y se dictan otras disposiciones”, estableció que a partir de su publicación, el Instituto Colombiano de Desarrollo Rural – INCODER en Liquidación no podrá iniciar nuevas actividades en desarrollo de su objeto social y conservará su capacidad jurídica únicamente para expedir actos, realizar operaciones, convenios y celebrar los contratos necesarios para su liquidación.</span><br><br>';
$str.='<span style="text-align:justify;" >Que el citado artículo estableció que el Instituto Colombiano de Desarrollo Rural – INCODER en Liquidación conservará su capacidad para seguir adelantando los procesos agrarios, de titulación de baldíos, de adecuación de tierras y riego, gestión y desarrollo productivo, promoción, asuntos étnicos y ordenamiento productivo hasta tanto entren en operación la Agencia Nacional de Tierras y la Agencia de Desarrollo Rural, lo cual deberá ocurrir en un término no mayor a dos (2) meses, contados a partir de la fecha de vigencia del decreto.</span><br><br>';
$str.='<span style="text-align:justify;" >Que así mismo, el artículo 5º numeral 8 y 27 del Decreto 2365 de 2015 señala que el Liquidador actuará como representante legal del Instituto Colombiano de Desarrollo Rural – INCODER en Liquidación y le corresponde adoptar las decisiones y proferir los actos administrativos que sean requeridos para facilitar la preparación y realización de una liquidación rápida y efectiva, así como las demás actividades que sean propias de su cargo como las de proferir los actos administrativos que se relacionen con la organización y funcionamiento, con el ejercicio de la autonomía administrativa y el cumplimiento de los objetivos y funciones de la entidad en liquidación.</span><br><br>';
$str.='<span style="text-align:justify;" >Que en desarrollo de tal función reglamentada por los artículos 9, 10 y 12 de la Ley 489 de 1998, el Liquidador del Instituto Colombiano de Desarrollo Rural – INCODER en Liquidación, mediante la Resolución No. 00007 del 07 de diciembre de 2015 delegó en las Direcciones Territoriales del Instituto Colombiano de Desarrollo Rural – INCODER en Liquidación, la suscripción de los actos administrativos o documentos equivalentes, para hacer efectiva la cofinanciación de los proyectos territoriales que se formulen y viabilicen en el marco proyecto de inversión “Implementación de Proyectos de Desarrollo Rural a Nivel Nacional Atención a Población Campesina y Desplazada” previa verificación del cumplimiento de los requisitos exigidos para acceder a este tipo de proyectos, así como el seguimiento, acompañamiento y supervisión a la ejecución de los proyectos, de acuerdo a lo dispuesto en los protocolos, manuales y circulares correspondientes.</span><br><br>';
$str.='<span style="text-align:justify;" >Que de acuerdo con lo establecido en el numeral 3 del artí culo Vigésimo Tercero del Acuerdo No. 344 de 2014, se procede a efectuar la adjudicación del incentivo para el proyecto antes mencionado.</span><br><br>';
$str.='<span style="text-align:justify;" >Que en mérito de lo expuesto, el Instituto Colombiano de Desarrollo Rural – INCODER en Liquidación, Dirección Territorial del Departamento de(l) '.strtoupper($departamento).',</span><br><br>';
$pdf->writeHTML($str, true, false, false, false, '');
$str.='<span style="text-align:center;" ><b>R  E  S  U  E  L  V  E</b></span><br><br>';
$str.='<span style="text-align:justify;" ><b>ARTÍCULO PRIMERO: Adjudicación del incentivo. Otorgar un incentivo por la suma de ' . $cofinanciacion . ' MONEDA LEGAL COLOMBIANA ($' . number_format($evaluacion['Evaluation']['cofinanciacion'], 2, ",", ".") . '), para cofinanciar el proyecto ' . $resolucion['Proyect']['codigo'] . '.</span><br><br>';
$pdf->writeHTML($str, true, false, false, false, '');

$str = '<table border="1" cellpadding="5" style="text-align:justify;width:100%;" ><tr><th style="width:20%;">Nombre completo </th><th style="width:20%;">Nit</th><th style="width:35%;">Representante Legal Nombre Completo</th><th style="width:25%;">Representante Legal C.C. No.</th></tr>';
foreach ($asociaciones as $asociacion) {
    $str.="<tr><td >" . strtoupper($asociacion['Asociation']['nombre']) . "</td><td>" . $asociacion['Asociation']['nit'] . " </td><td>" . strtoupper($asociacion['Asociation']['nombre_rep']) . " " . strtoupper($asociacion['Asociation']['primer_apellido_rep']) . " " . strtoupper($asociacion['Asociation']['segundo_apellido_rep']) . "</td><td>" . $asociacion['Asociation']['cedula_rep'] . "</td></tr>";
}
$str.="</table>";
$pdf->writeHTML($str, true, false, false, false, '');

$str = '<span style="text-align:justify;" >El objeto del incentivo es cofinanciar el proyecto de desarrollo rural ' . $resolucion['Proyect']['codigo'] . ' denominado “' . $nombre_proyecto . '” ” el cual fue formulado y declarada su viabilidad en el marco de lo establecido en el Acuerdo 344 de 2014  “Por el cual se reglamenta el programa de financiación y cofinanciación de proyectos Productivos de '
        . 'desarrollo rural con enfoque territorial en las áreas de actuación del INCODER”</span><br><br>';
$str = '<span style="text-align:justify;" >Los recursos de la cofinanciación se pagarán con cargo a los recursos comprometidos en el convenio interadministrativo suscrito con el departamento de ' . strtoupper($departamento) . ' de la siguiente manera:</span><br><br>';

$str .= '<table border="1" cellpadding="5" style="text-align:justify;width:100%;" ><tr><th style="width:30%;">CDP</th><th style="width:30%;">Monto</th><th style="width:40%;">Ficha de inversión</th></tr>';
foreach ($certificaciones as $certificacion) {
    $str.="<tr><td>" . $certificacion['Certification']['cdp'] . "</td><td>$ " . number_format($certificacion['Certification']['valor'], 2, ",", ".") . " </td><td>" . $certificacion['Certification']['poblacion'] . "</td></tr>";
}
$str.="</table>";
$pdf->writeHTML($str, true, false, false, false, '');
$str = '<span style="text-align:justify;" ><b>ARTÍCULO SEGUNDO: Obligaciones de la persona jurídica.</b> Como consecuencia de la adjudicación del incentivo corresponderá a la persona jurídica sin ánimo de lucro las siguientes obligaciones: 1. Formar parte del equipo técnico de vigilancia de la inversión y dar cumplimiento a lo establecido para tales fines en la regulación normativa que expida el Instituto Colombiano de Desarrollo Rural – INCODER en Liquidación, y garantizar que los beneficiarios que representa cumplan con los requisitos establecidos en el acuerdo 344 de 2014; 2. Notificarse '
        . 'de los actos administrativo que se profieran en el marco del proyecto cofinanciado; 3. Aperturar una cuenta a nombre del proyecto ' . $resolucion['Proyect']['codigo'] . ' a través de la cual se pueda garantizar un manejo controlado con el INCODER a través del Director Territorial. Como requisito para el desembolso de los recursos, se deberá remitir una constancia de la cuenta bancaria del proyecto a la que se '
        . 'girarán los recursos del incentivo adjudicado a los beneficiarios por parte del INCODER. La certificación bancaria expedida por la entidad financiera debe detallar el nombre del titular, NIT de la organización, tipo de cuenta y número de la cuenta, la cuenta debe ser controlada por el director territorial; 4. Constituir una garantía de cumplimiento cuyo beneficiario sea el Instituto Colombiano de Desarrollo Rural – INCODER en Liquidación por un valor del diez por ciento (10%) del valor del incentivo entregado por el Instituto y por el término '
        . 'de dos (2) años; en los casos en que no sea posible contar con dicho amparo, previa verificación y validación por parte de la dirección territorial, lo cual se hará constar en el formato F33-GI-PPDRET-01, diligenciado por la persona jurídica, para los efectos garantía; 5. Remitir mensualmente a la Dirección Territorial del  Instituto Colombiano de Desarrollo Rural – INCODER en Liquidación el extracto de la cuenta para el respectivo control de saldos 6. Poner a disposición del presente proyecto su infraestructura administrativa, experiencia y conocimiento; 7. Facilitar al Instituto Colombiano de Desarrollo Rural – INCODER en Liquidación, Comité Técnico Territorial toda la información necesaria para el cumplimiento de sus funciones;'
        . ' 8. Ejecutar el proyecto productivo de conformidad con la formulación evaluada, aprobada y declarada viable la cual hace parte integral de la presente resolución. Lo anterior, sin perjuicio de que el proyecto pueda ser objeto de modificación previa decisión motivada del Equipo Técnico de Vigilancia de la Inversión; 9. Destinar los recursos que reciba exclusivamente en lo relacionado con el cumplimiento del objeto del '
        . 'proyecto y velar por la entrega completa y oportuna de los insumos, bienes y/o suministros de los proveedores, que se adquieran en el marco de la ejecución del proyecto; 10. 10. Establecer una contabilidad del proyecto, la cual denote transparencia en el empleo de los recursos asignados y el flujo en el tiempo de los ingresos y egresos, de conformidad con las normas aplicables y mantenerla actualizada y  disponible cuando '
        . 'los organismos de control, el Comité Técnico Territorial, el Comité Supervisor, Instituto Colombiano de Desarrollo Rural – INCODER en Liquidación o la comunidad, lo requieran; 11. Crear un archivo organizado de los originales del proyecto y sus actividades, con toda la documentación inherente a la ejecución del mismo y mantenerlo disponible, cuando los organismos de control, el Comité Técnico Territorial y Supervisor o el INCODER lo requieran; 12. Resolver las peticiones que les sean '
        . 'presentadas por el Instituto Colombiano de Desarrollo Rural – INCODER en Liquidación; 13. Suscribir el acta de cierre del proyecto. </span><br><br>';
$pdf->writeHTML($str, true, false, false, false, '');
$str = '<span style="text-align:justify;" ><b>Parágrafo:</b>No obstante el INCODER  se reserva la facultad de realizar la verificación de los requisitos de los beneficiarios hasta la implementación del proyecto, y en caso de encontrar que algún beneficiario no cumple, la persona jurídica deberá reemplazarla por una familia que cumpla con lo establecido en el procedimiento estatuido por el Instituto Colombiano de Desarrollo Rural – INCODER en Liquidación.</span><br><br>';
$str.='<span style="text-align:justify;" ><b>ARTÍCULO TERCERO: Familias asociadas al proyecto productivo: </b>El proyecto denominado “' . $nombre_proyecto . '” está orientado a beneficiar a las personas naturales que se relacionan en el cuadro No. 1, en su condición de integrantes de la persona jurídica, debidamente representados de conformidad con lo establecido en el Acuerdo 344 de 2014 así:</span><br><br>';
$str.='<span style="text-align:justify;" ><b>Cuadro No. 1 beneficiarios del proyecto</b></span><br>';
$pdf->writeHTML($str, true, false, false, false, '');
$str = '<table border="1" cellpadding="5" style="text-align:justify;width:100%;" ><tr><th style="width:15%;">Núcleo Familiar No</th><th style="width:25%;">Número Cédula Ciudadanía</th><th style="width:45%;">Nombre Completo</th><th style="width:15%;">Población</th></tr>';
$cont = 1;
App::Import('model', 'Beneficiary');
$Beneficiary = new Beneficiary();
foreach ($beneficiarios as $beneficiario) {

    if ($conyuge = $Beneficiary->find('first', array('recursive' => -1, 'conditions' => array('Beneficiary.beneficiary_id' => $beneficiario['Beneficiary']['id']), 'fields' => array('Beneficiary.*')))) {
        $str.="<tr><td rowspan=\"2\">$cont</td><td>" . $beneficiario['Beneficiary']['tipo_identificacion'] . " " . $beneficiario['Beneficiary']['numero_identificacion'] . " </td><td>" . strtoupper($beneficiario['Beneficiary']['nombres']) . " " . strtoupper($beneficiario['Beneficiary']['primer_apellido']) . " " . strtoupper($beneficiario['Beneficiary']['segundo_apellido']) . "</td><td>" . strtoupper($beneficiario['Beneficiary']['tipo']." " .$beneficiario['Beneficiary']['grupo']) . "</td></tr>";
        $str.="<tr><td>" . $conyuge['Beneficiary']['tipo_identificacion'] . " " . $conyuge['Beneficiary']['numero_identificacion'] . " </td><td>" . strtoupper($conyuge['Beneficiary']['nombres']) . " " . strtoupper($conyuge['Beneficiary']['primer_apellido']) . " " . strtoupper($conyuge['Beneficiary']['segundo_apellido']) . "</td><td>" . strtoupper($beneficiario['Beneficiary']['tipo']) . "</td></tr>";
    } else {
        $str.="<tr><td >$cont</td><td>" . $beneficiario['Beneficiary']['tipo_identificacion'] . " " . $beneficiario['Beneficiary']['numero_identificacion'] . " </td><td>" . strtoupper($beneficiario['Beneficiary']['nombres']) . " " . strtoupper($beneficiario['Beneficiary']['primer_apellido']) . " " . strtoupper($beneficiario['Beneficiary']['segundo_apellido']) . "</td><td>" . strtoupper($beneficiario['Beneficiary']['tipo']." " .$beneficiario['Beneficiary']['grupo']) . "</td></tr>";
    }
    $cont++;
}
$str.="</table>";
$pdf->writeHTML($str, true, false, false, false, '');
$str = '<span style="text-align:justify;" ><b>Parágrafo:</b> Si por circunstancias de fuerza mayor o caso fortuito se requiere sustituir un beneficiario(s), el representante legal de la persona jurídica' . strtoupper($nombre_asociaciones) . 'deberá presentar al Director Territorial para su aprobación la respectiva justificación del cambio, la(s) persona que se postule en remplazo debe cumplir con todos los requisitos y no incurrir en ninguna de las prohibiciones establecidas en los artículos decimocuarto y decimoquinto del Acuerdo No. 344 de 2014, una vez aprobada la solicitud el Director Territorial expedirá el respectivo acto administrativo, el cual será notificado al representante legal de la asociación.</span><br><br>';
$str.='<span style="text-align:justify;" ><b>ARTÍCULO CUARTO:</b>  Obligaciones de los beneficiarios del proyecto. Los beneficiarios del incentivo tienen la obligación de: 1. Implementar las actividades prediales establecidas en el proyecto; 2. permitir las labores de seguimiento y evaluación del proyecto; 3. Utilizar los bienes entregados exclusivamente para la implementación del proyecto; 4. No enajenar o transferir a cualquier título, los derechos que ostentan sobre el (los) predio (s) en el (los) cual (es) se implementará, parcial o totalmente, el proyecto productivo durante el plazo de ejecución del proyecto; 5. Obtener la titularidad de las licencias, concesiones, permisos y/o autorizaciones para el uso, manejo, aprovechamiento y/o disposición de los recursos naturales renovables, necesarios para la implementación y ejecución del proyecto productivo, en consonancia con las normas que rigen la materia, y por ende, también deben cumplir las obligaciones que dichos actos jurídicos impongan sobre el manejo y control ambiental, de acuerdo a lo establecido en las disposiciones legales y reglamentarias que regulan la expedición de los mismos.</span><br><br>';
$pdf->writeHTML($str, true, false, false, false, '');
$str = '<span style="text-align:justify;" >En caso de incumplimiento, los beneficiarios del otorgamiento del incentivo tendrán la obligación de restituir al proyecto hasta la totalidad de los recursos de dicho incentivo, previo agotamiento del procedimiento determinado en el “Manual de financiación y/o cofinanciación para la formulación, ejecución, evaluación y seguimiento de proyectos Productivos del INCODER”.</span><br><br>';
$str.='<span style="text-align:justify;" ><b>ARTÍCULO QUINTO: Implementación del proyecto Productivo.</b>El proyecto productivo, se implementará en el (los) predio (s) que se identifica (n) a continuación:</span><br><br>';
$str.='<span style="text-align:justify;" ><b>Cuadro No. 2 Predios vinculados al proyecto ' . $resolucion['Proyect']['codigo'] . '</b></span><br><br>';
$pdf->writeHTML($str, true, false, false, false, '');
$str = '<table border="1" cellpadding="2" style="text-align:justify;width:100%;"  nobr="true" ><tr style="text-align:center;"><th>Nombre</th><th>Municipio y departamento de Ubicación</th><th>Relación jurídica con el predio</th><th>Número de Folio de Matrícula Inmobiliaria (si aplica)</th></tr>';
foreach ($predios as $predio) {

    $str.="<tr style=\"text-align:justify;\">"
            . "<td>" . strtoupper($predio['Property']['nombre']) . " </td>
          <td>" . strtoupper($predio['Departament']['name']) . " - " . strtoupper($predio['City']['name']) . "</td>
          <td>" . strtoupper($predio['Property']['tipo_tenencia']) . "</td>
          <td>" . $predio['Property']['oficina_matricula'] . " - " . $predio['Property']['numero_matricula'] . "</td></tr>";
}
$str.="</table>";
$pdf->SetFont('Trebuchet', '', 8);
$pdf->writeHTML($str, true, false, false, false, '');
$pdf->SetFont('Trebuchet', '', 10);
$str = '<span style="text-align:justify;" >*La anterior descripción se realiza para identificar el (los) predio (s) en el (los) cual (es) se implementará, parcial o totalmente el proyecto productivo y no constituye título traslaticio del derecho real de dominio.</span><br><br>';
$str.='<span style="text-align:justify;" ><b>ARTÍCULO SEXTO: Conformación del Equipo Técnico de vigilancia de la Inversión.</b>El Equipo Técnico de vigilancia de  la Inversión se conformará por el Director Territorial del Instituto Colombiano de Desarrollo Rural – INCODER en Liquidación, un representante de la Gobernación del Departamento de(l) ' . strtoupper($departamento) . '; '
        . 'El representante legal de la persona jurídica o su delegado mediante poder. Parágrafo 1: En caso de que existan otros cofinanciadores cada uno tendrá derecho a un representante en el Equipo Técnico de Vigilancia de la Inversión. Parágrafo 2: Las familias beneficiarias del proyecto podrán asistir a las reuniones del Equipo Técnico de vigilancia de la Inversión con voz pero sin voto.</span><br><br>';
$pdf->writeHTML($str, true, false, false, false, '');
$str = '<span style="text-align:justify;" ><b>ARTÍCULO SÉPTIMO: Conforme a lo dispuesto en el artículo Vigésimo Quinto del Acuerdo No. 344 de 2014, en el “Manual de financiación y/o cofinanciación para la formulación, ejecución, evaluación y seguimiento de proyectos productivos del INCODER -MFC-”, el Equipo Técnico de Vigilancia de la Inversión ejerce las siguientes funciones o actividades: 1. Realizar el acompañamiento, apoyo, control y seguimiento a los proyectos que sean financiados o cofinanciados por el INCODER, de acuerdo con la normatividad establecida para estos fines (Acuerdos, Resoluciones, Manuales, procedimientos, documentos etc.); 2. Actuar como Comité de Compras o hacer parte de él para aprobar las inversiones de conformidad con la formulación aprobada para la correcta implementación del proyecto; 3. Admitir o inadmitir las solicitudes presentadas por los beneficiarios para modificar los componentes de los proyectos; 4. Asesorar y recomendar las modificaciones o ajustes que estimen convenientes y que permitan la eficiente y eficaz ejecución de los proyectos y el cumplimiento de las metas productivas propuestas en cada uno; 5. Verificar que en los proyectos así como en sus modificaciones, se mantengan indicadores positivos relacionados con el margen de rentabilidad establecido en la formulación y las metas físicas generales propuestas; 6. Aprobar la sustitución de beneficiarios; 7. Aprobar el cierre del proyecto o liquidación para el caso de convenios. 8. Las demás funciones que le sean asignadas o que por su naturaleza le correspondan.</span><br><br>';
$pdf->writeHTML($str, true, false, false, false, '');
$str = '<span style="text-align:justify;" ><b>ARTÍCULO OCTAVO: La supervisión del proyecto productivo estará a cargo del Coordinador Técnico de la Dirección Territorial o su delegado, a falta de éste será el funcionario y/o contratista que designe el Director Territorial. Parágrafo 1. La supervisión realizará todas las funciones inherentes al cargo establecidas en la ley y el reglamento, para la cabal y adecuada vigilancia del presente proyecto. Parágrafo 2. La supervisión tiene entre sus obligaciones presentar un informe de cierre del proyecto y de liquidación de la cuenta de manejo controlado, además del reporte periódico de información en el marco de los lineamientos de seguimiento establecidos por el nivel central.</span><br><br>';
$str.='<span style="text-align:justify;" ><b>ARTÍCULO NOVENO: Desembolso de los Recursos:</b>El desembolso de los recursos del incentivo se realizará de conformidad con el artículo Vigésimo Séptimo del Acuerdo 344 de 2014 y las normas, manuales, procedimientos y documentos que lo modifiquen, adicionen y/o complementen. Parágrafo. '
        . 'Cuando por cualquier circunstancia el proyecto productivo no pueda ser ejecutado o sus metas de producción no sean cumplidas en el tiempo de vigencia de la póliza de seguro constituida por los beneficiarios a favor del INCODER, la persona jurídica, presentará solicitud al Equipo Técnico de Vigilancia de la Inversión para '
        . 'la ampliación de la cobertura de la garantía por el término que técnicamente se determine para que el proyecto cumpla con las metas de producción.</span><br><br>';
$pdf->writeHTML($str, true, false, false, false, '');
$str = '<span style="text-align:justify;" ><b>ARTÍCULO DÉCIMO. Notificación. </b>La presente resolución se notificará personalmente a la persona jurídica ' . strtoupper($nombre_asociaciones) . ' en la forma contemplada en el Código de Procedimiento Administrativo y de lo Contencioso Administrativo, y se comunicará a la Procuraduría Delegada para Asuntos Ambientales y Agrarios.</span><br><br>';
$str.='<span style="text-align:justify;" >Parágrafo: Para la notificación del presente acto administrativo, el representante legal de la persona jurídica deberá presentar el respectivo certificado de existencia y representación legal con una expedición no mayor de treinta (30) días y  copia de su cédula.</span><br><br>';
$pdf->writeHTML($str, true, false, false, false, '');
$str = '<span style="text-align:justify;" ><b>ARTÍCULO UNDÉCIMO. Recursos.</b>Contra la presente decisión procede el recurso de reposición, el cual podrá ser interpuesto por escrito ante el Director Territorial, en la diligencia de notificación personal o dentro de los diez (10) días siguientes a ella.</span><br><br>';
$str.='<span style="text-align:center;" ><strong>NOTIFÍQUESE Y CÚMPLASE</strong></span><br><br>';
$pdf->writeHTML($str, true, false, false, false, '');
$str = '<span style="text-align:justify;" >Dada en ' . strtoupper($capital) . " - " . strtoupper($departamento) . ' a los ' . $EnLetras->SubValLetra($dia) . " (" . $dia . ') días del mes de ' . $EnLetras->getMontName($resolucion['Resolution']['fecha']) . ' del ' . $anio . '</span><br><br><br><br>';
$str.='<span style="text-align:center;" >' . strtoupper($director) . '</span><br>';
$pdf->writeHTML($str, true, false, false, false, '');
$str = '<span style="text-align:center;" >Director Territorial ' . strtoupper($departamento) . '</span><br><br>';
$str.='<span style="text-align:left;" >Proyectó ' . $resolucion['Resolution']['proyecto'] . '</span><br><br>';
$str.='<span style="text-align:left;" >Revisó ' . $resolucion['Resolution']['reviso'] . '</span></p>';
$str.='<span style="text-align:left;" >Vo.Bo ' . $resolucion['Resolution']['visto_bueno'] . '</span></p>';
$pdf->writeHTML($str, true, false, false, false, '');
$pdf->Output('resolucion_Asociativo_' . $resolucion['Resolution']['id'] . '.pdf', 'D');
?>