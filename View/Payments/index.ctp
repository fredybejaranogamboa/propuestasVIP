<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Pagos
            </div>
            <div class="dataTable_wrapper">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Solicitud</th>
                            <th>Desembolso</th>
                            <th>Usuario</th>
                            <th>Monto</th>
                            <th class="sorter-false" colspan="3"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($Payments as $Payment): ?>
                            <tr>
                                <td><?php echo $Payment['Payment']['id']; ?></td>
                                <td><?php echo $Payment['Payment']['fecha_solicitud']; ?></td>
                                <td><?php echo $Payment['Payment']['fecha_desembolso']; ?></td>
                                <td><?php echo $Payment['User']['nombre'], " ", $Payment['User']['primer_apellido'], " <br>Calificación final: ", $Payment['Payment']['calificacion_final']; ?></td>
                                <td><?php echo number_format($Payment['Evaluation']['cofinanciacion'], 2, ",", ".") ?></td>
                                <td>
                                    <?php echo $this->Ajax->link(' Info Básica', array('controller' => 'Payments', 'action' => 'edit', $Payment["Payment"]["id"]), array('update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-success fa fa-pencil')); ?><br><br>
                                    <?php if ($calificar) echo $this->Ajax->link(' Calificación', array('controller' => 'Payments', 'action' => 'view', $Payment["Payment"]["id"], 0), array('update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-success fa fa-folder-open-o')); ?>
                                    <?php echo $this->Ajax->link(' Documentos', array('controller' => 'Payments', 'action' => 'view', $Payment["Payment"]["id"], 1), array('update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-success fa fa-file-pdf-o')); ?>
                                    <?php echo $this->Ajax->link(' Certificaciones', array('controller' => 'Certifications', 'action' => 'index', $Payment["Payment"]["id"]), array('update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-success fa fa-file-pdf-o')); ?>
                                    <?php echo $this->Ajax->link(' Fechas', array('controller' => 'Payments', 'action' => 'dates', $Payment["Payment"]["id"]), array('update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-success fa fa-calendar')); ?>
                                    <?php
                                    if (AuthComponent::User('group_id') == 1) {
                                        echo $this->Ajax->link(' Eliminar', array('controller' => 'Payments', 'action' => 'delete', $Payment["Payment"]["id"], $Payment["Payment"]["proyect_id"]), array('update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-danger fa fa-trash'), '¿Desea eliminar el desembolso?');
                                    }
                                    ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?php
                if ($permitir) {
                    if (empty($Payments)) {

                        echo $this->Ajax->link("  Adicionar", array('controller' => 'Payments', "action" => "add", $proyect_id), array('update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-success fa fa-plus-square-o'));
                    }
                } else {
                    echo "<h2>El proyecto no cumple, por favor verificar la evaluación hecha.</h2>";
                }
                ?>
            </div>
        </div>
    </div>
</div>