<?php
$title = "redigera";
include "_includes/database-connection.php";
include "_includes/global-functions.php";
session_start();
$title = "";
$content = "";
$user_id = "";
$row = null;
setup_page($pdo);
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $id = isset($_POST['id']);
    $sql = "UPDATE `page` SET `title`='$title',`content`='content', `user_id`='$user_id' WHERE id";
    // $result = $pdo->exec($sql);
    print($sql);
    $stmt = $pdo->prepare($sql);
    $result = $stmt->execute([$title, $content, $user_id]);
    if ($result) {
        // header("Location: page.php? sidan uppdaterades");
        exit;
    }
}
if ($_SERVER['REQUEST_METHOD'] === "GET") {
    $id = isset($_GET['id']) ? $_GET['id'] : 0;
    $sql = "SELECT * from page WHERE id = $id";
    $result = $pdo->prepare($sql);

    $result->execute();
    $row = $result->fetch();

    if ($row) {
        print_r($row);
        $title = $row['title'];
        $content = $row['content'];
    }
}
// $action_delete = isset($_POST['delete']) ? true : false;
// if ($action_delete) {
//     $sql = "DELETE FROM page WHERE id=$id";
//     $result = $pdo->exec($sql);
//     if ($result) {
//         header("Location: page.php? sidan raderades");
//         exit;
//     }
// }

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
    if ($row) {

    ?>
        <?php
        if ($_SESSION['user_id']) {

        ?>
            <form action="page.php" method="post">
                <p>
                    <input type="text" name="title" id="title" placeholder="skriv en titel för sidan" value="<?= $title ?>">
                </p>
                <p>
                    <input type="text" name="content" id="content" placeholder="skriv något" value="<?= $content ?>">

                </p>

                <button type="submit" name="Update">spara</button>
                <button type="submit" name="Delete">radera</button>
            </form>
        <?php
        }
        ?>
    <?php
    }

    ?>
    <?php
    include "_includes/footer.php";
    ?>


</body>

</html>