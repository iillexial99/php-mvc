<?php
namespace Loader;

class Loader{
    
    public function view($view){
        if(file_exists($view)){
            require_once('Core/Views/'.$view);
        }
        else{
            throw new \Exception("$view view load error");
        }
    }
    
    
    
}
