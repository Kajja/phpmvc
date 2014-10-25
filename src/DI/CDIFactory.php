<?php

class CDIFactory extends CDIFactoryDefault 
{
    public function __construct() 
    {
        parent::__construct();

        //
        $this->set('db', function() {
            $db = new \Mos\Database\CDatabaseBasic();
            $db->setOptions(require ANAX_APP_PATH . 'config/database_sqlite.php');
            $db->connect();
            return $db;
        });
    }
}