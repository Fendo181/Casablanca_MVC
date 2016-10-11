<?php

class View
{

    protected $base_dir;
    protected $defaults;
    protected $layouts_variablse = array();

    public function __construct($base_dir,$defaults = array()){
        $this -> base_dir =$base_dir;
        $this -> defaults =$defaults;
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
        >
         出力情報を内部にバッファリングする為の機能です。`ob_start関数`を呼び出すと
         アウトプットバッファリングを開始します。
        */

        ob_start();

        /*
        バッファの自動フラッシュを制御する関数です。0を渡して自動フラッシュを無効にします。
        ここで自動フラッシュを有効にすると、バッファの容量を超えた際などにバッファの内容が自動的に
        出力されてしまします。文字列と取得し、最期にまとめて主力する為、ここでは自動フラッシュいを
        無効にしています。
        */
        ob_implicit_flush(0);

        require $_file;
        /*
        `ob_get_clean()`を使えば、内部にレンダリングされたバッファをそのままコンテンツ
        として、保持する事が可能となります。
        */
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
