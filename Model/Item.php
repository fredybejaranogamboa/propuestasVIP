<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Item extends AppModel{

    public $name="Item";
    public $belongsTo="Menu";
    public $hasAndBelongsToMany = array('Group');
    public $actsAs = array('Logable' => array(
            'userModel' => 'User',
            'userKey' => 'user_id',
            'change' => 'full', // options are 'list' or 'full'
            'description_ids' => TRUE // options are TRUE or FALSE
            ));

}

?>
