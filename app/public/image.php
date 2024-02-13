<?php 


session_start();
include_once "_includes/database-connection.php";
include_once "_includes/global-functions.php";
include_once "_models/database.php";
include_once "_models/Page.php";
include_once "_models/Image.php";
$image_extensions = ["jpg", "jpeg", "png", "gif"];

if(in_array($file_extensions, $image_extensions)) {

}

if (isset($_FILES['uploads'])) {
    $file_name = $_FILES['upload']['name'];
    $file_tmp = $_FILES['upload']['tmp_name'];
    $url = "uploads/" . $file_name;
    if (move_uploaded_file($file_tmp, $url)) {
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
<form action="handleUploads.php" method="post">
        <fieldset>
            <legend>Ange bildlänk</legend>
            <label for="upload">Välj bild</label>
            <input type="text" name="url" id="url">
            <input type="hidden" name="page_id" value="<?= $id ?>">
            <input type="submit" value="Spara">
        </fieldset>
    </form>    
    





</body>
</html>