<?php

App::import('Vendor', 'PHPExcel');
$objPHPExcel = new PHPExcel();

$objPHPExcel->getProperties()->setCreator("Aplicativo PDRET - INCODER")
        ->setLastModifiedBy("Aplicativo PDRET")
        ->setTitle("Reporte Predios PDRET - " . date("Y-m-d"))
        ->setSubject("Reporte Predios PDRET - " . date("Y-m-d"));




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


foreach ($properties as $property) {
    $i++;

    $rutaArchivo = APP . "webroot" . DS . "files" . DS . "Predio-" . $property['Property']['id'] . DS;

    $verificacionPredial = $rutaArchivo . 'verificacion_predial.pdf';
    if (file_exists($verificacionPredial)) {
        $verificacionPredialE = "CARGADO";
    } else {
        $verificacionPredialE = "NO CARGADO";
    }

    $f25 = $rutaArchivo . 'f25.pdf';
    if (file_exists($f25)) {
        $f25E = "CARGADO";
    } else {
        $f25E = "NO CARGADO";
    }

    $f4 = $rutaArchivo . 'f4.pdf';
    if (file_exists($f4)) {
        $f4E = "CARGADO";
    } else {
        $f4E = "NO CARGADO";
    }

    $tramites_ambientales = $rutaArchivo . 'tramites_ambientales.pdf';
    if (file_exists($tramites_ambientales)) {
        $tramites_ambientalesE = "CARGADO";
    } else {
        $tramites_ambientalesE = "NO CARGADO";
    }

    $archivo_matricula = $rutaArchivo . 'Matricula.pdf';
    if (file_exists($archivo_matricula)) {
        $archivo_matriculaE = "CARGADO";
    } else {
        $archivo_matriculaE = "NO CARGADO";
    }

    $distrito = $rutaArchivo . 'Distrito.pdf';
    if (file_exists($distrito)) {
        $distritoE = "CARGADO";
    } else {
        $distritoE = "NO CARGADO";
    }

    $resguardo = $rutaArchivo . 'Resguardo.pdf';
    if (file_exists($resguardo)) {
        $resguardoE = "CARGADO";
    } else {
        $resguardoE = "NO CARGADO";
    }

    $consejo = $rutaArchivo . 'Consejo.pdf';
    if (file_exists($consejo)) {
        $consejoE = "CARGADO";
    } else {
        $consejoE = "NO CARGADO";
    }

    $uso_suelo = $rutaArchivo . 'Uso_suelo.pdf';
    if (file_exists($uso_suelo)) {
        $uso_sueloE = "CARGADO";
    } else {
        $uso_sueloE = "NO CARGADO";
    }

    $junta_accion_comunal = $rutaArchivo . 'junta_accion_comunal.pdf';
    if (file_exists($junta_accion_comunal)) {
        $junta_accion_comunalE = "CARGADO";
    } else {
        $junta_accion_comunalE = "NO CARGADO";
    }

    $sana_posesion = $rutaArchivo . 'sana_posesion.pdf';
    if (file_exists($sana_posesion)) {
        $sana_posesionE = "CARGADO";
    } else {
        $sana_posesionE = "NO CARGADO";
    }

    $manifiesto_colindancias = $rutaArchivo . 'manifiesto_colindancias.pdf';
    if (file_exists($manifiesto_colindancias)) {
        $manifiesto_colindanciasE = "CARGADO";
    } else {
        $manifiesto_colindanciasE = "NO CARGADO";
    }

    $declaracion_extrajuicio = $rutaArchivo . 'declaracion_extrajuicio.pdf';
    if (file_exists($declaracion_extrajuicio)) {
        $declaracion_extrajuicioE = "CARGADO";
    } else {
        $declaracion_extrajuicioE = "NO CARGADO";
    }

    $rowArray = array($property['Proyect']['codigo'], $property['Departament']['name'],
        $property['City']['name'], $property['Property']['vereda'], $property['Property']['nombre'], $property['Property']['tipo_tenencia'],
        $property['Property']['oficina_matricula'] . "-" . $property['Property']['numero_matricula'],
        $property['Property']['corregimiento'], $property['Property']['area_total_ha'] . " Ha - " .
        $property['Property']['area_total_m'] . " mts", ($property['Property']['requiere_permisos_ambientales'] == 1) ? "Si" : "NO",
        $verificacionPredialE, $f25E, $f4E, $tramites_ambientalesE, $archivo_matriculaE, $distritoE, $resguardoE, $consejoE, $uso_sueloE, $junta_accion_comunalE,
        $sana_posesionE, $manifiesto_colindanciasE, $declaracion_extrajuicioE);

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
$objPHPExcel->getActiveSheet()->getCell('A1')->setValue("Reporte predios programa PDRET - " . date("Y-m-d"));
$objPHPExcel->getActiveSheet()->mergeCells('A1:' . $objPHPExcel->getActiveSheet()->getHighestDataColumn() . '1');

$rowArray = array(
    'Proyecto', 'Departamento', 'Municipio', 'Vereda', 'Nombre Predio', 'Tipo tenencia', 'Matrícula inmobiliaria', 'Corregimiento',
    'Área', 'Requiere permisos ambientales', 'Cruce ambiental preliminar',
    'Análisis jurídico de predios F25/F7',
    'Visita de verificación a predio f4',
    'Tramites y permisos ambientales',
    'Matrícula inmobiliaria',
    'Certificación distrito de riego',
    'Certificación resguardo indígena',
    'Certificación consejo comunitario',
    'Uso del suelo',
    'Junta acción comunal',
    'Sana posesión',
    'Manifiesto de colindancias',
    'Declaración extrajuicio'
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

$objPHPExcel->getActiveSheet()->setTitle('Predios PDRET');
$objPHPExcel->setActiveSheetIndex(0);

//autosize a todas las columnas
foreach (range('A', $objPHPExcel->getActiveSheet()->getHighestDataColumn()) as $col) {
    $objPHPExcel->getActiveSheet()
            ->getColumnDimension($col)
            ->setAutoSize(true);
}

//salida del archivo
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Reporte_predios_PDRET_' . date("Y-m-d") . '.xlsx"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
?>