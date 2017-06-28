<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Extractos bancarios
            </div>
            <div class="dataTable_wrapper">
                <h3>Extractos: <?php echo $codigo . "" ?></h3>
                <div>
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th style="width: 5%">ID</th>
                                <th style="width: 20%">Fecha</th>
                                <th style="width: 20%">Saldo</th>
                                <th style="width: 35%">Observaciones</th>
                                <th class="sorter-false" colspan="2" style="width: 20%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($Extractos as $Extracto): ?>
                                <?php
                                $rutaDocumento = APP . "webroot" . DS . "files" . DS . "Seguimiento" . DS . "Extracto-" . $Extracto['Extract']['id'] . ".pdf";
                                ?>
                                <tr>
                                    <td><?php echo $Extracto['Extract']['id']; ?></td>
                                    <td><?php echo $Extracto['Extract']['fecha']; ?></td>
                                    <td><?php echo '$' . number_format($Extracto['Extract']['saldo'], 2, ",", "."); ?></td>
                                    <td><?php echo $Extracto['Extract']['observaciones']; ?></td>
                                    <td>
                                        <table  cellpadding="5px" cellspacing="5px">
                                            <tr>
                                                <td>
                                                    <?php
                                                    echo $this->Ajax->link(' Editar', array('controller' => 'Extracts', 'action' => 'edit', $Extracto['Extract']['id']), array('class' => 'btn btn-success fa fa-pencil', 'update' => 'content', 'indicator' => 'loading'));
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <?php echo $this->Ajax->link(' Eliminar', array('controller' => 'Extracts', 'action' => 'delete', $Extracto['Extract']['id']), array('update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-danger fa fa-trash'), '¿Realmente desea borrar el registro?'); ?>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td>
                                        <?php
                                        if (file_exists($rutaDocumento)) {
                                            echo $this->Html->link('  PDF ', '..' . DS . "files" . DS . "seguimiento" . DS . "Extracto-" . $Extracto['Extract']['id'] . ".pdf", array('target' => 'blank', 'indicator' => 'loading', 'class' => 'btn btn-info fa fa-file-pdf-o', 'download' => "ExtractoBancario-" . $aleatorio . ".pdf"));
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
                    echo $this->Ajax->link(' Adicionar', array('controller' => 'Extracts', 'action' => 'add', $proyect_id), array('update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-success fa fa-plus-square-o'));
                ?>
            </div>
        </div>
    </div>
</div>