<?php
// @1:初期化処理1

var_dump("bootstrap.php");

// require(dirname(__FILE__) ."/core/ClassLoader.php");
require 'core/ClassLoader.php';

//インスタンス生成
$loader=new ClassLoader();

//registerDirメソッドを呼び出し。coreとmodelsから呼び出せるようにする。
$loader->registerDir(dirname(__FILE__).'/core');
$loader->registerDir(dirname(__FILE__).'/models');


/*
ここで初めてresgister(spl_auto_loadを使ったコールバック関数)を呼び出し、オートローダとして
外部からクラスを読み込める準備ができました。
*/
$loader->register();
