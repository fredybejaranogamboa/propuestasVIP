<?php echo $this->Ajax->link('Adicionar', array('controller' => 'Branches', 'action' => 'add'), array('update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-success fa fa-plus-square-o')); ?>
<table class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Código</th>
            <th>Director</th>
            <th>Dirección</th>
            <th>Telefono</th>
            <th class="sorter-false" colspan="3"></th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th>Nombre</th>
            <th>Código</th>
            <th>Director</th>
            <th>Dirección</th>
            <th>Telefono</th>
            <th colspan="3"></th>
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
        <?php foreach ($Branches as $Branch): ?>
            <tr>
                <td><?php echo $Branch['Branch']['nombre']; ?></td>
                <td><?php echo $Branch['Branch']['codigo']; ?></td>
                <td><?php echo $Branch['Branch']['director']; ?></td>
                <td><?php echo $Branch['Branch']['direccion']; ?></td>
                <td><?php echo $Branch['Branch']['telefono']; ?></td>
                <td><?php echo $this->Ajax->link(' Editar', array('controller' => 'Branches', 'action' => 'edit', $Branch["Branch"]["id"]), array('update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-success fa fa-pencil')); ?></td>
                <td><?php echo $this->Ajax->link(' Usuarios', array('controller' => 'BranchUsers', 'action' => 'index', $Branch["Branch"]["id"]), array('update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-success fa fa-envelope-o')); ?></td>
                <td><?php echo $this->Ajax->link(' Eliminar', array('controller' => 'Branches', 'action' => 'delete', $Branch["Branch"]["id"]), array('update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-danger fa fa-trash'), '¿Desea eliminar la territorial?'); ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php echo $this->Ajax->link('Adicionar', array('controller' => 'Branches', 'action' => 'add'), array('update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-success fa fa-plus-square-o')); ?>
