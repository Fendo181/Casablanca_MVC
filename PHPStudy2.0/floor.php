<?php

print floor(0.1+0.7); //0
print floor((0.1+0.7)*10); //7

/*
floor()は小数点以下を切り捨てる関数です。
しかし結果はなぜか7です。
内部的には2進数で計算が行われるので、誤差が生じて(7.9999999999999999991118)みたいな
結果的に7が出力されます。
*/

//ただしくはこうです。

/*
がこれを使うには

結局、php53-common conflicts with php-commonをアンインストールしてから、
php53-bcmath-5.3.3.1.el5_6.1.i386と、php53-common conflicts with php-common関連で
一緒にアンインストールされてしまったモジュールをアップグレードしてインストールし直しました。
http://detail.chiebukuro.yahoo.co.jp/qa/question_detail/q1066129675
です。

*/

$add = bcadd(0.1,0.7,1);
$mul = bcmul($add,10,1);

print floor($mul);