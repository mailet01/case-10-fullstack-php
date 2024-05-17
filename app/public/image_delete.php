<?php 
$title = "Radera bild";
session_start();
include_once "_includes/database-connection.php";
include_once "_includes/global-functions.php";
include_once "_models/Database.php";
include_once "_models/Image.php";
$db = new Database();
$imageModel = new Image();
$image_extensions = ["jpg", "jpeg", "png", "gif"];
$file_extensions = "";
// $id = 0;
$page_id = "";
if($_SERVER['REQUEST_METHOD'] == "POST") { 
    $id = isset($_POST['id']) ? (int) $_POST['id'] : 0;
    // $page_id = isset($_POST['page_id']) ? (int) $_POST['page_id'] : 0;
    $sql = "SELECT * FROM `image` WHERE id= :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam('id', $id, PDO::PARAM_INT);
$stmt->execute();
    $row = $stmt->fetch();
 if(unlink($row['url'])) {
header("Location: index.php");
}
$image = $imageModel->delete_image($id);
if($image > 0) {
    echo "delete successfully";

 
} 
    }
    if ($_SERVER['REQUEST_METHOD'] === "GET") {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
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
include_once "_includes/header.php";

?>
<h1><?= $title ?></h1>
<form action="" method="post">
            <p>
Är du säker på att du vill ta bort den valda bilden?


            </p>
            <p>
<button type="submit" name="Delete">ja</button>

            </p>
            <input type="hidden" name="id" value="<?= $id ?>">
            
            
        
    </form>

</body>
</html>