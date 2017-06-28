<?php

class Evaluation extends AppModel {

    public $name = "Evaluation";
    public $belongsTo = array('Proyect', 'User');
    public $hasMany = array('Revision', 'Observation');
    public $actsAs = array('Logable' => array(
            'userModel' => 'User',
            'userKey' => 'user_id',
            'change' => 'full', // options are 'list' or 'full'
            'description_ids' => TRUE // options are TRUE or FALSE
    ));

}

?>