<?php


function func_caller($name)
{
    if(function_exists($name)){
        $name();
    }
}

function foo()
{
    echo "Hy! Endo!";
}

#普通の関数呼び出し。
foo();

#可変関数における関数呼び出し。
func_caller('foo');

?>