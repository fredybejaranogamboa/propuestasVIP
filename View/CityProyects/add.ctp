<div class="panel-body">
    <div class="row">
        <div class="col-lg-6">
    <?php
    echo $this->Form->create('CityProyect', array('role'=>"form"));
    echo $this->Form->hidden("CityProyect.proyect_id", array('value'=> $proyect_id));
    ?>
            <div id="loading" style="display: none;">
        <?php echo $this->Html->image('loading.gif', array('border' => "0", 'align' => 'center')); ?>
            </div>
<?php echo $this->Form->input('CityProyect.departament_id', array('label' => 'Departamento', 'class' => 'required', 'empty' => 'Seleccione departamento')); ?>

<?php
echo $this->Ajax->observeField('CityProyectDepartamentId', array(
    'url' => array('action' => 'select'),
    'frequency' => 0.1,
    'update' => 'ciudades',
        )
);
?>
            <div id="ciudades">
            </div>
    <?php
    echo $this->Ajax->submit('Guardar', array('url' => array('controller' => 'CityProyects', 'action' => 'add', $proyect_id), 'update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-default'));
    echo $this->Form->end();
    ?>

        </div>
    </div>
</div>

