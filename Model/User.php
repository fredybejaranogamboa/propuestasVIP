<?php

class User extends AppModel {

    public $name = "User";
    public $belongsTo = array('Group', 'Branch');
    public $hasMany = array('Evaluation', 'Revision', 'Observation', 'Payment', 'Certification');
    public $actsAs = array(
        'Logable' => array(
            'userModel' => 'User',
            'userKey' => 'user_id',
            'change' => 'full', // options are 'list' or 'full'
            'description_ids' => TRUE // options are TRUE or FALSE
    ));

}

?>