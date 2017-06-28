<?php echo $this->Ajax->link(
    'Registrar',
    array( 'controller' => "Users", "action" => "add", 1 ),
    array(  
        'update' => 'fff',
        'complete' => '$("#add1").modal("show")',
        'class' => 'btn btn-success fa fa-plus-square-o',
        'type' => 'synchronous'
    )
);
?>

<br><br>
<table class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th>Usuario</th>
            <th>Nombre</th>
            <th>Primer Apellido</th>
            <th>Datos</th>
            <th class="sorter-false" colspan="2"></th>
        </tr>
    </thead>
    <tfoot>
        <tr>

            <th>Usuario</th>
            <th>Nombre</th>
            <th>Primer Apellido</th>
            <th>Datos</th>
            <th colspan="2"></th>
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
        <?php foreach ($User as $usuario): ?>
        <tr>
            <td><?php echo $usuario['User']['username']; ?> </td>
            <td><?php echo $usuario['User']['nombre'] ?></td>
            <td><?php echo $usuario['User']['primer_apellido'] ?></td>
            <td style="font-size: small">
                <table border="0" style="width:50px">
                    <tr>
                        <td><?php echo $usuario['Branch']['nombre'] ?></td>
                    </tr>
                    <tr>
                        <td><?php echo substr($usuario['User']['email'], 0, 30) ?></td>
                    </tr>
                    <tr>
                        <td><?php echo $usuario['Group']['name'] ?></td>
                    </tr>
                </table>
            </td>
            <td><?php
                echo $this->Ajax->link("", array('controller' => "Users", "action" => "edit", $usuario['User']['id']), array('update' => 'content', 'class' => 'btn btn-success fa fa-pencil'));
                if (AuthComponent::User('group_id') == 1) {
                echo $this->Ajax->link('', array('controller' => 'Users', 'action' => 'delete', $usuario['User']['id']), array('update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-danger fa fa-trash'), '¿Desea eliminar el usuario?');
                }
                ?>
            </td>
            <td><?php echo $this->Ajax->link(" Asignados", array('controller' => "UserProyects", "action" => "index", $usuario['User']['id']), array('update' => 'content', 'class' => 'btn btn-success fa fa-desktop')) ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<br><br>


<?php echo $this->Ajax->link(
'Registrar',
array( 'controller' => "Users", "action" => "add", 1 ),
array(  
'update' => 'fff',
'complete' => '$("#add1").modal("show")',
'class' => 'btn btn-success fa fa-plus-square-o',
'type' => 'synchronous'
)
);
?>


<div class="modal fade" id="add1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

    <div class="modal-dialog" style="width: 60%">
        <div class="modal-content" >
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <div id="banner" align="center"><?php echo $this->Html->image('banderac.png', array('width'=>'400','height'=>'auto')) ?> </div>
            </div>


                <!-- -->

                    <div class="modal-body" id="fff">

                    </div>

                <!-- -->


        </div>
    </div>
</div>