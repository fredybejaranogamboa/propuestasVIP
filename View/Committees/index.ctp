<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Comités de compra
            </div>
            <div class="dataTable_wrapper">
                <h3>Comités: <?php echo $codigo . "" ?></h3>
                <div>
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th style="width: 5%">ID</th>
                                <th style="width: 20%">Fecha</th>
                                <th style="width: 20%">Valor</th>
                                <th style="width: 35%">Observaciones</th>
                                <th class="sorter-false" colspan="2" style="width: 20%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($Comites as $Comite): ?>
                                <?php
                                $rutaSoporte = APP . "webroot" . DS . "files" . DS . "Seguimiento" . DS . "Comite-" . $Comite['Committee']['id'] . ".pdf";
                                $rutaCotizacion = APP . "webroot" . DS . "files" . DS . "Seguimiento" . DS . "Cotizacion-" . $Comite['Committee']['id'] . ".pdf";
                                $rutaFactura = APP . "webroot" . DS . "files" . DS . "Seguimiento" . DS . "Factura-" . $Comite['Committee']['id'] . ".pdf";
                                ?>
                                <tr>
                                    <td><?php echo $Comite['Committee']['id']; ?></td>
                                    <td><?php echo $Comite['Committee']['fecha']; ?></td>
                                    <td><?php echo '$' . number_format($Comite['Committee']['valor'], 2, ",", "."); ?></td>
                                    <td><?php echo $Comite['Committee']['observaciones']; ?></td>
                                    <td>
                                        <table  cellpadding="5px" cellspacing="5px">
                                            <tr>
                                                <td>
                                                    <?php
                                                    echo $this->Ajax->link(' Editar', array('controller' => 'Committees', 'action' => 'edit', $Comite['Committee']['id']), array('class' => 'btn btn-success fa fa-pencil', 'update' => 'content', 'indicator' => 'loading'));
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <?php echo $this->Ajax->link(' Eliminar', array('controller' => 'Committees', 'action' => 'delete', $Comite['Committee']['id']), array('update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-danger fa fa-trash'), '¿Realmente desea borrar el registro?'); ?>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td>
                                        <?php
                                        if (file_exists($rutaSoporte)) {
                                            echo $this->Html->link('  Soporte ', '..' . DS . "files" . DS . "seguimiento" . DS . "Comite-" . $Comite['Committee']['id'] . ".pdf", array('target' => 'blank', 'indicator' => 'loading', 'class' => 'btn btn-info fa fa-file-pdf-o', 'download' => "ComiteDeCompra-" . $aleatorio . ".pdf"));
                                        }
                                        ?><br>
                                        <?php
                                        if (file_exists($rutaCotizacion)) {
                                            echo $this->Html->link('  Cotizaciones ', '..' . DS . "files" . DS . "seguimiento" . DS . "Cotizacion-" . $Comite['Committee']['id'] . ".pdf", array('target' => 'blank', 'indicator' => 'loading', 'class' => 'btn btn-info fa fa-file-pdf-o', 'download' => "Cotizaciones-" . $aleatorio . ".pdf"));
                                        }
                                        ?><br>
                                        <?php
                                        if (file_exists($rutaFactura)) {
                                            echo $this->Html->link('  Facturas ', '..' . DS . "files" . DS . "seguimiento" . DS . "Factura-" . $Comite['Committee']['id'] . ".pdf", array('target' => 'blank', 'indicator' => 'loading', 'class' => 'btn btn-info fa fa-file-pdf-o', 'download' => "Facturas-" . $aleatorio . ".pdf"));
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
                    echo $this->Ajax->link(' Adicionar', array('controller' => 'Committees', 'action' => 'add', $proyect_id), array('update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-success fa fa-plus-square-o'));
                ?>
            </div>
        </div>
    </div>
</div>