<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Listado Asociaciones
            </div>
            <div class="dataTable_wrapper">
                <?php if ($permitir) echo $this->Ajax->link("  Adicionar", array('controller' => 'Asociations', "action" => "add"), array('update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-success fa fa-plus-square-o')) ?>
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nombre asociación</th>
                            <th>NIT</th>
                            <th class="sorter-false"></th>
                            <th class="sorter-false"></th>
                            <th class="sorter-false" colspan="2"></th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Id</th>
                            <th>Nombre asociación</th>
                            <th>NIT</th>
                            <th></th>
                            <th></th>
                            <th colspan="2"></th>
                        </tr>
                        <tr>
                            <th colspan="7" class="ts-pager form-horizontal">
                                <button type="button" class="btn first"><i class="icon-step-backward glyphicon glyphicon-step-backward"></i></button>
                                <button type="button" class="btn prev"><i class="icon-arrow-left glyphicon glyphicon-backward"></i></button>
                                <span class="pagedisplay"></span> <!-- this can be any element, including an input -->
                                <button type="button" class="btn next"><i class="icon-arrow-right glyphicon glyphicon-forward"></i></button>
                                <button type="button" class="btn last"><i class="icon-step-forward glyphicon glyphicon-step-forward"></i></button>
                                <select class="pagesize input-mini" title="Select page size">
                                    <option selected="selected" value="10">10</option>
                                    <option value="20">20</option>
                                    <option value="30">30</option>
                                    <option value="40">40</option>
                                </select>
                                <select class="pagenum input-mini" title="Select page number"></select>
                            </th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php foreach ($Asociations as $Asociation): ?>
                        <tr>
                            <td><?php echo $Asociation['Asociation']['id']; ?></td>
                            <td><?php echo $Asociation['Asociation']['nombre']; ?></td>
                            <td><?php echo $Asociation['Asociation']['nit']; ?></td>
                            <td>
                                    <?php echo $this->Ajax->link(' Documentos', array('controller' => 'Asociations', 'action' => 'edit', $Asociation["Asociation"]["id"]), array('update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-success fa fa-file-pdf-o')); ?><br>
                                    <?php echo $this->Ajax->link(' SOCIO-ORGANIZACIONAL', array('controller' => 'Asociations', 'action' => 'socio_organizacional', $Asociation["Asociation"]["id"]), array('update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-success fa fa-pencil')); ?>
                                    <?php echo $this->Ajax->link(' REPRESENTANTE', array('controller' => 'Asociations', 'action' => 'representante', $Asociation["Asociation"]["id"]), array('update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-success fa fa-pencil')); ?>

                            </td>
                            <td><?php if ($permitir) echo $this->Ajax->link(' Eliminar', array('controller' => 'Asociations', 'action' => 'delete', $Asociation["Asociation"]["id"]), array('update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-danger fa fa-trash'), '¿Desea elimiar la asociación?'); ?></td>
                            <td><?php
                                    if (file_exists("../webroot/files/Asociaciones/existencia-" . $Asociation['Asociation']['id'] . ".pdf"))
                                        echo $this->Html->link('  Certificado vínculo', "../files/Asociaciones/existencia-" . $Asociation['Asociation']['id'] . ".pdf", array('target' => 'blank', 'indicator' => 'loading', 'class' => 'btn btn-info fa fa-file-pdf-o', 'download' => "Certificado_vinculo-" . $aleatorio . ".pdf"));
                                    ?>
                                <br><br>
                                    <?php
                                    if (file_exists("../webroot/files/Asociaciones/rut-" . $Asociation['Asociation']['id'] . ".pdf"))
                                        echo $this->Html->link('  RUT', "../files/Asociaciones/rut-" . $Asociation['Asociation']['id'] . ".pdf", array('target' => 'blank', 'indicator' => 'loading', 'class' => 'btn btn-info fa fa-file-pdf-o', 'download' => "RUT-" . $aleatorio . ".pdf"));
                                    ?>
                                <br><br>
                                    <?php
                                    if (file_exists("../webroot/files/Asociaciones/cedulaRepresentante-" . $Asociation['Asociation']['id'] . ".pdf"))
                                        echo $this->Html->link('  Cédula', "../files/Asociaciones/cedulaRepresentante-" . $Asociation['Asociation']['id'] . ".pdf", array('target' => 'blank', 'indicator' => 'loading', 'class' => 'btn btn-info fa fa-file-pdf-o', 'download' => "CedulaRepresentante-" . $aleatorio . ".pdf"));
                                    ?>
                                <br><br>
                                    <?php
                                    if (file_exists("../webroot/files/Asociaciones/certificacion-" . $Asociation['Asociation']['id'] . ".pdf"))
                                        echo $this->Html->link('  Certificación', "../files/Asociaciones/certificacion-" . $Asociation['Asociation']['id'] . ".pdf", array('target' => 'blank', 'indicator' => 'loading', 'class' => 'btn btn-info fa fa-file-pdf-o', 'download' => "Certificacion-" . $aleatorio . ".pdf"));
                                    ?></td>

                            <td><?php
                                    if (file_exists("../webroot/files/Asociaciones/experiencia-" . $Asociation['Asociation']['id'] . ".pdf"))
                                        echo $this->Html->link('  Experiencia', "../files/Asociaciones/experiencia-" . $Asociation['Asociation']['id'] . ".pdf", array('target' => 'blank', 'indicator' => 'loading', 'class' => 'btn btn-info fa fa-file-pdf-o', 'download' => "Experiencia-" . $aleatorio . ".pdf"));
                                    ?>
                                <br><br>
                                    <?php
                                    if (file_exists("../webroot/files/Asociaciones/credencial-" . $Asociation['Asociation']['id'] . ".pdf"))
                                        echo $this->Html->link('  Credencial', "../files/Asociaciones/credencial-" . $Asociation['Asociation']['id'] . ".pdf", array('target' => 'blank', 'indicator' => 'loading', 'class' => 'btn btn-info fa fa-file-pdf-o', 'download' => "Credencial-" . $aleatorio . ".pdf"));
                                    ?>
                                <br><br>
                                    <?php
                                    if (file_exists("../webroot/files/Asociaciones/facultad_representante-" . $Asociation['Asociation']['id'] . ".pdf"))
                                        echo $this->Html->link('  Facultad_representante', "../files/Asociaciones/facultad_representante-" . $Asociation['Asociation']['id'] . ".pdf", array('target' => 'blank', 'indicator' => 'loading', 'class' => 'btn btn-info fa fa-file-pdf-o', 'download' => "Facultad_representante-" . $aleatorio . ".pdf"));
                                    ?>
                                <br><br>
                                    <?php
                                    if (file_exists("../webroot/files/Asociaciones/posesion-" . $Asociation['Asociation']['id'] . ".pdf"))
                                        echo $this->Html->link('  Posesión', "../files/Asociaciones/posesion-" . $Asociation['Asociation']['id'] . ".pdf", array('target' => 'blank', 'indicator' => 'loading', 'class' => 'btn btn-info fa fa-file-pdf-o', 'download' => "Posesion-" . $aleatorio . ".pdf"));
                                    ?>
                                <br><br>
                                    <?php
                                    if (file_exists("../webroot/files/Asociaciones/cdp-" . $Asociation['Asociation']['id'] . ".pdf"))
                                        echo $this->Html->link('  CDP', "../files/Asociaciones/cdp-" . $Asociation['Asociation']['id'] . ".pdf", array('target' => 'blank', 'indicator' => 'loading', 'class' => 'btn btn-info fa fa-file-pdf-o', 'download' => "CDP-" . $aleatorio . ".pdf"));
                                    ?>
                                <br><br>
                                    <?php
                                    if (file_exists("../webroot/files/Asociaciones/f28-" . $Asociation['Asociation']['id'] . ".pdf"))
                                        echo $this->Html->link('  F28', "../files/Asociaciones/f28-" . $Asociation['Asociation']['id'] . ".pdf", array('target' => 'blank', 'indicator' => 'loading', 'class' => 'btn btn-info fa fa-file-pdf-o', 'download' => "F28-" . $aleatorio . ".pdf"));
                                    ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?php if ($permitir) echo $this->Ajax->link("  Adicionar", array('controller' => 'Asociations', "action" => "add"), array('update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-success fa fa-plus-square-o')) ?>
            </div>
        </div>
    </div>
</div>