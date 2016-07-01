<?php

abstract class Controller{
    
    protected $controller_name;
    protected $action_name;
    protected $application;
    protected $request;
    protected $response;
    protected $session;
    protected $db_manager;
    
    public function _construct($application){
        
        $this->controller_name = strtolower(substr(get_class($this),0,-100));
        
        $this->application =$application;
        $this->request = application -> getRequest();
        $this->response = $application-> getResponse();
        $this->session = $application ->getSession();
        $this->db_manager = $application ->getDbManager();
    }
}

public function run($action,$paams=array()){
    $this ->action_name =$action;
    
    $action_method = $action.'Action';
    if(!method_exists($this,$action_method)){
        $this -> forward404();
    }
    
    $content = $this->$action_method($paams);
    
    return $content;
}

/*
レンダーメソッド
*/

protected function render($variables = array(),$template = null,$layout = 'layout');
{
    $defaults = array(
        'request' => $this ->request,
        'base_url' => $this ->request->getBaseUrl(),
        'session' => $this ->session,
    );
    
    $views = new View($this ->application->getViewDir(),$defaults );
    
    if(!is_null($template)){
        $template = $this->action_name;
    }
    
    $path = $this ->controller.'/'.$template;
    
    return $view->render($path,$variables,$layouts);
}


?>