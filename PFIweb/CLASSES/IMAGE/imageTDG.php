<?php

include_once __DIR__ . "/../../UTILS/connector.php";

class ImageTDG extends DBAO{

    private $tableName;
    private static $_instance = null;

    //singleton
    private function __construct(){
        Parent::__construct();
        $this->tableName = "images";
    }

    public static function get_instance(){
        if(is_null(self::$_instance)) {
            self::$_instance = new ImageTDG();
          }
      
          return self::$_instance;
    }
    public function get_by_id($id){
        try{
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "SELECT id, albumID, url, descr, nombreVues, type, date FROM $tableName WHERE id=:id";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetch();
        }

        catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }
        //fermeture de connection PDO
        $conn = null;
        return $result;
    }
    public function get_by_albumID($albumID){
        try{
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "SELECT id, url, descr, nombreVues, type, date FROM $tableName WHERE albumID=:id";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':id', $albumID);
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

    public function get_all_images(){

        try{
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "SELECT id, albumID, url, descr, nombreVues, type, date FROM $tableName";
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

    public function add_image($albumID, $url, $descr, $type){
        $descr = validator::sanitize($descr);

        try{
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "INSERT INTO $tableName (albumID, url, descr, nombreVues, type, date) VALUES (:albumID, :url, :descr, 0, :type, curdate())";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':albumID', $albumID);
            $stmt->bindParam(':url', $url);
            $stmt->bindParam(':descr', $descr);
            $stmt->bindParam(':type', $type);
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
    public function delete_image($imageID) {
        try{
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "delete from $tableName where id=:id";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':id', $imageID);
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
    public function delete_images_by_albumID($albumID) {
        try{           
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "delete from $tableName where albumID=:albumID";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':albumID', $albumID);
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
    public function get_number_of_likes($imageID) {
        try{
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "select count(*) as likes from likes where elemID = :imageID and typeElem = 'image'";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':imageID', $imageID);
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

    public function is_image_liked_by($imageID, $userID) {
        try{
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "select count(*) as count from likes where elemID = :imageID and typeElem = 'image' and userID = :userID";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':imageID', $imageID);
            $stmt->bindParam(':userID', $userID);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetch();
        }

        catch(PDOException $e)
        {
            return false;
        }
        //fermeture de connection PDO
        $conn = null;
        return $result["count"] > 0;
    }

    public function add_view($imageID) {
        try{
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "update $tableName set nombreVues = nombreVues + 1 where id=:id";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':id', $imageID);
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

    public function search_descr($descr){
        try{
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "SELECT id, albumID, url, descr, nombreVues, date FROM $tableName WHERE descr like :descr";
            $stmt = $conn->prepare($query);
            $param = "%" . $descr . "%";
            $stmt->bindParam(':descr', $param);
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
} 
?>