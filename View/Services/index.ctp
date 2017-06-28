<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Listado servicios
            </div>
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Tipo</th>
                        <th>Descripción</th>
                        <th>Valor</th>
                        <th class="sorter-false" colspan="2">Opciones</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Tipo</th>
                        <th>Descripción</th>
                        <th>Valor</th>
                        <th colspan="2">Opciones</th>
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
                    <?php foreach ($Services as $Service):?>
                        <tr>
                            <td><?php echo $Service['Service']['tipo'] ?></td>
                            <td><?php echo $Service['Service']['descripcion'] ?></td>
                            <td><?php echo $Service['Service']['valor'] ?></td>
                            <td><?php echo $this->Ajax->link(' Editar', array('controller' => 'Services', 'action' => 'edit', $Service["Service"]["id"]), array('update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-success fa fa-plus-square-o')); ?></td>
                            <td><?php echo $this->Ajax->link(' Eliminar', array('controller' => 'Services', 'action' => 'delete', $Service["Service"]["id"], $property_id), array('update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-danger fa fa-trash'), '¿Desea eliminar el registro?'); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <br>
            <?php echo $this->Ajax->link(' Adicionar_Servicio', array('controller' => 'Services', 'action' => 'add', $property_id), array('update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-success fa fa-plus-square-o')); ?>
        </div>
    </div> 
</div>
