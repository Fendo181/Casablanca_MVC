<?php


function br(){
    echo nl2br("\n");
}

//クラス
class Employer{
    
    public $name;
    public $state='働いている';
    
    public static function work(){
        echo "書類を整理します";
    }
}

//インスタント生成
$yamada=new Employer();

//プロパティにアクセス1
$yamada->name="山田";
echo $yamada->state;

//sttaic変数にアクセス
//echo Employer::state;

br();
echo $yamada->name;
br();
//メソッ呼び出し
$yamada->work();

//staticメソッド呼び出し
Employer::work();



