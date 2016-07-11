<?php

/*
ところで、PHPのinterfaceはあくまで宣言時に型が決まり、偶然同じシグネチャを持っていても同じ型だとは見なされません。こういう性質を公称型と呼びます。

構造的部分型は静的なダックタイピングであると言われることがあります。公称型はあくまで宣言時に書いてあることしか信用しないので、お役所的というか、融通が利かないイメージです。個人的には、構造的部分型の方が中身を見てくれるので柔軟で便利な気がしています。
*/

interface FooInterface {
    public function doSomething();
}

interface MooInterface {
    public function doSomething();
}

class Hoge implements FooInterface {
    public function doSomething() { }
}

$hoge = new Hoge;

var_dump($hoge instanceof FooInterface); // true
var_dump($hoge instanceof MooInterface); // false. 同じシグネチャを持っているけど別の型