<?php

class City extends AppModel {

    public $name = "City";
    public $belongsTo = array('Departament');
    public $hasMany = array('Properties', 'Beneficiaries', 'Asociations');
    public $actsAs = array('Logable' => array(
            'userModel' => 'User',
            'userKey' => 'user_id',
            'change' => 'full', // options are 'list' or 'full'
            'description_ids' => TRUE // options are TRUE or FALSE
    ));

}

?>