<?php
namespace Products;
require_once 'autoLoader.php';

class DVD extends Product
{
    protected $size;
    
    public function __construct($conn)
    {
        parent::__construct($conn);
    }

    public function setSize($size)
    {
        $this->size = $size;
    }

    public function getSize()
    {
        return $this->size;
    }

    public function insertData()
    {
        $sku = $GLOBALS['data']['SKU'];
        $check = mysqli_query( $this->conn, "SELECT * FROM " . $this->table . " WHERE `sku` = '$sku'");
        $valid = mysqli_num_rows($check);
  
        if ($valid ==1) {
            echo " duplicated sku, use another SKU";
        } elseif (empty($GLOBALS['data']['size'])) {
            echo "Please enter the size of DVD";
        } elseif ($GLOBALS['data']['price'] <5){
            echo "Please enter the price equal or bigger than 5";
        } elseif (empty($GLOBALS['data']['SKU'])) {
            echo "Please enter the SKU";
        } elseif (empty($GLOBALS['data']['names'])) {
            echo "Please enter the name of DVD";
        } elseif (empty($GLOBALS['data']['price'])) {
            echo "Please enter the price of DVD";
        } else {
            $this->setSKU(htmlspecialchars($GLOBALS['data']['SKU'], ENT_QUOTES, 'UTF-8'));
            $this->setName(htmlspecialchars($GLOBALS['data']['names'], ENT_QUOTES, 'UTF-8'));
            $this->setPrice(htmlspecialchars($GLOBALS['data']['price'], ENT_QUOTES, 'UTF-8'));
            $this->setSize(htmlspecialchars($GLOBALS['data']['size'], ENT_QUOTES, 'UTF-8'));
            $this->setType((string) $GLOBALS['data']['type']);
        
   
            $stat = $this->conn->prepare("INSERT INTO " . $this->table . "(`SKU`, `name`, `price`,`type`,  `size`) VALUES(?,?,?,?, ?)");
            $stat->bind_param("ssdsi", $this->SKU, $this->name, $this->price, $this->type ,$this->size);
            $result=  $stat->execute();
    
        if ($result) {
            http_response_code(201); // Created
            echo  "DVD property created successfully.";
        } else if (http_response_code(400)) {
            echo  "Invalid product type.";
        } else {
            http_response_code(405); // Method Not Allowed
            echo  "Method not allowed for this endpoint.";
        }
            $stat->close();
        }
    }

    public function deleteData($SKUs)
    {   
        foreach ($SKUs as $sku) {
            $del = $sku->sku;
            $type = $sku->type;
            $result=  mysqli_query($this->conn,"DELETE FROM `product1` WHERE `sku` = '$del' AND `type`='$type'");

        } if ($result) {
            echo "DVD deleted successfully";
        } else {
            echo "there is an error";
        }
    }
}

?>