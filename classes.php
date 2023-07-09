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
        private $balance;
        public $cart;

        public function __construct($user_id = 0, $name = '', $email = '', $ign = '', $user_name = '', $balance = 0, $pass = '', $cart = new Cart(), $transactions = array())
        {
            $this->user_id = $user_id;
            $this->name = $name;
            $this->ign = $ign;
            $this->user_name = $user_name;
            $this->pass = $pass;
            $this->cart = $cart;
            $this->balance = $balance;
            $this->transactions = $transactions;
        }

        public function getID(){return $this->user_id;}
        // public function setID($newID){$this->user_id = $newID;}

        public function getName(){return $this->name;}
        // public function setName($newName){$this->name = $newName;}

        public function getEmail(){return $this->email;}
        // public function setEmail($newEmail){$this->email = $newEmail;}

        public function getIGN(){return $this->ign;}
        // public function setIGN($newIGN){$this->ign = $newIGN;}

        public function getUName(){return $this->user_name;}
        // public function setUName($newUname){$this->user_name = $newUname;}

        public function getPass(){return $this->pass;}
        // public function setPass($newPass){$this->pass = $newPass;}

        public function displayCart(){
            echo "<pre>";
            print_r($this->cart->items);
            echo "</pre>";
            print($this->cart->total);
        }

        public function displayInventory(){
            global $raw_inventory;
            echo "<pre>";
            print_r($raw_inventory);
            echo "</pre>";
        }

        public function displayTransactions(){
            echo "<pre>";
            print_r($this->transactions);
            echo "</pre>";
        }

        public function addtoCart($id){
            global $raw_inventory;

            if($raw_inventory[$id]["stock"] >= 1){
                $this->cart->items[] = $id;
                $this->cart->total += $raw_inventory[$id]["price"];
                sort($this->cart->items);
                $raw_inventory[$id]["stock"] -= 1;
            }

            else{
                echo "item out of stock";
            }
        } 
        
        public function removefromCart($id){
            global $raw_inventory;
            foreach($this->cart->items as $i=>$item_id){
                if($item_id == $id){
                    unset($this->cart->items[$i]);
                    $this->cart->total -= $raw_inventory[$id]["price"];
                    $raw_inventory[$id]["stock"] += 1;
                    break;
                }
            }
        }

        public function generateCartId(){
            global $raw_inventory;
            $base = count($raw_inventory);
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

        public function completeTransaction(){
            if($this->balance >= $this->cart->total){
                $transaction = new Transaction($this->user_id, $this->generateCartId());
                $this->transactions[] = $transaction;
                $this->balance -= $this->cart->total;

                $this->cart->items = array();
                $this->cart->total = 0;
            }

            else{
                echo 'Sorry, you have insufficient balance to complete this transactions';
            }
        }
    }

    class Cart{ 
        public $items;
        public $total;
        
        public function __construct($items = array(), $total = 0){
            $this->items = $items;
            $this->total = $total;
        }
    }

    class Transaction{
        public $user_id;
        public $cart_id;
        public $date;

        public function __construct($user_id = 0, $cart_id = ''){
            $this->user_id = strval($user_id);
            $this->cart_id = $cart_id;
            $this->date =  date("Y-m-d H:i:s");
        }

        public function generateTransactionID(){
            return $this->user_id.'_'.$this->cart_id.'_'.$this->date;
        }
    }

    //Search function
    function searchItem($itemName){
        global $raw_inventory;
        $raw_items_found = array();
        foreach($raw_inventory as $id => $item){
            if(str_contains(strtolower($item["name"]), strtolower($itemName))){
                $raw_items_found[$item["id"]] = $item;
            }
        }

        if(!$raw_items_found){
            return 0;
        }

        else{
            $items_found = array();
            foreach($raw_items_found as $key=>$item){
                $category = $item['category'];
            
                if(!array_key_exists($category, $items_found)){$items_found[$category] = array();}
            
                $items_found[$category][$item['id']] = $item['id'];
            }

            return $items_found;
        }
    }
?>