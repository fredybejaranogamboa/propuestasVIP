<?php

if (!empty($cities)) {
    echo $this->Form->input('CityProyect.city_id', array(
        
        'label' => __('Municipio', true),
        'empty' => __('Seleccione ciudad', true),
        'class'=>'required'
            )
    );
}
?>
