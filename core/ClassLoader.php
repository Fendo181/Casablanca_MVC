<?php

var_dump("ClassLoader.php");
// @1:初期化処理2

/*
このクラスの目的

①PHPにオートローダクラスを登録する
②オートローダが実行された際にクラスファイルを登録する。

*/

class ClassLoader
{

    protected $dirs; //ディレクトリ登録用の変数。

    //PHPにオートローダクラスを登録する処理
    public function register()
    {
        spl_autoload_register(array($this,'loadClass'));

    }

    //ディレクトリからクラスを読むこむ為。
    public function registerDir($dir){
        $this->dirs[] =$dir;

    }

    // クラス読み込む処理
    public function loadClass($class)
    {
        foreach($this->dirs as $dir){
            $file = $dir . '/' . $class . '.php';
            var_dump($file);

            if(is_readable($file)){
                //  not returnじゃないよ!!
                // return $file;

                require $file;

                return;
            }

        }
    }
}
