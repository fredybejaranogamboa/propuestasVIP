<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Resoluciones
            </div>
            <div class="dataTable_wrapper">
                <h3>Resoluciones proyecto: <?php echo $codigo . "" ?></h3>
                <div>
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th style="width: 5%">ID</th>
                                <th style="width: 15%">Fecha</th>
                                <th style="width: 10%">Número</th>
                                <th class="sorter-false" colspan="3"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($Resolutions as $Resolution): ?>
                                <?php
                                $rutaDocumento = APP . "webroot" . DS . "files" . DS . "resoluciones" . DS . "SoporteResolucion-" . $codigo . "-" . $Resolution['Resolution']['id'] . ".pdf";
                                ?>
                                <tr>
                                    <td><?php echo $Resolution['Resolution']['id']; ?></td>
                                    <td><?php echo $Resolution['Resolution']['fecha']; ?></td>
                                    <td><?php echo $Resolution['Resolution']['numero']; ?></td>
                                    <td>
                                        <table  cellpadding="5px" cellspacing="5px">
                                            <tr>
                                                <td>
                                                    <?php
                                                    echo $this->Ajax->link(' Editar', array('controller' => 'Resolutions', 'action' => 'edit', $Resolution['Resolution']['id']), array('class' => 'btn btn-success fa fa-pencil', 'update' => 'content', 'indicator' => 'loading'));
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <?php if ($Resolution['Resolution']['tipo'] == 'ADJUDICACIÓN') echo $this->Html->link(' Imprimir', array('controller' => 'Resolutions', 'action' => 'print_letter', $Resolution['Resolution']['id']), array('target' => 'blank', 'class' => 'btn btn-success fa fa-print')); ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <?php if ($permitir) echo $this->Ajax->link(' Eliminar', array('controller' => 'Resolutions', 'action' => 'delete', $Resolution['Resolution']['id'], $Resolution['Resolution']['proyect_id']), array('update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-danger fa fa-trash'), '¿Realmente desea borrar el registro?'); ?>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td>
                                        <table cellpadding="5px" cellspacing="5px">
                                            <tr>
                                                <td>
                                                    <?php
                                                    if (file_exists($rutaDocumento)) {
                                                        echo $this->Html->link('  Adjunto resolución ', '..' . DS . "files" . DS . "resoluciones" . DS . "SoporteResolucion-" . $codigo . "-" . $Resolution['Resolution']['id'] . ".pdf", array('target' => 'blank', 'indicator' => 'loading', 'class' => 'btn btn-info fa fa-file-pdf-o', 'download' => "SoporteResolucion-" . $aleatorio . ".pdf"));
                                                    }
                                                    ?>
                                                </td>
                                            <tr>
                                                <td>
                                                    <?php $this->Ajax->link('Corrección de información', array('controller' => 'Proyects', 'action' => 'correccion_de_informacion'), array('update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-success')); ?> 
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <?php $this->Ajax->link('Resoluciones modificatorias', array('controller' => 'ResolutionCorrections', 'action' => 'index', $Resolution['Resolution']['id']), array('update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-success')); ?> 
                                                </td>
                                            </tr>
                                        </table>  

                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>  
                <br><br><br>
                <?php
                if ($permitir) {
                    echo $this->Ajax->link(' Adicionar', array('controller' => 'Resolutions', 'action' => 'add', $proyect_id), array('update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-success fa fa-plus-square-o'));
                } else {
                    echo "<h2>No es posible agregar una nueva resolución. Esto se debe a que la evaluación del proyecto no tiene como calificación cumple, o a que se esta haciendo el desembolso de los recursos.</h2>";
                }
                ?>
            </div>
        </div>
    </div>
</div>