<?php
App::import('Vendor', 'ClassEzpdf', array('file' => 'pdf/class.ezpdf.php'));
App::import('Vendor', 'EnLetras', array('file' => 'EnLetras.class.php'));
$pdf = new Cezpdf('LETTER');
$V = new EnLetras();

generar_cartaev(' ', "", $pdf);
App::Import('model', 'Candidate');
$Candidate = new Candidate();
$Candidate->recursive = -1;

$str = "";
$conteo = 0;
foreach ($aspirantes as $aspirante) {
    $i = $pdf->ezStartPageNumbers(20, 75, 10, 'right', utf8_decode($resolucion['Proyect']['codigo'] . ' Página ' . "{PAGENUM} de {TOTALPAGENUM}"), 1);


    $str = "2500 \nBogotá D.C\nSeñor(es):\n";
    $pdf->ezText(utf8_decode($str), 11, array('justification' => 'full'));
    $str = "";
    $tipo = "";
    switch ($aspirante['Candidate']['tipo_ident']) {
        case 1:
            $tipo = "C.C";
            break;
        case 2:
            $tipo = "T.I";
            break;

        default:
            break;
    }

    $str.= $aspirante['Candidate']['1er_nombre'] . " " . $aspirante['Candidate']['2do_nombre'] . " " . $aspirante['Candidate']['1er_apellido'] . " " . $aspirante['Candidate']['2do_apellido'] . "\n";

    if ($conyuge = $Candidate->find('first', array('conditions' => array('Candidate.candidate_id' => $aspirante['Candidate']['id']), 'fields' => array('Candidate.id', 'Candidate.tipo_ident', 'Candidate.nro_ident', 'Candidate.1er_apellido', 'Candidate.2do_apellido', 'Candidate.1er_nombre', 'Candidate.2do_nombre', 'Candidate.jerarquia')))) {
        $tipoc = "";
        switch ($conyuge['Candidate']['tipo_ident']) {
            case 1:
                $tipoc = "C.C";
                break;
            case 2:
                $tipoc = "T.I";
                break;

            default:
                break;
        }
        $str.= $conyuge['Candidate']['1er_nombre'] . " " . $conyuge['Candidate']['2do_nombre'] . " " . $conyuge['Candidate']['1er_apellido'] . " " . $conyuge['Candidate']['2do_apellido'];
    }
    $str.="\nBeneficiario (os) Proyecto " . $resolucion['Proyect']['codigo'];
    $str.="\nCONVOCATORIA PÚBLICA INCODER " . $resolucion['Call']['nombre'] . "\n";
    $str.="Dirección: " . $aspirante['Candidate']['direccion'] . "\n";
    $str.="Teléfono: " . $aspirante['Candidate']['telefono'] . "\n\n";
    $pdf->ezText(utf8_decode($str), 11, array('justification' => 'full'));

    $str = "REFERENCIA: NOTIFICACIÓN RESOLUCIÓN ADJUDICACIÓN DEL SUBSIDIO INTEGRAL PARA LA COMPRA DE TIERRAS\n";
    $pdf->ezText(utf8_decode($str), 11, array('justification' => 'full', 'left' => 20));
    $fecha = $V->obtenerMes($resolucion['Resolution']['fecha']);
    $str = "De conformidad con lo establecido en la Ley 160 de 1994 en lo relacionado con el subsidio para compra de tierras, de manera muy atenta, me permito informarle que le ha sido adjudicado el SUBSIDIO INTEGRAL PARA LA COMPRA DE TIERRAS mediante la Resolución " . $resolucion['Resolution']['numero'] . " de fecha " . $fecha . ".\n";
    $str.="Por lo anterior, es  necesario que se acerque a la Oficina de la Dirección Territorial  de " . $resolucion['Branch']['nombre'] . " ubicada en la " . $resolucion['Branch']['direccion'] . ", dentro de los siguiente diez días calendario al recibo de la presente comunicación, para que le sea entregada y notificada la mencionada Resolución, en cumplimiento de lo establecido en el artículo 44 del Código Contencioso Administrativo; para la notificación debe presentar su cédula de ciudadanía actualizada.\n";
    $str.="\nCordial saludo,\n\n\n\n\n\n";
    $pdf->ezText(utf8_decode($str), 11, array('justification' => 'full'));
    $str = $resolucion['Branch']['director'] . "\n";
    $str.= "Director Territorial " . $resolucion['Branch']['nombre'];
    $pdf->ezText(utf8_decode($str), 11, array('justification' => 'full'));
    ;
    $pdf->ezStopPageNumbers(1, 1, $i);
    $conteo++;
    if ($conteo == $evaluacion['FinalEvaluation']['familias_habilitadas']) {
        break;
    } else {

        $pdf->ezNewPage();
    }
}


















$pdf->ezStream();
?>
<?php

function generar_cartaev($cod, $str, &$pdf, $start = true, $m_left = 2.5, $m_right = 2.5) {
    //App::import('Vendor', 'ClassEzpdf', array('file' => 'pdf/class.ezpdf.php'));
    if ($pdf == NULL) {
        //$pdf = new Cezpdf('LETTER');
    }
    if ($start) {
        $tmp = array(
            'b' => 'Trebuchet-Bold.afm'
            , 'i' => 'Trebuchet-Italic.afm'
            , 'bi' => 'Trebuchet-BoldItalic.afm'
            , 'ib' => 'Trebuchet-BoldItalic.afm'
            , 'bb' => 'Trebuchet-Bold.afm'
        );
        $pdf->setFontFamily('Trebuchet.afm', $tmp);
        $pdf->selectFont('fonts/Trebuchet.afm');

        $all = $pdf->openObject();
        $pdf->saveState();
        $pdf->addJpegFromFile('img/cabecera.jpg', 60, 670, 500);
        $pdf->addJpegFromFile('img/pie.jpg', 0, 10, 610, 60);
        $pdf->restoreState();
        $pdf->closeObject();
        $pdf->addObject($all, 'all');
        $pdf->transaction('start');
    }

    $pdf->ezSetCmMargins(5, 5, $m_left, $m_right);

    $textOptions = array('justification' => 'full');
    $data = explode("\n", $str);
    $collecting = 0;
    foreach ($data as $d) {
        chop($d);
        if (strlen($d) && $d[0] == '#') {
            switch ($d) {
                case '#NP':
                    $pdf->ezNewPage();
                    break;
            }
        } else {
            $pdf->ezText($d, 8, $textOptions);
        }
    }
}

?>