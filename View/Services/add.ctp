<?php echo $this->Form->create("Service", array('novalidate'=>'','id'=>'formulario','role'=>"form","class" => "form", 'enctype' => 'multipart/form-data', 'type' => 'file', 'url' => array("action" => "add", $property_id))); ?>

<fieldset>
    <?php echo $this->Form->hidden('Service.property_id', array('value' => $property_id)); ?>

    <?php
        echo $this->Form->input('Service.tipo', array('label' => 'Tipo', 'required' => '', 'class' => 'form-control', 'empty' => '', 'options' => array(
                'Acueducto, alcantarillado y aseo' =>'Acueducto, alcantarillado y aseo',                
                'Energía eléctrica' => 'Energía eléctrica',
                'Gas domiciliario' => 'Gas domiciliario',
                'Telecomunicaciones' => 'Telecomunicaciones'
        )));
    ?>
    <?php echo $this->Form->input('Service.valor', array('label' => 'Valor', 'class' => 'form-control')); ?>
    <?php echo $this->Form->input('Service.descripcion', array('label' => 'Descripción', 'class' => 'form-control')); ?>

    <?php echo $this->Form->end(array('label' => 'Guardar','class' => 'btn btn-default'))?>
</fieldset>