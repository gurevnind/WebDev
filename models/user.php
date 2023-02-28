<?php

use JetBrains\PhpStorm\NoReturn;

class User
{



    private ?PDO $conn;
    private string $table_name = "user";
    public int $id;
    public string $username;
    public int $city_id;

    public  string $name;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function get(): bool|PDOStatement
    {

        $query = "SELECT user.id, username, user.name as name, city.name as city FROM " . $this->table_name . " INNER JOIN city ON ". $this->table_name . ".city_id = city.id;";

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt;
    }

    function create(): bool|PDOStatement
    {

        $query = "INSERT INTO " . $this->table_name . " SET name=:name, city_id=:city_id, username=:username";

        $stmt = $this->conn->prepare($query);


        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->city_id = htmlspecialchars(strip_tags($this->city_id));
        $this->username = htmlspecialchars(strip_tags($this->username));


        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":city_id", $this->city_id);
        $stmt->bindParam(":username", $this->username);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    function delete(){
        $query = "DELETE FROM " . $this->table_name ." WHERE id=:id;";

        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(":id", $this->id);

        $stmt->execute();

        return $stmt;
    }

    function  update(){
        $query = "UPDATE " . $this->table_name . " SET name=:name, username=:username, city_id=:city_id  WHERE id=:id;";

        $stmt = $this->conn->prepare($query);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->username = htmlspecialchars(strip_tags($this->username));
        $this->city_id = htmlspecialchars(strip_tags($this->city_id));
        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":username", $this->username);
        $stmt->bindParam(":city_id", $this->city_id);
        $stmt->bindParam(":id", $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

}


