<?php 
include_once "_includes/database-connection.php";
include_once "_models/Database.php";
include_once "_models/User.php";
include_once "_models/Image.php";
include_once "_models/Page.php";

$user = new User();
$page = new Page();
$image = new Image();
// installera tabell
$user->setup();
$page->setup();
$image->setup();
?>

<a href="/">applikationen är nu installerad. Klicka här för att gå till startsidan</a>