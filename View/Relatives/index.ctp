<h1>Familiares de <?php echo $aspirante['Candidate']['primer_nombre']." ".$aspirante['Candidate']['primer_apellido'] ?></h1>

<div class="paging">
<?php
echo $this->Paginator->options(array('update' => '#content','evalScripts' => false));
echo $this->Paginator->prev('< ' . __('Anterior'), array(), null, array('class' => 'prev disabled'));
echo $this->Paginator->numbers(array('separator' => ''));
echo $this->Paginator->next(__('Siguiente') . ' >', array(), null, array('class' => 'next disabled'));
?>
</div>
<table>
    <thead>
        <tr>
            <th><?php echo $this->Paginator->sort('Relative.primer_nombre', 'Primer nombre'); ?></th>
            <th><?php echo $this->Paginator->sort('Relative.primer_apelllido', 'Primer apellido'); ?></th>
            <th><?php echo $this->Paginator->sort('Relative.segundo_apellido', 'Segundo apellido'); ?></th>
            <th><?php echo $this->Paginator->sort('Relative.parentesco', 'Parentesco'); ?></th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
<?php foreach ($Relatives as $Relative): ?>
            <tr>
                <td><?php echo $Relative['Relative']['primer_nombre']; ?></td>
                <td><?php echo $Relative['Relative']['primer_apelllido']; ?></td>
                <td><?php echo $Relative['Relative']['segundo_apellido']; ?></td>
                <td><?php echo $Relative['Relative']['parentesco']; ?></td>
                <td><?php echo $this->Ajax->link('Editar', array('controller' => 'Relatives', 'action' => 'edit', $Relative["Relative"]["id"]), array('update' => 'content', 'indicator' => 'loading','complete'=>'formularioAjax()')); ?></td>
                <td><?php echo $this->Ajax->link('Eliminar', array('controller' => 'Relatives', 'action' => 'delete',$Relative["Relative"]["id"], $Relative['Relative']['candidate_id']), array('update' => 'content', 'indicator' => 'loading'),'¿Realmente desea borrar el registro?'); ?></td>
            </tr>
<?php endforeach; ?>
    </tbody>
</table>
<?php echo $this->Js->writeBuffer(); ?>
<?php echo $this->Ajax->link('Adicionar', array('controller' => 'Relatives', 'action' => 'add',$candidate_id), array('update' => 'content', 'indicator' => 'loading','complete'=>'formularioAjax()')); ?>
    <table width="100%" border="0"  CellSpacing=10  align="center" >
        <tbody>
            <tr>          
                <td><?php echo $this->Ajax->link($this->Html->image('regresar.gif', array('width' => '30', 'heigth' => '30', 'alt' => 'Regresar', 'title' => 'Regresar')), array('controller' => 'Candidates', 'action' => 'index', $candidate_id), array('update' => 'content', 'indicator' => 'loading', 'escape' => false)); ?></td>
            </tr>
        </tbody>
    </table>