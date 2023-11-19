<?php
namespace Products;
require_once 'autoLoader.php';

class Furniture extends Product
{
    protected $height;
    protected $width;
    protected $length;
  
    public function __construct($conn)
    {
        parent::__construct($conn);
    }


    public function setHeight($height)
    {
        $this->height = $height;
    }

    public function setWidth($width)
    {
        $this->width = $width;
    }

    public function setLength($length)
    {
        $this->length = $length;
    }

    public function getHeight()
    {
        return $this->height;
    }

    public function getWidth()
    {
        return $this->width;
    }

    public function getLength()
    {
        return $this->length;
    }


    public function insertData()
    {
        $sku = $GLOBALS['data']['SKU'];
        $check = mysqli_query( $this->conn, "SELECT * FROM " . $this->table . " WHERE `sku` = '$sku'");
        $valid = mysqli_num_rows($check);
     
        if ($valid ==1) {
         echo " duplicated sku, use another SKU";
        } elseif (empty($GLOBALS['data']['SKU'])) {
            echo "Please enter the SKU";
        } elseif (empty($GLOBALS['data']['names'])) {
            echo "Please enter the name of Furniture";
        } elseif (empty($GLOBALS['data']['price'])) {
            echo "Please enter the price of Furniture";
        }  elseif ($GLOBALS['data']['price'] <5) {
            echo "Please enter the price equal or bigger than 5";
        } elseif (empty($GLOBALS['data']['height']) ||
            empty($GLOBALS['data']['length']) || empty($GLOBALS['data']['width'])) {
            echo "Please enter the all the data for furniture";
        } else {
            $this->setSKU(htmlspecialchars($GLOBALS['data']['SKU'], ENT_QUOTES, 'UTF-8'));
            $this->setName(htmlspecialchars($GLOBALS['data']['names'], ENT_QUOTES, 'UTF-8'));
            $this->setPrice(htmlspecialchars($GLOBALS['data']['price'], ENT_QUOTES, 'UTF-8'));
            $this->setHeight(htmlspecialchars($GLOBALS['data']['height'], ENT_QUOTES, 'UTF-8'));
            $this->setWidth(htmlspecialchars($GLOBALS['data']['width'], ENT_QUOTES, 'UTF-8'));
            $this->setLength(htmlspecialchars($GLOBALS['data']['length'], ENT_QUOTES, 'UTF-8'));
            $this->setType($GLOBALS['data']['type']);

            $stat = $this->conn->prepare("INSERT INTO ".$this->table."(SKU, name, price, type, width, height, length) VALUES(?,?,?,?, ?,?,?)");
            $stat->bind_param("ssdsiii", $this->SKU, $this->name, $this->price ,$this->type, $this->height, $this->length, $this->width);
            $result = $stat->execute();

        if ($result) {
           http_response_code(201); // Created
           echo  "Furniture property created successfully.";
        }  elseif (http_response_code(400)) {
           echo "Invalid product type.";     
        }  else {
           http_response_code(405); // Method Not Allowed
           echo  "Method not allowed for this endpoint.";
        }
           $stat->close();
        }
    }

    public function deleteData($SKUs)
    {
        foreach($SKUs as $sku) {
            $del = $sku->sku;
            $type = $sku->type;
            $result=  mysqli_query($this->conn,"DELETE FROM `product1` WHERE `sku` = '$del' AND `type`='$type'");
        }   
        
        if ($result) {
            echo "Furniture deleted successfully";
        } else {
            echo "there is an error";
        }
    }
}


?>