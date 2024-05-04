<?php 
include_once "Database.php";
class Page extends Database
{
  public function __construct()
  {
    parent::__construct();
    
  }
  
  public function setup()  
  {
    $sql = "CREATE TABLE IF NOT EXISTS `page` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `title` varchar(255) NOT NULL,
        `content` text DEFAULT NULL,
        `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
        `user_id` int(11) NOT NULL,
        PRIMARY KEY (`id`),
        KEY `user_id` (`user_id`),
        CONSTRAINT `page_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci";  
  
  $stmt = $this->db->prepare($sql);
  $stmt->execute();

}
public function select_all()
{
    try {
        $sql = "SELECT id, title, user_id FROM `page`";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    } catch (PDOException $err) {
        echo "Felmeddelande: " . $err->getMessage();   
    }
}
public function select_one($id)
    {
        try {
            $sql = "SELECT 
            `page`.`id`, 
            `page`.`title`, 
            `page`.`content`, 
            `user`.`username`,
            `page`.`user_id` 
            FROM `page` 
            INNER JOIN `user` ON `page`.`user_id` = `user`.`id` 
            WHERE `page`.`id` = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetch();
        } catch (PDOException $err) {
            echo "Felmeddelande: " . $err->getMessage();
        }
    }

}

  






?>