<?php

/*
抽象クラスとは、他のクラスで継承してもらうことを前提としたクラス。
抽象クラス自体をインスタンス化することはできません。

コードの共通化ができたりコード量が減らせたりするなど「便利だから存在する」と言うよりは、構築していくシステムの『概念』をより正確に定義しコードを分かりやすくするための概念です。

抽象クラスはそういう基底クラスを設計する時に登場する概念です。何度も繰り返しますが、そんな風に性質を引き継がないといけないような概念はそう多くないので、システムを構築するような場合はあまり登場しないのではないでしょうか。


*/

function br()
{
    echo nl2br("\n");
}


//抽象的親クラス
abstract class AbClass
{
    //宣言のみ
    abstract protected function getValue();
    
    
    //宣言のみ
    abstract protected function fixValue($prefix);
    
    //common method
    public function printout(){
        print $this->getValue();
    }
    
}

//abstrctクラスを継承する

class testClass1 extends AbClass
{
    //protected
    protected function getValue(){
        return "testClass1";
    }
    
    //public
    public function fixValue($prefix){
        return "{$prefix}testClass1";
    }
}

class testClass2 extends AbClass
{
    //protected
    protected function getValue(){
        return "testClass2";
    }
    
    //public
    public function fixValue($prefix){
        return "{$prefix}testClass2";
    }
}

/*
インスタンス
*/

$class1= new testClass1;
$class1->printout(); //abstrctクラスのメソッド
br();
echo $class1->fixValue('Endo!');

br();

$class2=new testClass2;
$class2->printout();
br();
echo $class2->fixValue('Skyrim!');

?>