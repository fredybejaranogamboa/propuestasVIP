<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Menu extends AppModel {

    public $name = "Menu";
    public $hasMany = array("Item");
    public $belongsTo = array("Tab");
    public $actsAs = array('Logable' => array(
            'userModel' => 'User',
            'userKey' => 'user_id',
            'change' => 'full', // options are 'list' or 'full'
            'description_ids' => TRUE // options are TRUE or FALSE
            ));

}

?>
