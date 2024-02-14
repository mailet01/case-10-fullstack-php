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
    
    if (move_uploaded_file($file_tmp, $url)) {
 $image = $imageModel->add_image($url, $page_id);
 if($image > 0) {
    echo "upload successfully";
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
<h1>ladda upp en bild</h1>

<?php
 
// form to upload image
if (isset($_SESSION['user_id'])) {
    $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
?>
<?php
}
 

?>    
<form action="image.php" method="post" enctype="multipart/form-data">
        <fieldset>
            <legend>Ladda upp bild till sidan</legend>
            <label for="upload">Välj bild</label>
            <input type="file" name="upload" id="upload">
            <input type="text" name="page_id" value="<?= $id ?>">
            <input type="submit" value="Ladda upp">
        </fieldset>
    </form>




</body>
</html>