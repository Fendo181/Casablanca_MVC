<?php
/*

もし明示的に型を使うならば下の様に宣言しないといけません!。
*/
declare(strict_types=1);

function br(){
    echo nl2br("\n");
}

function getTraiangleArea($base,$height){
    return ($base*$height)/2;
}

$area=getTraiangleArea(20,30);

var_dump($area);
echo "一般的な関数で求めると面積はint型の{$area}です";



br();

/*
戻り値の型宣言
*/

/*
引数に型を指定できる上に、返り値に型を決めて返すことが可能になる
*/
function getTtiangleArea2(float $base,float $height) :float{
    return ($base*$height)/2.0;
}



$area2=getTtiangleArea2(20,'10');
var_dump($area2);
echo "PHP7で型付き関数の面積はfloat型の{$area2}です";
