<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Listado estructuraciones del proyecto
            </div>
            <div class="dataTable_wrapper">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Fecha</th>
                            <th>Usuario</th>
                            <th>Calificación concepto final</th>
                            <th class="sorter-false" colspan="3"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($Evaluations as $Evaluation): ?>
                            <tr>
                                <td><?php echo $Evaluation['Evaluation']['id']; ?></td>
                                <td><?php echo $Evaluation['Evaluation']['fecha']; ?></td>
                                <td><?php echo $Evaluation['User']['nombre'], " ", $Evaluation['User']['primer_apellido']; ?></td>
                                <td><?php echo $Evaluation['Evaluation']['calificacion_concepto_final'] ?></td>
                                <td><?php echo $this->Ajax->link(' Editar', array('controller' => 'Evaluations', 'action' => 'edit', $Evaluation["Evaluation"]["id"]), array('update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-success fa fa-pencil')); ?><br><br>
                                    <?php echo $this->Ajax->link(' Verificación', array('controller' => 'Revisions', 'action' => 'index', $Evaluation["Evaluation"]["id"]), array('update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-success')); ?><br><br>
                                    <?php echo $this->Ajax->link('  Otros documentos', array('controller' => 'Documents', 'action' => 'index', $Evaluation["Evaluation"]["id"], 23), array('update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-success fa fa-plus-square-o')); ?><br><br>
                                    <?php echo $this->Ajax->link(' Observaciones', array('controller' => 'Observations', 'action' => 'index', $Evaluation["Evaluation"]["id"]), array('update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-success')); ?><br><br>
                                    <?php echo $this->Ajax->link(' Concepto final', array('controller' => 'Evaluations', 'action' => 'concepto_final', $Evaluation["Evaluation"]["id"]), array('update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-success')); ?><br><br>
                                </td>
                                <td><?php if ($habilitado) echo $this->Ajax->link(' Eliminar', array('controller' => 'Evaluations', 'action' => 'delete', $Evaluation["Evaluation"]["id"], $Evaluation["Evaluation"]["proyect_id"]), array('update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-danger fa fa-trash'), '¿Desea eliminar la evaluación?'); ?></td>
                                <td><?php
                                    if (file_exists("../webroot/files/Evaluaciones/f10-" . $Evaluation['Evaluation']['id'] . ".docx"))
                                        echo $this->Html->link('  PLAN DE NEGOCIOS', "../files/Evaluaciones/f10-" . $Evaluation['Evaluation']['id'] . ".docx", array('target' => 'blank', 'indicator' => 'loading', 'class' => 'btn btn-info fa fa-file-pdf-o', 'download' => "PlanDeNegociosF10-" . $aleatorio . ".docx"));
                                    ?>
                                    <br><br>
                                    <?php
                                    if (file_exists("../webroot/files/Evaluaciones/f10-" . $Evaluation['Evaluation']['id'] . ".pdf"))
                                        echo $this->Html->link('  PLAN DE NEGOCIOS', "../files/Evaluaciones/f10-" . $Evaluation['Evaluation']['id'] . ".pdf", array('target' => 'blank', 'indicator' => 'loading', 'class' => 'btn btn-info fa fa-file-pdf-o', 'download' => "PlanDeNegociosF10-" . $aleatorio . ".pdf"));
                                    ?>
                                    <br><br>
                                    <?php
                                    if (file_exists("../webroot/files/Evaluaciones/f11-" . $Evaluation['Evaluation']['id'] . ".xlsx"))
                                        echo $this->Html->link('  Anexo técnico plan de negocios', "../files/Evaluaciones/f11-" . $Evaluation['Evaluation']['id'] . ".xlsx", array('target' => 'blank', 'indicator' => 'loading', 'class' => 'btn btn-info fa fa-file-pdf-o', 'download' => "Anexo_tecnicoF11-" . $aleatorio . ".xlsx"));
                                    ?>
                                    <br><br>
                                    <?php
                                    if (file_exists("../webroot/files/Evaluaciones/estudios-" . $Evaluation['Evaluation']['id'] . ".pdf"))
                                        echo $this->Html->link('  Estudios', "../files/Evaluaciones/estudios-" . $Evaluation['Evaluation']['id'] . ".pdf", array('target' => 'blank', 'indicator' => 'loading', 'class' => 'btn btn-info fa fa-file-pdf-o', 'download' => "Estudios-" . $aleatorio . ".pdf"));
                                    ?>
                                    <br><br>
                                    <?php
                                    if (file_exists("../webroot/files/Evaluaciones/disenos-" . $Evaluation['Evaluation']['id'] . ".pdf"))
                                        echo $this->Html->link('  Diseños', "../files/Evaluaciones/disenos-" . $Evaluation['Evaluation']['id'] . ".pdf", array('target' => 'blank', 'indicator' => 'loading', 'class' => 'btn btn-info fa fa-file-pdf-o', 'download' => "Disenos-" . $aleatorio . ".pdf"));
                                    ?>
                                    <br><br>
                                    <?php
                                    if (file_exists("../webroot/files/Evaluaciones/licencias-" . $Evaluation['Evaluation']['id'] . ".pdf"))
                                        echo $this->Html->link('  Licencias', "../files/Evaluaciones/licencias-" . $Evaluation['Evaluation']['id'] . ".pdf", array('target' => 'blank', 'indicator' => 'loading', 'class' => 'btn btn-info fa fa-file-pdf-o', 'download' => "Licencias-" . $aleatorio . ".pdf"));
                                    ?>
                                    <br><br>
                                    <?php
                                    if (file_exists("../webroot/files/Evaluaciones/permisos_ambientales-" . $Evaluation['Evaluation']['id'] . ".pdf"))
                                        echo $this->Html->link('  Permisos_ambientales', "../files/Evaluaciones/permisos_ambientales-" . $Evaluation['Evaluation']['id'] . ".pdf", array('target' => 'blank', 'indicator' => 'loading', 'class' => 'btn btn-info fa fa-file-pdf-o', 'download' => "Permisos_ambientales-" . $aleatorio . ".pdf"));
                                    ?>
                                    <br><br>
                                    <?php
                                    if (file_exists("../webroot/files/Evaluaciones/f30-" . $Evaluation['Evaluation']['id'] . ".pdf"))
                                        echo $this->Html->link(' Concepto técnico sobre estudios, diseños y otros', "../files/Evaluaciones/f30-" . $Evaluation['Evaluation']['id'] . ".pdf", array('target' => 'blank', 'indicator' => 'loading', 'class' => 'btn btn-info fa fa-file-pdf-o', 'download' => "F30-" . $aleatorio . ".pdf"));
                                    ?>
                                    <br><br>
                                    <?php
                                    if (file_exists("../webroot/files/Evaluaciones/f27-" . $Evaluation['Evaluation']['id'] . ".pdf"))
                                        echo $this->Html->link(' Certificación cumplimiento de requisitos de beneficiario', "../files/Evaluaciones/f27-" . $Evaluation['Evaluation']['id'] . ".pdf", array('target' => 'blank', 'indicator' => 'loading', 'class' => 'btn btn-info fa fa-file-pdf-o', 'download' => "F27-" . $aleatorio . ".pdf"));
                                    ?>
                                    <br><br>
                                    <?php
                                    if (file_exists("../webroot/files/Evaluaciones/f22-" . $Evaluation['Evaluation']['id'] . ".pdf"))
                                        echo $this->Html->link(' Aspectos obligatorios para evaluación', "../files/Evaluaciones/f22-" . $Evaluation['Evaluation']['id'] . ".pdf", array('target' => 'blank', 'indicator' => 'loading', 'class' => 'btn btn-info fa fa-file-pdf-o', 'download' => "F22-" . $aleatorio . ".pdf"));
                                    ?>
                                    <h3>Concepto final</h3>
                                    <?php
                                    if (file_exists("../webroot/files/Evaluaciones/f29-" . $Evaluation['Evaluation']['id'] . ".pdf"))
                                        echo $this->Html->link(' Concepto final F29', "../files/Evaluaciones/f29-" . $Evaluation['Evaluation']['id'] . ".pdf", array('target' => 'blank', 'indicator' => 'loading', 'class' => 'btn btn-info fa fa-file-pdf-o', 'download' => "Concepto_final_F29-" . $aleatorio . ".pdf"));
                                    ?>
                                    <br><br>
                                    <?php
                                    if (file_exists("../webroot/files/Evaluaciones/f13-" . $Evaluation['Evaluation']['id'] . ".pdf"))
                                        echo $this->Html->link('  Concepto final F13', "../files/Evaluaciones/f13-" . $Evaluation['Evaluation']['id'] . ".pdf", array('target' => 'blank', 'indicator' => 'loading', 'class' => 'btn btn-info fa fa-file-pdf-o', 'download' => "Concepto_final_F13-" . $aleatorio . ".pdf"));
                                    ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?php
                if (empty($Evaluations)) {
                    if ($habilitado)
                        echo $this->Ajax->link("  Adicionar", array('controller' => 'Evaluations', "action" => "add", $proyect_id), array('update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-success fa fa-plus-square-o'));
                }
                ?>
            </div>
        </div>
    </div>
</div>