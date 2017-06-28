<script>
    $(document).ready(function () {
        $("#formulario").validate({
            rules: {
                'data[Group][name]': {
                    required: true
                }
            }
        });
    });
</script>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Grupos
            </div>
            <div class="dataTable_wrapper">
                <?php
                echo $this->Form->create('Group', array('novalidate' => '', 'id' => 'formulario', 'role' => "form", "class" => "form", 'enctype' => 'multipart/form-data', 'type' => 'file', 'url' => array("action" => "edit", $this->data['Group']['id'])));
                echo $this->Form->hidden("Group.id");
                echo $this->Form->input("Group.name", array('label' => 'Nombre', 'required' => '', 'class' => 'form-control'));
                echo $this->Form->end(array('label' => "Guardar", 'class' => 'btn btn-default'));
                ?>
            </div>
        </div>
    </div>
</div>