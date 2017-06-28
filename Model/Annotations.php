<?php

class Annotations extends AppModel {

    public $name = "Annotations";
    public $belongsTo = array('TitleStudy',);
    public $actsAs = array('Logable' => array(
            'userModel' => 'User',
            'userKey' => 'user_id',
            'change' => 'full', // options are 'list' or 'full'
            'description_ids' => TRUE // options are TRUE or FALSE
            ));

}

?>