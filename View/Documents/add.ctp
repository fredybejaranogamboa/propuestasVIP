<script>
    $(document).ready(function () {
        $(".form").validate({
            rules: {
                'data[Document][comentario]': {
                    required: true,
                },
                'data[Document][document_type_id]': {
                    required: true,
                    empty: false
                }
            }
        });
    });
</script>
<fieldset>
    <?php echo $this->Form->create("Document", array("class" => "form", 'enctype' => 'multipart/form-data', 'type' => 'file', 'url' => array("action" => "add", $foreign_id, $entity_id))); ?>
    <?php echo $this->Form->hidden('Document.entity_id', array('value' => $entity_id)); ?>
    <?php echo $this->Form->hidden('Document.foreign_id', array('value' => $foreign_id)); ?>
    <?php
        echo $this->Ajax->observeField('DocumentDocumentTypeId', array(
                'url' => array('action' => 'select', 'controller' => 'Documents'),
                'frequency' => 0.2,
                'update' => 'documento'
            )
        );
    ?>
    <?php echo $this->Form->input('Document.document_type_id', array('label' => 'Tipo', 'empty' => 'Seleccione un tipo', 'class' => 'form-control')); ?>

    <div id="documento">
    </div>   
    <br>

    <br><br>
    <?php echo $this->Form->input('Document.comentario', array('label' => 'comentario', 'class' => 'form-control')); ?>
    <?php echo $this->Form->end(array('label' => "Guardar", 'class' => 'btn btn-default')) ?>
</fieldset>