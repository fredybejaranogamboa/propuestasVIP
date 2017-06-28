<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Planes de inversión
            </div>
            <div class="dataTable_wrapper">
                <h3>Planes de inversión: <?php echo $codigo . "" ?></h3>
                <div>
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th style="width: 10%">ID</th>
                                <th style="width: 20%">Fecha</th>
                                <th style="width: 40%">Observaciones</th>
                                <th class="sorter-false" colspan="2" style="width: 30%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($Planes as $Plan): ?>
                                <?php
                                $rutaDocumento = APP . "webroot" . DS . "files" . DS . "Seguimiento" . DS . "PlanInversion-" . $Plan['Follow']['id'] . ".pdf";
                                ?>
                                <tr>
                                    <td><?php echo $Plan['Follow']['id']; ?></td>
                                    <td><?php echo $Plan['Follow']['fecha']; ?></td>
                                    <td><?php echo $Plan['Follow']['observaciones']; ?></td>
                                    <td>
                                        <table  cellpadding="5px" cellspacing="5px">
                                            <tr>
                                                <td>
                                                    <?php
                                                    echo $this->Ajax->link(' Editar', array('controller' => 'Follows', 'action' => 'edit', $Plan['Follow']['id']), array('class' => 'btn btn-success fa fa-pencil', 'update' => 'content', 'indicator' => 'loading'));
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <?php echo $this->Ajax->link(' Eliminar', array('controller' => 'Follows', 'action' => 'delete', $Plan['Follow']['id']), array('update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-danger fa fa-trash'), '¿Realmente desea borrar el registro?'); ?>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td>
                                        <?php
                                        if (file_exists($rutaDocumento)) {
                                            echo $this->Html->link('  PDF ', '..' . DS . "files" . DS . "seguimiento" . DS . "PlanInversion-" . $Plan['Follow']['id'] . ".pdf", array('target' => 'blank', 'indicator' => 'loading', 'class' => 'btn btn-info fa fa-file-pdf-o', 'download' => "PlanDeInversion-" . $aleatorio . ".pdf"));
                                        }
                                        ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>  
                <br><br><br>
                <?php
                    echo $this->Ajax->link(' Adicionar', array('controller' => 'Follows', 'action' => 'add', $proyect_id), array('update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-success fa fa-plus-square-o'));
                ?>
            </div>
        </div>
    </div>
</div>