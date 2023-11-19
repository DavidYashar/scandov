<?php
namespace  Products;

class Book extends Product
{
    protected $weight;
  
    public function __construct($conn)
    {
        parent::__construct($conn);
    }

    public function setWeight($weight)
    {
        $this->weight = $weight;
    }

    public function getWeight()
    {
        return $this->weight;
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
            echo "Please enter the name of Book";
        } elseif (empty($GLOBALS['data']['price'])) {
            echo "Please enter the price of Book";
        } elseif ($GLOBALS['data']['price'] <5) {
            echo "Please enter the price equal or bigger than 5";
        } elseif (empty($GLOBALS['data']['weight'])) {
            echo "Please enter the weight of the Book";
        } else {  
            $this->setSKU(htmlspecialchars($GLOBALS['data']['SKU'], ENT_QUOTES, 'UTF-8'));
            $this->setName(htmlspecialchars($GLOBALS['data']['names'], ENT_QUOTES, 'UTF-8'));
            $this->setPrice(htmlspecialchars($GLOBALS['data']['price'], ENT_QUOTES, 'UTF-8'));
            $this->setWeight(htmlspecialchars($GLOBALS['data']['weight'], ENT_QUOTES, 'UTF-8'));
            $this->setType($GLOBALS['data']['type']);

            $stat = $this->conn->prepare("INSERT INTO " . $this->table . "(sku, name, price, type, weight) VALUES(?,?,?,?, ?)");
            $stat->bind_param("ssdsi", $this->SKU, $this->name, $this->price ,$this->type, $this->weight);
            $result = $stat->execute();

        if ($result) {

            http_response_code(201); // Created
            echo  "Book property created successfully.";
        } elseif (http_response_code(400)) {
       
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
        foreach($SKUs as $sku) {
            $del = $sku->sku;
            $type = $sku->type;
            $result=  mysqli_query($this->conn,"DELETE FROM `product1` WHERE `sku` = '$del' AND `type`='$type'");

       } if ($result) {
            echo "Book deleted successfully";
       } else {
            echo "there is an error";
       }
    }
}

?>