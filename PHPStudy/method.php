<?php

function br(){
    echo nl2br("\n");
}

class Skyrim{
    
    
    private static $name = "endo";
    
    //staticメソッド
    public static function sayHi(){
        echo "sayHi";
    }
    
    public static function getName(){
        return self::$name;
    }
    
    public static function setName($value){
        self::$name = $value;
    }
}


Skyrim::sayHi(); //staticメソッド
br();
echo "ゲッター値は".Skyrim::getName(); br();
Skyrim::setName("Takahashi");
echo "セッターで入れ替えた後の値は".Skyrim::getName(); br();

