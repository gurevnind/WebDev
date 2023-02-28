<?php

use JetBrains\PhpStorm\NoReturn;

class City
{



    private ?PDO $conn;
    private string $table_name = "city";
    public int $id;
    public  string $name;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function get(): bool|PDOStatement
    {

        $query = "SELECT * FROM " . $this->table_name . " ORDER BY id ASC";

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt;
    }

    function create(): bool|PDOStatement
    {

        $query = "INSERT INTO " . $this->table_name . " SET name=:name";

        $stmt = $this->conn->prepare($query);


        $this->name = htmlspecialchars(strip_tags($this->name));



        $stmt->bindParam(":name", $this->name);


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
        $query = "UPDATE " . $this->table_name . " SET name=:name  WHERE id=:id;";

        $stmt = $this->conn->prepare($query);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":id", $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}


