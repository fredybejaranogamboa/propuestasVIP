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
            <th><?php echo $this->Paginator->sort('TitleStudyDocument.tipo', 'Tipo'); ?></th>
            <th><?php echo $this->Paginator->sort('TitleStudyDocument.numero', 'Número'); ?></th>
            <th><?php echo $this->Paginator->sort('TitleStudyDocument.fecha', 'Fecha'); ?></th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($TitleStudyDocuments as $TitleStudyDocument): ?>
            <tr>
                <td><?php echo $TitleStudyDocument['TitleStudyDocument']['tipo']; ?></td>
                <td><?php echo $TitleStudyDocument['TitleStudyDocument']['numero']; ?></td>
                <td><?php echo $TitleStudyDocument['TitleStudyDocument']['fecha']; ?></td>
                <td><?php echo $this->Ajax->link('Editar', array('controller' => 'TitleStudyDocuments', 'action' => 'edit', $TitleStudyDocument["TitleStudyDocument"]["id"], $property_id), array('update' => 'content', 'indicator' => 'loading', 'complete' => 'formularioAjax()', 'class' => 'acciones')); ?></td>
                <td><?php echo $this->Ajax->link('Eliminar', array('controller' => 'TitleStudyDocuments', 'action' => 'delete', $TitleStudyDocument["TitleStudyDocument"]["id"], $title_study_id, $property_id), array('update' => 'content', 'indicator' => 'loading', 'class' => 'acciones'), '¿Realmente desea borrar el registro?'); ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php echo $this->Js->writeBuffer(); ?>
<?php echo $this->Ajax->link('Adicionar', array('controller' => 'TitleStudyDocuments', 'action' => 'add', $title_study_id, $property_id), array('update' => 'content', 'indicator' => 'loading', 'class' => 'acciones', 'complete' => 'formularioAjax()')); ?>
<table width="100%" border="0"  CellSpacing=10  align="center" >
    <tbody>
        <tr>          
            <td><?php echo $this->Ajax->link($this->Html->image('regresar.gif', array('width' => '30', 'heigth' => '30', 'alt' => 'Regresar', 'title' => 'Regresar')), array('controller' => 'TitleStudies', 'action' => 'index', $property_id), array('update' => 'content', 'indicator' => 'loading', 'escape' => false)); ?></td>
        </tr>
    </tbody>
</table>