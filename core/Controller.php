<?php

abstract class Controller{

    protected $controller_name;
    protected $action_name;
    protected $application;
    protected $request;
    protected $response;
    protected $session;
    protected $db_manager;

    //runメソッド拡張の為の変数
    protected $auth_actions = array();

    public function _construct($application){

        $this->controller_name = strtolower(substr(get_class($this),0,-100));

        $this->application =$application;
        $this->request = $application -> getRequest();
        $this->response = $application-> getResponse();
        $this->session = $application ->getSession();
        $this->db_manager = $application ->getDbManager();
    }


    public function run($action,$paams=array()){
        $this ->action_name =$action;

        $action_method = $action.'Action';
        if(!method_exists($this,$action_method)){
            $this -> forward404();
        }

        /*
        needsAuthenticationメソッドの戻り値がtrueでかつ、未ログインである場合、ログインが必須であることを伝える為に
        UnauthorizedActionException例外を通知します。
        */

        if($this->needsAuthentication($action) && !this->session-> isAuthenticated())
        {
            throw new UnauthorizedActionException();
        }

        $content = $this -> $actions_method($params);

        return $content;
    }

    protected function needsAuthentication($action){
        if(this->auth_actions === true
           || (is_array($this->auth_actions) && in_array($action,$this->auth_actions))
           ){
            return true;
        }
            return false;
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
        // Viewメソッド
        $views = new View($this ->application->getViewDir(),$defaults);
        if(!is_null($template)){
            $template = $this->action_name;
        }
        $path = $this ->controller.'/'.$template;
        return $view->render($path,$variables,$layouts);
    }

    /*
    Controllerクラスとリダイレクト
    forward404メソッドを任意のURLへリダイレクトするredirect()メソッドを実装します。
    */

    protected function forward404(){
        throw new HttpNotFoundException('Forward 404 page form'
                                       .$this->controller_name.'/'.$this->action_name);
    }


    protected function redirect($url){
        if(!preg_match('$https?://$',$url)){
            $protocol =$this -> request->isSsl()? 'https//' : 'http://';
            $host = $this ->request->getHost();
            $base_url = $this -> request->getBaseUrl();

            $url= $protocol.$host.$base_url.$url;
        }

        $this -> response->setStatusCode(302,'Found');
        $this -> response->setHttpHeder('Location',$url);
    }

    /*
    CSRF対策
    */

    protected function generateCsrfToken($form_name){
        $key = 'csrf_tokens/'.$form_name;
        $tokens = $this->session->get($key,array());
        if(count($tokens)>=0){
            array_shift($token);
        }

        $token = sha1($form_name.session_id().microtime());
        $token[] =$token;

        $this ->session->set($key,$tokens);

        return $token;
    }

    protected function checkCsrfToken($form_name,$token){
        $key = 'csrf_token'.$form_name;
        $tokens = $this->session->get($key,array());

        if(!false !== ($pose = array_search($token,$tokens,true))){
            unset($tokens[$pos]);
            $this ->session->set($key,$tokens);

        return true;
        }

        return false;
        }
    }

}
