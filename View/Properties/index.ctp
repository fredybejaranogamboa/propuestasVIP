<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Listado Predios
            </div>
            <div class="dataTable_wrapper">
                <?php if ($permitir) echo $this->Ajax->link('  Adicionar', array('controller' => 'Properties', 'action' => 'add_property'), array('update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-success fa fa-plus-square-o')); ?>
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Municipio</th>
                            <th>Matrícula</th>
                            <th>Extensión (ha)</th>
                            <th class="sorter-false"></th>
                            <th class="sorter-false"></th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Nombre</th>
                            <th>Municipio</th>
                            <th>Matrícula</th>
                            <th>Extensión (ha)</th>
                            <th></th>
                            <th></th>
                        </tr>
                        <tr>
                            <th colspan="6" class="ts-pager form-horizontal">
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
                        <?php foreach ($Properties as $Property): ?>
                            <tr>
                                <td><?php echo $Property['Property']['nombre']; ?></td>
                                <td><?php echo $Property['City']['name'] . " (" . $Property['Departament']['name'] . ") "; ?></td>
                                <td><?php echo $Property['Property']['oficina_matricula'] . "-" . $Property['Property']['numero_matricula']; ?></td>
                                <td><?php echo $Property['Property']['area_total_ha'] . " Ha " . $Property['Property']['area_total_m'] . " mt2"; ?></td>
                                <td>
                                    <?php if ($permitir)
                                        echo $this->Ajax->link(' Editar', array('controller' => 'Properties', 'action' => 'edit_property', $Property["Property"]["id"]), array('update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-success fa fa-pencil'));
                                    ?>
                                    <br>
                                    <?php echo $this->Ajax->link(' Ver', array('controller' => 'Properties', 'action' => 'view', $Property["Property"]["id"]), array('update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-success fa fa-eye')); ?>
                                    <br>
    <?php echo $this->Ajax->link('Puntos_geográficos', array('controller' => 'Points', 'action' => 'index', $Property["Property"]["id"]), array('update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-success')); ?>
                                    <br>
    <?php echo $this->Ajax->link('Servicios', array('controller' => 'Services', 'action' => 'index', $Property["Property"]["id"]), array('update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-success')); ?>
                                </td>
                                <td>
                                    <?php if ($permitir) echo $this->Ajax->link(' Adjuntar_Archivos', array('controller' => 'Properties', 'action' => 'upload_files', $Property["Property"]["id"]), array('update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-success fa fa-file-pdf-o')); ?>
                                    <br>
                                    <?php echo $this->Ajax->link(' Ver adjuntos', array('controller' => 'Properties', 'action' => 'view_files', $Property["Property"]["id"]), array('update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-success fa fa-file-pdf-o')); ?>
                                    <br>
                                    <?php if ($permitir) echo $this->Ajax->link(' Eliminar', array('controller' => 'Properties', 'action' => 'delete', $Property["Property"]["id"]), array('update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-danger fa fa-trash'), '¿Esta seguro de eliminar el predio?'); ?>
    <?php //echo $this->Ajax->link('Estudio titulos', array('controller' => 'title_studies', 'action' => 'index', $Property["Property"]["id"]), array('update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-success'));  ?>
                                </td>
                            </tr>
<?php endforeach; ?>
                    </tbody>
                </table>
<?php if ($permitir) echo $this->Ajax->link('  Adicionar', array('controller' => 'Properties', 'action' => 'add_property'), array('update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-success fa fa-plus-square-o')); ?>
            </div>
        </div>
    </div>
</div>