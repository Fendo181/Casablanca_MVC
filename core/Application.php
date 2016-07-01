<?php

abstract class Application
{
    protected $debug = false;
    protected $request;
    protected $response;
    protected $session;
    protected $db_manager;
    
    
    public function __constrct($debug = false){
        $this -> setDebugMode($debug);
        $this -> initialize();
        $this -> configure();
    }
    
    protected function setDebugMode($debug)
    {
        if($debug){
            $this ->debug = true;
            ini_set('display')
        }
        
    }
    
    protected function setDebugMode($debug)
    {
        if($debug){
            $this ->debug =true;
            ini_set('display_erros',1);
            error_reporting(-1);
        }else{
            $this->debug = false;
            ini_set('display_erros',0);
        }
    }
    
    protected function initialize(){
        
        $this->request = new Request();
        $this->request = new Response();
        $this->request = new Session();
        $this->db_manager = new DbManager();
        
        $this ->route =new Router($this->registerRoutes());
    }
    
    protected function configure()
    {
        
    }
    
    
    
}

?>