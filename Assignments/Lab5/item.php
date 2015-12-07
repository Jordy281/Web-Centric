<?php
    class Item{
        public $name;
        public $id;
        public $value;
        public $cartID;
        
        public function __construct($name, $value){
            $this->name=$name;
            $this->value=$value;
        }
    }
    
    public function insert($dbc,$cid){
            
        $query = "INSERT INTO basket(cartID,itemName,Value) VALUES(?,?,?)";
        
        $stmt=mysqli_prepare($dbc, $query);
                
        if ( !$stmt ) {
            die('mysqli error: '.mysqli_error($dbc));
        }
                
        mysqli_stmt_bind_param($stmt, "dsd", $cid,$this->name,$this->value);
                
        if ( !mysqli_execute($stmt) ) {
            die( 'stmt error: '.mysqli_stmt_error($stmt) );
        }
        
        $this->id=mysqli_stmt_insert_id($stmt);
    }
    
    public function load($dbc,$cid){
        $query = "SELECT * FROM basket WHERE cartID=?"
        $stmt=mysqli_prepare($dbc,$query);
        
        if ( !$stmt ) {
            die('mysqli error: '.mysqli_error($dbc));
        }
        
        mysqli_stmt_bind_param($stmt,"d",$cid);
        
        if ( !mysqli_execute($stmt) ) {
            die( 'stmt error: '.mysqli_stmt_error($stmt) );
        }
        
        mysqli_stmt_bind_result($stmt, $id, $name,$value);
        $items= array();
        while (mysqli_stmt_fetch($stmt)) {
            $item = new Item($name,$value);
            array_push($items,$name);
        }
        //return array
        return $items;
    }

        
    }
    
    
?>
