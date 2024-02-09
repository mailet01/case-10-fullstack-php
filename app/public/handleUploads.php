
<?php
session_start();

// var_dump($_FILES);
include_once("_includes/database-connection.php");
include_once("_models/Image.php");

// När fileModel skapas så kommer en ny tabell files att skapas i databasen
$imageModel = new Image();

// platsen där vi ska spara filen
$target_dir = "uploads/";

// filen som ska sparas
$url = $_FILES["file"]["name"];

// full path blir
$fullPath = $target_dir . $url; // /uploads/runbox_invoice.pdf

echo "You want to upload " . $url . " to " . $fullPath;

$succesfullUpload = move_uploaded_file($_FILES["file"]["tmp_name"], $fullPath);

if ($succesfullUpload) {
    echo "<p>This was a success!</p>";

    $uploadedId = $imageModel->add_image($_FILES["file"]["name"], $fullPath, $_FILES["file"]["size"], $_SESSION["user_id"]);

    if ($uploadedId > 0) {
        echo "<p>Successfull insertion into table 'files' with id: " . $uploadedId . "</p>";
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
</body>
</html>