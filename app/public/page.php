<?php

$title = "skapa sida";
include "_includes/database-connection.php";
include "_includes/global-functions.php";
session_start();
// $title = "";
$content = "";
$user_id = "";
setup_page($pdo);
print_r2($_SESSION);
print_r2($_POST);
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $user_id = $_SESSION['user_id'];
    $sql = "INSERT INTO `page` (`title`, `content`, `user_id`) VALUES (?, ?, ?)";
    print($sql);
    $stmt = $pdo->prepare($sql);
$stmt->execute([$title, $content, $user_id]);
header("Location: index.php");

}
if ($_SERVER['REQUEST_METHOD'] === "GET" || $_SERVER['REQUEST_METHOD'] === "POST") {
    $sql = "SELECT * FROM page";
    $result = $pdo->prepare($sql);
    $result->execute();
    $rows = $result->fetchAll();
    
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
</head>

<body>
    <?php
    include "_includes/header.php";


    ?>
    <h1><?= $title ?></h1>


     <?php 
    if (isset($_SESSION['user_id'])) {

    ?>
        <form action="page.php" method="post"> 
            <p>
                <input type="text" name="title" id="title" placeholder="skriv en titel för sidan">
            </p>
            <p>
                <textarea name="content" id="content" cols="30" rows="30" placeholder="skriv något"></textarea>

            </p>

            <button type="submit">spara</button>
        </form>


    <?php
    }

    ?>
 
<?php 
include "_includes/footer.php";
?>

</body>

</html>