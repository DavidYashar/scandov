<?php 
namespace Products;
abstract class Product{
    protected $name;
    protected $price;
    protected $SKU;
    protected $conn;
    protected string $type;
    protected $table = "product1";
   
    public function __construct($conn)
    {
        // $conn = mysqli_connect('localhost', 'root', '', 'moving');
        $this->conn = $conn;
    }

    public function setName($name)
    {
        $this->name = $name;
    }
    
    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function setSKU($SKU)
    {
        $this->SKU = $SKU;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getSKU()
    {
        return $this->SKU;
    }

   abstract public function insertData();

   abstract public function deleteData($SKUs);
    
}

?> 
