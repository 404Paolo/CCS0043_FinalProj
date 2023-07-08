<?php   
    //Getting items from database and storing in an array "$inventory"
    require_once("connection.php");
    $query = "SELECT * FROM items";
    $result = $conn->query($query);
    $raw_inventory = $result->fetch_all(MYSQLI_ASSOC);
    $inventory = array();
    //Organizes sql result into categories
    foreach($raw_inventory as $key=>$item){
      $category = $item['category'];
  
      if(!array_key_exists($category, $inventory)){$inventory[$category] = array();}
  
      $inventory[$category][$item['id']] = $item['id'];
    }

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
            print($this->cart->balance);
        }

        public function displayInventory(){
            global $inventory;
            echo "<pre>";
            print_r($inventory);
            echo "</pre>";
        }

        public function addtoCart($id){
            global $inventory;

            if($inventory[$id]["stock"] >= 1){
                $this->cart->items[] = $id;
                $this->cart->balance += $inventory[$id]["price"];
                sort($this->cart->items);
                $inventory[$id]["stock"] -= 1;
            }

            else{
                echo "item out of stock";
            }
        }
        
        public function removefromCart($id){
            global $inventory;
            foreach($this->cart->items as $i=>$item_id){
                if($item_id == $id){
                    unset($this->cart->items[$i]);
                    $this->cart->balance -= $inventory[$id]["price"];
                    $inventory[$id]["stock"] += 1;
                    break;
                }
            }
        }

        public function generateCartId(){
            $base = 40;
            $num = 0;
            $items = array();
            $len = count($this->cart->items);

            foreach($this->cart->items as $n=>$id){
                $num += ($id * pow($base, $len - ($n+1)));
            }

            return dechex($num);
        }
        
        public function decryptCartId($num){
            $num = hexdec($num);
            $txt = $this->recurse($num);
            return str_split($txt);
        }

        private function recurse($num){
            $base = 40;
            if($num <= $base){
                return strval($num%$base);
            }

            else{
                return strval($this->recurse($num/$base)).strval($num%$base);
            }
        }
    }

    class Cart{ 
        public $items;
        public $balance;
        
        public function __construct($items = array(), $balance = 0){
            $this->items = $items;
            $this->balance = $balance;
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

    //Search function
    function searchItem($itemName){
        global $inventory;
        $items_found = array();
        foreach($inventory as $id => $item){
            if(str_contains(strtolower($item["name"]), strtolower($itemName))){
                $items_found[$item["id"]] = $item;
            }
        }

        if(!$items_found){
            print("Sorry no items found");
        }

        else{
            echo "<pre>";
            print_r($items_found);
            echo "</pre>";
        }
    }
?>