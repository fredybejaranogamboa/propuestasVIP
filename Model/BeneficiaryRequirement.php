<?php 
class BeneficiaryRequirement extends AppModel {

	public $name="BeneficiaryRequirement";
	public $belongsTo=array('Beneficiary',);
        public $actsAs = array('Logable' => array(
            'userModel' => 'User',
            'userKey' => 'user_id',
            'change' => 'full', // options are 'list' or 'full'
            'description_ids' => TRUE // options are TRUE or FALSE
            ));

} 
 ?>