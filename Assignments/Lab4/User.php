<?php
    class User {
        public $firstName;
        public $lastName;
        public $email;
        public $password;
        public $confirmationPassword;
        public $streetAddress;
        public $postalCode;
        public $DOB;
        public $gender;
        
        
        public function __construct($firstName,$lastName, $email,$password, $confirmationPassword,$streetAddress,$postalCode, $DOB, $gender){
            $this->firstName=$firstName;
            $this->lastName=$lastName;
            $this->email=$email;
            $this->password=$password;
            $this->confirmationPassword=$confirmationPassword;
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

        
        
        
    }
?>