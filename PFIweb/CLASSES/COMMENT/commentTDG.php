<?php
include_once __DIR__ . "/../../UTILS/connector.php";
class CommentTDG extends DBAO{
    private $tableName;
    private static $_instance = null;
    
    private function __construct(){
        Parent::__construct();
        $this->tableName = "comments";
    }
    
    public static function get_instance(){
        if(is_null(self::$_instance)) {
            self::$_instance = new CommentTDG();
          }
      
          return self::$_instance;
    }
    public function get_by_ID($id){
        
        try{
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "SELECT id, idUser, elemID, typeElem, content, date FROM $tableName WHERE id=:id";
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
    public function get_by_authorID($authorID){
        
        try{
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "SELECT id, elemID, typeElem, content, date FROM $tableName WHERE idUser=:authorID";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':authorID', $authorID);
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
    public function get_by_elemID($elemID, $typeElem){
        
        try{
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "SELECT id, idUser, content, date FROM $tableName WHERE elemID=:elemID and typeElem=:typeElem order by id";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':elemID', $elemID);
            $stmt->bindParam(':typeElem', $typeElem);
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
    public function get_all_comments(){
        
        try{
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "SELECT id, idUser, elemID, typeElem, content, date FROM $tableName";
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
    public function add_comment($authorID, $elemID, $typeElem, $content){
        
        try{
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "INSERT INTO $tableName (idUser, elemID, typeElem, content, date) VALUES (:authorID, :elemID, :typeElem, :content, curdate())";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':authorID', $authorID);
            $stmt->bindParam(':elemID', $elemID);
            $stmt->bindParam(':typeElem', $typeElem);
            $stmt->bindParam(':content', $content);
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
    public function delete_comment($id) {
        try{
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "delete from $tableName WHERE id=:id";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $resp = true;
        }
        
        catch(PDOException $e)
        {
            $resp = false;
        }
        //fermeture de connection PDO
        $conn = null;
        return $resp;
    }
    public function delete_comment_by_elemID($elemID, $typeElem) {
        try{
            echo $elemID;
            echo $typeElem;
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "delete from $tableName WHERE elemID=:elemID and typeElem=:typeElem";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':elemID', $elemID);
            $stmt->bindParam(':typeElem', $typeElem);
            $stmt->execute();
            $resp = true;
        }
        
        catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
            $resp = false;
        }
        //fermeture de connection PDO
        $conn = null;
        return $resp;
    }
    public function updateContent($content, $id){
        
        try{
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "UPDATE $tableName SET content=:content WHERE id=:id";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':content', $content);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $resp = true;
        }
        
        catch(PDOException $e)
        {
            $resp = false;
        }
        //fermeture de connection PDO
        $conn = null;
        return $resp;
    }
    public function get_number_of_likes($commentID) {
        try{
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "select count(*) as likes from likes where elemID = :commentID and typeElem = 'comment'";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':commentID', $commentID);
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
    public function is_comment_liked_by($commentID, $userID) {
        try{
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "select count(*) as count from likes where elemID = :commentID and typeElem = 'comment' and userID = :userID";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':commentID', $commentID);
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
    public function like_comment($commentID, $userID) {
        try{
            $conn = $this->connect();
            $query = "insert into likes values(:userID,:commentID,'comment')";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':userID', $userID);
            $stmt->bindParam(':commentID', $commentID);
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
    public function unlike_comment($commentID, $userID) {
        try{
            $conn = $this->connect();
            $query = "delete from likes where userID=:userID and elemID=:commentID and typeElem='comment'";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':userID', $userID);
            $stmt->bindParam(':commentID', $commentID);
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
}
?>