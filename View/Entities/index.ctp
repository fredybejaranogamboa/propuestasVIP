<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Controladores
            </div>
            <div class="dataTable_wrapper">
                <?php echo $this->Ajax->link('  Adicionar', array('controller' => 'entities', 'action' => 'add'), array('update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-success fa fa-plus-square-o')); ?>
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th colspan="2"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($entities as $entity): ?>
                            <tr>
                                <td><?php echo $entity['Entity']['id']; ?></td>
                                <td><?php echo $entity['Entity']['name']; ?></td>
                                <td>
                                    <?php echo $this->Ajax->link(' Editar', array('controller' => 'entities', 'action' => 'edit', $entity["Entity"]["id"]), array('update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-success fa fa-pencil')); ?>
                                </td>
                                <td>
                                    <?php echo $this->Ajax->link(' Eliminar', array('controller' => 'entities', 'action' => 'delete', $entity["Entity"]["id"]), array('update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-danger fa fa-trash'), '¿Esta seguro de eliminar el controlador?. Esto evitará que los usuarios puedan ingresar a todas las acciones del objeto'); ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?php echo $this->Ajax->link('  Adicionar', array('controller' => 'entities', 'action' => 'add'), array('update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-success fa fa-plus-square-o')); ?>
            </div>
        </div>
    </div>
</div>

