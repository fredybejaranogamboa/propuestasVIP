<?php

class Visit extends AppModel {

    public $name = "Visit";
    public $belongsTo = array('Proyect');
    public $hasMany = array('Photography');
    public $actsAs = array('Logable' => array(
            'userModel' => 'User',
            'userKey' => 'user_id',
            'change' => 'full', // options are 'list' or 'full'
            'description_ids' => TRUE // options are TRUE or FALSE
    ));

}

?>