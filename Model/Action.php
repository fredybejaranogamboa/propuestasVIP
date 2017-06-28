<?php

class Action extends AppModel {

    public $name = "Action";
    public $belongsTo = array('Entity');
    public $hasAndBelongsToMany = array('Group');
    public $actsAs = array('Logable' => array(
            'userModel' => 'User',
            'userKey' => 'user_id',
            'change' => 'full', // options are 'list' or 'full'
            'description_ids' => TRUE // options are TRUE or FALSE
    ));

}

?>