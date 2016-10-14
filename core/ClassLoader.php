<?php

/*
このクラスの目的

①PHPにオートローダクラスを登録する
②オートローダが実行された際にクラスファイルを登録する。

*/

class ClassLoader{

    protected $dirs; //ディレクトリ登録用の変数。

    public function register(){
        spl_autoload_register(array($this,'loadClass'));
    }

    //ディレクトリを登録する。
    public function registerDir($dir){
        $this->dirs[] =$dir;

    }

    public function loadClass($class){

        foreach($this->dirs as $dir){
            $file = $dir.'/'.$class.'.php';

            if(is_readable($file)){
                return;
            }

        }
    }
}
