<?php

/*
$str = "He i's teacher"; //ok
$str = 'he i's teacher'; //error
print $str;

*/

$str = "endo";

/*

ヒアドキュメントです。

EODとかはなんでもいい。
また、<<<ですよ!

<<<'EDO'は変数の中身を展開しない。
*/
$msg= <<<EOD
{$str}は毎違いなく!<br />
hogeです。
EOD;

print $msg;
