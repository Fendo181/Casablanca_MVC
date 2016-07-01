<?php

Class Router{
    
    
    public function resolve($path_info){
        
        if('/' !==substr($path_info,0,1)){
            $path_info='/'.$path_info;
        }
        
        foreach($this->routes as $pattern => $params){
            if(preg_match('#^'.$pattern. '$#',$path_info,$matches)){
                $params = array_merge($params,$matches);
                
                return $params;
            }
        }
        
        return false;
        
    }
}

?>