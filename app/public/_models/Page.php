<?php 

class Page extends Database
{
  public function __construct()
  {
    parent::__construct();
    $this->setup();
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
        $sql = "SELECT id, title FROM `page`";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    } catch (PDOException $err) {
        echo "Felmeddelande: " . $err->getMessage();   
    }
}

}

  






?>