<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description 
 *
 * @author root
 */
class CityProyect extends AppModel {

    //put your code here
    var $name = "CityProyect";
    var $actsAs = array('Logable' => array(
            'userModel' => 'User',
            'userKey' => 'user_id',
            'change' => 'full', // options are 'list' or 'full'
            'description_ids' => TRUE // options are TRUE or FALSE
            ));
    var $belongsTo = array(
        'Proyect',
        'City'
    );

}

?>
