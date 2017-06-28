<script>

    $(document).ready(function() {
        $( "#calendario" ).datepicker();
        jQuery("#frm").validate({
            
        });
    })

</script>
<table width="100%" border="0"  CellSpacing=10  align="center" >
    <tbody>
        <tr>          
            <td><?php echo $this->Ajax->link($this->Html->image('regresar.gif', array('width' => '30', 'heigth' => '30', 'alt' => 'Regresar', 'title' => 'Regresar')), array('controller' => 'TitleStudyDocuments', 'action' => 'index', $title_study_id, $property_id), array('update' => 'content', 'indicator' => 'loading', 'escape' => false)); ?></td>
        </tr>
    </tbody>
</table>
<fieldset >
    <?php echo $this->Form->create("TitleStudyDocument", array('id' => 'formulario', "action" => "add/" . $title_study_id . "/" . $property_id)); ?>
    <legend>Edición de Estudio de título</legend>
    <?php echo $this->Form->hidden('TitleStudyDocument.title_study_id', array('value' => $title_study_id, 'type' => 'text')); ?>

    <?php echo $this->Form->input('TitleStudyDocument.tipo', array('label' => 'Tipo', 'empty' => '', 'options' => array('Escritura' => 'Escritura publica', 'Resolucion' => 'Resolución', 'Sentencia' => 'Sentencia', 'Certificado de tradición' => 'Certificado de tradición'))); ?>
    <?php echo $this->Form->input('TitleStudyDocument.numero', array('label' => 'Número')); ?>
    <?php echo $this->Form->input('TitleStudyDocument.fecha', array('label' => 'Fecha expedición', 'class' => 'calendario', 'type' => 'text')); ?>
    <?php echo $this->Form->input('TitleStudyDocument.entidad_expide', array('label' => 'Entidad que expide el documento')); ?>

    <?php echo $this->Form->end("Guardar") ?>
</fieldset>
<table width="100%" border="0"  CellSpacing=10  align="center" >
    <tbody>
        <tr>          
            <td><?php echo $this->Ajax->link($this->Html->image('regresar.gif', array('width' => '30', 'heigth' => '30', 'alt' => 'Regresar', 'title' => 'Regresar')), array('controller' => 'TitleStudyDocuments', 'action' => 'index', $title_study_id, $property_id), array('update' => 'content', 'indicator' => 'loading', 'escape' => false)); ?></td>
        </tr>
    </tbody>
</table>