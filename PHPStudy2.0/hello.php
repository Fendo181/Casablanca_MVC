<?php

function br(){
    echo nl2br("\n");
}

$msg= "Endo"; //変数の初期化

print $msg."Hello php Year";

/*可変変数とは

[変数名を変数の値によって決める]事が出来る変数です。
先頭に$$をつけることで、変数を別の変数に能動的に決定します。
*/
br();

$x='title';

$title = 'PHP:Hypertext Preprocessor'; 

print $$x; //PHP:Hypertext Preprocessor

/*
可変変数 おもろいなぁ。。。

もしかするとこれでフレームワークの名前解決できるんじゃね?
*/

/*

PHPには27の予約語がある。

*/
