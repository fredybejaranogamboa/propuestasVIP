<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Listado Beneficiarios
            </div>
            <div class="dataTable_wrapper">
                <?php if ($permitir) echo $this->Ajax->link(" Agregar Beneficiario ", array('controller' => 'Beneficiaries', "action" => "add", $proyect_id, 0), array('update' => 'content', 'class' => 'btn btn-success fa fa-plus-square-o', 'indicator' => 'loading')) ?>
                <br>
                <h3>Beneficiarios del proyecto <?php echo $proyecto['Proyect']['codigo'] ?></h3>
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Documento Identidad</th>
                            <th>Nombres</th>
                            <th>Primer Apellido</th>
                            <th>Segundo Apellido</th>
                            <th class="convocatoria filter-select">Tipo</th>
                            <th class="sorter-false" colspan="3">Opciones</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Documento Identidad</th>
                            <th>Nombres</th>
                            <th>Primer Apellido</th>
                            <th>Segundo Apellido</th>
                            <th class="convocatoria filter-select">Tipo</th>
                            <th class="sorter-false" colspan="3">Opciones</th>
                        </tr>
                        <tr>
                            <th colspan="8" class="ts-pager form-horizontal">
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
                        <?php foreach ($beneficiaries as $ben): ?>
                            <tr>
                                <td><?php echo $ben['Beneficiary']['numero_identificacion'] ?></td>
                                <td><?php echo $ben['Beneficiary']['nombres'] ?></td>
                                <td><?php echo $ben['Beneficiary']['primer_apellido'] ?></td>
                                <td><?php echo $ben['Beneficiary']['segundo_apellido'] ?></td>
                                <td><?php echo $ben['Beneficiary']['tipo'] ?></td>
                                <td>
                                    <?php
                                    if (file_exists("../webroot/files/Beneficiarios/documento_identidad-" . $ben['Beneficiary']['id'] . ".pdf")) {
                                        $archivo = ".." . DS . "webroot" . DS . "files" . DS . "Beneficiarios" . DS . "documento_identidad-" . $ben['Beneficiary']['id'] . ".pdf";
                                        echo $this->Html->link(' Documento_identidad', "../files/Beneficiarios/documento_identidad-" . $ben['Beneficiary']['id'] . ".pdf", array('target' => 'blank', 'indicator' => 'loading', 'class' => 'btn btn-info fa fa-file-pdf-o', 'download' => "Documento_identidad-" . $aleatorio . ".pdf"));
                                        if ($admin) {
                                            echo $this->Ajax->link(" Eliminar", array('controller' => 'Beneficiaries', "action" => "delete_file", 1, $ben['Beneficiary']['id']), array('update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-danger fa fa-trash'), '¿Seguro de borrar el archivo?');
                                        }
                                    }
                                    ?>
                                    <br>
                                    <?php
                                    if (file_exists("../webroot/files/Beneficiarios/policia-" . $ben['Beneficiary']['id'] . ".pdf")) {
                                        echo $this->Html->link(' Certificado_policía', "../files/Beneficiarios/policia-" . $ben['Beneficiary']['id'] . ".pdf", array('target' => 'blank', 'indicator' => 'loading', 'class' => 'btn btn-info fa fa-file-pdf-o', 'download' => "Certificado_policia-" . $aleatorio . ".pdf"));
                                        if ($admin) {
                                            echo $this->Ajax->link(" Eliminar", array('controller' => 'Beneficiaries', "action" => "delete_file", 2, $ben['Beneficiary']['id']), array('update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-danger fa fa-trash'), '¿Seguro de borrar el archivo?');
                                        }
                                    }
                                    ?>
                                    <br>
                                    <?php
                                    if (file_exists("../webroot/files/Beneficiarios/contraloria-" . $ben['Beneficiary']['id'] . ".pdf")) {
                                        echo $this->Html->link(' Certificado_contraloría', "../files/Beneficiarios/contraloria-" . $ben['Beneficiary']['id'] . ".pdf", array('target' => 'blank', 'indicator' => 'loading', 'class' => 'btn btn-info fa fa-file-pdf-o', 'download' => "Certificado_contraloria-" . $aleatorio . ".pdf"));
                                        if ($admin) {
                                            echo $this->Ajax->link(" Eliminar", array('controller' => 'Beneficiaries', "action" => "delete_file", 3, $ben['Beneficiary']['id']), array('update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-danger fa fa-trash'), '¿Seguro de borrar el archivo?');
                                        }
                                    }
                                    ?>
                                    <br>
                                    <?php
                                    if (file_exists("../webroot/files/Beneficiarios/procuraduria-" . $ben['Beneficiary']['id'] . ".pdf")) {
                                        echo $this->Html->link(' Certificado_procuraduría', "../files/Beneficiarios/procuraduria-" . $ben['Beneficiary']['id'] . ".pdf", array('target' => 'blank', 'indicator' => 'loading', 'class' => 'btn btn-info fa fa-file-pdf-o', 'download' => "Certificado_procuraduria-" . $aleatorio . ".pdf"));
                                        if ($admin) {
                                            echo $this->Ajax->link(" Eliminar", array('controller' => 'Beneficiaries', "action" => "delete_file", 4, $ben['Beneficiary']['id']), array('update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-danger fa fa-trash'), '¿Seguro de borrar el archivo?');
                                        }
                                    }
                                    ?>
                                    <br>
                                    <?php
                                    if (file_exists("../webroot/files/Beneficiarios/sisben-" . $ben['Beneficiary']['id'] . ".pdf")) {
                                        echo $this->Html->link(' SISBEN', "../files/Beneficiarios/sisben-" . $ben['Beneficiary']['id'] . ".pdf", array('target' => 'blank', 'indicator' => 'loading', 'class' => 'btn btn-info fa fa-file-pdf-o', 'download' => "SISBEN-" . $aleatorio . ".pdf"));
                                        if ($admin) {
                                            echo $this->Ajax->link(" Eliminar", array('controller' => 'Beneficiaries', "action" => "delete_file", 5, $ben['Beneficiary']['id']), array('update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-danger fa fa-trash'), '¿Seguro de borrar el archivo?');
                                        }
                                    }
                                    ?>
                                    <br>
                                    <?php
                                    if (file_exists("../webroot/files/Beneficiarios/f26-" . $ben['Beneficiary']['id'] . ".pdf")) {
                                        echo $this->Html->link(' F26 / F1', "../files/Beneficiarios/f26-" . $ben['Beneficiary']['id'] . ".pdf", array('target' => 'blank', 'indicator' => 'loading', 'class' => 'btn btn-info fa fa-file-pdf-o', 'download' => "F26_F1-" . $aleatorio . ".pdf"));
                                        if ($admin) {
                                            echo $this->Ajax->link(" Eliminar", array('controller' => 'Beneficiaries', "action" => "delete_file", 6, $ben['Beneficiary']['id']), array('update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-danger fa fa-trash'), '¿Seguro de borrar el archivo?');
                                        }
                                    }
                                    ?>
                                </td>
                                <td>
                                    <br>
                                    <?php
                                    if ($permitir) {
                                        $par_con = 1;
                                    } else {
                                        $par_con = 0;
                                    }
                                    echo $this->Ajax->link("Conyugue", array('controller' => 'Families', "action" => "index", $ben['Beneficiary']['id'], $proyect_id, $par_con), array('update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-success'))
                                    ?>
                                    <br>
                                    <?php echo $this->Ajax->link(" Editar", array('controller' => 'Beneficiaries', "action" => "edit", $ben['Beneficiary']['id'], 0, 0), array('update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-success fa fa-pencil')) ?>
                                    <br>
                                    <?php echo $this->Ajax->link(" Ver", array('controller' => 'Beneficiaries', "action" => "view", $ben['Beneficiary']['id'], $proyect_id), array('update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-success fa fa-eye')) ?>
                                    <br>
                                    <?php if ($permitir) echo $this->Ajax->link(" Eliminar", array('controller' => 'Beneficiaries', "action" => "delete", $ben['Beneficiary']['id'], $proyect_id, 0), array('update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-danger fa fa-trash'), 'Tambien se borrará el conyugue.') ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<br>
<?php if ($permitir) echo $this->Ajax->link(" Agregar Beneficiario ", array('controller' => 'Beneficiaries', "action" => "add", $proyect_id, 0), array('update' => 'content', 'class' => 'btn btn-success fa fa-plus-square-o', 'indicator' => 'loading')) ?>