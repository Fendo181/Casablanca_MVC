<?php


/*
Requestクラスはユーザからのリクエスト情報を制御するクラスです。

主な機能としては
1.HTPPメソッド($_GET/$_POST)などの値を取得
2.リクエストされたURLの取得
3.サーバのホスト名やSSLでのアクセスなのかを判定する機能
4.フロントコントローラを採用している為、URLに関する情報も取得します。
*/

class Request{
    
    
    /*
    HTTPメソッドがPOSTか確認する。
    */
    public function isPost(){
        
        if($_SERVER['REQUEST_METHOD']==='PPST'){
            return true;
        }
        
        return false;
    }
    
    /*
    $_GET変数から値受け取る。
    */
    public function getGet($name,$default=null){
        if(isset($_GET[$name])){
            return $_GET[$name];
        }
        
        return $default;
    }
    
    
    /*
    $_POST変数から値を受け取る。
    */
    public function getPost($name,$default=null){
        if(isset($_POST[$name])){
        return $_POST[$name];
    }
    
        return $default;
    }
    
    /*
    サーバのホスト名を取得するメソッド
    */
    public function getHost(){
        if(!empty($_SERVER['HTTP_HOST'])){
            return $_SERVER['HTTP_HOST'];
        }
        
        return $_SERVER['SERVER_NMAE'];
    }
    
    /*
    HTTPSメソッドでアクセスされたか確認するメソッドです。
    */
    public function isSsl(){
        /*
        HTTPSメソッドでonにと言う文字が含まれるので、それを判定します。
        */
        if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] ==='on'){
            return true;
        }
        
        return false;
    }
    
    /*
     リクエストされたURLの情報を$_SERVER['REQUEST_URI']に格納します。
    */
    public function getRequestUri(){
        return $_SERVER['Request_URI'];
        
    }
    

    public function getBaseUrl(){
        $script_name=$_SERVER['SCRIPT_NAME'];
        
        //クラス内でメソッド呼び出し。
        $request_uri=$this->getRequestUri();
        
        //strops()が一番高速で正規マッチを行う
        if(0 ===strpos($request_uri,$script_name)){
            return $script_name;
            /*
            dirname()はファイルのパスからディレクトリ部分を抜き出すメソッドです。/
            */
        }else if(0 === strpos($request_uri,dirname($script_name))){
            return rtrim(dirname($script_name),'/');
        }
        
        return '';
    }
    
    public function getPathInfo(){
        
        $base_url=$this->getBaseUrl();
        $request_uri=$this->getRequestUri();
        
        if(false !== ($pos=strpos($request_uri,'?'))){
            $request_uri=substr($request_uri,0,$pos);
        }
        
        $path_info=(string)substr($request_uri,strlen($base_url));
        
        return $path_info;
    }
    
}


?>