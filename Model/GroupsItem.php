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
class GroupsItem extends AppModel{

    //put your code here
    public $name = "GroupsItem";
    public $acftsAs = array('Logable' => array(
            'userModel' => 'User',
            'userKey' => 'user_id',
            'change' => 'full', // options are 'list' or 'full'
            'description_ids' => TRUE // options are TRUE or FALSE
            ));
   

    
}
?>
