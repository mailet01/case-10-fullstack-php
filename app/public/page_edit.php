<?php
$title = "redigera";
include "_includes/database-connection.php";
include "_includes/global-functions.php";
session_start();
$title = "";
$content = "";
$user_id = "";
$id = 0;
$row = null;
setup_page($pdo);
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $action_delete = isset($_POST['delete']) ? true : false;
    $id = isset($_POST['id']) ? $_POST['id'] : 0;
    if ($action_delete) {
        $sql = "DELETE FROM page WHERE id=$id";
        $result = $pdo->exec($sql);
        if ($result) {
            header("Location: index.php");
            // die("sidan raderades");
            exit;
        }
    }


    $content = isset($_POST['content']) ? trim($_POST['content']) : "";
    $title = isset($_POST['title']) ? trim($_POST['title']) : "";
    $sql = "UPDATE `page` SET `title`= :title,`content`= :content  WHERE id = :id";
    // $result = $pdo->exec($sql);
    print($sql);
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":title", $title, pdo::PARAM_STR);
    $stmt->bindParam(":content", $content, pdo::PARAM_STR);
    $stmt->bindParam(":id", $id, pdo::PARAM_INT);
    $result = $stmt->execute();
    if ($result) {
        header("Location: index.php");
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
        
        $title = $row['title'];
        $content = $row['content'];
    }
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
    if ($row) {

    ?>
        <?php
        if ($_SESSION['user_id']) {

        ?>
            <form action="page_edit.php" method="post">
                <input type="hidden" name="id" value="<?= $id ?>">


                <p>
                    <input type="text" name="title" id="title" placeholder="skriv en titel för sidan" value="<?= $title ?>">
                </p>
                <p>
                    <textarea name="content" id="content" cols="30" rows="30"><?= $content ?></textarea>

                </p>

                <button type="submit" name="Update">spara</button>
                <button type="submit" name="delete">radera</button>
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