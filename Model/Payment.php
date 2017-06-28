<?php

class Payment extends AppModel {

    public $name = "Payment";
    public $belongsTo = array('Proyect', 'User', 'Beneficiary', 'Asociation');
    public $hasMany = array('Certification');
    public $actsAs = array('Logable' => array(
            'userModel' => 'User',
            'userKey' => 'user_id',
            'change' => 'full', // options are 'list' or 'full'
            'description_ids' => TRUE // options are TRUE or FALSE
    ));

}

?>