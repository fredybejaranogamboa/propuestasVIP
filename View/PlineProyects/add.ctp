<div class="panel-body">
    <div class="row">
        <div class="col-lg-6">
            <div id="loading" style="display: none;">
        <?php echo $this->Html->image('loading.gif', array('border' => "0", 'align' => 'center')); ?>
            </div>
    <?php
    echo $this->Form->create('PlineProyect', array('role'=>"form"));
    echo $this->Form->hidden("PlineProyect.proyect_id", array('value'=> $proyect_id));
    echo $this->Form->input('PlineProyect.pline_id', array('label' => 'Línea productiva', 'class' => 'required', 'empty' => 'Seleccione una línea'));
    echo $this->Ajax->submit('Guardar', array('url' => array('controller' => 'PlineProyects', 'action' => 'add', $proyect_id), 'update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-default'));
    echo $this->Form->end();
    ?>
        </div>
    </div>
</div>