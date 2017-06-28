<?php

class Property extends AppModel {

    public $name = "Property";
    public $actsAs = array('Logable' => array(
            'userModel' => 'User',
            'userKey' => 'user_id',
            'change' => 'full', // options are 'list' or 'full'
            'description_ids' => TRUE // options are TRUE or FALSE
    ));
    public $belongsTo = array('City', 'Departament', 'Proyect');
    public $hasMany = array('Point', 'Beneficiary', 'Service');

}

?>