<?php

require_once(dirname(__FILE__) . "/core/Application.php");

class MiniBlogApplication extends Application{
    protected $login_action = array('account','sigin');

    //
    public function getRootDir(){
        return dirname(__FILE__);
    }

    protected function registerRoutes(){
        return array(

        );
    }

    protected function configure()
    {
        $this -> db_manager ->connect('master',array(
            'dsn' => 'mysql::dbname = dot_mysql; host=localhost',
            'user' => 'dotuser',
            'password' => 'dtdt1201',
        ));
    }
}
