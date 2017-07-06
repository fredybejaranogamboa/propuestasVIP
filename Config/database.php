<?php

class DATABASE_CONFIG {

//  public $default = array(
//		'datasource' => 'Database/Sqlserver',
//		'persistent' => false,
//		'host' => '192.168.1.13\PRUEBAS',
//		'login' => 'sa',
//		'password' => 'prcake2014',
//		'database' => 'ipdr',
//                
//		//'prefix' => '',
//		//'encoding' => 'utf8',
//	);

    public $default= array(
        'datasource' => 'Database/Mysql',
        'persistent' => false,
        'host' => 'localhost',
        'login' => 'root',
        'password' => '',
        'database' => 'pdret',
        'prefix' => '',
        'encoding' => 'utf8',
        
    );

}
