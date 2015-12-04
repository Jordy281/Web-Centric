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
        
        
        public function __construct($id, $firstName,$lastName, $email,$password,$streetAddress,$postalCode, $DOB, $gender){
            $this->id=$id;
            $this->firstName=$firstName;
            $this->lastName=$lastName;
            $this->email=$email;
            $this->password=$password;
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
        
        public function sessionUser(){
            session_start();
            $_SESSION["id"]=$this->id;
            $_SESSION["firstName"]=$this->firstName;
            $_SESSION["lastName"]=$this->lastName;
            $_SESSION["email"]=$this->email;
            $_SESSION["password"]=$this->password;
            $_SESSION["streetAddress"]=$this->streetAddress;
            $_SESSION["postalCode"]=$this->postalCode;
            $_SESSION["DOB"]=$this->DOB;
            $_SESSION["gender"]=$this->gender;
        }

        
        
        
    }
?>