<div class="paging">
    <?php
    echo $this->Paginator->options(array('update' => '#content', 'evalScripts' => false));
    echo $this->Paginator->prev('< ' . __('Anterior'), array(), null, array('class' => 'prev disabled'));
    echo $this->Paginator->numbers(array('separator' => ''));
    echo $this->Paginator->next(__('Siguiente') . ' >', array(), null, array('class' => 'next disabled'));
    ?>
</div>
<table>
    <thead>
        <tr>
            <th><?php echo $this->Paginator->sort('Annotation.tipo_principal', 'Tipo'); ?></th>
            <th><?php echo $this->Paginator->sort('Annotation.anotacion', 'Anotación'); ?></th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($Annotations as $Annotation): ?>
            <tr>
                <td><?php echo $Annotation['Annotation']['tipo_principal']; ?></td>
                <td><?php echo $Annotation['Annotation']['anotacion']; ?></td>
                <td><?php echo $this->Ajax->link('Editar', array('controller' => 'Annotations', 'action' => 'edit', $Annotation["Annotation"]["id"], $property_id), array('update' => 'content', 'indicator' => 'loading', 'complete' => 'formularioAjax()', 'class' => 'acciones')); ?></td>
                <td><?php echo $this->Ajax->link('Eliminar', array('controller' => 'Annotations', 'action' => 'delete', $Annotation["Annotation"]["id"], $title_study_id, $property_id), array('update' => 'content', 'indicator' => 'loading', 'class' => 'acciones'), '¿Realmente desea borrar el registro?'); ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php echo $this->Js->writeBuffer(); ?>
<?php echo $this->Ajax->link('Adicionar', array('controller' => 'Annotations', 'action' => 'add', $title_study_id, $property_id), array('update' => 'content', 'indicator' => 'loading', 'class' => 'acciones', 'complete' => 'formularioAjax()')); ?>
<table width="100%" border="0"  CellSpacing=10  align="center" >
    <tbody>
        <tr>          
            <td><?php echo $this->Ajax->link($this->Html->image('regresar.gif', array('width' => '30', 'heigth' => '30', 'alt' => 'Regresar', 'title' => 'Regresar')), array('controller' => 'TitleStudies', 'action' => 'index', $property_id), array('update' => 'content', 'indicator' => 'loading', 'escape' => false)); ?></td>
        </tr>
    </tbody>
</table>