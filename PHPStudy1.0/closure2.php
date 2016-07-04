<?php

//クロージャーとは関数内に現れる変数の名前解決がローカルスコープだけではなく、関数が定義された場所のスコープも含めえて行われる**関数**の事である。PHPでは,無名関数を定義する際にuse()構文を用いて関数内で利用できる変数を指定します。これにより、その無名関数が定義されたスコープにおける変数を、関数内で指定する事可能です。

function br(){
    echo nl2br("\n");
}



function create_count(){
    $count_local = 0; //local value(この関数内でしか値を保持しない)
    
    //返り値として渡す無名関数にuseで引き渡す
    return function() use (&$count_local){
        return ++$count_local;
    };
    
   
}

//echo create_count(); Erroが起きる

//$countはclosureオブジェクト変数になる。
$count=create_count();

var_dump($count);

//クロージャ呼びだし
echo $count(); //1
br();
echo $count(); //2
br();
echo $count(); //



/*$my_pow=function($times=2){#デフォルトは2
    
    //返り値に更に関数を入れる
    
    
    ここでは乗数を引き継ぐ
    return function ($v) use (&$times){
        return pow($v,$times);
    };
    
};
*/








?>