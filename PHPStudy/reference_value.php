<?php

//&(アンパサン)をつける
function add_one(&$value){
    $value +=1;
}

function br(){
    echo nl2br("\n");

}

$a=10;

echo "参照渡しする前のa".$a;
add_one($a);


br();

echo "参照渡しした後のa".$a;

?>