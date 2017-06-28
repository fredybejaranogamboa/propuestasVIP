<?php

App::import('Vendor', 'PHPExcel');
$objPHPExcel = new PHPExcel();

$objPHPExcel->getProperties()->setCreator("Aplicativo PDRET - INCODER")
        ->setLastModifiedBy("Aplicativo PDRET")
        ->setTitle("Reporte resoluciones PDRET - " . date("Y-m-d"))
        ->setSubject("Reporte resoluciones PDRET - " . date("Y-m-d"));

$styleArray = array(
    'font' => array(
        'bold' => true,
    ),
    'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
    ),
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN
        )
    ),
    'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'color' => array('rgb' => '90C3D4')
    ),
);

//Datos reporte
$i = 3;

App::Import('model', 'Resolution');
$re = new Resolution();
App::Import('model', 'Beneficiary');
$c = new Beneficiary();
App::Import('model', 'Certification');
$cer = new Certification();

foreach ($proyects as $proyect) {
    $i++;

    //verifico que se haya cargado el documento soporte
    $rutaArchivo = APP . "webroot" . DS . "files" . DS . "resoluciones" . DS;
    $archivoResolucion = $rutaArchivo . "SoporteResolucion-" . $proyect['proyect']['codigo'] . '-' . $proyect['resolution']['id'] . '.pdf';
    if (file_exists($archivoResolucion)) {
        $archivoResolucionE = "CARGADO";
    } else {
        $archivoResolucionE = "NO CARGADO";
    }

    //Tipos de proyectos
    switch ($proyect['proyect']['tipo']) {
        case 'F':
            $tipo_proyecto = "Familiar";
            break;
        case 'T':
            $tipo_proyecto = "Territorial";
            break;
        case 'A':
            $tipo_proyecto = "Asociativo";
            break;
        case 'R':
            $tipo_proyecto = "Asociativo-Resguardo";
            break;
        default:
            $tipo_proyecto = "";
            break;
    }

    //Listado de CDP's
    $certificados = $cer->find('all', array('conditions' => array('Certification.payment_id' => $proyect['payment']['id']), 'recursive' => -1, 'fields' => array('Certification.cdp', 'Certification.rp', 'Certification.poblacion')));
    $cdps = $rps = $poblaciones = "";
    $h = 0;
    foreach ($certificados as $certificado) {
        if ($h < 1) {
            $cdps = $certificado['Certification']['cdp'];
            $rps = $certificado['Certification']['rp'];
            $poblaciones = $certificado['Certification']['poblacion'];
        } else {
            $cdps.= " - " . $certificado['Certification']['cdp'];
            $rps.= " - " . $certificado['Certification']['rp'];
            $poblaciones.= " - " . $certificado['Certification']['poblacion'];
        }
        $h++;
    }

    //Número de resoluciones por tipo
    $modificatorias = (string) $re->find('count', array('conditions' => array('Resolution.proyect_id' => $proyect['proyect']['id'], 'Resolution.tipo' => 'MODIFICATORIA O ACLARATORIA')));
    $revocatorias = (string) $re->find('count', array('conditions' => array('Resolution.proyect_id' => $proyect['proyect']['id'], 'Resolution.tipo' => 'REVOCATORIA')));

    //Número de beneficiarios por tipo
    $campesinos = (string) $c->find('count', array('conditions' => array('Beneficiary.proyect_id' => $proyect['proyect']['id'], 'Beneficiary.tipo' => 'Campesino', 'Beneficiary.beneficiary_id' => 0)));
    $victimas = (string) $c->find('count', array('conditions' => array('Beneficiary.proyect_id' => $proyect['proyect']['id'], 'Beneficiary.tipo' => 'Victima', 'Beneficiary.beneficiary_id' => 0)));
//    $indigenas = (string) $c->find('count', array('conditions' => array('Beneficiary.proyect_id' => $proyect['proyect']['id'], 'Beneficiary.tipo' => 'Indigena', 'Beneficiary.beneficiary_id' => 0)));
//    $roms = (string) $c->find('count', array('conditions' => array('Beneficiary.proyect_id' => $proyect['proyect']['id'], 'Beneficiary.tipo' => 'Rom', 'Beneficiary.beneficiary_id' => 0)));
//    $mujerCF = (string) $c->find('count', array('conditions' => array('Beneficiary.proyect_id' => $proyect['proyect']['id'], 'Beneficiary.tipo' => 'Mujer cabeza de familia', 'Beneficiary.beneficiary_id' => 0)));
//    $negritudes = (string) $c->find('count', array('conditions' => array('Beneficiary.proyect_id' => $proyect['proyect']['id'], 'Beneficiary.tipo' => 'Negritudes', 'Beneficiary.beneficiary_id' => 0)));
    //nombre e identificación representante
    $nombre_representante = $identificacion_representante = "";
    if (!is_null($proyect['payment']['asociation_id'])) {
        $nombre_representante = $proyect['asociation']['nombre'];
        $identificacion_representante = $proyect['asociation']['nit'];
    } else {
        $nombre_representante = $proyect['beneficiary']['nombres'] . " " . $proyect['beneficiary']['primer_apellido'] . " " . $proyect['beneficiary']['segundo_apellido'];
        $identificacion_representante = $proyect['beneficiary']['numero_identificacion'];
    }

    $rowArray = array($proyect['branch']['nombre'], $tipo_proyecto, $proyect['proyect']['codigo'],
        $campesinos, $victimas, ($campesinos + $victimas), $proyect['evaluation']['fecha_concepto_final'],
        $proyect['evaluation']['contrapartida'], $proyect['evaluation']['cofinanciacion'], $proyect['evaluation']['otras_fuentes'],
        ($proyect['evaluation']['contrapartida'] + $proyect['evaluation']['cofinanciacion'] + $proyect['evaluation']['otras_fuentes']), $proyect['evaluation']['cofinanciador'],
        $proyect['resolution']['fecha'], $proyect['resolution']['numero'], $archivoResolucionE, $modificatorias, $revocatorias, $proyect['payment']['fecha_solicitud'], $proyect['payment']['fecha_desembolso'],
        $cdps, $rps, $poblaciones, $nombre_representante, $identificacion_representante, $proyect['payment']['numero_cuenta'], $proyect['payment']['nombre_banco']
    );

    $objPHPExcel->getActiveSheet()
            ->fromArray(
                    $rowArray, NULL, 'A' . $i
    );
}

$objPHPExcel->getActiveSheet()->getStyle('A3:' . $objPHPExcel->getActiveSheet()->getHighestDataColumn() . '3')->applyFromArray($styleArray);

$styleArray = array(
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN
        )
    )
);

$objPHPExcel->getActiveSheet()->getStyle('A4:' . $objPHPExcel->getActiveSheet()->getHighestDataColumn() . $i)->applyFromArray($styleArray);

//Encabezado
$objPHPExcel->getActiveSheet()->getCell('A1')->setValue("Reporte resoluciones programa PDRET - " . date("Y-m-d"));
$objPHPExcel->getActiveSheet()->mergeCells('A1:' . $objPHPExcel->getActiveSheet()->getHighestDataColumn() . '1');

$rowArray = array('Territorial', 'Tipo', 'Código', 'Campesinos', 'Victimas', 'Total familias', 'Fecha concepto final proyecto',
    'Contrapartida', 'Cofinanciación', 'Otras fuentes', 'Valor total proyecto', 'Cofinanciador', 'Fecha resolución', 'Número resolución', 'Soporte resolución',
    'Modificatorias', 'Revocatorias', 'Fecha radicado desembolso', 'Fecha desembolso', 'CDP', 'RP', 'Poblaciones', 'Nombre representante', 'Identificación representante',
    'Número cuenta', 'Nombre banco'
);
$objPHPExcel->getActiveSheet()
        ->fromArray(
                $rowArray, NULL, 'A3'
);

//Formato para el encabezado
$styleArray = array(
    'font' => array(
        'bold' => true,
        'size' => 15
    ),
    'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
    ),
    'borders' => array(
        'outline' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN
        )
    ),
    'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'color' => array('rgb' => 'D4B890')
    ),
);

$objPHPExcel->getActiveSheet()->getStyle('A1:' . $objPHPExcel->getActiveSheet()->getHighestDataColumn() . '1')->applyFromArray($styleArray);

$objPHPExcel->getActiveSheet()->setTitle('Resoluciones PDRET');
$objPHPExcel->setActiveSheetIndex(0);

//autosize a todas las columnas
foreach (range('A', $objPHPExcel->getActiveSheet()->getHighestDataColumn()) as $col) {
    $objPHPExcel->getActiveSheet()
            ->getColumnDimension($col)
            ->setAutoSize(true);
}

$objPHPExcel->getActiveSheet()->getStyle('H4:K' . $i)->getNumberFormat()->setFormatCode('"$"#,##0,00_-');

//salida del archivo
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Reporte_resoluciones_PDRET_' . date("Y-m-d") . '.xlsx"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
?>