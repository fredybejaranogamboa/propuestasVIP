<?php

class DocumentType extends AppModel {

    public $name = "DocumentType";
    public $hasMany = array('Document');
    public $actsAs = array('Logable' => array(
            'userModel' => 'User',
            'userKey' => 'user_id',
            'change' => 'full', // options are 'list' or 'full'
            'description_ids' => TRUE // options are TRUE or FALSE
    ));

}

?>