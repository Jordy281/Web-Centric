<?php
    class Item{
        public $name;
        //public $id;
        public $value;
        
        public function __construct($name, $value){
            $this->name=$name;
        //    $id=$this->id;
            $this->value=$value;
        }
    }
    
    
?>