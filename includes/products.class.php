<?php


class product{

    private $connection;

    /**
     * start connection
     */
    public function __construct()
    {
        $this->connection = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
    }

    /**
     * add new product
     * @param $title
     * @param $description
     * @param $image
     * @param $price
     * @param $available
     * @param $user_id
     * @return bool 
     */
    public function addProduct($title, $description,$image,$price,$available,$user_id)
    {
        $this->connection->query("INSERT INTO `products`(`title`,`description`,`image`,`price`,`available`,`user_id`) VALUES('$title','$description','$image',$price,'$available',$user_id)");

        if($this->connection->affected_rows > 0)
            return true;

        // echo $this->connection->error;
        return false;
    }

    /**
     * update product
     * @param $id
     * @param $title
     * @param $description
     * @param $image
     * @param $price
     * @param $available
     * @param $user_id
     * @return bool 
     */
    public function updateProduct($id, $title, $description,$image,$price,$available,$user_id)
    {
        $this->connection->query("UPDATE `products` SET `title` ='$title',`description`= '$description',`image`= '$image',`price`= $price,`available`= '$available',`user_id`= $user_id
         WHERE `id`= $id");

        if($this->connection->affected_rows > 0)
            return true;

        // echo $this->connection->error;
        return false;
    }

    /**
     * delete product
     * @param $id
     * @return bool 
     */
    public function deleteProduct($id)
    {
        $this->connection->query("DELETE FROM `products` WHERE `id`=$id");
        if($this->connection->affected_rows > 0)
            return true;

        return false;
    }

    /**
     * get all products
     * @return array | null
     */
    public function getProducts($condition = '')
    {
        $result = $this->connection->query("SELECT * FROM `products` $condition");
        if($result->num_rows > 0){
            $products  = array();
            while($row = $result->fetch_assoc()){
                $products[]    = $row;
            }
            return $products;
        }else{
            return null;
        }
    }

    /**
     * get product by id
     * @param $id
     * @return mixed | null
     */
    public function getProduct($id)
    {
        $product   = $this->getProducts("WHERE `id` = $id");
        if($product && count($product) > 0) 
            return $product[0];

        return null;
    }

    /**
     * search product by title
     * @param $keyword
     * @return mixed | null
     */
    public function searchProduct($keyword)
    {
        return $this->getProducts("WHERE `title` LIKE '%$keyword%'");
    }

    /**
     * close connection
     */
    public function __destruct(){
        $this->connection->close();
    }
}