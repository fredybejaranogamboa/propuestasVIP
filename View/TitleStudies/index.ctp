<table width="100%" border="0"  CellSpacing=10  align="center" >
    <tbody>
        <tr>          
            <td><?php echo $this->Ajax->link($this->Html->image('regresar.gif', array('width' => '30', 'heigth' => '30', 'alt' => 'Regresar', 'title' => 'Regresar')), array('controller' => 'Properties', 'action' => 'property_index', $property_id), array('update' => 'content', 'indicator' => 'loading', 'escape' => false)); ?></td>
        </tr>
    </tbody>
</table>
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
            <th><?php echo $this->Paginator->sort('TitleStudy.fecha', 'Fecha estudio de titulo'); ?></th>
            <th><?php echo $this->Paginator->sort('TitleStudy.titulo_tipo', 'Tipo de título'); ?></th>
            <th><?php echo $this->Paginator->sort('TitleStudy.titulo_fecha', 'Fecha título'); ?></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($TitleStudies as $TitleStudy): ?>
            <tr>
                <td><?php echo $TitleStudy['TitleStudy']['fecha']; ?></td>
                <td><?php echo $TitleStudy['TitleStudy']['titulo_tipo']; ?></td>
                <td><?php echo $TitleStudy['TitleStudy']['titulo_fecha']; ?></td>
                <td><?php echo $this->Ajax->link('Anotaciones', array('controller' => 'Annotations', 'action' => 'index', $TitleStudy["TitleStudy"]["id"], $property_id), array('update' => 'content', 'indicator' => 'loading', 'complete' => 'formularioAjax()', 'class' => 'acciones')); ?></td>
                <td><?php echo $this->Ajax->link('Concepto final', array('controller' => 'TitleStudies', 'action' => 'edit', $TitleStudy["TitleStudy"]["id"]), array('update' => 'content', 'indicator' => 'loading', 'complete' => 'formularioAjax()', 'class' => 'acciones')); ?></td>
                <td><?php if ($TitleStudy['TitleStudy']['calificacion'] == 'Suspendido') echo $this->Ajax->link('Documentos', array('controller' => 'TitleStudyDocuments', 'action' => 'index', $TitleStudy["TitleStudy"]["id"], $property_id), array('update' => 'content', 'indicator' => 'loading', 'complete' => 'formularioAjax()', 'class' => 'acciones')); ?></td>
                <td><?php echo $this->Ajax->link('Eliminar', array('controller' => 'TitleStudies', 'action' => 'delete', $TitleStudy["TitleStudy"]["id"], $property_id), array('update' => 'content', 'indicator' => 'loading', 'class' => 'acciones'), '¿Realmente desea borrar el registro?'); ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php echo $this->Js->writeBuffer(); ?>
<?php echo $this->Ajax->link('Adicionar', array('controller' => 'TitleStudies', 'action' => 'add', $property_id), array('update' => 'content', 'indicator' => 'loading', 'class' => 'acciones', 'complete' => 'formularioAjax()')); ?>
<table width="100%" border="0"  CellSpacing=10  align="center" >
    <tbody>
        <tr>          
            <td><?php echo $this->Ajax->link($this->Html->image('regresar.gif', array('width' => '30', 'heigth' => '30', 'alt' => 'Regresar', 'title' => 'Regresar')), array('controller' => 'Properties', 'action' => 'property_index', $property_id), array('update' => 'content', 'indicator' => 'loading', 'escape' => false)); ?></td>
        </tr>
    </tbody>
</table>