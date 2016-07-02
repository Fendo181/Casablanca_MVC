<?php

class View
{

    protected $base_dir;
    protected $default;
    protected $layouts_variablse = array();
    
    /*
    これはコンストラクタでね。
    
    
    */
    public function __construct($base_dir,$defau = array()){
        $this -> base_dir =$base_dir;
        $this -> defaults =$default;
    }
    
    public function setLayoutVar($name,$value){
        $this ->layout_variables[$name] = $value;
    }
    
    /*
    render メソッド
    
    実際にViewファイルを読み込む事が可能です。
    
    */
    public function render($_path,$_variables = array(),$_layout = false){
        $_file = $this ->base_dir.'/'.$_path.'.php';
        
        extract(array_merge($this->defaults,$_variables));
        
        
        /*
        
        アウトプットバッファリングって何?
        */
        
        ob_start();
        ob_implicit_flush(0);
        
        require $_file;
        
        $countent = ob_get_clean();
        
        if($_layout){
            $countent = $this->render($_layout,
                                      array_merge($this->layout_variables,array(
                                          '_content' => $content,
                                          )
                                      ));
        }
        
        return $content;
        
        }
    
    public function escape($string){
        return htmlspecialchars($string,ENT_QUOTES,'UTF-8');
    }
   
}
