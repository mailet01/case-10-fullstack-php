<header>
emils bloggapplikation

    <?= isset($_SESSION['username']) ? $_SESSION['username'] : ""; ?>
</header>
<nav>
<a href="index.php">startsida</a>    
<?php 
if(isset($_SESSION['user_id'])) {

?>

    <a href="logout.php">Logga ut</a> | 
<?php 
} else {
?>



    <a href="login.php">Logga in</a> | 
<?php


}
?>
    <a href="register.php">Registrera</a> | 
<a href="page.php">skapa en sida</a> |
<a href="page_edit.php">redigera sida</a>
</nav>
<hr>