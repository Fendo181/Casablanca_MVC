<?php

/*

このクラスの目的

①PHPにオートローダクラスを登録する(?)
②オートローダが実行された際にクラスファイルを登録する。

*/



class ClassLoader{
    
    protected $dirs;
    
    /*
    PHPにオートローダクラスを登録する処理にあたります。
    従ってregister()が呼び出される時に
    コールバック関数の引数として
    loadClass()が呼び出すようにしています(?)
    
    いや多分違う
    */
    public function register(){
        spl_autoload_register(array($this,'loadClass'));
    }
    
    //ディレクトリを登録する。
    public function registerDir($dir){
        $this->dirs[] =$dir
        
    }
    
    
    /*
    これを元にクラスファイルの読み込みを行う。
    */
    
    public function loadClass($class){
        
        foreach($this->dirs as $dir){
            $file = $dir.'/'.$class.'.php';
            
            if(is_readable($file)){
                
                return;
            }
            
        }
    }
}

?>