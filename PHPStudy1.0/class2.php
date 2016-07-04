<?php

function br(){
    echo nl2br("\n");
}

class Hello{
    
  
    
    //クラス外からアクセスできる。
     public $item = "banan";
    
    //クラス内のみしかアクセスできない
    private $hp = "100";
    
    /*
    sataic(静的)なプロパティはオブジェクトによらずこのクラス内の共通の変数なものです
    つまりは書き換えはしなくてもいい変数を置く。
    */
    public static $name ="Yamato";
    
    
    
    public function sayHi(){
        echo "Sayhi!";
    }
    
    //publicなプロパティにアクセスするメソッド
    public function getItem(){
        echo $this->item;
    }
        
    //privateなプロパティにアクセスするメソッド
    public function getHp(){
        /* echo $hp;これはエラーがおきます。
        なぜなら、pravateをつけてクラス内で使うには$thisをつけて
        $thisはクラスのインスタンス生成時に、自分自身のオブジェクトのプロパティやメソッドの参照を行います。
        URL:http://php.net/manual/ja/language.oop5.visibility.php
        */
        echo $this->hp;
    }
    
    
    
}

    //インスタンス生成=objectを作る
    $RPG = new Hello();
    
    //メソッド呼び出し=->(アロー)
    $RPG->sayHi();
    br();

    //プロパティ呼び出し
    echo "クラス外からアロー演算子でプロパティ呼び出し".$RPG->item;
    
    br();
    //値をゲッター呼び出し
    echo "クラス外からゲッターメソッドでプロパティ呼び出し";
    $RPG->getItem();
    br();

    //echo $yamada->HP; //privateだから見れません
    $RPG->getHp();br(); //これならprivaetのプロパティを間接的に閲覧する事が可能です。
    br();

    //staticメソッド呼び出しクラス名::$プロパティ名
    echo "主人公の名前は".Hello::$name; //主人公の名前はYamato




    



    

    
?>