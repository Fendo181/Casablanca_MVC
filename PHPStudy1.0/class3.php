<?php

function br(){
    echo nl2br("\n");
}

class Skyrim{
    
    /*
    self
    selfはクラスコンテキスト内部では、そのクラス自身を刺し示しま
    */
    
    public static $town = "ノルドの地";
    
    public function getTown(){
        
        echo self::$town; //クラス内でstaticを使う時はthisではなく、selfですね
    }

    /*
    
    const　で定義します。
    
    クラス定数(変数ではないので$はいらない。)
    定数の用いることができるのはスカラ値です。
    クラス定数が主に使われるのはそのクラスの初期化時に用いられる
    設定のブラウザや、オプションに対応する定数などに用いられます。
    
    */
    const USERNAME = "Endo";
    const FOLLOWE = "takeshi";
}

//クラス定数はクラス名に::と定数名を用いてアクセスします。


echo Skyrim::USERNAME; //※staticと違って$がいらない

/*
Class定数 値を変更できない&&呼び出しに$がいらない
static変数 値を変更できる&&呼び出しに$がいる。

*/

$test = new Skyrim(); br();
$test->getTown(); br();
echo Skyrim::$town;