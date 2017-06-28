<?php

if (!empty($cities)) {
    echo $this->Form->input('Proyect.city_id', array(
        
        'label' => __('Municipio', true),
        'empty' => __('Seleccione ciudad', true),
        'class'=>'required'
            )
    );
}
?>
