<?php

if (!empty($cities)) {
    echo $this->Form->input('Beneficiary.city_id', array(
        'label' => __('Municipio', true),
        'empty' => __('Seleccione ciudad', true),
        'class' => 'form-control',
        'required' => ''
            )
    );
}
?>
