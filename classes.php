<?php
    global $cart_id;
    $cart_id = 0;

    class User{
        private $user_id;
        private $name;
        private $email;
        private $ign;
        private $user_name;
        private $pass;
        private $transactions;
        public $cart;

        public function __construct($user_id = 0, $name = '', $email = '', $ign = '', $user_name = '', $pass = '', $cart = new Cart(), $transactions = array())
        {
            $this->user_id = $user_id;
            $this->name = $name;
            $this->ign = $ign;
            $this->user_name = $user_name;
            $this->pass = $pass;
            $this->cart = $cart;
            $this->transactions = $transactions;
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

        public function getPass(){return $this->pass;}
        public function setPass($newPass){$this->pass = $newPass;}

        public function displayCart(){
            echo "<pre>";
            print_r($this->cart->items);
            echo "</pre>";
        }

        public function addtoCart($items, $id){
            if($items[$id]["stock"] >= 1){
                $this->cart->items[$id] = $items[$id];
                $items[$id]["stock"] -= 1;
            }

            else{
                echo "item out of stock";
            }
        }
        
        public function removefromCart($items, $id){
            $this->cart->items[$id]
        }
    }

    class Cart{ 
        public $items;
        public $balance;
        
        public function __construct($items = array(), $balance = 0){
            $this->items = $items;
            $this->balance = $balance;
        }

        public function generateID(){
        }
    }

    class Item{
        public $item_id;
        public $item_name;
        public $stock;
        public $price;
        public $image;

        public function __construct($item_id = 0,$item_name = '',$stock = 0,$price = 0, $image = ''){
            $this->item_id = $item_id;
            $this->item_name = $item_name;
            $this->stock = $stock;
            $this->price = $price;
            $this->image = $image;
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

    //Converting CSV into array of all items(inventory)
    $header = null;
    $items = array();

    if (($file = fopen("Items.csv", 'r')) !== false) {
        while (($row = fgetcsv($file, 1000, ",")) !== false) {
            if (!$header) {
                $header = $row;
            } else {
                $data = array_combine($header, $row);
                $item = new Item($data['Id'], $data['Name'], (int)$data['Stock'], (int)$data['Price'], $data['Image']);
                $items[] = $item;
            }
        }
        fclose($file);
    }
?>