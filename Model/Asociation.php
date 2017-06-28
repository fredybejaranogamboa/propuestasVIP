<?php

class Asociation extends AppModel {

    var $name = "Asociation";
    var $hasMany = array('Beneficiary', 'Payment', 'Proyects');
    var $belongsTo = array('City');
    var $actsAs = array('Logable' => array(
            'userModel' => 'User',
            'userKey' => 'user_id',
            'change' => 'full', // options are 'list' or 'full'
            'description_ids' => TRUE // options are TRUE or FALSE
    ));

}

?>