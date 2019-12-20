<?php

include_once __DIR__ . "/../../UTILS/connector.php";

class LikeTDG extends DBAO{

    private $tableName;
    private static $_instance = null;

    //singleton
    private function __construct(){
        Parent::__construct();
        $this->tableName = "likes";
    }

    public static function get_instance(){
        if(is_null(self::$_instance)) {
            self::$_instance = new LikeTDG();
          }
      
          return self::$_instance;
    }
    
    public function get_all_likes(){

        try{
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "SELECT userID, elemIDID, typeElem FROM $tableName";
            $stmt = $conn->prepare($query);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetchAll();
        }

        catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }
        //fermeture de connection PDO
        $conn = null;
        return $result;
    }

    public function delete_likes_by_elemID($elemID, $typeElem) {
        try{           
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "delete from $tableName where elemID=:elemID and typeElem=:typeElem";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':elemID', $elemID);
            $stmt->bindParam(':typeElem', $typeElem);
            $stmt->execute();
            
            $resp =  true;
        }

        catch(PDOException $e)
        {
            $resp =  false;
        }
        //fermeture de connection PDO
        $conn = null;
        return $resp;
    }
    public function get_number_of_likes($elemID, $typeElem) {
        try{
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "select count(*) as likes from $tableName where elemID = :elemID and typeElem = :typeElem";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':elemID', $elemID);
            $stmt->bindParam(':typeElem', $typeElem);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetch();
        }

        catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
            return 0;
        }
        //fermeture de connection PDO
        $conn = null;
        return $result["likes"];
    }

    public function is_elem_liked_by($elemID, $typeElem, $userID) {
        try{
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "select count(*) as count from $tableName where elemID = :elemID and typeElem = :typeElem and userID = :userID";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':elemID', $elemID);
            $stmt->bindParam(':userID', $userID);
            $stmt->bindParam(':typeElem', $typeElem);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetch();
        }

        catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
            return false;
        }
        //fermeture de connection PDO
        $conn = null;
        return $result["count"] > 0;
    }


    public function like_elem($elemID, $typeElem, $userID) {
        try{
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "insert into $tableName values(:userID,:elemID,:typeElem)";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':userID', $userID);
            $stmt->bindParam(':elemID', $elemID);
            $stmt->bindParam(':typeElem', $typeElem);
            $stmt->execute();
            $resp =  true;
        }

        catch(PDOException $e)
        {
            $e->getMessage();
            $resp =  false;
        }
        //fermeture de connection PDO
        $conn = null;
        return $resp;
    }
    public function unlike_elem($elemID, $typeElem, $userID) {
        try{
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "delete from $tableName where userID=:userID and elemID=:elemID and typeElem=:typeElem";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':userID', $userID);
            $stmt->bindParam(':elemID', $elemID);
            $stmt->bindParam(':typeElem', $typeElem);
            $stmt->execute();
            $resp =  true;
        }

        catch(PDOException $e)
        {
            $e->getMessage();
            $resp =  false;
        }
        //fermeture de connection PDO
        $conn = null;
        return $resp;
    }
} 
?>