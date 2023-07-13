<?php   
    //Getting items from database and storing in an array "$raw_inventory"
    require_once("connection.php");
    $query = "SELECT * FROM items";
    $result = $conn->query($query);
    $raw_inventory = $result->fetch_all(MYSQLI_ASSOC);
    $inventory = array();

    //Getting coins form database and storing in array "$coin_inventory"
    $query = "SELECT * FROM coins";
    $result = $conn->query($query);
    $coin_inventory = $result->fetch_all(MYSQLI_ASSOC);

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

        public function __construct($user_id = 0, $name = '', $email = '', $ign = '', $user_name = '', $balance = 0, $pass = '', $cart = new Cart(), $transactions = array()){
            $this->user_id = $user_id;
            $this->name = $name;
            $this->ign = $ign;
            $this->user_name = $user_name;
            $this->pass = $pass;
            $this->cart = $cart;
            $this->balance = $balance;
            $this->transactions = $transactions;
            foreach()
        }

        public function getID(){return $this->user_id;}

        public function getName(){return $this->name;}

        public function getEmail(){return $this->email;}

        public function getIGN(){return $this->ign;}

        public function getUName(){return $this->user_name;}

        public function getPass(){return $this->pass;}
        public function changePass($oldpass, $newpass, $confirmpass){
            global $conn;
            if($oldpass == $this->pass){
                if(strlen($newpass) >= 8 && $newpass != $oldpass){
                    if($newpass == $confirmpass){
                        $query = "UPDATE users SET pass = '$newpass' WHERE user_name = '$this->user_name'";
                        $conn->query($query);

                        return "Password successfully changed";
                    }

                    else{
                        return "New password confirmation failed";
                    }
                }
                else{
                    return "Password should be atleast 8 characters long, and not equal to old password";
                }
            }

            else{
                return "Wrong password";
            }
        }

        public function getTransactions(){
            global $conn;
            $query = "SELECT * FROM transactions;";
            $result = $conn->query($query);
            $result->fetch_all(MYSQLI_ASSOC);

            return $result;
        }

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
                $transaction = new Transaction($this->user_id, $this->generateCartId(), $this->cart->total);
                $transaction->complete();
                $this->transactions[] = $transaction;
                $this->balance -= $this->cart->total;
                $this->cart->items = array();
                $this->cart->total = 0;
            }

            else{
                echo 'Sorry, you have insufficient balance to complete this transactions';
            }
        }

        public function completePayment($bill){
            $bill = $bill." Pesos";
            $transaction = new Transaction($this->user_id, $this->generateCartId(), $bill);
            $this->transactions[] = $transaction;
            $this->balance -= $this->cart->total;
            $this->cart->items = array();
            $this->cart->total = 0;
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
        public $bill;
        public $date;

        public function __construct($user_id = 0, $cart_id = '',$bill = ''){
            $this->user_id = strval($user_id);
            $this->cart_id = $cart_id;
            $this->bill = $bill;
            $this->date = date("Y-m-d H:i:s");
        }

        public function complete(){
            global $conn;
            $query = "INSERT INTO transactions (user_id, cart_id, transaction_date, bill)
                      VALUES ($this->user_id, '$this->cart_id', '$this->date', $this->bill);";
            $conn->query($query);
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

    function registerUser(){
        global $conn;
        $user = $_POST;
        $invalid_input = 0;
        $regex = array(
            "name" => "/^[a-zA-Z_\s'\.]*$/",
            "user_name" => "/^[a-zA-Z0-9#!\?\*_\s'-\.]+$/",
            "ign" => "/^\d{4}-\d{4}-\d{4}$/",
            "email" => "/^[a-zZ-a0-9._]+@[a-zA-Z0-9.-]+[\.][a-zA-Z]{2,}$/",
            "pass" => "/^.{8,}$/",    
            "cpass" => "/^.{8,}$/"
        );

        if($user['pass'] != $user['cpass']){
            return "User not registered: Password confirmation failed";
        }

        $alert_message = "User not registered: Invalid inputs for";
        foreach ($user as $key=>$value){
            if(!preg_match($regex[$key], $value)){  
                $alert_message .= " -$key";
                $invalid_input += 1;
            }
        }

        if(!$invalid_input){
            require_once('connection.php');
            $name = $user['name'];
            $user_name = $user['user_name'];
            $ign = $user['ign'];
            $email = $user['email'];
            $pass = $user['pass'];
            $query = "INSERT INTO users (name, user_name, ign, email, pass) VALUES ('$name', '$user_name', '$ign', '$email', '$pass')";
            $conn->query($query);
        }

        return $alert_message;
    }

    function signInUser($user){
        global $conn;
        $valid_user = false;

        $user_name = $user['user_name'];
        $pass = $user['pass'];
        $query = "SELECT * FROM users WHERE user_name = '$user_name' AND pass = '$pass'";
        $result = $conn->query($query);

        if($result->num_rows > 0){
            $rows = $result->fetch_all(MYSQLI_ASSOC);
            $user = $rows[0];
            $valid_user = true;

            $_SESSION['user'] = new User($user['user_id'],$user['name'],$user['email'],$user['ign'],$user['user_name'],$user['balance'],$user['pass']);
        }

        return $valid_user;
    }
?>