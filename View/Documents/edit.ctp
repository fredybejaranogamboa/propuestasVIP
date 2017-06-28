<script>
    $(document).ready(function () {
        $("#form").validate({
            rules: {
                'data[Document][comentario]': {
                    required: true
                }
            }
        });
    });
</script>
<fieldset>
    <?php echo $this->Form->create("Document", array("class" => "form", 'enctype' => 'multipart/form-data', 'type' => 'file', 'url' => array("action" => "edit", $this->data['Document']['id']))); ?>
    <?php echo $this->Form->hidden('Document.property_id'); ?>
    <?php echo $this->Form->hidden('Document.id'); ?>
    <?php echo $this->Form->input('Document.document_type_id', array('label' => 'Tipo', 'empty' => 'Seleccione un tipo', 'class' => 'form-control')); ?>
    <br>
    <?php
    echo $this->Form->file('Document.documento', array('label' => 'Documento',
        'class' => 'form-control',
        'accept' => 'application/pdf',
        'aria-required' => 'true',
        'required' => 'true',
        'extension' => 'pdf'));
    ?>
    <br><br>
    <?php echo $this->Form->input('Document.comentario', array('label' => 'comentario', 'class' => 'form-control')); ?>
    <?php echo $this->Form->end(array('label' => "Guardar", 'class' => 'btn btn-default')) ?>
</fieldset>