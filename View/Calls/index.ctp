<table class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th class="sorter-false" colspan="2"></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($Calls as $Call): ?>
            <tr>
                <td><?php echo $Call['Call']['id']; ?></td>
                <td><?php echo $Call['Call']['nombre']; ?></td>
                <td><?php echo $this->Ajax->link('Editar', array('controller' => 'Calls', 'action' => 'edit', $Call["Call"]["id"]), array('update' => 'content', 'class' => 'btn btn-success fa fa-pencil')); ?></td>
                <td><?php //echo $this->Ajax->link('Requisitos minimos', array('controller' => 'initialRequirements', 'action' => 'index', $Call["Call"]["id"]), array('update' => 'content', 'class' => 'btn btn-success fa fa-desktop')); ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php echo $this->Ajax->link('Adicionar', array('controller' => 'Calls', 'action' => 'add'), array('update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-success fa fa-plus-square-o')); ?>