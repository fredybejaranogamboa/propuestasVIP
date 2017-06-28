<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Acciones
            </div>
            <div class="dataTable_wrapper">
                <table  class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>NOMBRE</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <?php foreach ($group as $usuario): ?>
                        <tbody>
                            <tr>
                                <td><?php echo $usuario['Group']['id'] ?></td>
                                <td><?php echo $usuario['Group']['name'] ?></td>
                                <td><?php echo $this->Ajax->link(" Editar", array('controller' => 'Groups', "action" => "edit", $usuario['Group']['id']), array('update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-success fa fa-pencil')) ?></td>
                                <td><?php echo $this->Ajax->link(" Asignar menus", array('controller' => 'GroupsItems', "action" => "edit", $usuario['Group']['id']), array('update' => 'content', 'class' => 'btn btn-success fa fa-sitemap')) ?></td>
                                <td><?php echo $this->Ajax->link(" Asignar acciones", array('controller' => 'ActionsGroups', "action" => "edit", $usuario['Group']['id']), array('update' => 'content', 'class' => 'btn btn-success fa fa-bars')) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?php echo $this->Ajax->link(" Agregar grupo", array("controller" => "Groups", "action" => "add"), array('update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-success fa fa-plus-square-o')) ?>
            </div>
        </div>
    </div>
</div>