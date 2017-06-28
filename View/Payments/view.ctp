<script>
    $(document).ready(function () {
        $("#formulario").validate();
    });
    $(function () {
        $("#datepicker").datepicker({
            changeMonth: true,
            changeYear: true,
            yearRange: "2015:2017"
        });
    });
    $(function () {
        $("#datepicker1").datepicker({
            changeMonth: true,
            changeYear: true,
            yearRange: "2015:2017"
        });
    });
</script>
<?php if ($option == 0): ?>

    <?php echo $this->Form->create("Payment", array('novalidate' => '', 'id' => 'formulario', 'role' => "form", "class" => "form", 'enctype' => 'multipart/form-data', 'type' => 'file', 'url' => array("action" => "view", $this->data['Payment']['id'], $option))); ?>
    <?php echo $this->Form->hidden('Payment.id'); ?>
    <?php echo $this->Form->hidden('Payment.proyect_id'); ?>

<?php endif; ?>
<table class="table table-striped table-bordered table-hover">
    <tbody>
    <td colspan="5"><center>
        <h3>INFORMACIÓN DEL PAGO</h3>
    </center></td>
<tr>
    <td>
        Valor:<br>
        <?php echo number_format($Payment['Evaluation']['cofinanciacion'], 2, ",", ".") ?>
    </td>
    <td>
        Fecha solicitud:<br>
        <?php echo $Payment['Payment']['fecha_solicitud'] ?>
    </td>
    <td>
        Fecha desembolso :<br>
        <?php echo $Payment['Payment']['fecha_desembolso'] ?>
    </td>
    <td>
        Usuario que ingreso la información:<br>
        <?php echo $Payment['User']['nombre'], " ", $Payment['User']['primer_apellido'] ?>
    </td>
</tr> 
<tr>
    <td>
        Banco:<br>
        <?php echo $Payment['Payment']['nombre_banco'] ?>
    </td>
    <td>
        Número cuenta:<br>
        <?php echo $Payment['Payment']['numero_cuenta'] ?>
    </td>
    <td colspan="2">
        Tipo cuenta:<br>
        <?php echo $Payment['Payment']['tipo_cuenta'] ?>
    </td>
</tr>
<tr>
    <td colspan="2">
        Asociación:<br>
        <?php echo $asociation['Asociation']['nombre'] . " - " . $asociation['Asociation']['nit'] ?>
    </td>
    <td colspan="2">
        Beneficiario:<br>
        <?php echo $beneficiary['Beneficiary']['primer_apellido'] . " - " . $beneficiary['Beneficiary']['segundo_apellido'] . " " . $beneficiary['Beneficiary']['nombres'] ?>
    </td>
</tr></tbody>
</table>
<br><br>
<table class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th colspan="3">ARCHIVOS DESEMBOLSO</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td colspan="3">
                <?php
                if (file_exists("../webroot/files/Pagos/poliza-" . $Payment["Payment"]["id"] . ".pdf")) {
                    echo $this->Html->link('Poliza', "../files/Pagos/poliza-" . $Payment["Payment"]["id"] . ".pdf", array('target' => 'blank', 'indicator' => 'loading', 'class' => 'btn btn-success fa fa-file-pdf-o', 'download' => "Poliza-" . $aleatorio . ".pdf"));
                }
                ?>
                <br>
                <?php
                if (file_exists("../webroot/files/Pagos/acta_aprobacion_poliza-" . $Payment["Payment"]["id"] . ".pdf")) {
                    echo $this->Html->link('acta_aprobacion_poliza', "../files/Pagos/acta_aprobacion_poliza-" . $Payment["Payment"]["id"] . ".pdf", array('target' => 'blank', 'indicator' => 'loading', 'class' => 'btn btn-success fa fa-file-pdf-o', 'download' => "acta_aprobacion_poliza-" . $aleatorio . ".pdf"));
                }
                ?>
                <br>
                <?php
                if (file_exists("../webroot/files/Pagos/certificacion_bancaria-" . $Payment["Payment"]["id"] . ".pdf")) {
                    echo $this->Html->link('certificacion_bancaria', "../files/Pagos/certificacion_bancaria-" . $Payment["Payment"]["id"] . ".pdf", array('target' => 'blank', 'indicator' => 'loading', 'class' => 'btn btn-success fa fa-file-pdf-o', 'download' => "certificacion_bancaria-" . $aleatorio . ".pdf"));
                }
                ?>
                <br>
                <?php
                if (file_exists("../webroot/files/Pagos/notificacion-" . $Payment["Payment"]["id"] . ".pdf")) {
                    echo $this->Html->link('notificacion', "../files/Pagos/notificacion-" . $Payment["Payment"]["id"] . ".pdf", array('target' => 'blank', 'indicator' => 'loading', 'class' => 'btn btn-success fa fa-file-pdf-o', 'download' => "notificacion-" . $aleatorio . ".pdf"));
                }
                ?>
                <br>
                <?php
                if (file_exists("../webroot/files/Pagos/poder-" . $Payment["Payment"]["id"] . ".pdf")) {
                    echo $this->Html->link('poder', "../files/Pagos/poder-" . $Payment["Payment"]["id"] . ".pdf", array('target' => 'blank', 'indicator' => 'loading', 'class' => 'btn btn-success fa fa-file-pdf-o', 'download' => "poder-" . $aleatorio . ".pdf"));
                }
                ?>
                <br>
                <?php
                if (file_exists("../webroot/files/Pagos/f12-" . $Payment["Payment"]["id"] . ".pdf")) {
                    echo $this->Html->link('f12', "../files/Pagos/f12-" . $Payment["Payment"]["id"] . ".pdf", array('target' => 'blank', 'indicator' => 'loading', 'class' => 'btn btn-success fa fa-file-pdf-o', 'download' => "f12-" . $aleatorio . ".pdf"));
                }
                ?>
                <br>
                <?php
                if (file_exists("../webroot/files/Pagos/cuenta_gobernacion-" . $Payment["Payment"]["id"] . ".pdf")) {
                    echo $this->Html->link('cuenta_gobernacion', "../files/Pagos/cuenta_gobernacion-" . $Payment["Payment"]["id"] . ".pdf", array('target' => 'blank', 'indicator' => 'loading', 'class' => 'btn btn-success fa fa-file-pdf-o', 'download' => "cuenta_gobernacion-" . $aleatorio . ".pdf"));
                }
                ?>
                <br>
                <?php
                if (file_exists("../webroot/files/Pagos/cdp_respaldo-" . $Payment["Payment"]["id"] . ".pdf")) {
                    echo $this->Html->link('cdp_respaldo', "../files/Pagos/cdp_respaldo-" . $Payment["Payment"]["id"] . ".pdf", array('target' => 'blank', 'indicator' => 'loading', 'class' => 'btn btn-success fa fa-file-pdf-o', 'download' => "cdp_respaldo-" . $aleatorio . ".pdf"));
                }
                ?>
                <br>
                <?php
                if (file_exists("../webroot/files/Pagos/poder_asociaciones-" . $Payment["Payment"]["id"] . ".pdf")) {
                    echo $this->Html->link('poder_asociaciones', "../files/Pagos/poder_asociaciones-" . $Payment["Payment"]["id"] . ".pdf", array('target' => 'blank', 'indicator' => 'loading', 'class' => 'btn btn-success fa fa-file-pdf-o', 'download' => "poder_asociaciones-" . $aleatorio . ".pdf"));
                }
                ?>
            </td>
        </tr>
        <tr>
            <td>
                <b>ARCHIVOS ASOCIACIÓN</b>
            </td>
            <td>
                <?php
                if (file_exists("../webroot/files/Asociaciones/existencia-" . $Payment["Payment"]["asociation_id"] . ".pdf")) {
                    echo $this->Html->link('  Certificado', "../files/Asociaciones/existencia-" . $asociation['Asociation']['id'] . ".pdf", array('target' => 'blank', 'indicator' => 'loading', 'class' => 'btn btn-info fa fa-file-pdf-o', 'download' => "Certificado-" . $aleatorio . ".pdf"));
                }
                echo '     ';
                if (file_exists("../webroot/files/Asociaciones/rut-" . $Payment["Payment"]["asociation_id"] . ".pdf")) {
                    echo $this->Html->link('  RUT', "../files/Asociaciones/rut-" . $Payment["Payment"]["asociation_id"] . ".pdf", array('target' => 'blank', 'indicator' => 'loading', 'class' => 'btn btn-info fa fa-file-pdf-o', 'download' => "RUT-" . $aleatorio . ".pdf"));
                }
                ?>
            </td>
        </tr>
        <tr>
            <td>
                <b>ARCHIVOS EVALUACIÓN</b>
            </td>
            <td>
                <?php
                if (file_exists("../webroot/files/Evaluaciones/f10-" . $Payment['Evaluation']['id'] . ".docx"))
                    echo $this->Html->link('  PLAN DE NEGOCIOS', "../files/Evaluaciones/f10-" . $Payment['Evaluation']['id'] . ".docx", array('target' => 'blank', 'indicator' => 'loading', 'class' => 'btn btn-info fa fa-file-pdf-o', 'download' => "PlanDeNegociosF10-" . $aleatorio . ".docx"));
                ?>
                <br><br>
                <?php
                if (file_exists("../webroot/files/Evaluaciones/f10-" . $Payment['Evaluation']['id'] . ".pdf"))
                    echo $this->Html->link('  PLAN DE NEGOCIOS', "../files/Evaluaciones/f10-" . $Payment['Evaluation']['id'] . ".pdf", array('target' => 'blank', 'indicator' => 'loading', 'class' => 'btn btn-info fa fa-file-pdf-o', 'download' => "PlanDeNegociosF10-" . $aleatorio . ".pdf"));
                ?>
                <?php
                if (file_exists("../webroot/files/Evaluaciones/f27-" . $Payment['Evaluation']['id'] . ".pdf"))
                    echo $this->Html->link(' Certificación cumplimiento de requisitos de beneficiario', "../files/Evaluaciones/f27-" . $Payment['Evaluation']['id'] . ".pdf", array('target' => 'blank', 'indicator' => 'loading', 'class' => 'btn btn-info fa fa-file-pdf-o', 'download' => "Certificacion_cumplimiento_requisitos-" . $aleatorio . ".pdf"));
                ?>
                <br>
                <?php
                if (file_exists("../webroot/files/Evaluaciones/f13-" . $Payment['Evaluation']['id'] . ".pdf"))
                    echo $this->Html->link('  Concepto final F13', "../files/Evaluaciones/f13-" . $Payment['Evaluation']['id'] . ".pdf", array('target' => 'blank', 'indicator' => 'loading', 'class' => 'btn btn-info fa fa-file-pdf-o', 'download' => "Concepto_final_F13-" . $aleatorio . ".pdf"));
                ?>
                <br>
                <?php
                if (file_exists("../webroot/files/Evaluaciones/f29-" . $Payment['Evaluation']['id'] . ".pdf"))
                    echo $this->Html->link(' Concepto final F29', "../files/Evaluaciones/f29-" . $Payment['Evaluation']['id'] . ".pdf", array('target' => 'blank', 'indicator' => 'loading', 'class' => 'btn btn-info fa fa-file-pdf-o', 'download' => "Concepto_final_F29-" . $aleatorio . ".pdf"));
                ?>
                <br>
                <?php
                if (file_exists("../webroot/files/Evaluaciones/f11-" . $Payment['Evaluation']['id'] . ".xlsx"))
                    echo $this->Html->link('  Anexo técnico plan de negocios', "../files/Evaluaciones/f11-" . $Payment['Evaluation']['id'] . ".xlsx", array('target' => 'blank', 'indicator' => 'loading', 'class' => 'btn btn-info fa fa-file-pdf-o', 'download' => "Anexo_tecnicoF11-" . $aleatorio . ".xlsx"));
                ?>
            </td>
        </tr>
    </tbody>
</table>

<table class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th colspan="3">Cédulas beneficiarios</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($beneficiaries as $ben):
            ?>
            <tr>
                <td>
                    <?php
                    echo $ben['Beneficiary']['primer_apellido'] . " " . $ben['Beneficiary']['segundo_apellido'] . " " . $ben['Beneficiary']['nombres'];
                    ?>
                </td>
                <td>
                    <?php
                    echo $ben['Beneficiary']['numero_identificacion'];
                    ?>
                </td>
                <td>
                    <?php
                    if (file_exists("../webroot/files/Beneficiarios/documento_identidad-" . $ben['Beneficiary']['id'] . ".pdf"))
                        echo $this->Html->link(' Documento_identidad', "../files/Beneficiarios/documento_identidad-" . $ben['Beneficiary']['id'] . ".pdf", array('target' => 'blank', 'indicator' => 'loading', 'class' => 'btn btn-warning fa fa-file-pdf-o', 'download' => "Documento_identidad-" . $aleatorio . ".pdf"));
                    ?>
                </td>
            </tr>
            <?php
        endforeach;
        ?>
    </tbody>
</table>

<table class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th colspan="3">Archivos predios</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($properties as $property):
            ?>
            <tr>
                <td>
                    <?php
                    echo "Nombre predio: ", $property['Property']['nombre'];
                    ?>
                </td>
                <td>
                    <?php
                    echo "Número de matrícula: ", $property['Property']['oficina_matricula'], '-', $property['Property']['numero_matricula'];
                    ?>
                </td>
                <td>
                    <?php
                    if (file_exists("../webroot/files/Predio-" . $property["Property"]["id"] . "/f25.pdf"))
                        echo $this->Html->link('Análisis jurídico de predios F25/F7', "../files/Predio-" . $property["Property"]["id"] . "/f25.pdf", array('target' => 'blank', 'indicator' => 'loading', 'class' => 'btn btn-success fa fa-file-pdf-o', 'download' => "Analisis_juridico-" . $aleatorio . ".pdf"));
                    ?>
                </td>
            </tr>
            <?php
        endforeach;
        ?>
    </tbody>
</table>
<?php if ($option == 0): ?>
    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th>Tipo</th>
                <th>Calificación</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Documentos de asignación de recursos: <?php echo $this->data['Payment']['asignacion_recursos'] ?>
                    <br>(Notificación)</td>
                <td><?php echo $this->Form->input('Payment.asignacion_recursos', array('label' => '', 'class' => 'form-control', 'required' => '', 'empty' => 'Seleccionar una opción...', 'options' => array('No aplica' => 'No aplica', 'Cumple' => 'Cumple', 'No cumple' => 'No cumple'))); ?>
                </td>
            </tr>
            <tr>
                <td>Cédulas beneficiarios: <?php echo $this->data['Payment']['cedulas'] ?>
                    <br>(Cédulas)
                </td>
                <td><?php echo $this->Form->input('Payment.cedulas', array('label' => '', 'class' => 'form-control', 'required' => '', 'empty' => 'Seleccionar una opción...', 'options' => array('No aplica' => 'No aplica', 'Cumple' => 'Cumple', 'No cumple' => 'No cumple'))); ?>
                </td>
            </tr>
            <tr>
                <td>Certificación de cumplimiento de requisitos por parte de beneficiarios, predios y/o persona jurídica: <?php echo $this->data['Payment']['certificacion_requisitos'] ?>
                    <br>(F9 certificación familias,  predios y persona jurídica)
                </td>
                <td><?php echo $this->Form->input('Payment.certificacion_requisitos', array('label' => '', 'class' => 'form-control', 'required' => '', 'empty' => 'Seleccionar una opción...', 'options' => array('No aplica' => 'No aplica', 'Cumple' => 'Cumple', 'No cumple' => 'No cumple'))); ?>
                </td>
            </tr>
            <tr>
                <td>Verificación jurídica de los predios vinculados al proyecto: <?php echo $this->data['Payment']['verificacion_juridica'] ?>
                    <br>(F7)
                </td>
                <td><?php echo $this->Form->input('Payment.verificacion_juridica', array('label' => '', 'class' => 'form-control', 'required' => '', 'empty' => 'Seleccionar una opción...', 'options' => array('No aplica' => 'No aplica', 'Cumple' => 'Cumple', 'No cumple' => 'No cumple'))); ?>
                </td>
            </tr>
            <tr>
                <td>Certificación de documentación de proyecto: <?php echo $this->data['Payment']['certificacion_proyecto'] ?>
                    <br>(F12)
                </td>
                <td><?php echo $this->Form->input('Payment.certificacion_proyecto', array('label' => '', 'class' => 'form-control', 'required' => '', 'empty' => 'Seleccionar una opción...', 'options' => array('No aplica' => 'No aplica', 'Cumple' => 'Cumple', 'No cumple' => 'No cumple'))); ?>
                </td>
            </tr>
            <tr>
                <td>Certificación representacion legal: <?php echo $this->data['Payment']['certificacion_rep_legal'] ?>
                    <br>(Cámara de comercio - RUT)
                </td>
                <td><?php echo $this->Form->input('Payment.certificacion_rep_legal', array('label' => '', 'class' => 'form-control', 'required' => '', 'empty' => 'Seleccionar una opción...', 'options' => array('No aplica' => 'No aplica', 'Cumple' => 'Cumple', 'No cumple' => 'No cumple'))); ?>
                </td>
            </tr>
            <tr>
                <td>Autorizaciones especiales: <?php echo $this->data['Payment']['autorizaciones_especiales'] ?>
                    <br>(Poder - F30 infraestructura)
                </td>
                <td><?php echo $this->Form->input('Payment.autorizaciones_especiales', array('label' => '', 'class' => 'form-control', 'required' => '', 'empty' => 'Seleccionar una opción...', 'options' => array('No aplica' => 'No aplica', 'Cumple' => 'Cumple', 'No cumple' => 'No cumple'))); ?>
                </td>
            </tr>
            <tr>
                <td>Contrapartidas: <?php echo $this->data['Payment']['contrapartidas'] ?>
                    <br>(CDP respaldando contrapartida)
                </td>
                <td><?php echo $this->Form->input('Payment.contrapartidas', array('label' => '', 'class' => 'form-control', 'required' => '', 'empty' => 'Seleccionar una opción...', 'options' => array('No aplica' => 'No aplica', 'Cumple' => 'Cumple', 'No cumple' => 'No cumple'))); ?>
                </td>
            </tr>
            <tr>
                <td>Formato de evaluación del proyecto productivo: <?php echo $this->data['Payment']['evaluacion_pp'] ?>
                    <br>(F13 asociativo - familias, F29 territoriales)</td>
                <td><?php echo $this->Form->input('Payment.evaluacion_pp', array('label' => '', 'class' => 'form-control', 'required' => '', 'empty' => 'Seleccionar una opción...', 'options' => array('No aplica' => 'No aplica', 'Cumple' => 'Cumple', 'No cumple' => 'No cumple'))); ?>
                </td>
            </tr>
            <tr>
                <td>Póliza y aprobación de la misma: <?php echo $this->data['Payment']['poliza_aprobacion'] ?>
                    <br>(F32)</td>
                <td><?php echo $this->Form->input('Payment.poliza_aprobacion', array('label' => '', 'class' => 'form-control', 'required' => '', 'empty' => 'Seleccionar una opción...', 'options' => array('No aplica' => 'No aplica', 'Cumple' => 'Cumple', 'No cumple' => 'No cumple'))); ?>
                </td>
            </tr>
            <tr>
                <td>Certificación bancaria cuenta controlada: <?php echo $this->data['Payment']['certificacion_bancaria_cal'] ?></td>
                <td><?php echo $this->Form->input('Payment.certificacion_bancaria_cal', array('label' => '', 'class' => 'form-control', 'required' => '', 'empty' => 'Seleccionar una opción...', 'options' => array('No aplica' => 'No aplica', 'Cumple' => 'Cumple', 'No cumple' => 'No cumple'))); ?>
                </td>
            </tr>
            <tr>
                <td>Observación calificación </td>
                <td><?php echo $this->Form->input('Payment.observacion_calificacion', array('label' => '', 'class' => 'form-control', 'required' => '')); ?>
                </td>
            </tr>
            <tr>
                <td>Calificación final: <?php echo $this->data['Payment']['calificacion_final'] ?></td>
                <td><?php echo $this->Form->input('Payment.calificacion_final', array('label' => '', 'class' => 'form-control', 'required' => '', 'empty' => 'Seleccionar una opción...', 'options' => array('Cumple' => 'Cumple', 'No cumple' => 'No cumple'))); ?>
                </td>
            </tr>
        </tbody>
    </table>

    <?php echo $this->Form->end(array('label' => "CALIFICAR", 'class' => 'btn btn-default')) ?>
<?php endif; ?>