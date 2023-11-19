<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

require_once 'autoLoader.php';

use Products\DVD;
use Products\Book;
use Products\Furniture;

$conn = mysqli_connect('sql203.infinityfree.com', 'if0_35437179', 'OQpwSTENAoqDw', 'if0_35437179_moving');

$GLOBALS['data'] = json_decode(file_get_contents("php://input"), true);

$productClasses = [
  'Book' => Book::class,
  'DVD' => DVD::class,
  'Furniture' => Furniture::class,
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productName = $GLOBALS['data']['type'];

    if (array_key_exists($productName, $productClasses)) {
        $productClass = $productClasses[$productName];
        $product = new $productClass($conn);
        $product->insertData();
    }
}

?>   
    
    

   