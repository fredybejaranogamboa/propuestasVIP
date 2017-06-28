<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Listado Observaciones
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
                            <th><?php echo $this->Paginator->sort('Observation.id', 'Id'); ?></th>
                            <th><?php echo $this->Paginator->sort('Observation.fecha', 'Fecha'); ?></th>
                            <th>Usuario</th>
                            <th>Observación</th>
                            <th colspan="2"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($Observations as $Observation): ?>
                        <tr>
                            <td><?php echo $Observation['Observation']['id']; ?></td>
                            <td><?php echo $Observation['Observation']['fecha']; ?></td>
                            <td><?php echo $Observation['User']['nombre'], " " , $Observation['User']['primer_apellido']; ?></td>
                            <td><?php echo $Observation['Observation']['observacion'] ?></td>
                            <td><?php if(AuthComponent::User('group_id')==1) echo $this->Ajax->link(' Eliminar', array('controller' => 'Observations', 'action' => 'delete', $Observation["Observation"]["id"], $Observation["Observation"]["evaluation_id"]), array('update' => 'content', 'indicator' => 'loading','class'=>'btn btn-danger fa fa-trash'), '¿Desea eliminar la verificación?'); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <?php echo $this->Js->writeBuffer(); ?>

                <?php echo $this->Ajax->link("  Adicionar", array('controller' => 'Observations', "action" => "add", $evaluation_id), array('update' => 'content', 'indicator' => 'loading','class'=>'btn btn-success fa fa-plus-square-o')) ?>
            </div>
        </div>
    </div>
</div>


