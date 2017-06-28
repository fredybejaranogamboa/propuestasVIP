<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Group
 *
 * @author 250-1-405
 */
class ActionsGroup extends AppModel{

    //put your code here
    public $name = "ActionsGroup";
    public $belongsTo = array('Action','Group');
    public $actsAs = array('Logable' => array(
            'userModel' => 'User',
            'userKey' => 'user_id',
            'change' => 'full', // options are 'list' or 'full'
            'description_ids' => TRUE // options are TRUE or FALSE
            ));
   

    
}
?>
