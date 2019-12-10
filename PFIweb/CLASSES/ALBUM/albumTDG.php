<?php

include_once __DIR__ . "/../../UTILS/connector.php";

class AlbumTDG extends DBAO{

    private $tableName;
    private static $_instance = null;

    //singleton
    private function __construct(){
        Parent::__construct();
        $this->tableName = "albums";
    }

    public static function get_instance(){
        if(is_null(self::$_instance)) {
            self::$_instance = new AlbumTDG();
        }
      
        return self::$_instance;
    }

    public function get_by_albumID($albumID){
        try{
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "SELECT id, title, descr, userID, nombreVues, date FROM $tableName WHERE id=:id";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':id', $albumID);
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

    public function get_by_userID($userID){
        try{
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "SELECT id, title, descr, userID, nombreVues, date FROM $tableName where userID=:id";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':id', $userID);
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

    public function get_number_of_likes($albumID) {
        try{
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "select count(*) as likes from likes where elemID = :albumID and typeElem = 'album'";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':albumID', $albumID);
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

    public function search_title($title){
        try{
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "SELECT id, title, descr, userID, nombreVues, date FROM $tableName WHERE title like :title";
            $stmt = $conn->prepare($query);
            $param = "%" . $title . "%";
            $stmt->bindParam(':title', $param);
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

    public function get_all_albums(){

        try{
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "SELECT id, title, descr, userID, nombreVues, date FROM $tableName";
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

    public function add_view($albumID) {
        try{
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "update $tableName set nombreVues = nombreVues + 1 where id=:id";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':id', $albumID);
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

    public function is_album_liked_by($albumID, $userID) {
        try{
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "select count(*) as count from likes where elemID = :albumID and typeElem = 'album' and userID = :userID";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':albumID', $albumID);
            $stmt->bindParam(':userID', $userID);
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

    public function like_album($albumID, $userID) {
        try{
            $conn = $this->connect();
            $query = "insert into likes values(:userID,:albumID,'album')";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':userID', $userID);
            $stmt->bindParam(':albumID', $albumID);
            $stmt->execute();
            $resp =  true;
        }

        catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
            $resp =  false;
        }
        //fermeture de connection PDO
        $conn = null;
        return $resp;
    }
    public function unlike_album($albumID, $userID) {
        try{
            $conn = $this->connect();
            $query = "delete from likes where userID=:userID and elemID=:albumID and typeElem='album'";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':userID', $userID);
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

    public function add_album($title,$descr,$userID,$date){
        try{
            $title = validator::sanitize($title);
            $descr = validator::sanitize($descr);
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "INSERT INTO $tableName (title, descr, userID, nombreVues, date) VALUES (:title, :descr, :userID, 0, :date)";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':descr', $descr);
            $stmt->bindParam(':userID', $userID);
            $stmt->bindParam(':date', $date);
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

    public function delete_album($id){
        try{
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "DELETE FROM $tableName where id = :id";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
        }

        catch(PDOException $e)
        {
            $resp =  false;
        }
        //fermeture de connection PDO
        $conn = null;
        return $resp;
    }
}
?>