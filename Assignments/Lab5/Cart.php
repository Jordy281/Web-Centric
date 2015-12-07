<?php
    class Cart{
        public $id;
        public $holder;
        public $purchased;
        public $datePurchase;
        public $items;
        
        //Create the cart
        public function __construct($holder){
                $this->holder=$holder;
                $this->purchased = 0;
                $this->items=array();
            
        }
        
        public static function newCart($dbc,$holder){
            $instance = new self($holder);
            $instance->insertCart($dbc,$holder);
            return $instance;
        }
        
        public static function loadCart($dbc, $id,$holder){
            $instance = new self($holder);
            $instance->loadByID($dbc,$id);
            $instance->loadItems($dbc);
            return $instance;
        }
        
        public function loadItems($dbc){
            $query = "SELECT * FROM basket WHERE cartID=?"
            $stmt=mysqli_prepare($dbc,$query);
            
            if ( !$stmt ) {
                die('mysqli error: '.mysqli_error($dbc));
            }
            
            mysqli_stmt_bind_param($stmt,"d",$this->id);
            
            if ( !mysqli_execute($stmt) ) {
                die( 'stmt error: '.mysqli_stmt_error($stmt) );
            }
            
            mysqli_stmt_bind_result($stmt, $id, $name,$value,$cartID);
            $items= array();
            while (mysqli_stmt_fetch($stmt)) {
                $item = new Item($name,$value);
                array_push($this->items,$item);
            }
        }
        
        
        public function saveCart($dbc){
            foreach($this->items as $item){
                $item->saveItem($dbc, $this->id);
            }
        }
        
            
        public function fill($stmt){
            while (mysqli_stmt_fetch($stmt)) {
                $this->id= $uid;
                $this->holder=$holder;
                $this->purchased=$purchased;
                $this->datePurchased=$datePurchase;
            }
        }
        
        
        //add item to the cart
        public function addItem($item){
            array_push($this->items, $item);
        }
        
        //removes item from the cart
        public function removeItem(Item $item){
            $index=0;
            foreach ($items as $thing){
                if(strcmp($thing->name,$item->name)){
                    array_splice($items,$index,1);
                }
            }
        }
        
        //This function is called on purcahse indicating the order is complete
        public function purchase($BFN,$BLN,$email,$BSA,$BC,$BCoun, $BPC, $SFN,$SLN,$SSA,$SC,$SCoun,$SPC){
            $this->newTransaction($BFN,$BLN,$email,$BSA,$BC,$BCoun, $BPC, $SFN,$SLN,$SSA,$SC,$SCoun,$SPC);
            $this->datePurchased=time();
            $this->purchased=1;
        }
        
        public function newTransaction($BFN,$BLN,$email,$BSA,$BC,$BCoun, $BPC, $SFN,$SLN,$SSA,$SC,$SCoun,$SPC){
            $query = "INSERT INTO transactions(pid,BFN,BLN,Email,BSA,BC,BCoun,BPC,SFN,SLN,SSA,SC,SCoun,SPC,items) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        
            $stmt=mysqli_prepare($dbc, $query);
    		
            if ( !$stmt ) {
                die('mysqli error: '.mysqli_error($dbc));
            }
    
            mysqli_stmt_bind_param($stmt, "dssssssssssssss", $this->holder,$BFN,$BLN,$email,$BSA,$BC,$BCoun, $BPC, $SFN,$SLN,$SSA,$SC,$SCoun, $SPC, $this->items);
    
    		if ( !mysqli_execute($stmt) ) {
                die( 'stmt error: '.mysqli_stmt_error($stmt) );
            }
        }
        
        /*
         * View Items in the cart
         *
         */
        public function viewItems(){
            require_once('Item.php');
                foreach($this->items as $item){
                    echo '
                        <div class="row">
                            <div class="col-sm-6" style="padding-left: 5%">
                                '.$item->name.'
                            </div>
                            <div class="col-sm-6 col-centered" style="padding-left: 5%">
                                '.$item->value.'
                            </div>
                        </div>
                    ';
                }
        }
        
        /*
         *Sum items in the cart
         */
        public function cartTotal(){
            require_once('Item.php');
            $total=0;
            
            foreach($this->items as $item){
                $total=$total+$item->value;
            }
            
            
            return $total;
        }
        
        /*
         * Load cart from DB by id
         *
         */
        
        public function loadByID($dbc, $id){
            
            $query = "SELECT * FROM carts WHERE id = ?";
            $stmt=mysqli_prepare($dbc,$query);
            if ( !$stmt ) {
                die('mysqli error: '.mysqli_error($dbc));
            }
            mysqli_stmt_bind_param($stmt,"d",$id);
            
            if ( !mysqli_stmt_execute($stmt)){
                die( 'stmt error1: '.mysqli_stmt_error($stmt) );
            }
            
            mysqli_stmt_bind_result($stmt, $uid, $holder, $dateCreated,$purchased,$datePurchase, $items);
            
            $this->fill($stmt);
        }
        /*
         *Insert cart into the database
         */
        public function insertCart($dbc, $holder){
            
            require_once('../mysqli_connect.php');
            
            //Make a new cart and save it to the DB
            //Insert info into the database, output the id of created row
            $query = "INSERT INTO carts (holder,purchased) VALUES (?,'0')";
            //Prepare mysqli statement
            $stmt=mysqli_prepare($dbc, $query);
            if ( !$stmt ) {
                die('mysqli error5: '.mysqli_error($dbc));
            }
            
            //Bind parameters
            mysqli_stmt_bind_param($stmt, "d", $holder);
            if ( !mysqli_execute($stmt) ) {
                die( 'stmt error6: '.mysqli_stmt_error($stmt) );
            }
            
            $this->id=mysqli_stmt_insert_id($stmt);
            
        }
        
        
        
        public function getID(){
            return $this->id;
        }
        
        
        
    }
?>
