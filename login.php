<?php
session_start();
include 'crud/db_connection.php';

function Login($username, $password, $remember)
{
    global $conn;

    if ($username == '' || $password == '') {
        echo "Username or password is empty!<br>";
        return false;
    }

    $stmt = $conn->prepare("SELECT username, password, role, count FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if (!$user) {
        echo "User not found!<br>";
        return false;
    }

    if (password_verify($password, $user['password'])) {
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $user['role'];

        // Check if the user is an admin or editor, and update count and last_login accordingly
        if ($user['role'] == 'admin' || $user['role'] == 'editor') {
            // Update login count and last login time
            $updateStmt = $conn->prepare("UPDATE users SET count = count + 1, last_login = NOW() WHERE username = ?");
            $updateStmt->bind_param("s", $username);
            $updateStmt->execute();
        }

        // If it's the first login for admin/editor, redirect to welcome.php
        if ($user['count'] == 0 && ($user['role'] == 'admin' || $user['role'] == 'editor')) {
            header("Location: welcome.php");
            exit();
        }

        // Remember me functionality
        if ($remember) {
            setcookie('username', $username, time() + 3600 * 24 * 7);
        }

        return true;
    } else {
        echo "Password verification failed!<br>";
    }

    return false;
}



function Logout()
{
    setcookie('username', '', time() - 1);
    unset($_SESSION['username']);
    unset($_SESSION['role']);
}

if (isset($_GET['logout'])) {
    Logout();
    header("Location: login.php");
    exit();
}

$enter_site = false;

if (count($_POST) > 0) {
    $remember = isset($_POST['remember']) ? true : false;
    $enter_site = Login($_POST['username'], $_POST['password'], $remember);
}

if ($enter_site) {
    header("Location: index.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href='https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap' rel='stylesheet'>
    <link rel='stylesheet' href='styles.css'>
</head>

<body>
    <div class="main__container hub__wrapper">
        <h1>Login to the site</h1>

        <?php if (isset($error_message)) {
            echo "<p style='color: red;'>$error_message</p>";
        } ?>

        <form class="login__form" action="" method="post">
            <div class="login__item"><span>Никнейм:</span><input type="text" name="username" required></div>
            <div class="login__item"><span>Пароль:</span><input type="password" name="password" required></div>
            <div class="login__item"><input type="checkbox" name="remember">Запомнить меня</div>
            <input class="btn" type="submit" value="Войти">
        </form>
        <div class="login__item">
            <p>Нет аккаунта? </p><a class="login__link" href="register.php">Зарегистрироваться</a>
        </div>
    </div>
</body>

</html>