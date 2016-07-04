<?php
//saticメソッドとは何か?

class PriceFormat{
    
    public static $endo;
    
    
    //static メソッド
    public static function formatJapan($price){
        
        $price =number_format($price);
        $price=$price.'円';
        
        return $price;
    }
    
    public static function formatBasic($price){
        
    
        $price=number_format($price);
        $price='＄'.$price;
        
    
        return $price;
    }

}

//クラス外からstaticメンバにアクセスする。

/*クラス名::メソッド名()
インスタンスを生成しなくても、アクセスできる。

*/

$price=PriceFormat::formatBasic(2000);
echo $price;


$price=PriceFormat::formatJapan(2000);
echo $price;

/*
staticメンバ変数にアクセスする。

クラス名::フィールド名
*/




?>