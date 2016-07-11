<?php

/*
クラスをこのコード内に書かないでインスタンス(オブジェクト)を生成する。
*/


//引数に関数として渡す場合


spl_autoload_register(function($name){
//    include __DIR__.'/'.$name.'.php'; //第一号
    
    /*
    DIRECTORY_SEPARATOR
    http://pentan.info/php/sample/ds.html
    はたとえばLinuuxでは\だけど、Windowsなら￥とか
    自動で判断して解決してくれるやつです。偉い。
    */
    include __DIR__.DIRECTORY_SEPARATOR.$name.'.php'; //第一号
});

$user = new User();

$user->sayHi();

//実行結果

//Hello