<header>
emils bloggapplikation

    <?= isset($_SESSION['username']) ? $_SESSION['username'] : ""; ?>
</header>
<nav>
<a href="index.php">startsida</a>    
    <a href="login.php">Logga in</a> | 
    <a href="logout.php">Logga ut</a> | 
    <a href="register.php">Registrera</a> | 
<a href="page.php">skapa en sida</a> |
<a href="page_edit.php">redigera sida</a>
</nav>
<hr>