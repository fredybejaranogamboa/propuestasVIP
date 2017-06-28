<?php

App::import('Vendor', 'tcpdf/tcpdf');
App::import('Vendor', 'EnLetras', array('file' => 'EnLetras.class.php'));

class MYPDF extends TCPDF {

    var $resolucion;
    var $flag = 0;

    //Page header
    public function Header() {

        $fecha = $this->resolucion['Resolution']['fecha'];
        $anio = explode("-", $fecha);
        $anio = $anio[0];
        $bMargin = $this->getBreakMargin();
        // get current auto-page-break mode
        $auto_page_break = $this->AutoPageBreak;
        // disable auto-page-break
        $this->SetAutoPageBreak(false, 0);

        $de = str_replace("\n", "", $this->getAliasNbPages());
        $tabla = '<table border="0"><tr><td width="120px">RESOLUCIÓN</td><td width="30px"></td><td>DE ' . $anio . ' </td><td width="100px"></td><td width="150px">HOJA No ' . $this->getAliasNumPage() . ' DE ' . $de . '</td></tr></table>';
        //$this->writeHTML("<br>$tabla", true, false, false, false, '');
        //$this->SetFont('Trebuchet', '', 7);
        $tx = "";
        if ($this->flag == 1) {
            $tx.= '<span style="text-align:center; font-size:smaller" ><br> Continuación de la Resolución "Por medio de la cual se otorga un incentivo de cofinanciación y/o financiación de proyectos de desarrollo rural con enfoque territorial en las áreas de actuación del INCODER, en el marco de lo dispuesto por el Acuerdo 344 de 2014 proferido por el Consejo Directivo del INCODER"</span><br>';
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
//$pdf->setPrintHeader(false);
$pdf->resolucion = $resolucion;
$pdf->setPrintFooter(false);
$pdf->SetMargins(25, 30, 25);

$pdf->setPageOrientation("P", true, 25);
$pdf->AddPage();
$pdf->flag = 1;
$fecha = explode("-", $resolucion['Resolution']['fecha']);
$anio = $fecha[0];
$pdf->SetFont('Trebuchet', '', 12);
$img_file = '../webroot/img/escudoResolucion.jpg';
$pdf->Image($img_file, 98, 0, 30, 30, '', '', '', false, 300, '', false, false, 0);
$EnLetras = new EnLetras();
$valor_total = $EnLetras->ValorEnLetras($evaluacion['Evaluation']['cofinanciacion'] + $evaluacion['Evaluation']['contrapartida'], 'PESOS');
$monto_solicitado = $EnLetras->ValorEnLetras($evaluacion['Evaluation']['cofinanciacion'], 'PESOS');
$contrapartida = $EnLetras->ValorEnLetras($evaluacion['Evaluation']['contrapartida'], 'PESOS');
$str = '<br><br><span style="text-align:center;" >INSTITUTO COLOMBIANO DE DESARROLLO RURAL-INCODER - EN LIQUIDACIÓN</span><br>';
$pdf->writeHTML($str, true, false, false, false, '');
$str = 'RESOLUCIÓN NÚMERO                  DE ' . $anio;
$pdf->Cell(0, 0, $str, 0, 1, 'C', 0, '', 0);
$pdf->Cell(0, 0, "(                                         )", 0, 1, 'C', 0, '', 0);
$codigo = strtoupper($resolucion['Proyect']['codigo']);
$pdf->SetFont('Trebuchet', '', 10);

$str = '<br><br><span style = "text-align:center;" >"Por medio de la cual se otorga un incentivo de cofinanciación y/o financiación de proyectos de desarrollo rural con enfoque territorial en las áreas de actuación del INCODER, en el marco de lo dispuesto por el Acuerdo 344 de 2014 proferido por el Consejo Directivo del INCODER" </span><br>';

$pdf->writeHTML($str, true, false, false, false, '');
$pdf->SetFont('Trebuchet', '', 12);
$str = '<span style = "text-align:center;" >EL DIRECTOR TERRITORIAL ' . strtoupper($departamento) . ' DEL INSTITUTO COLOMBIANO DE DESARROLLO RURAL - INCODER – EN LIQUIDACIÓN, </span><br>';
$pdf->writeHTML($str, true, false, false, false, '');
$pdf->SetFont('Trebuchet', '', 10);

$str = '<span style = "text-align:justify;" >En ejercicio de sus facultades legales y en especial las conferidas por la Ley 160 de 1994, Decreto único Reglamentario No. 1071 del 26 de mayo de 2015, Decreto 2365 del 07 de diciembre de 2015, Resolución No. 00007 del 07 de diciembre de 2015, Resolución No. 00015 del 11 de diciembre de 2015, Circular interna No. 005 del 15 de diciembre de 2015 y</span><br>';

$pdf->writeHTML($str, true, false, false, false, '');
$pdf->SetFont('Trebuchet', '', 12);
$str = '<span style = "text-align:center;" >CONSIDERANDO:</span><br>';
$pdf->writeHTML($str, true, false, false, false, '');
$pdf->SetFont('Trebuchet', '', 10);

$str = '<span style = "text-align:justify;font-style:italic" >Que los artículos 2, 13 y 65 de la Constitución Política, establecen que son fines esenciales del Estado, entre otros, promover la prosperidad general brindando especial atención a aquéllas personas que por su condición económica se encuentren en circunstancias de debilidad manifiesta, así como la prioridad del desarrollo integral de las actividades agrícolas, pecuarias, pesqueras, forestales y agroindustriales, con el propósito de incrementar su productividad.</span><br><br>';
$str.='<span style="text-align:justify;" >Que la Constitución Política de Colombia consagra en el artículo 64 como deber del Estado, el promover el acceso progresivo a la propiedad de la tierra de los trabajadores agrarios, en forma individual o asociativa, con el fin de mejorar el ingreso y calidad de vida de los campesinos.</span><br><br>';
$str.='<span style="text-align:justify;" >Que igualmente, el artículo 65 de la Carta Política dispone que la producción de alimentos goza de especial protección del Estado y que para tal efecto, se otorgará prioridad al desarrollo integral de las actividades agrícolas, pecuarias, pesqueras, forestales y agroindustriales, así como también a la construcción de obras de infraestructura física y adecuación de tierras.</span><br><br>';
$str.='<span style="text-align:justify;" >Que el artículo 209 de la Constitución Política de 1991, establece que la función administrativa se desarrolla con fundamento en los principios de igualdad, moralidad, eficacia, economía, celeridad, imparcialidad y publicidad.</span><br><br>';
$str.='<span style="text-align:justify;" >Que conforme a lo dispuesto en el ordinal segundo (2°) del artículo 1° de la Ley 160 de 1994, uno de los objetivos de la norma en cita, consiste en reformar la estructura social agraria por medio de procedimientos encaminados  a eliminar y prevenir la inequitativa concentración de la propiedad rústica o su fraccionamiento antieconómico y dotar de tierras a los hombres y mujeres campesinos de escasos recursos, mayores de 16 años que no la posean, a los minifundistas, mujeres campesinas jefes de hogar, a las comunidades indígenas y a los beneficiarios de los programas especiales que establezca el Gobierno Nacional.</span><br><br>';
$str.='<span style="text-align:justify;" >Que igualmente, el ordinal séptimo (7°) del artículo 1° de la Ley 160 de 1994, establece como objeto de la ley el promover, apoyar y coordinar el mejoramiento económico, social y cultural de la población rural y estimular la participación de las organizaciones campesinas en el proceso integral de la Reforma Agraria y el Desarrollo Rural Campesino para lograr su fortalecimiento.</span><br><br>';
$str.='<span style="text-align:justify;" >Que de acuerdo con el artículo 2º del Decreto 3759 de 2009, el Instituto Colombiano de Desarrollo Rural - INCODER, es el ejecutor de la política agropecuaria y de desarrollo rural que establezca el Gobierno Nacional para el país.</span><br><br>';
$str.='<span style="text-align:justify;" >Que el artículo 4º del Decreto 3759 de 2009, señala como funciones del INCODER, entre otras, las de financiar y cofinanciar planes, programas y proyectos de inversión para la ejecución de programas de desarrollo agropecuario y rural.</span><br><br>';
$str.='<span style="text-align:justify;" >Que el Consejo Directivo del Instituto, profirió el Acuerdo No. 344 de fecha 16 de diciembre de 2014, “Por el cual se reglamenta el programa de financiación y cofinanciación de proyectos Productivos de desarrollo rural con enfoque territorial en las áreas de actuación del INCODER”, el cual tiene como objetivo planificar, financiar o cofinanciar proyectos Productivos a desarrollar en el ámbito rural, los cuales podrán ser agrícolas, pecuarios, forestales, acuícolas, pesqueros o relacionados con el sector rural,'
        . ' ya sea de manera individual o a través de esquemas asociativos dentro de las áreas focalizadas y priorizadas por el Instituto, atendiendo principalmente aquellas que defina el Gobierno Nacional para realizar intervenciones integrales, promoviendo el ordenamiento económico, productivo , social y ambiental de los territorios rurales, con el fin de contribuir a la reducción de la pobreza rural, fortalecer la capacidad de generación de ingresos, situar a la población en las cadenas productivas, mejorar las condiciones de vida de la población rural, y aumentar la competitividad de la producción regional.</span><br><br>';
$str.='<span style="text-align:justify;" >Que la Gerencia General del INCODER, conforme a los artículos 9° y 10° de la Ley 489 de 1998, y al artículo 9° del Decreto 3759 de 2009, profirió la Resolución No. 01596 de fecha 27 de abril de 2015, por medio de la cual delegó en las Direcciones Territoriales del Instituto la expedición y suscripción de los actos administrativos relativos a la adjudicación del incentivo de financiación y/o cofinanciación para los proyectos Productivos a través de los mecanismos para la asignación de recursos establecidos en el Acuerdo 344 de 2014 proferido por el Consejo Directivo del INCODER y demás normas que lo adicionen o modifiquen.</span><br><br>';
$str.='<span style="text-align:justify;" >Que de conformidad con lo dispuesto (i) en los artículos Séptimo, Octavo y Décimo del Acuerdo No. 344 de 2014, así como lo contemplado  en el “Manual de financiación y/o cofinanciación para la formulación, ejecución, evaluación y seguimiento de proyectos Productivos  de desarrollo rural con enfoque territorial”, se adelantaron las actuaciones de focalización y priorización de los potenciales beneficiarios del programa.</span><br><br>';
$str.='<span style="text-align:justify;" >Que con fundamento en los artículos Decimocuarto, Decimoquinto, Vigésimo y siguientes del Acuerdo No. 344 de 2014, en el “Manual de financiación y/o cofinanciación para la formulación, ejecución, evaluación y seguimiento de proyectos Productivos  de desarrollo rural con enfoque territorial”, los beneficiarios del incentivo para la cofinanciación y/o financiación del proyecto productivo, fueron sujetos de verificación del cumplimiento de los requisitos para poder acceder al programa.</span><br><br>';
$str.='<span style="text-align:justify;" >Que adicionalmente se adelantaron las actuaciones previstas en el parágrafo 2 del artículo Decimoséptimo del Acuerdo No. 344 de 2014, en el “Manual de financiación y/o cofinanciación para la formulación, ejecución, evaluación y seguimiento de proyectos Productivos  de desarrollo rural con enfoque territorial”, respecto de la verificación de las condiciones jurídicas y técnicas del (los) predio (s) en donde se implementará el proyecto productivo.</span><br><br>';
$str.='<span style="text-align:justify;" >Que con sustento en los artículos Decimoctavo, Decimonoveno, Vigésimo Primero y Vigésimo Segundo del Acuerdo No. 344 de 2014, en el “Manual de financiación y/o cofinanciación para la formulación, ejecución, evaluación y seguimiento de proyectos Productivos  de desarrollo rural con enfoque territorial”, se efectuaron las actividades de caracterización y formulación del proyecto productivo objeto del incentivo, el cual fue sometido a la respectiva evaluación por parte del Equipo Técnico de Evaluación y Viabilización de Proyectos Productivos</span><br><br>';
$str.='<span style="text-align:justify;" >Que una vez surtidas las actuaciones administrativas de caracterización, verificación, formulación y evaluación, se determinó la viabilidad del otorgamiento del incentivo para el proyecto productivo denominado '.$codigo.', correspondiente a la focalización y priorización de la vigencia 2015.</span><br><br>';
$str.='<span style="text-align:justify;" >Que el inciso 2° del Artículo 3° del  Decreto 2365 de 2015 “Por el cual se suprime el Instituto Colombiano de Desarrollo Rural Incoder, se ordena su liquidación y se dictan otras disposiciones”, estableció que a partir de su publicación, el Instituto Colombiano de Desarrollo Rural – INCODER en Liquidación no podrá iniciar nuevas actividades en desarrollo de su objeto social y conservará su capacidad jurídica únicamente para expedir actos, realizar operaciones, convenios y celebrar los contratos necesarios para su liquidación.</span><br><br>';
$str.='<span style="text-align:justify;" >Que el citado artículo estableció que el Instituto Colombiano de Desarrollo Rural – INCODER en Liquidación conservará su capacidad para seguir adelantando los procesos agrarios, de titulación de baldíos, de adecuación de tierras y riego, gestión y desarrollo productivo, promoción, asuntos étnicos y ordenamiento productivo hasta tanto entren en operación la Agencia Nacional de Tierras y la Agencia de Desarrollo Rural, lo cual deberá ocurrir en un término no mayor a dos (2) meses, contados a partir de la fecha de vigencia del decreto.</span><br><br>';
$str.='<span style="text-align:justify;" >Que así mismo, el artículo 5º numeral 8 y 27 del Decreto 2365 de 2015 señala que el Liquidador actuará como representante legal del Instituto Colombiano de Desarrollo Rural – INCODER en Liquidación y le corresponde adoptar las decisiones y proferir los actos administrativos que sean requeridos para facilitar la preparación y realización de una liquidación rápida y efectiva, así como las demás actividades que sean propias de su cargo como las de proferir los actos administrativos que se relacionen con la organización y funcionamiento, con el ejercicio de la autonomía administrativa y el cumplimiento de los objetivos y funciones de la entidad en liquidación.</span><br><br>';
$str.='<span style="text-align:justify;" >Que en desarrollo de tal función reglamentada por los artículos 9, 10 y 12 de la Ley 489 de 1998, el Liquidador del Instituto Colombiano de Desarrollo Rural – INCODER en Liquidación, mediante la Resolución No. 00007 del 07 de diciembre de 2015 delegó en las Direcciones Territoriales del Instituto Colombiano de Desarrollo Rural – INCODER en Liquidación, la suscripción, expedición y notificación de los actos administrativos relativos a la adjudicación de la financiación y/o cofinanciación para los proyectos productivos, así como el respectivo control y seguimiento a la ejecución integral de los proyectos productivos, de acuerdo a lo dispuesto en los protocolos, manuales y circulares correspondientes.</span><br><br>';
$str.='<span style="text-align:justify;" >Que en mérito de lo expuesto, el Instituto Colombiano de Desarrollo Rural – INCODER en Liquidación, Dirección Territorial del Departamento de '.strtoupper($departamento).',</span><br><br><br><br><br><br>';
$str.='<span style="text-align:center;" ><b>R  E  S  U  E  L  V  E</b></span><br>';

$str.='<span style="text-align:justify;" ><b>ARTÍCULO PRIMERO:<b> Otorgar un incentivo de cofinanciación y/o financiación a favor de las personas que a continuación se detallan, y sean notificadas personalmente de la presente resolución, como familias beneficiarias del proyecto productivo denominado ' . $codigo . '</span><br>';
$str.='<span style="text-align:justify;" ><b>Personas Naturales:<b></span><br><br>';

$pdf->writeHTML($str, true, false, false, false, '');

$str = '<table border="1" cellpadding="5" style="text-align:justify;width:100%;" ><tr><th style="width:15%;">Núcleo Familiar No</th><th style="width:25%;">Número Cédula Ciudadanía</th><th style="width:45%;">Nombre Completo</th><th style="width:15%;">Población</th></tr>';
$cont = 1;

App::Import('model', 'Beneficiary');
$Beneficiary = new Beneficiary();
foreach ($beneficiarios as $beneficiario) {

    if ($conyuge = $Beneficiary->find('first', array('recursive' => -1, 'conditions' => array('Beneficiary.beneficiary_id' => $beneficiario['Beneficiary']['id']), 'fields' => array('Beneficiary.*')))) {
        $str.="<tr><td rowspan=\"2\">$cont</td><td>" . $beneficiario['Beneficiary']['tipo_identificacion'] . " " . $beneficiario['Beneficiary']['numero_identificacion'] . " </td><td>" . $beneficiario['Beneficiary']['nombres'] . " " . $beneficiario['Beneficiary']['primer_apellido'] . " " . $beneficiario['Beneficiary']['segundo_apellido'] . "</td><td>" . $beneficiario['Beneficiary']['tipo'] ." " .$beneficiario['Beneficiary']['grupo']. "</td></tr>";
        $str.="<tr><td>" . $conyuge['Beneficiary']['tipo_identificacion'] . " " . $conyuge['Beneficiary']['numero_identificacion'] . " </td><td>" . $conyuge['Beneficiary']['nombres'] . " " . $conyuge['Beneficiary']['primer_apellido'] . " " . $conyuge['Beneficiary']['segundo_apellido'] . "</td><td>" . $beneficiario['Beneficiary']['tipo'] . "</td></tr>";
    } else {
        $str.="<tr><td >$cont</td><td>" . $beneficiario['Beneficiary']['tipo_identificacion'] . " " . $beneficiario['Beneficiary']['numero_identificacion'] . " </td><td>" . $beneficiario['Beneficiary']['nombres'] . " " . $beneficiario['Beneficiary']['primer_apellido'] . " " . $beneficiario['Beneficiary']['segundo_apellido'] . "</td><td>" . $beneficiario['Beneficiary']['tipo'] ." " .$beneficiario['Beneficiary']['grupo']."</td></tr>";
    }
    $cont++;
}
$str.="</table>";

$pdf->writeHTML($str, true, false, false, false, '');
$str = 'El proyecto denominado “' . $codigo . '”, el cual se desarrollará en el (los) predio (s) rural (es) que se identifica (n) a continuación: </span><br>';
$pdf->writeHTML($str, true, false, false, false, '');

$str = '<table border="1" cellpadding="2" style="text-align:justify;width:100%;"  nobr="true" ><tr style="text-align:center;"><th>Nombre</th><th>Municipio y departamento</th><th>Número del Folio de Matrícula Inmobiliaria</th></tr>';

foreach ($predios as $predio) {

    $str.="<tr style=\"text-align:justify;\">"
            . "<td>" . $predio['Property']['nombre'] . " </td>
          <td>" . $predio['Departament']['name'] . " " . $predio['City']['name'] . "</td>
          <td>" . $predio['Property']['oficina_matricula'] . " - " . $predio['Property']['numero_matricula'] . "</td>
          </tr>";
}
$str.="</table>";
$pdf->SetFont('Trebuchet', '', 8);
$pdf->writeHTML($str, true, false, false, false, '');

$pdf->SetFont('Trebuchet', '', 10);

$str = '<span style="text-align:justify;" >*La anterior descripción se realiza para identificar el (los) predio (s) en el (los) cual (es) se implementará, parcial o totalmente el proyecto productivo y no constituye título traslaticio del derecho real de dominio.</span><br><br>';

$str .= '<span style="text-align:justify;" ><b>PARÁGRAFO </b>Los beneficiarios del incentivo tienen la obligación de no enajenar o transferir a cualquier título, los derechos que ostentan sobre el (los) predio (s) en el (los) cual (es) se implementará, parcial o totalmente, el proyecto productivo.</span><br><br>';
$str.='<span style="text-align:justify;" ><b>ARTÍCULO SEGUNDO </b>El valor total del proyecto productivo equivale a la suma de ' . $valor_total . '  ($' . number_format($evaluacion['Evaluation']['contrapartida'] + $evaluacion['Evaluation']['cofinanciacion'], 0, ',', '.') . '), de los cuales ' . $monto_solicitado . ' ($' . number_format($evaluacion['Evaluation']['cofinanciacion'], 0, ',', '.') . ') corresponden al valor destinado como incentivo del Instituto Colombiano de Desarrollo Rural – INCODER en Liquidación, dicha suma será entregada por el Instituto a los beneficiarios de conformidad con lo dispuesto en la presente resolución, y ' . $contrapartida . '  ($' . number_format($evaluacion['Evaluation']['contrapartida'], 0, ',', '.') . ') corresponden a la contrapartida a cargo de los beneficiarios para la implementación del proyecto productivo denominado '.$codigo.'.<br><br>';
//$str.='<span style="text-align:justify;" ><b>ARTÍCULO SEGUNDO</b>El valor total del proyecto productivo equivale a la suma de ' . $valor_total . '  ($' . number_format($evaluacion['Evaluation']['contrapartida'] + $evaluacion['Evaluation']['cofinanciacion'], 0, ',', '.') . '), de los cuales ' . $monto_solicitado . ' ($' . number_format($evaluacion['Evaluation']['cofinanciacion'], 0, ',', '.') . ') corresponde al valor destinado como cofinanciación del INCODER, dicha suma será entregada por el INCODER a los beneficiarios, de conformidad con lo dispuesto en la presente resolución, y ' . $contrapartida . ' ($' . number_format($evaluacion['Evaluation']['contrapartida'], 0, ',', '.') . ') corresponden al valor destinado como incentivo del INCODER, dicha suma será entregada por el Instituto a los beneficiarios de conformidad con lo dispuesto en la presente resolución,) corresponden a la contrapartida a cargo de los beneficiarios para la implementación del proyecto productivo denominado '.$codigo.'.</span><br><br>';

$str.='<span style="text-align:justify;" ><b>ARTÍCULO TERCERO </b>Conforme a lo dispuesto en el artículo Vigésimo Quinto del Acuerdo No. 344 de 2014, en el “Manual de financiación y/o cofinanciación para la formulación, ejecución, evaluación y seguimiento de proyectos Productivos  de desarrollo rural con enfoque territorial” (Documento D1-GI-PPDRET-02 versión publicada en la Intranet), el Equipo Técnico de Vigilancia de la Inversión ejerce las siguientes funciones o actividades: 1. Realizar el acompañamiento, apoyo, control y seguimiento a los proyectos que sean financiados o cofinanciados por el Instituto Colombiano de Desarrollo Rural – INCODER en Liquidación, de acuerdo con la normatividad establecida para estos fines (Acuerdos, Resoluciones, Manuales, procedimientos, documentos etc.). 2. Actuar como Comité de Compras o hacer parte de él para aprobar las inversiones de conformidad con la formulación aprobada para la correcta implementación del proyecto. 3. Admitir o inadmitir las solicitudes presentadas por los beneficiarios para modificar los componentes de los proyectos. 4. Asesorar y recomendar las modificaciones o ajustes que estimen convenientes y que permitan la eficiente y eficaz ejecución de los proyectos y el cumplimiento de las metas productivas propuestas en cada uno. 5. Verificar que en los proyectos así como en sus modificaciones, se mantengan indicadores positivos relacionados con el margen de rentabilidad establecido en la formulación y las metas físicas generales propuestas. 6. Aprobar la sustitución de beneficiarios. 7.	Aprobar el cierre del proyecto; 8. Las demás funciones que le sean asignadas o que por su naturaleza le correspondan.<br><br>';
$str.='<span style="text-align:justify;" ><b>ARTÍCULO CUARTO </b>La supervisión del proyecto productivo  estará a cargo del Director Territorial conforme a lo dispuesto en el numeral 18 del artículo 32 del Decreto 3759 de 2009, concordante con el “Manual de financiación y/o cofinanciación para la formulación, ejecución, evaluación y seguimiento de proyectos Productivos  de desarrollo rural con enfoque territorial” (Documento D1-GI-PPDRET-02 versión publicada en la Intranet), el cual hace parte integral de la presente resolución.<br><br>';
$str.='<span style="text-align:justify;" ><b>ARTÍCULO QUINTO </b>. La obligación principal a cargo de los beneficiarios de la cofinanciación es implementar y ejecutar el proyecto productivo  formulado, evaluado y viabilizado, el cual hace parte integral de la presente resolución. Lo anterior, sin perjuicio de que el proyecto pueda ser objeto de modificación previa decisión motivada del Equipo Técnico de Vigilancia de la Inversión.<br><br>';
$str.='<span style="text-align:justify;" >Si se comprueba que los beneficiarios no utilizan los recursos para la implementación del proyecto productivo, el INCODER tomará las medidas necesarias para garantizar el cumplimiento de las obligaciones que se generan del presente otorgamiento del incentivo.<br><br>';
$str.='<span style="text-align:justify;" >En caso de incumplimiento, los beneficiarios del otorgamiento del incentivo tendrán la obligación de restituir hasta la totalidad de los recursos de dicho incentivo, previo agotamiento del procedimiento determinado en el “Manual de financiación y/o cofinanciación para la formulación, ejecución, evaluación y seguimiento de proyectos Productivos  de desarrollo rural con enfoque territorial” (Documento D1-GI-PPDRET-02 versión publicada en la Intranet).<br><br>';
$str.='<span style="text-align:justify;" ><b>ARTÍCULO SEXTO </b>El desembolso de los recursos del incentivo se realizará de conformidad con el artículo Vigésimo Séptimo del Acuerdo No. 344 de 2014, concordante con el “Manual de Financiación y/o Cofinanciación para la Formulación, Ejecución, Evaluación y Seguimiento de Proyectos Productivos del Instituto Colombiano de Desarrollo Rural – INCODER”.<br><br>';
$str.='<span style="text-align:justify;" ><b>ARTÍCULO SÉPTIMO </b>Los beneficiarios del incentivo se comprometen a constituir a favor del Instituto Colombiano de Desarrollo Rural – INCODER en Liquidación, con NIT 830.122.398-0, una garantía de cumplimiento del proyecto productivo denominado “'.$codigo.'”, que consistirá en una póliza de seguro de conformidad con el acuerdo 344 de 2014 la cual debe cubrir el cumplimiento del proyecto en una cuantía equivalente al diez por ciento (10%) del valor del incentivo otorgado por el Instituto, con una vigencia de veinticuatro (24) meses. Esta garantía deberá ser aprobada por parte del Director Territorial o del Coordinador Técnico de la Dirección Territorial.<br><br>';
$str.='<span style="text-align:justify;" ><b>PARÁGRAFO </b>Cuando por cualquier circunstancia el proyecto productivo no pueda ser ejecutado o sus metas de producción no sean cumplidas en el tiempo de vigencia de la póliza de seguro constituida por los beneficiarios a favor del Instituto Colombiano de Desarrollo Rural – INCODER en Liquidación, éste, a través del Equipo Técnico de Vigilancia de la Inversión, podrá solicitar a los beneficiarios la ampliación de la cobertura de dicha póliza por el término que técnicamente se determine para que el proyecto cumpla con las metas de producción.<br><br>';
$str.='<span style="text-align:justify;" ><b>ARTÍCULO OCTAVO </b>Los beneficiarios se obligan a obtener la titularidad de las licencias, concesiones, permisos y/o autorizaciones para el uso, manejo, aprovechamiento y/o disposición de los recursos naturales renovables, necesarios para la implementación y ejecución del proyecto productivo , en consonancia con las normas que rigen la materia, y por ende, también deben cumplir las obligaciones que dichos actos jurídicos impongan sobre el manejo y control ambiental, de acuerdo a lo establecido en las disposiciones legales y reglamentarias que regulan la expedición de los mismos.<br><br>';
$str.='<span style="text-align:justify;" ><b>ARTÍCULO NOVENO </b>La presente resolución se notificará personalmente a los adjudicatarios en la forma contemplada en el Código de Procedimiento Administrativo y de lo Contencioso Administrativo, y se comunicará a la Procuraduría Delegada para Asuntos Ambientales y Agrarios.<br><br>';
$str.='<span style="text-align:justify;" ><b>ARTÍCULO DÉCIMO </b>Contra la presente decisión procede el recurso de reposición, el cual podrá ser interpuesto por escrito ante el Director Territorial, en la diligencia de notificación personal o dentro de los diez (10) días siguientes a ella.<br><br>';

$str.='<span style="text-align:center;" ><strong>NOTIFÍQUESE, COMUNÍQUESE y CÚMPLASE.</strong></span><br><br><br><br>';

$str.='<span style="text-align:center;" >' . strtoupper($director) . '</span><br><br>';
$str.='<span style="text-align:center;" >Director Territorial ' . strtoupper($departamento) . '</span><br><br>';
$str.= '<span style="text-align:left;" >Proyectó ' . $resolucion['Resolution']['proyecto'] . '</span><br><br>';
$str.='<span style="text-align:left;" >Revisó ' . $resolucion['Resolution']['reviso'] . '</span></p>';
$pdf->writeHTML($str, true, false, false, false, '');
$pdf->Output('resolucion_Familiar_' . $resolucion['Resolution']['id'] . '.pdf', 'D');
?>