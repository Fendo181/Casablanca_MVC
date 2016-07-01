<?php

/*編集 2016年7月1日*/

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
    
    abstract public function grtRootDir();
    
    abstract protected function registerRoutes();
    
    
    public function isDebugMode(){
        return $this->debug;
    }
    
    public function getRequest(){
        return $this ->request;
    }
    
    public function getResponse(){
        return $this ->session;
    }
    
    public function getDbManager(){
        return $this ->getRootDir().'/controller';
    }
    
    public function getViewDir(){
        return $this ->getRootDir().'/views';
    }
    
    public function getModelDir(){
        return $this ->getRootDir().'/models';
    }
    
    public function getWebDir(){
        return $this ->getRootDir().'/web';
    }
    
    /*コントローラの呼び出しと実行日*/
    
    /*
    なにやっているの?
    ここでは変数$paramsにRouteクラスのresolveメソッドを呼び出し、ルーティングパラメータを取得しコントローラ名とアクション名を特定します。それらを元にRunActionメソッドを呼び出してアクションを実行します。
    */
    public function run(){
        $params =$this->route->resolve($this->request->getPathInfo());
        
        if ($params === false){
            // todo A なにこれ?(例外処理)
            throw new HttpNotFoundException('No route found for'.$this->request->getPathInfo());
        }
        
        try{
            //***
        }catch(HttpNotFoundException $e){
            $this -> render404Page($e);
        }
        protected function render404Page($e)
        {
            $this -> response->setStatusCode(404,'Not Found');
            $message =$this -> isDebugMode() ? $e ->getMessage() : 'Page not founnd';
            $message =$this -> htmlspecialchars($message,ENT_QUOTES,'UTF-8');
        
        
        $this->response->setContent(
            /*HTML構文*/
        <!DOCTYPE html>
        <html>
        <head>
        <title>404 NotFound</title>
        <meta charset="UTF-8">
        <meta name="description" content="" />
        <meta name="keywords" content="" />
        </head>
        <body>
            {$message}
        </body>
        </html>
        
            );
        }
        
            
            
        $this ->response->send();
        $controller = $params['controller'];
        $action = $params['action'];
        
        //runActionメソッド
        $this ->runAction($controller,$action,$params);
        
        $this ->response->send();
    }
    
    /*
    これは何?
    
    RunActionメソッドは実際にアクションを実行するメソッドです。具体的にはコントローラのクラス名はコントローラ名にContollerを付けるというルールにします。またルーティングにはコントローラ名の先頭を小文字で指定するようにしたので、ucfirst()関数を用いて先頭を大文字にしています。
    */
    public function runAction($controller_name,$action,$params = array()){
        
        $controller_class = ucfirst($controller_name).'Contoller';
        
        //findControllerメソッド呼び出し。
        $controller =$this->findController($controller_class);
        if($controller == false){
            // todoB(例外処理)
            
            throw new HttpNotFoundException($controller_class.'controller is not found!');
        }
        
        $content = $controller->run($action,$params);
        
        $this ->response->setContent($content);
    }
    
    /*
    これなに?
    findController()メソッドではコントローラクラスが読み込まれていない場合に、クラスファイルの読み込みを行います。クラスファイルの読み込みを行います。クラスファイルの読み込みが完了したらコントローラクラス生成しています。Contoller()クラスはまだ実現しませんが、コンストラクタにはApplocationクラス自身を渡すようにします。

    */
    protected function findController($controller_class)
    {
        if(!class_exists($controller_class)){
            $controller_file = $this->getCoontrollerDir().'/'.$controller_class.'php';
        }
        
        if(!is_readable($controller_file)){
            return false;
        }else{
            //読み込み部分
            require_once $controller_file;
            
            if(!class_exits($controller_class)){
                return false;
            }
        }
    }
    
    return new $controller_class($this);
}

?>
