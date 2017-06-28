<?php

class Proyect extends AppModel {

    public $name = "Proyect";
    public $actsAs = array('Logable' => array(
            'userModel' => 'User',
            'userKey' => 'user_id',
            'change' => 'full', // options are 'list' or 'full'
            'description_ids' => TRUE // options are TRUE or FALSE
    ));
    public $belongsTo = array('Departament', 'Branch', 'Call', 'Agreement', 'Asociation');
    public $hasMany = array('Property', 'Beneficiary', 'Asociation',
        'Resolution', 'Evaluation', 'Payment', 'Extract', 'Committee', 'Follow', 'Visit');

}

?>