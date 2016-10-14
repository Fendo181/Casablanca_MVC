<?php

require(dirname(__FILE__) . "/core/ClassLoader.php");

//インスタンス生成
$loder=new ClassLoader();

//registerDirメソッドを呼び出し。coreとmodelsから呼び出せるようにする。
$loder->registerDir(dirname(__FILE__),'/core');
$loder->registerDir(dirname(__FILE__),'/models');


/*
ここで初めてresgister(spl_auto_loadを使ったコールバック関数)を呼び出し、オートローダとして
外部からクラスを読み込める準備ができました。
*/
$loder->register();
