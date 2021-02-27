<?php

class users{

    private $connection;

    /**
     * create new connection
     */
    public function __construct(){
        $this->connection   = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
    }
 
    /**
     * add new user
     * @param $username
     * @param $email
     * @param $password
     * @return bool 
     */
    public function addUser($username, $email, $password){
        $this->connection->query("INSERT INTO `users`(`username`,`email`,`password`) VALUES('$username','$email','$password')");

        if($this->connection->affected_rows > 0)
            return true;

        return false;
    }

    /**
     * delete user
     * @param $id
     * @return bool 
     */
    public function deleteUser($id){
        $this->connection->query("DELETE FROM `users` WHERE `id`=$id");
        if($this->connection->affected_rows > 0)
            return true;

        return false;
    }

    /**
     * update user
     * @param $id
     * @param $username
     * @param $email
     * @param $password
     * @return bool 
     */
    public function updateUser($id, $username, $email, $password){
        $id = (int)$id;
        $sql    = "UPDATE `users` SET `username` = '$username', `email` = '$email'";

        if(strlen($password) > 0)
            $sql   .= ", `password`='$password'";

        $sql   .= " WHERE `id`=$id";
        $this->connection->query($sql);

        if($this->connection->affected_rows > 0)
            return true;
        
        return false;
    }

    /**
     * get all users
     * @return array | null
     */
    public function getUsers($condition = ''){
        $result = $this->connection->query("SELECT * FROM `users` $condition");
        if($result->num_rows > 0){
            $users  = array();
            while($row = $result->fetch_assoc()){
                $users[]    = $row;
            }
            return $users;
        }else{
            return null;
        }
    }

    /**
     * get user by id
     * @param $id
     * @return mixed | null
     */
    public function getUser($id){
        $user   = $this->getUsers("WHERE `id` = $id");
        if($user && count($user) > 0) 
            return $user[0];

        return null;
    }

    /**
     * user login
     * @param $username
     * @param $password
     * @return mixed | null
     */
    public function login($username, $password){
        $user   = $this->getUsers("WHERE `username` = '$username' AND `password`= '$password'");
        if($user && count($user) > 0) 
            return $user[0];

        return null;
    }

    /**
     * close connection
     */
    public function __destruct(){
        $this->connection->close();
    }
}