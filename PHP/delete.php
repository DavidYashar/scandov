<?php
require_once 'autoLoader.php';
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Disposition, Content-Type, Content-Length, Accept-Encoding");
header("Content-type:application/json");

use Products\Book;
use Products\DVD;
use Products\Furniture;
$conn = mysqli_connect('sql203.infinityfree.com', 'if0_35437179', 'OQpwSTENAoqDw', 'if0_35437179_moving');

$productClasses = [
    'Book' => Book::class,
    'DVD' => DVD::class,
    'Furniture' => Furniture::class,
  ];

  $jsonData = file_get_contents('php://input');
  $skus = json_decode($jsonData);
  echo var_dump($skus);

  foreach ($skus->skus as $sku) {
      $productName = $sku->type;
    

      if (array_key_exists($productName, $productClasses)) {
          $productClass = $productClasses[$productName];
          $product = new $productClass($conn);
          $product->deleteData([$sku]);
      }

  }
?>