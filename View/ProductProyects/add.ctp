<script>
    $(".selectpicker").selectpicker().selectpicker("render");
</script>
<div class="panel-body">
    <div class="row">
        <div class="col-lg-6">
            <div id="loading" style="display: none;">
        <?php echo $this->Html->image('loading.gif', array('border' => "0", 'align' => 'center')); ?>
            </div>
    <?php
    echo $this->Form->create('ProductProyect', array('role'=>"form"));
    echo $this->Form->hidden("ProductProyect.proyect_id", array('value'=> $proyect_id));
    echo $this->Form->input('ProductProyect.product_id', array('label' => 'Producto', 'required' => '','class' => 'form-control selectpicker', 'empty' => 'Seleccione un producto', "data-live-search"=>"true"));
    echo $this->Form->input('ProductProyect.area_h', array('label' => 'Área hectáreas', 'class' => 'form-control'));
    echo $this->Form->input('ProductProyect.area_m', array('label' => 'Área metros cuadrados', 'class' => 'form-control'));    
    echo $this->Ajax->submit('Guardar', array('url' => array('controller' => 'ProductProyects', 'action' => 'add', $proyect_id), 'update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-default'));
    echo $this->Form->end();
    ?>
        </div>
    </div>
</div>