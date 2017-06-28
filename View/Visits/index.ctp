<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Visitas de Seguimiento
            </div>
            <div class="dataTable_wrapper">
                <h3>Visitas de seguimiento: <?php echo $codigo . "" ?></h3>
                <div>
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th style="width: 5%">ID</th>
                                <th style="width: 20%">Fecha</th>
                                <th style="width: 20%">Observaciones</th>
                                <th style="width: 35%">Recomendaciones</th>
                                <th class="sorter-false" colspan="3" style="width: 20%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($Visitas as $Visita): ?>
                                <?php
                                $rutaDocumento = APP . "webroot" . DS . "files" . DS . "Seguimiento" . DS . "Visita-" . $Visita['Visit']['id'] . ".pdf";
                                ?>
                                <tr>
                                    <td><?php echo $Visita['Visit']['id']; ?></td>
                                    <td><?php echo $Visita['Visit']['fecha']; ?></td>
                                    <td><?php echo $Visita['Visit']['observaciones']; ?></td>
                                    <td><?php echo $Visita['Visit']['recomendaciones']; ?></td>
                                    <td>
                                        <table  cellpadding="5px" cellspacing="5px">
                                            <tr>
                                                <td>
                                                    <?php
                                                    echo $this->Ajax->link(' Editar', array('controller' => 'Visits', 'action' => 'edit', $Visita['Visit']['id']), array('class' => 'btn btn-success fa fa-pencil', 'update' => 'content', 'indicator' => 'loading'));
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <?php echo $this->Ajax->link(' Eliminar', array('controller' => 'Visits', 'action' => 'delete', $Visita['Visit']['id']), array('update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-danger fa fa-trash'), '¿Realmente desea borrar el registro?'); ?>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td>
                                        <?php
                                        if (file_exists($rutaDocumento)) {
                                            echo $this->Html->link('  PDF ', '..' . DS . "files" . DS . "seguimiento" . DS . "Visita-" . $Visita['Visit']['id'] . ".pdf", array('target' => '_blank', 'indicator' => 'loading', 'class' => 'btn btn-info fa fa-file-pdf-o', 'download' => "VisitaDeSegumiento-" . $aleatorio . ".pdf"));
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                            echo $this->Ajax->link(' Fotografías', array('controller' => 'Photographies', 'action' => 'index', $Visita['Visit']['id']), array('update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-success fa fa-picture-o'));
                                        ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>  
                <br><br><br>
                <?php
                    echo $this->Ajax->link(' Adicionar', array('controller' => 'Visits', 'action' => 'add', $proyect_id), array('update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-success fa fa-plus-square-o'));
                ?>
            </div>
        </div>
    </div>
</div>