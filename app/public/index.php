<?php

session_start();

$title = "startsida";
$content = "";
$username = "";
$editlink = "";
$user_id = $_SESSION['user_id'];
include_once("_includes/database-connection.php");
include_once("_includes/global-functions.php");

include_once "_models/database.php";
include_once "_models/page.php";
include "_models/Image.php";
$page = new Page();
$image = new Image();

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

    <?php
    // include "_includes/error-message.php";
    ?>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == "GET") {
        $rows = $page->select_all();

        if ($rows) {
            echo '<ul>';
            foreach ($rows as $row) {
                echo '<li><a href="index.php?id=' . $row['id'] . '">' . $row['title'] . '</a></li>';
            }
            echo '</ul>';
        }
    }
    if ($_GET) {
        $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
        $row = $page->select_one($id);
        // print_r($row);

        if ($row) {
            $title = $row['title'];
            $content = $row['content'];
            $username = $row['username'];
            if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $row['user_id']) {
                $editlink = '<a href="page_edit.php?id=' . $id . '">redigera</a>';
            }
        }
    }
    ?>
    <main>
        <h1><?php echo $title; ?></h1>
        <div><?php echo $content ?></div>
        <div><?php echo $username ?></div>
        <?php 
        echo $editlink;
        ?>
    </main>

    <?php
    include "_includes/footer.php";
    ?>


</body>

</html>