<?php

class TitleStudyDocuments extends AppModel {

    public $name = "TitleStudyDocuments";
    public $belongsTo = array('TitleStudy');
    public $actsAs = array('Logable' => array(
            'userModel' => 'User',
            'userKey' => 'user_id',
            'change' => 'full', // options are 'list' or 'full'
            'description_ids' => TRUE // options are TRUE or FALSE
            ));

}

?>