<?php

/*
配列改めて
*/


function br(){
    echo nl2br("\n");
}

/*
最後は,をつけてもつけなくてもよい。

arrayとつけなくてもいいのか!
*/

//ブラケット構文
$data = ['山田','田中','佐藤'];

//配列の中身を見るときはprint_r文でいい
print_r($data[0]);
print_r($data[2]);

br();

print_r ($data);
