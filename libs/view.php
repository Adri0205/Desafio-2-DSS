
<?php 
 
class View{ 
    private $data = [];
 
    function __construct(){ 
        
    }
    
    public function __set($name, $value){
        $this->data[$name] = $value;
    }
    
    public function __get($name){
        return $this->data[$name] ?? null;
    }
 
    function renderView($vista){
        extract($this->data);
        require 'views/' . $vista; 
    } 
 
}
?> 