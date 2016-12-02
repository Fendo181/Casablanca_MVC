<?php


var_dump("Application.php");

// これをauto_loadrで上手く使いたいね
// require(dirname(__FILE__) . "/Request.php");
// require(dirname(__FILE__) . "/Router.php");
// require(dirname(__FILE__) . "/Session.php");
// require(dirname(__FILE__) . "/HttpNotFoundException.php");
// require(dirname(__FILE__) . "/DbManager.php");
// require(dirname(__FILE__) . "/Response.php");


abstract class Application
{
    protected $debug = false;
    //  これは今作った
    protected $request;
    protected $response;
    protected $session;
    protected $db_manager;


    public function __construct($debug = false){
        $this -> setDebugMode($debug);
        $this -> initialize();
        $this -> configure();
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
        $this->response = new Response();
        $this->session = new Session();
        $this->db_manager = new DbManager();
        $this ->router =new Router($this->registerRoutes());
    }

    /**
     * アプリケーションの設定
     */
    protected function configure()
    {

    }

    /**
     * プロジェクトのルートディレクトリを取得
     *
     * @return string ルートディレクトリへのファイルシステム上の絶対パス
     */

    abstract public function getRootDir();



    abstract protected function registerRoutes();


    public function isDebugMode(){
        return $this->debug;
    }

    public function getRequest(){
        return $this ->request;
    }

    public function getResponse(){
        return $this ->response;
    }

    public function getSession()
    {
        return $this->session;
    }

    //DB周りの操作を行う。
    public function getDbManager()
    {
    return $this->db_manager;
    }

    public function getCoontrollerDir(){
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
        try{
            $params =$this->router->resolve($this->request->getPathInfo());
            if ($params === false){
                // todo A なにこれ?(例外処理)
                // print "hello wold!"
                throw new HttpNotFoundException('No route found for' .$this->request->getPathInfo());
            }
        $controller = $params['controller'];
        $action = $params['action'];

        $this ->runAction($controller,$action,$params);
    }catch(HttpNotFoundException $e){
        $this -> render404Page($e);
    }catch(UnauthorizedActionException $e){  //Applicationログイン画面の制御
        list($controller,$action) = $this ->login_action;
        $this ->runAction($controller,$action);
        }
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
        if(!is_readable($controller_file)){
            return false;
        }else{
            //読み込み部分
            require_once $controller_file;
            if(!class_exists($controller_class)){
                return false;
            }
        }
    }

    return new $controller_class($this);
    }
    protected function render404Page($e)
    {
        $this->response->setStatusCode(404, 'Not Found');
        $message = $this->isDebugMode() ? $e->getMessage() : 'Page not found.';
        $message = htmlspecialchars($message, ENT_QUOTES, 'UTF-8');

        $this->response->setContent(<<<EOF
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>404</title>
</head>
<body>
    {$message}
</body>
</html>
EOF
        );
    }

}
