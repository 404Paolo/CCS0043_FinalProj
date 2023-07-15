<?php
require_once("connection.php");
$query = "SELECT * FROM items";
$result = $conn->query($query);
$raw_inventory = $result->fetch_all(MYSQLI_ASSOC);
$inventory = array();

$query = "SELECT * FROM coins";
$result = $conn->query($query);
$coin_inventory = $result->fetch_all(MYSQLI_ASSOC);

foreach ($raw_inventory as $key => $item) {
    $category = $item['category'];

    if (!array_key_exists($category, $inventory)) {
        $inventory[$category] = array();
    }

    $inventory[$category][$item['id']] = $item['id'];
}

class User
{
    private $user_id;
    private $name;
    private $email;
    private $ign;
    private $user_name;
    private $pass;
    private $transactions;
    private $balance;
    public $cart;
    public $coin_cart;

    public function __construct($user_id = 0, $name = '', $email = '', $ign = '', $user_name = '', $balance = 0, $pass = '', $cart = new Cart(), $transactions = array())
    {
        $this->user_id = $user_id;
        $this->name = $name;
        $this->ign = $ign;
        $this->user_name = $user_name;
        $this->email = $email;
        $this->pass = $pass;
        $this->cart = $cart;
        $this->coin_cart = new Cart();
        $this->balance = $balance;
        $this->transactions = $transactions;
    }

    public function getID()
    {
        return $this->user_id;
    }
    public function getName()
    {
        return $this->name;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getIGN()
    {
        return $this->ign;
    }
    public function getUName()
    {
        return $this->user_name;
    }
    public function getBalance()
    {
        return $this->balance;
    }
    public function getPass()
    {
        return $this->pass;
    }
    public function getCartCount()
    {
        return count($this->cart->items);
    }
    public function changePass($oldpass, $newpass, $confirmpass)
    {
        global $conn;
        if ($oldpass == $this->pass) {
            if ($newpass != $oldpass) {
                if ($newpass == $confirmpass) {
                    $this->pass = $newpass;
                    $query = "UPDATE users SET pass = '$this->pass' WHERE user_name = '$this->user_name'";
                    $conn->query($query);

                    return "Password successfully changed";
                } else {
                    return "Password not changed: Confirmation failed";
                }
            } else {
                return "Password not changed: New passwordd should not be equal to old password";
            }
        } else {
            return "Password not changed: Old password incorrect";
        }
    }

    public function getTransactions()
    {
        return $this->transactions;
    }

    public function displayCart()
    {
        echo "<pre>";
        print_r($this->cart->items);
        echo "</pre>";
        print($this->cart->total);
    }

    public function displayInventory()
    {
        global $raw_inventory;
        echo "<pre>";
        print_r($raw_inventory);
        echo "</pre>";
    }

    public function displayTransactions()
    {
        echo "<pre>";
        print_r($this->transactions);
        echo "</pre>";
    }

    public function addtoCart($id)
    {
        global $raw_inventory;
        global $conn;
        if ($raw_inventory[$id]["stock"] >= 1) {
            $this->cart->items[] = $id;
            $this->cart->total += $raw_inventory[$id]["price"];
            sort($this->cart->items);
            $raw_inventory[$id]["stock"] -= 1;
            $conn->query("UPDATE items SET stock = stock - 1 WHERE id = $id;");

            return true;
        }
        
        else {
            return false;
        }
    }

    public function removeFromCart($search_id)
    {
        global $raw_inventory;
        global $conn;
        foreach ($this->cart->items as $key => $id) {
            if ($search_id == $id) {
                unset($this->cart->items[$key]);
                $this->cart->total -= $raw_inventory[$id]["price"];
                $raw_inventory[$id]["stock"] += 1;
                $conn->query("UPDATE items SET stock = stock + 1 WHERE id = $id;");

                break;
            }
        }
    }

    public function removeAllFromCart()
    {
        global $raw_inventory;
        global $conn;
        foreach ($this->cart->items as $key => $id) {
            unset($this->cart->items[$key]);
            $this->cart->total -= $raw_inventory[$id]["price"];
            $raw_inventory[$id]["stock"] += 1;            
            $conn->query("UPDATE items SET stock = stock + 1 WHERE id = $id;");
        }
    }

    public function generateCartId()
    {
        global $raw_inventory;
        $base = count($raw_inventory);
        $num = 0;
        $len = count($this->cart->items);

        foreach ($this->cart->items as $n => $id) {
            $num += ($id * pow($base, $len - ($n + 1)));
        }

        return dechex($num);
    }

    public function generateCoinCartId()
    {
        global $raw_inventory;
        $base = count($raw_inventory);
        $num = 0;
        $len = count($this->coin_cart->items);

        foreach ($this->coin_cart->items as $n => $coin) {
            $num += ($coin['id'] * pow($base, $len - ($n + 1)));
        }

        return dechex($num);
    }
    

    public function completeTransaction()
    {
        global $conn;
        if ($this->balance >= $this->cart->total) {
            $cart_id = $this->generateCartId();
            $user_id = $this->user_id;
            $bill = $this->cart->total;
            $type = 'item';
            $transaction = new Transaction($user_id, $cart_id , $bill, $type);
            $this->transactions[] = array("user_id"=>$user_id, "cart_id"=>$cart_id, "bill"=>$bill, "transaction_date"=>$transaction->date, "transaction_type"=>$type);
            $transaction->complete();

            $this->balance -= $this->cart->total;
            $this->cart->items = array();
            $this->cart->total = 0;
            
            $query = "UPDATE users SET balance = $this->balance WHERE user_id = $this->user_id";
            $conn->query($query);

            return true;
        } else {
            return false;
        }
    }

    public function addCoin($id){
        global $coin_inventory;
        if(count($this->coin_cart->items) <= 3){
            $this->coin_cart->items[] = $coin_inventory[$id];
            $this->coin_cart->total += $coin_inventory[$id]["price"];
            
            return true;
        }

        else{
            return false;
        }
    }

    public function completePayment(){
        global $conn;
        foreach($this->coin_cart->items as $coin){
            $this->balance += $coin['value'];
        }
        
        $cart_id = $this->generateCoinCartId();
        $user_id = $this->user_id;
        $bill = $this->coin_cart->total;
        $type = 'coins';
        $transaction = new Transaction($user_id, $cart_id , $bill, $type);
        $this->transactions[] = array("user_id"=>$user_id, "cart_id"=>$cart_id, "bill"=>$bill, "transaction_date"=>$transaction->date, "transaction_type"=>$type);
        $transaction->complete();
        
        $conn->query("UPDATE users SET balance = $this->balance WHERE user_id = $this->user_id");
        $this->coin_cart = new Cart();
    }
}

class Cart
{
    public $items;
    public $total;

    public function __construct($items = array(), $total = 0)
    {
        $this->items = $items;
        $this->total = $total;
    }
}

class Transaction
{
    public $user_id;
    public $cart_id;
    public $bill;

    public $transaction_type;
    public $date;

    public function __construct($user_id = 0, $cart_id = '', $bill = '',$transaction_type = '')
    {
        $this->user_id = strval($user_id);
        $this->cart_id = $cart_id;
        $this->bill = $bill;
        $this->transaction_type = $transaction_type;
        $this->date = date("Y-m-d H:i:s");
    }

    public function complete()
    {
        global $conn;
        $query = "INSERT INTO transactions (user_id, cart_id, transaction_date, bill, transaction_type)
                      VALUES ($this->user_id, '$this->cart_id', '$this->date', $this->bill, '$this->transaction_type');";
        $conn->query($query);
    }
}


function decryptCartId($num){
    $num = hexdec($num);
    $txt = recurse($num);
    return explode('_', $txt);
}

function recurse($num){
    global $raw_inventory;
    $base = count($raw_inventory);
    if ($num <= $base) {
        return strval($num % $base);
    } else {
        return strval(recurse($num / $base)).'_'.strval($num % $base);
    }
}


//Search function
function searchItem($itemName)
{
    global $raw_inventory;
    $raw_items_found = array();
    foreach ($raw_inventory as $id => $item) {
        if (str_contains(strtolower($item["name"]), strtolower($itemName))) {
            $raw_items_found[$item["id"]] = $item;
        }
    }

    if (!$raw_items_found) {
        return 0;
    } else {
        $items_found = array();
        foreach ($raw_items_found as $item) {
            $category = $item['category'];

            if (!array_key_exists($category, $items_found)) {
                $items_found[$category] = array();
            }

            $items_found[$category][$item['id']] = $item['id'];
        }

        return $items_found;
    }
}

function registerUser()
{
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

    if ($user['pass'] != $user['cpass']) {
        return "User not registered: Password confirmation failed";
    }

    $alert_message = "User not registered: Invalid inputs for";
    foreach ($user as $key => $value) {
        if (!preg_match($regex[$key], $value)) {
            $alert_message .= " -$key";
            $invalid_input += 1;
        }
    }

    if (!$invalid_input) {
        require_once('connection.php');
        $name = $user['name'];
        $user_name = $user['user_name'];
        $ign = $user['ign'];
        $email = $user['email'];
        $pass = $user['pass'];
        $query = "INSERT INTO users (name, user_name, ign, email, pass) VALUES ('$name', '$user_name', '$ign', '$email', '$pass')";
        $conn->query($query);
        $alert_message = "User successfully registered!";

        signInUser($user);
    }

    return $alert_message;
}

function signInUser($user)
{
    global $conn;
    $user_name = $user['user_name'];
    $pass = $user['pass'];
    $result = $conn->query("SELECT * FROM users WHERE user_name = '$user_name' AND pass = '$pass'");

    if ($result->num_rows > 0) {
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        $user = $rows[0];
        $user_id = $user['user_id'];
        $transaction_query = $conn->query("SELECT * FROM transactions WHERE user_id = $user_id");
        $transaction_rows = $transaction_query->fetch_all(MYSQLI_ASSOC);
        
        $_SESSION['user'] = new User($user['user_id'], $user['name'], $user['email'], $user['ign'], $user['user_name'], $user['balance'], $user['pass'], new Cart(), $transaction_rows);
        return true;
    } else {
        return false;
    }
}

function signOut()
{
    unset($_SESSION['user']);
}
?>