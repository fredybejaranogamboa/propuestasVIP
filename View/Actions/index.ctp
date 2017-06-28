<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Acciones
            </div>
            <div class="dataTable_wrapper">
                <?php echo $this->Ajax->link('  Adicionar', array('controller' => 'actions', 'action' => 'add'), array('update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-success fa fa-plus-square-o')); ?>
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Controlador</th>
                            <th colspan="2"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($actions as $action): ?>
                            <tr>
                                <td><?php echo $action['Action']['id']; ?></td>
                                <td><?php echo $action['Action']['name']; ?></td>
                                <td><?php echo $action['Entity']['name']; ?></td>
                                <td>
                                    <?php echo $this->Ajax->link(' Editar', array('controller' => 'actions', 'action' => 'edit', $action["Action"]["id"]), array('update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-success fa fa-pencil')); ?>
                                </td>
                                <td>
                                    <?php echo $this->Ajax->link(' Eliminar', array('controller' => 'actions', 'action' => 'delete', $action["Action"]["id"]), array('update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-danger fa fa-trash'), '¿Esta seguro de eliminar la acción?.'); ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?php echo $this->Ajax->link('  Adicionar', array('controller' => 'actions', 'action' => 'add'), array('update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-success fa fa-plus-square-o')); ?>
            </div>
        </div>
    </div>
</div>

