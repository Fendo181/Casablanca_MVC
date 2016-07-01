<?php

function br(){
    echo nl2br("\n");
}

class Skyrim{
    
    private static function br(){
        echo nl2br("\n");
    }
    
    
    
    private $name;
    private $type;
    
    //コンストラクラ
    
    public function __construct($name,$type){
        
        $this->name= $name;
        $this->type= $type;
    }
    
    public function getStatus(){
        echo $this->name;
        self::br();
        echo $this->type;
    }
   
}


$game=new Skyrim("高橋","炎");
$game->getStatus();





