<?php
    class User {
        public $id;
        public $firstName;
        public $lastName;
        public $email;
        public $password;
        public $streetAddress;
        public $postalCode;
        public $DOB;
        public $gender;
        public $cartHeld;
        
        
        public function __construct( $email,$password){
            
            $this->email=$email;
            $this->password=$password;         
        }
        
        /*
         *Load user from DB by email and password
         */
        
        public static function loadUser($dbc, $email,$pwd){
            
            require_once('../mysqli_connect.php');
            
            $query = "SELECT * FROM users WHERE email = ?";
            
            $stmt=mysqli_prepare($dbc,$query);
            if ( !$stmt ) {
                die('mysqli error: '.mysqli_error($dbc));
            }
            mysqli_stmt_bind_param($stmt,"s",$email);
            
            if ( !mysqli_stmt_execute($stmt)){
                die( 'stmt error1: '.mysqli_stmt_error($stmt) );
            }
            
            mysqli_stmt_bind_result($stmt, $uid, $firstName,$lastName,$email, $db_password, $streetAddress, $postalCode, $DOB, $gender,$cartHeld);
            
            while (mysqli_stmt_fetch($stmt)) {
                if(strcmp($db_password,$pwd)==0){
                    $instance= new self($email, $pwd);
                    $instance->id=$uid;
                    $instance->fill($firstName,$lastName, $streetAddress,$postalCode,$DOB,$gender,$cartHeld);
                    return $instance;
                    
                }else{
                    echo"Login Failed : Wrong Email password combination";
                }
            }
        }
        
        /*
         *Create a new User
         */
        
        public static function newUser($dbc, $fn, $ln,$email,$pwd,$sa,$pc,$DOB,$gender){
            $instance=new self($email,$pwd);
            $instance->fill($fn,$ln,$sa,$pc,$DOB,$gender);
            $instance->insertUser($dbc);
            return $instance;
        }
        
        public function newCart($dbc){
            require_once ('Cart.php');
            $cart=Cart::newCart($dbc,$this->id);
            $this->cartHeld=$cart->getID();
            return $cart;
        }
        
        public function loadCart($dbc){
            require_once ('Cart.php');
            $cart = Cart::loadCart($dbc, $cartHeld,$this->id);
            $this->cartHeld=$cart->getID();
            return $cart;
        }
        
        public function insertUser($dbc){
            
            require_once('../mysqli_connect.php');
            
            //Insert info into the database
            $query = "INSERT INTO users(firstName,lastName,email, password, streetAddress, postalCode, DOB, gender) VALUES (?,?,?,?,?,?,?,?)";
            //Prepare mysqli statement
            $stmt=mysqli_prepare($dbc, $query);
            if ( !$stmt ) {
                die('mysqli error1: '.mysqli_error($dbc));
            }
            
            //Bind parameters
            mysqli_stmt_bind_param($stmt, "ssssssds", $this->firstName,$this->lastName,$this->email,$this->password, $this->streetAddress, $this->postalCode, $this->DOB, $this->gender);
            if (!mysqli_execute($stmt) ) {
                die( 'stmt error2: '.mysqli_stmt_error($stmt) );
            }
            
            $this->id=mysqli_stmt_insert_id($stmt);
        }
        
        public function fill($firstName,$lastName,$streetAddress,$postalCode, $DOB, $gender){
            $this->firstName=$firstName;
            $this->lastName=$lastName;
            $this->streetAddress=$streetAddress;
            $this->postalCode=$postalCode;
            $this->DOB=$DOB;
            $this->gender=$gender;
        }
        
        
        public function printInfo(){
            echo "Name: ".$this->firstName." ".$this->lastName."<br/>";
            echo "Gender: ".$this->gender."<br/>";
            echo "Date of Birth: ".$this->DOB."<br/>";
            echo "Password: HA! Think I'd actually give it to you?"."<br/>";
            echo "Address:".$this->streetAddress."<br/>";
            echo "Postal Code: ".$this->postalCode."<br/>";
        }

        public function getID(){
            return $this->id;
        }
    }
?>