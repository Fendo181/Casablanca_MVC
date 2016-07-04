<?php


//普通の関数
function foo() {
    echo "foo!";
}

//普通関数呼び出し
foo();

//無名関数
$bar=function(){
    echo "bar!";
};//ここにセミコロンいれますね


//無名関数呼び出し
$bar();

?>
