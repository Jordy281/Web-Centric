<?php
    class Cart{
        public $id;
        public $holder;
        public $dateCreated;
        public $purchased;
        public $datePurchase;
        public $items;
        
        //Shipping Information
        public $shipTo;
        public $shipAddress;
        public $shipCity;
        public $shipCountry;
        
        // Eventually Add Billing information
        
        
        //Create the cart
        public function __construct($id, $holder){
            
            $id = $this->id;
            $holder=$this->holder;
            $dateCreated=date("Y-m-d",time());
            $purchased = false; 
        }
        
        public static function Reciept($id, $holder, $dateCreated,$purchased,$datePurchase, $items, $shipTo, $shipAddress, $shipCity, $shipCountry){
            $cart = new self();
            $cart->dateCreated = $this->dateCreated;
            $cart->purchased=$this->purchased;
            $cart->datePurchased=$this->datePurchase;
            $cart->items=$this->items;
            $cart->shipTo=$this->shipTo;
            $cart->shipAddress=$this->shipAddress;
            $cart->shipCity=$this->shipCity;
            $cart->shipCountry=$this->shipCountry;
            return $cart;
        }
        
        //add item to the cart
        public function addItem(Item $item){
            array_push($items, item);
        }
        
        //removes item from the cart
        public function removeItem(Item $item){
            $index=0;
            foreach ($thing as $items){
                if(strcmp($thing->name,$item->name)){
                    array_splice($items,$index,1);
                }
            }
        }
        
        //This function changes where to ship the package to
        public function shipOut($to, $sa, $scity, $scountry){
            $shipTo=$to;
            $shipAddress=$sa;
            $shipCity=$scity;
            $shipCountry=$scountry;
        }
        
        //This function is called on purcahse indicating the order is complete
        public function purchase(){
            $datePurchased=date("Y-m-d",time());
            $purchased=TRUE;
        }
        public function viewItems(){
            foreach($item as $items){
                echo '
                    <div class="row">
                        <div class="col-sm-6">
                            '.$item->name.'
                        </div>
                        <div class="col-sm-6">
                            '.$item->value.'
                        </div>
                    </div>
                ';
            }
        }
        
        public function cartTotal(){
            require_once('item.php');
            foreach($item as $items){
                $total=$total+$item->value;
            }
        }
        
        
    }
?>