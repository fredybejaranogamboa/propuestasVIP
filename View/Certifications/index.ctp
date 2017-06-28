<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Listado Certificaciones estándar
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
                            <th><?php echo $this->Paginator->sort('Certification.id', 'Id'); ?></th>
                            <th><?php echo $this->Paginator->sort('Certification.valor', 'Valor'); ?></th>
                            <th><?php echo $this->Paginator->sort('Certification.poblacion', 'Población'); ?></th>
                            <th>Usuario</th>
                            <th colspan="2"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($Certifications as $Certification): ?>
                            <tr>
                                <td><?php echo $Certification['Certification']['id']; ?></td>
                                <td><?php echo "$ " . number_format($Certification['Certification']['valor'], 2, ",", "."); ?></td>
                                <td><?php echo $Certification['Certification']['poblacion']; ?></td>
                                <td><?php echo $Certification['User']['nombre'], " ", $Certification['User']['primer_apellido']; ?></td>
                                <td>
                                    <?php echo $this->Ajax->link(' Editar', array('controller' => 'Certifications', 'action' => 'edit', $Certification["Certification"]["id"]), array('update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-success fa fa-pencil')); ?>
                                    <?php echo $this->Html->link(' Imprimir', array('controller' => 'Certifications', 'action' => 'pdf', $Certification["Certification"]["id"]), array('target' => 'blank', 'class' => 'btn btn-success fa fa-print')); ?>
                                </td>
                                <td><?php echo $this->Ajax->link(' Eliminar', array('controller' => 'Certifications', 'action' => 'delete', $Certification["Certification"]["id"], $Certification["Certification"]["payment_id"]), array('update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-danger fa fa-trash'), '¿Desea eliminar la certificación?'); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <?php echo $this->Js->writeBuffer(); ?>

                <?php echo $this->Ajax->link("  Adicionar", array('controller' => 'Certifications', "action" => "add", $payment_id), array('update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-success fa fa-plus-square-o')) ?>
            </div>
        </div>
    </div>
</div>


