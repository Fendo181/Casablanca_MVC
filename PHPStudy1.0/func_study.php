<?php

/*

$array=array(1,2,3,4,5);

foreach ($array as $value){
    echo "$value";
}


$fluits_color=array(
    'apple' => 'red',
    'banana' => 'yellow',
    'orange' => 'orange',
);

foreach($fluits_color as $name=>$color){
    echo "$name is $color".":";
    
    if($color === "yellow"){
        break;
    }
}*/

function sayHello($name){
    
    echo "say hello $name";
}

function add($a,$b){
   
    $c=$a+$b;
    
   return $c;
}

sayHello("endo");
echo add(100,200);

//無名関数



add=function($v1,$v2){
  return $v1+$v2;
};

echo add(1,2)

?>