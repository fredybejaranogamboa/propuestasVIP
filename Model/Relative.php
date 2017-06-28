<?php 
class Relative extends AppModel {

	public $name="Relative";
	public $belongsTo=array('Candidate');
        public $actsAs = array('Logable' => array(
            'userModel' => 'User',
            'userKey' => 'user_id',
            'change' => 'full', // options are 'list' or 'full'
            'description_ids' => TRUE // options are TRUE or FALSE
            ));

} 
 ?>