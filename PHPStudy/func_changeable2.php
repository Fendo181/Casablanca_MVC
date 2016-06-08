<?php

function add($v1,$v2){
    return $v1+$v2;
}

class Math{
    //staticeメソッド
    public function sub($v1,$v2){
        return $v1-$v2;
    }
    
    //staticメソッド
    public static function add($v1,$v2){
        return $v1+$v2;
    }
}

//call_user_func()はコールバック関数の指定につづいて引数を指定する事ができます。

echo call_user_func('add',1,2); //一番上のaddメソッドを指定して値を呼び出しします。
    
//コールバック関数には無名関数(クロージャ/関数名を指定せずに関数を作成する事ができる。)
echo call_user_func(function($v1,$v2){ return $v1+$v2;},10,20);

//sttaicメソッドの場合、クラス名を文字列で指定できる
echo call_user_func(array('Math','add'),1,2); //3
    
//staticメソッドの場合、「クラス名::メソッド名」と言う文字列でも指定できる。

echo call_user_func('Math::add',10,20); //30
    
//インスタンス変数とメソッド名を指定する。
    
$math=new Math();//インスタンス生成
echo call_user_func(array($math,'sub'),10,30); //-20

//call_user_func_array()は、第二引数に配列で
echo call_user_func_array('add',array(20,20));

//インスタンスを使う可変関数
echo call_user_func_array(array($math,'add'),array(17,18));



?>