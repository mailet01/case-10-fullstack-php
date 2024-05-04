<?php 
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
// if(in_array($file_extensions, $image_extensions)) {

// }
if($_SERVER['REQUEST_METHOD'] == "POST") { 
if (isset($_FILES['upload'])) {
    $id = isset($_POST['id']) ? (int) $_POST['id'] : 0;
    $page_id = isset($_POST['page_id']) ? (int) $_POST['page_id'] : 0;
    $file_name = $_FILES['upload']['name'];
    $file_tmp = $_FILES['upload']['tmp_name'];
    $url = "uploads/" . $file_name;
    
    if (unlink($page_image['url'])) {
 $image = $imageModel->delete_image($id);
 if($image > 0) {
    echo "delete successfully";
header("Location: index.php");
 print_r2($image);    } 
    }
}
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="index.php" method="post" enctype="multipart/form-data">
            
            <input type="file" name="delete" id="delete">
            <input type="hidden" name="page_id" value="<?= $id ?>">
            <input type="submit" value="radera bild">
            
        
    </form>

</body>
</html>