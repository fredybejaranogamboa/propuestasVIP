<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Listado Revisiones
            </div>

            <div class="dataTable_wrapper">
                <div class="paging">
                    <?php
                    echo $this->Paginator->options(array('update' => '#content', 'evalScripts' => false));
                    echo $this->Paginator->prev('< ' . __('Anterior'), array(), null, array('class' => 'prev disabled'));
                    echo $this->Paginator->numbers(array('separator' => ''));
                    echo $this->Paginator->next(__('Siguiente') . ' >', array(), null, array('class' => 'next disabled'));
                    ?>
                </div>
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th><?php echo $this->Paginator->sort('Revision.id', 'Id'); ?></th>
                            <th><?php echo $this->Paginator->sort('Revision.fecha', 'Fecha'); ?></th>
                            <th><?php echo $this->Paginator->sort('Revision.calificacion', 'Calificación'); ?></th>
                            <th>Usuario</th>
                            <th colspan="2"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($Revisions as $Revision): ?>
                        <tr>
                            <td><?php echo $Revision['Revision']['id']; ?></td>
                            <td><?php echo $Revision['Revision']['fecha']; ?></td>
                            <td><?php echo $Revision['Revision']['calificacion']; ?></td>
                            <td><?php echo $Revision['User']['nombre'], " " , $Revision['User']['primer_apellido']; ?></td>
                            <td><?php echo $this->Ajax->link(' Editar', array('controller' => 'Revisions', 'action' => 'edit', $Revision["Revision"]["id"]), array('update' => 'content', 'indicator' => 'loading','class'=>'btn btn-success fa fa-pencil')); ?></td>
                            <td><?php echo $this->Ajax->link(' Eliminar', array('controller' => 'Revisions', 'action' => 'delete', $Revision["Revision"]["id"], $Revision["Revision"]["evaluation_id"]), array('update' => 'content', 'indicator' => 'loading','class'=>'btn btn-danger fa fa-trash'), '¿Desea eliminar la verificación?'); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?php echo $this->Js->writeBuffer(); ?>
                <?php echo $this->Ajax->link("  Adicionar", array('controller' => 'Revisions', "action" => "add", $evaluation_id), array('update' => 'content', 'indicator' => 'loading','class'=>'btn btn-success fa fa-plus-square-o')) ?>
            </div>
        </div>
    </div>
</div>