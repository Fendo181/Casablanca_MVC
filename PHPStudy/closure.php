<?php

//クロージャーとは関数内に現れる変数の名前解決がローカルスコープだけではなく、関数が定義された場所のスコープも含めえて行われる**関数**の事である。PHPでは,無名関数を定義する際にuse()構文を用いて関数内で利用できる変数を指定します。これにより、その無名関数が定義されたスコープにおける変数を、関数内で指定する事可能です。

function br(){
    echo nl2br("\n");
}


$my_pow=function($times=2){#デフォルトは2
    
    //返り値に更に関数を入れる
    
    /*
    ここでは乗数を引き継ぐ*/
    return function ($v) use (&$times){
        return pow($v,$times);
    };
    
};

/*$cube変数は今は3乗を行う関数が定義されます。
オブジェクト(クロージャー)が定義される。
*/
$cube=$my_pow(3);

var_dump($cube);
//echo pow(2,3); #8

//この1はreturn function ($v1)に渡される。
echo $cube(1); #1 

br();
echo $cube(4); #64=4*3
br();
echo $cube(2); #8=2*3
br();
echo $cube(10); #1000=10*3
br();
echo "これがクロージャーか!気持ち悪い!!";



?>