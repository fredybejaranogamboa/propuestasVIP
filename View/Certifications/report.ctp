<?php

App::import('Vendor', 'PHPExcel');
$objPHPExcel = new PHPExcel();
App::Import('model', 'UserProyect');
$up = new UserProyect();

$objPHPExcel->getProperties()->setCreator("Aplicativo PDRET - INCODER")
        ->setLastModifiedBy("Aplicativo PDRET")
        ->setTitle("Reporte certificaciones estándar PDRET - " . date("Y-m-d"))
        ->setSubject("Reporte certificaciones estándar - " . date("Y-m-d"));

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

foreach ($certifications as $certification) {
    $i++;

    //Tipos de proyectos
    switch ($certification['Proyect']['tipo']) {
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

    //busco a quien esta asignado el proyecto del grupo desembolsos
    $user = $up->find('first', array('fields' => array('User.nombre', 'User.primer_apellido', 'User.segundo_apellido'), 'recursive' => 0, 'conditions' => array('UserProyect.proyect_id' => $certification['Proyect']['id'], 'User.group_id' => 17)));

    $rowArray = array(
        $certification['Proyect']['codigo'],
        $tipo_proyecto,
        $certification['Departament']['name'],
        $certification['Payment']['nombre_banco'],
        $certification['Payment']['numero_cuenta'],
        $certification['Payment']['tipo_cuenta'],
        $certification['Payment']['calificacion_final'],
        $certification['Payment']['fecha_solicitud'],
        $certification['Payment']['fecha_desembolso'],
        $certification['Certification']['cdp'],
        $certification['Certification']['rp'],
        $certification['Certification']['poblacion'],
        $certification['Certification']['valor'],
        $user['User']['nombre']." ".$user['User']['primer_apellido']." ".$user['User']['segundo_apellido'],
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
$objPHPExcel->getActiveSheet()->getCell('A1')->setValue("Reporte certificaciones estándar programa PDRET - " . date("Y-m-d"));
$objPHPExcel->getActiveSheet()->mergeCells('A1:' . $objPHPExcel->getActiveSheet()->getHighestDataColumn() . '1');

$rowArray = array('Código proyecto', 'Tipo proyecto', 'Territorial', 'Nombre banco', 'Número de cuenta', 'Tipo de cuenta',
    'Calificación docs desembolso', 'Fecha solicitud', 'Fecha desembolso', 'CDP', 'RP', 'Población', 'Valor', 'Responsable');

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
$objPHPExcel->getActiveSheet()->setTitle('Certificaciones estándar PDRET');
$objPHPExcel->setActiveSheetIndex(0);

//autosize a todas las columnas
foreach (range('A', $objPHPExcel->getActiveSheet()->getHighestDataColumn()) as $col) {
    $objPHPExcel->getActiveSheet()
            ->getColumnDimension($col)
            ->setAutoSize(true);
}

//formato de dinero
$objPHPExcel->getActiveSheet()->getStyle('M4:M' . $i)->getNumberFormat()->setFormatCode('"$"#,##0,00_-');
$objPHPExcel->getActiveSheet()->getStyle('H4:I' . $i)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_YYYYMMDD2);

//salida del archivo
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Reporte_desembolsos_PDRET_' . date("Y-m-d") . '.xlsx"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
?>