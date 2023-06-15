<?php
    global $cart_id;
    $cart_id = 0;

    class User{
        private $user_id;
        private $name;
        private $email;
        private $ign;
        private $user_name;
        private $password;
        public $cart;

        public function __construct($user_id = 0, $name = '', $email = '', $ign = '', $user_name = '', $password = '', $cart = new Cart())
        {
            $this->user_id = $user_id;
            $this->name = $name;
            $this->ign = $ign;
            $this->user_name = $user_name;
            $this->password = $password;
            $this->cart = $cart;
        }

        public function getID(){return $this->user_id;}
        public function setID($newID){$this->user_id = $newID;}

        public function getName(){return $this->name;}
        public function setName($newName){$this->name = $newName;}

        public function getEmail(){return $this->email;}
        public function setEmail($newEmail){$this->email = $newEmail;}

        public function getIGN(){return $this->ign;}
        public function setIGN($newIGN){$this->ign = $newIGN;}

        public function getUName(){return $this->user_name;}
        public function setUName($newUname){$this->user_name = $newUname;}

        public function getPass(){return $this->password;}
        public function setPass($newPass){$this->password = $newPass;}
    }

    class Cart{ 
        public $cart_id;
        public $items;
        public $balance;
        
        public function __construct($cart_id = 0, $items = [], $balance = 0){
            $this->$cart_id;
            $this->$items;
            $this->$balance;
        }
    }

    class Item{
        public $item_id;
        public $price;
        public $image;

        public function __construct($item_id = 0, $price = 0, $image = ''){
            $this->item_id;
            $this->price;
            $this->image;
        }
    }

    class Transaction{
        public $user_id;
        public $cart_id;
        public $date;

        public function __construct($user_id = 0, $cart_id = 0, $date = ''){
            $this->user_id;
            $this->cart_id;
            $this->date;
        }
    }

    
?>