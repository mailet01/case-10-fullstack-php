<?php 
class Image extends Database
{
    public function __construct()
    {
        parent::__construct();
        $this->setup();
    }

    public function setup()
    {
        $sql = "CREATE TABLE IF NOT EXISTS `image` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `url` varchar(255) NOT NULL,
            `page_id` int(11) NOT NULL,
            PRIMARY KEY (`id`),
            KEY `page_id` (`page_id`),
            CONSTRAINT `image_ibfk_1` FOREIGN KEY (`page_id`) REFERENCES `page` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
    }
public function add_image($url)
{
    $stmt = $this->db->prepare("INSERT INTO image (url) VALUES (:url)");
    $stmt->bindParam(':url', $url);
    $stmt->execute();
    return $this->db->lastInsertId();
}
public function show_imagesbypage_id($page_id)
{
    $stmt = $this->db->prepare("SELECT * FROM `image` INNER JOIN `page` ON image.page_id=page.id WHERE `page_id` = :page_id");
    $stmt->bindParam('page_id', $page_id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll();
}
public function delete_image($id) {
    $stmt = $this->db->prepare("DELETE FROM `image` WHERE id=:id");
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();
return $stmt->rowCount();
}
public function edit_image($url)
{
    $stmt = $this->db->prepare("UPDATE `image` SET url=:url WHERE id=:id");
    $stmt->bindParam(':url', $url, PDO::PARAM_STR);
    return $stmt->rowCount();
}
}





?>