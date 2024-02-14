<?php

// credentials
$servername = "mysql";
$database = "db_case";
$username = "db_user";
$password = "db_password";

// data source name
$dsn = "mysql:host=$servername;dbname=$database";

try {

  // connect to database
  $pdo = new PDO($dsn, $username, $password);

  // set the PDO error mode to exception
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
  echo "Connected successfully";
} catch (PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}


function setup_image($pdo)

{
  $sql = "CREATE TABLE IF NOT EXISTS `image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(255) NOT NULL,
  `page_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `page_id` (`page_id`),

 CONSTRAINT `image_ibfk_1` FOREIGN KEY (`page_id`) REFERENCES `page` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION)";
  // ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
  $pdo->exec($sql);
}
// funktion för att skapa tabellen user
function setup_page($pdo)
{
  $sql = "CREATE TABLE IF NOT EXISTS `page` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `title` varchar(255) NOT NULL,
    `content` text DEFAULT NULL,
    `date_created` date NOT NULL DEFAULT current_timestamp(),
    `user_id` int(11) NOT NULL,
    PRIMARY KEY (`id`),
    KEY `user_id` (`user_id`),
  --  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci,
    CONSTRAINT `page_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
  )";
  $pdo->exec($sql);
}


function setup_user($pdo)
{
  $sql = "CREATE TABLE IF NOT EXISTS `user` (
   `id` int(11) NOT NULL AUTO_INCREMENT,
    `username` varchar(255) NOT NULL,
    `password` varchar(255) NOT NULL,
    PRIMARY KEY (`id`)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
  ";
  $pdo->exec($sql);
}

function setup_foreignkeys($pdo)
{
  $sql = "ALTER TABLE `image`
ADD CONSTRAINT `image_ibfk_1` FOREIGN KEY (`page_id`) REFERENCES `page` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restriktioner för tabell `page`
--
ALTER TABLE `page`
ADD CONSTRAINT `page_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

";
  $pdo->exec($sql);
}
setup_user($pdo);
setup_page($pdo);
setup_image($pdo);


// setup_foreignkeys($pdo);