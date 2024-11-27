<?php
session_start();

// Redirect the user to login page if they're not logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Добро пожаловать</title>
    <link href='https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap' rel='stylesheet'>
    <link rel='stylesheet' href='styles.css'>
</head>

<body>
    <div class="main__container hub__wrapper welcome__wrapper">
        <h1>Добро пожаловать, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
        <p>Вы были назначены модератором сайта и теперь можете формировать отчеты.</p>
        <a href="index.php" class="btn">На главную</a>
    </div>
</body>

</html>