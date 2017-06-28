<?php

App::import('Vendor', 'PHPExcel');
$objPHPExcel = new PHPExcel();

$objPHPExcel->getProperties()->setCreator("Aplicativo PDRET - INCODER")
        ->setLastModifiedBy("Aplicativo PDRET")
        ->setTitle("Reporte Beneficiarios PDRET - " . date("Y-m-d"))
        ->setSubject("Reporte Beneficiarios PDRET - " . date("Y-m-d"));

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




foreach ($beneficiaries as $beneficiary) {

    $i++;

    $rutaArchivo = APP . "webroot" . DS . "files" . DS . "Beneficiarios" . DS;

    $documento_identidad = $rutaArchivo . 'documento_identidad-' . $beneficiary['Beneficiary']['id'] . '.pdf';
    if (file_exists($documento_identidad)) {
        $documento_identidadE = "CARGADO";
    } else {
        $documento_identidadE = "NO CARGADO";
    }

    $policia = $rutaArchivo . 'policia-' . $beneficiary['Beneficiary']['id'] . '.pdf';
    if (file_exists($policia)) {
        $policiaE = "CARGADO";
    } else {
        $policiaE = "NO CARGADO";
    }

    $contraloria = $rutaArchivo . 'contraloria-' . $beneficiary['Beneficiary']['id'] . '.pdf';
    if (file_exists($contraloria)) {
        $contraloriaE = "CARGADO";
    } else {
        $contraloriaE = "NO CARGADO";
    }

    $procuraduria = $rutaArchivo . 'procuraduria-' . $beneficiary['Beneficiary']['id'] . '.pdf';
    if (file_exists($procuraduria)) {
        $procuraduriaE = "CARGADO";
    } else {
        $procuraduriaE = "NO CARGADO";
    }

    $sisben = $rutaArchivo . 'sisben-' . $beneficiary['Beneficiary']['id'] . '.pdf';
    if (file_exists($sisben)) {
        $sisbenE = "CARGADO";
    } else {
        $sisbenE = "NO CARGADO";
    }

    $f26 = $rutaArchivo . 'f26-' . $beneficiary['Beneficiary']['id'] . '.pdf';
    if (file_exists($f26)) {
        $f26E = "CARGADO";
    } else {
        $f26E = "NO CARGADO";
    }

    //documentos conyuge
    if (!is_null($beneficiary['Beneficiary2']['id']) and ( $beneficiary['Beneficiary2']['id'] != 0)) {
        $documento_identidad = $rutaArchivo . 'documento_identidad-' . $beneficiary['Beneficiary2']['id'] . '.pdf';
        if (file_exists($documento_identidad)) {
            $documento_identidad2E = "CARGADO";
        } else {
            $documento_identidad2E = "NO CARGADO";
        }

        $policia = $rutaArchivo . 'policia-' . $beneficiary['Beneficiary2']['id'] . '.pdf';
        if (file_exists($policia)) {
            $policia2E = "CARGADO";
        } else {
            $policia2E = "NO CARGADO";
        }

        $contraloria = $rutaArchivo . 'contraloria-' . $beneficiary['Beneficiary2']['id'] . '.pdf';
        if (file_exists($contraloria)) {
            $contraloria2E = "CARGADO";
        } else {
            $contraloria2E = "NO CARGADO";
        }

        $procuraduria = $rutaArchivo . 'procuraduria-' . $beneficiary['Beneficiary2']['id'] . '.pdf';
        if (file_exists($procuraduria)) {
            $procuraduria2E = "CARGADO";
        } else {
            $procuraduria2E = "NO CARGADO";
        }

        $sisben = $rutaArchivo . 'sisben-' . $beneficiary['Beneficiary2']['id'] . '.pdf';
        if (file_exists($sisben)) {
            $sisben2E = "CARGADO";
        } else {
            $sisben2E = "NO CARGADO";
        }

        $f26 = $rutaArchivo . 'f26-' . $beneficiary['Beneficiary2']['id'] . '.pdf';
        if (file_exists($f26)) {
            $f262E = "CARGADO";
        } else {
            $f262E = "NO CARGADO";
        }
    } else {
        $documento_identidad2E = $policia2E = $contraloria2E = $procuraduria2E = $sisben2E = $f262E = "";
    }

    $rowArray = array($beneficiary['Proyect']['codigo'], $beneficiary['Departament']['name'], $beneficiary['City']['name'], $beneficiary['Beneficiary']['numero_identificacion'], $beneficiary['Beneficiary']['tipo_identificacion'],
        $beneficiary['Beneficiary']['nombres'], $beneficiary['Beneficiary']['primer_apellido'], $beneficiary['Beneficiary']['segundo_apellido'], $beneficiary['Beneficiary']['genero'], $beneficiary['Beneficiary']['tipo'], $beneficiary['Beneficiary']['fecha_nacimiento'],
        $documento_identidadE, $policiaE, $contraloriaE, $procuraduriaE, $sisbenE, $f26E,
        $beneficiary['Beneficiary2']['numero_identificacion'], $beneficiary['Beneficiary2']['tipo_identificacion'],
        $beneficiary['Beneficiary2']['nombres'], $beneficiary['Beneficiary2']['primer_apellido'], $beneficiary['Beneficiary2']['segundo_apellido'], $beneficiary['Beneficiary2']['genero'], $beneficiary['Beneficiary2']['fecha_nacimiento'],
        $documento_identidad2E, $policia2E, $contraloria2E, $procuraduria2E, $sisben2E, $f262E
    );


    $objPHPExcel->getActiveSheet()
            ->fromArray(
                    $rowArray, NULL, 'A' . $i
    );
}

$objPHPExcel->getActiveSheet()->getStyle('A3:AD3')->applyFromArray($styleArray);

$styleArray = array(
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN
        )
    )
);

$objPHPExcel->getActiveSheet()->getStyle('A4:AD' . $i)->applyFromArray($styleArray);

//Encabezado
$objPHPExcel->getActiveSheet()->getCell('A1')->setValue("Reporte beneficiarios programa PDRET - " . date("Y-m-d"));
$objPHPExcel->getActiveSheet()->mergeCells('A1:AD1');

$rowArray = array(
    'Proyecto', 'Departamento', 'Municipio', 'Número identificación', 'Documento identificación', 'Nombres', 'Primer apellido', 'Segundo apellido',
    'Genero', 'Tipo', 'Fecha de nacimiento',
    'Documento identidad', 'Policia', 'Contraloria', 'Procuraduría', 'Soporte sisben', 'F26',
    'Número identificación Cónyuge', 'Documento identificación Cónyuge', 'Nombres Cónyuge', 'Primer apellido Cónyuge', 'Segundo apellido Cónyuge',
    'Genero Cónyuge', 'Fecha de nacimiento Cónyuge',
    'Documento identidad Cónyuge', 'Policia Cónyuge', 'Contraloria Cónyuge', 'Procuraduría Cónyuge', 'Soporte sisben Cónyuge', 'F26 Cónyuge'
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

$objPHPExcel->getActiveSheet()->getStyle('A1:AD1')->applyFromArray($styleArray);

$objPHPExcel->getActiveSheet()->setTitle('Beneficiarios PDRET');
$objPHPExcel->setActiveSheetIndex(0);

//autosize a todas las columnas
foreach (range('A', 'Z') as $col) {
    $objPHPExcel->getActiveSheet()
            ->getColumnDimension($col)
            ->setAutoSize(true);
}

$columnasSuperiores = array('AA', 'AB', 'AC', 'AD');

foreach ($columnasSuperiores as $col) {
    $objPHPExcel->getActiveSheet()
            ->getColumnDimension($col)
            ->setAutoSize(true);
}

//salida del archivo
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Reporte_beneficiarios_PDRET_' . date("Y-m-d") . '.xlsx"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
?>