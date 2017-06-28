<script>
    $(function () {
        $("#myTable").tablesorter();
    });
</script>
<br> 
<?php 
App::Import('model', 'Beneficiary');
$ben = new Beneficiary();
echo $this->Ajax->link('  Nueva Propuesta', array('controller' => 'Proyects', 'action' => 'add'), array('update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-success fa fa-plus-square-o')); ?>
<?php echo $this->Ajax->link('  Nueva Asociación', array('controller' => 'Asociations', "action" => "add"), array('update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-success fa fa-plus-square-o')) ?>
<br>
<br>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Listado proyectos
            </div>
            <div class="dataTable_wrapper">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No Radicado</th>
                            <th class="convocatoria filter-select">Año</th>
                            <th>Asociación</th>
                            <th>Nombre del proyecto</th>
                            <th>Valor solicitado</th>
                            <th>Líneas productivas</th>
                            <th>Número de beneficiarios</th>
                            <th>Estado</th>
                            <th class="sorter-false" colspan="1"></th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No Radicado</th>
                            <th>Año</th>
                            <th>Asociación</th>
                            <th>Nombre del proyecto</th>
                            <th>Valor solicitado</th>
                            <th>Líneas productivas</th>
                            <th>Número de beneficiarios</th>
                            <th>Estado</th>
                            <th colspan="1"></th>
                        </tr>
                        <tr>
                            <th colspan="9" class="ts-pager form-horizontal">
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
                        <?php foreach ($Proyects as $Proyect): ?>
                        <tr>
                            <td><?php echo $this->Ajax->link($Proyect['Proyect']['codigo'], array('controller' => 'Proyects', 'action' => 'select_proyect2', $Proyect["Proyect"]["id"]), array('update' => 'current', 'indicator' => 'loading')); ?></td>
                            <td><?php echo $Proyect['Call']['nombre']; ?></td>
                            <td><?php echo $Proyect['Asociation']['nit'] . " ". $Proyect['Asociation']['nombre']; ?></td>
                            <td><?php echo $Proyect['Proyect']['nombre']; ?></td>
                            <td><?php echo "$ ". number_format($Proyect['Proyect']['valor_solicitado'], 2, ',', '.'); ?></td>
                            <td>
                                <?php echo $this->Ajax->link(' Líneas', array('controller' => 'PlineProyects', 'action' => 'index', $Proyect["Proyect"]["id"]), array('update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-success fa fa-pagelines')); ?><br>
                                <?php echo $this->Ajax->link(' Productos', array('controller' => 'ProductProyects', 'action' => 'index', $Proyect["Proyect"]["id"]), array('update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-success fa fa-shopping-cart')); ?><br>
                                <?php echo $this->Ajax->link(' COMPONENTE TÉCNICO', array('controller' => 'Proyects', 'action' => 'componente_tecnico', $Proyect["Proyect"]["id"]), array('update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-success fa fa-wrench')); ?><br>
                                <?php echo $this->Ajax->link(' CONDICIONES BIOFISICAS', array('controller' => 'Proyects', 'action' => 'condiciones_biofisicas', $Proyect["Proyect"]["id"]), array('update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-success fa fa-leaf')); ?>
                                <?php echo $this->Ajax->link(' COMPONENTE COMERCIAL', array('controller' => 'Proyects', 'action' => 'componente_comercial', $Proyect["Proyect"]["id"]), array('update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-success fa fa-money')); ?>
                                <?php echo $this->Ajax->link(' COMPONENTE AMBIENTAL', array('controller' => 'Proyects', 'action' => 'componente_ambiental', $Proyect["Proyect"]["id"]), array('update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-success fa fa-recycle')); ?>
                                <?php echo $this->Ajax->link(' INDICADORES ORGANIZACIÓN', array('controller' => 'Proyects', 'action' => 'indicadores_organizacion', $Proyect["Proyect"]["id"]), array('update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-success fa fa-line-chart')); ?>
                            </td>
                            <td><?php echo $ben->find('count', array('conditions' => array('Beneficiary.proyect_id' => $Proyect['Proyect']['id']))); ?></td>
                            <td><?php echo $Proyect['Proyect']['estado']; ?></td>
                            <td>
                            <?php echo $this->Ajax->link('', array('controller' => 'Proyects', 'action' => 'edit', $Proyect["Proyect"]["id"]), array('update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-success fa fa-pencil')); ?>
                                <br/>
                            <?php echo $this->Ajax->link('', array('controller' => 'Proyects', 'action' => 'view', $Proyect["Proyect"]["id"]), array('update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-success fa fa-eye')); ?>
                                <br/>
                            <?php echo $this->Ajax->link('Municipios', array('controller' => 'CityProyects', 'action' => 'index', $Proyect["Proyect"]["id"]), array('update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-success')); ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?php echo $this->Ajax->link('  Adicionar Propuesta', array('controller' => 'Proyects', 'action' => 'add'), array('update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-success fa fa-plus-square-o')); ?>
            </div>
        </div>
    </div>
</div>