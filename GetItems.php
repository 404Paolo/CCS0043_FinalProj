<?php
    require_once("classes.php");
    $header = null;
    $items = array();

    if (($handle = fopen("items.csv", 'r')) !== false) {
        while (($row = fgetcsv($handle, 1000, ",")) !== false) {
            if (!$header) {
                $header = $row;
            } else {
                $data = array_combine($header, $row);
                $item = new Item($data['Id'], $data['Name'], (int)$data['Stock'], (int)$data['Price'], $data['Image']);
                $items[] = $item;
            }
        }
        fclose($handle);
    }
    
    echo "<pre>";
    print_r($items);
    echo "<pre>";
?>
