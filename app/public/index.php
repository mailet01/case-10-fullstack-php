<?php

session_start();

$title = "startsida";

include_once("_includes/database-connection.php");
include_once("_includes/global-functions.php");

include_once "_models/database.php";
include_once "_models/page.php";
$page = new Page();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
</head>

<body>

    <?php
        include "_includes/header.php";


    ?>
<h1><?=$title?></h1>
    <?php
        include "_includes/error-message.php";
    ?>

<?php
if($_SERVER['REQUEST_METHOD'] == "GET")
{
    $rows = $page->select_all();

    if ($rows) {
        echo '<ul>';
        foreach ($rows as $row) {
            echo '<li>'. $row['title'] .'</li>';
        }
        echo '</ul>';
    
}
    }
    ?>    
    
    <?php
    include "_includes/footer.php";
    ?>


</body>

</html>