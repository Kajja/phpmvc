<?php

namespace Anax\Di;

use \Anax\DI\CDIFactoryDefault;

class CDIFactory extends CDIFactoryDefault 
{
    public function __construct() 
    {
        parent::__construct();

        // Creating a controller service for comments
        $this->set('CommentController', function() {
            $controller = new \Phpmvc\Comment\CommentController();
            $controller->setDI($this);
            return $controller;
        });

        // Creating a model service for comments
        $this->set('comments', function(){
//            $comments = new \Phpmvc\Comment\CommentsInSession();
            $comments = new \Phpmvc\Comment\Comment();
            $comments->setDI($this);
            return $comments;
        });

        // Database service (from mos vendor)
        $this->set('db', function() {
            $db = new \Mos\Database\CDatabaseBasic();
            $db->setOptions(require ANAX_APP_PATH . 'config/database_sqlite.php');
            $db->connect();
            return $db;
        });

        // Form service (from mos vendor)
        $this->set('form', '\Mos\HTMLForm\CForm');

        // Controller for forms
        $this->set('FormController', function() {
            $controller = new \Anax\HTMLForm\FormController();
            $controller->setDI($this);
            return $controller;
        });

        // Controller for User-actions
        $this->set('UsersController', function() {
            $controller = new \Anax\Users\UsersController();
            $controller->setDI($this);
            return $controller;
        });

        // Request-recorder service
        $this->set('recorder', function() {
            $dbh = new \Kajja\Recorder\RequestDatabase();
            $dbh->setOptions([
                'dsn'           => 'sqlite:' . ANAX_APP_PATH . '.htphpmvc.sqlite',
                'fetch_mode'    => \PDO::FETCH_ASSOC
                ]);
            $dbh->connect();
            $formatter = new \Kajja\Recorder\HTMLFormatter();
            $recorder = new \Kajja\Recorder\RequestRecordAnax($dbh, $formatter, $this);
            return $recorder;
        });
    }
}