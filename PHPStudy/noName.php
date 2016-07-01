<?php

//無名関数

//#addは関数オブジェクト変数?
$add =function($v1,$v2){
    return $v1+$v2;
};

echo $add(1,2);

$array=array(
    '"ダブルクォート"',
    '<tag>',
    '\'シングルクオォート\'',
            );

#$escapedに無名関数でarray_mapを使いコールバック関数をつかっている
$escaped=array_map(function($value){
    return htmlspecialchars($value,ENT_QUOTES,'UTF-8');
},$array);

var_dump($array);
echo nl2br("\n");
echo "エスケープ処理後";
var_dump($escaped);