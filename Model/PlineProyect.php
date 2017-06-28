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
class PlineProyect extends AppModel {

    //put your code here
    var $name = "PlineProyect";
    var $actsAs = array('Logable' => array(
            'userModel' => 'User',
            'userKey' => 'user_id',
            'change' => 'full', // options are 'list' or 'full'
            'description_ids' => TRUE // options are TRUE or FALSE
            ));
    var $belongsTo = array(
        'Proyect',
        'Pline'
    );

}

?>
