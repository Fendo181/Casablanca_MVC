<?php

var_dump("Response.php");


class Response
{
    protected $content;
    protected $status_code = 200;
    protected $status_text = 'ok!';
    protected $http_headers = array();

    /*
    Ｒｅｓｐｏｎｓｅを送信
    */
    public function send()
    {

        header('HTTP/1.1 ' . $this->status_code . ' ' . $this->status_text);

        /* これ細かいけどダメパターンです。

        heder('HTTP/1.1 ') → 半角スペースいります！！
        header('HTTP/1.1' . $this->status_code . ' ' . $this->status_text);
        */


        foreach($this->http_headers as $name => $value){
            header($name. ': ' .$value);
        }

        echo $this->content;
    }

    public function setContent($content){
        $this->content=$content;
    }

    public function setStatusCode($status_code,$status_text= '')
    {
        $this->status_code =$status_code;
        $this->status_text =$status_text;
    }

    public function setHttpHeader($name,$value){
        $this->http_headers[$name] = $value;
    }
}
