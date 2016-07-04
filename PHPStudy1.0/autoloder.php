<?php

/*
クラスMyClass1および、MyClass2をそれぞれMyClass1.phpおよび、MyClass2.phpからロードします。
*/

//splはThe Standard PHP Library (SPL)と言う意味です。

/*おまじあない?*/
spl_autoload_register(function ($class_name){
   include $class_name. '.php';
    
});

$obj=new "MyClass1()";
$obj=new "MyClsas2()"


?>