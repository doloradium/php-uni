<?php
session_start();
include 'crud/db_connection.php';

function RegisterUser($username, $password, $email, $real_name)
{
    global $conn;

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        return 'Email already registered';
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (username, password, email, real_name, role, count, last_login) VALUES (?, ?, ?, ?, ?, 0, NULL)");
    $role = 'guest';
    $stmt->bind_param("sssss", $username, $hashed_password, $email, $real_name, $role);

    if ($stmt->execute()) {
        return true;
    } else {
        return "Error: " . $stmt->error;
    }
}

if (isset($_POST['submit'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $real_name = $_POST['real_name'];

    $result = RegisterUser($username, $password, $email, $real_name);

    if ($result === true) {
        header("Location: login.php");
        exit();
    } else {
        $error_message = $result;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link href='https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap' rel='stylesheet'>
    <link rel='stylesheet' href='styles.css'>
</head>

<body>
    <?php if (isset($error_message)) {
        echo "<p style='color: red;'>$error_message</p>";
    } ?>

    <div class="main__container hub__wrapper">
        <h1>Регистрация</h1>
        <form class="login__form" action="" method="post">
            <div class="login__item"><span>Никнейм:</span><input type="text" name="username" required></div>
            <div class="login__item"><span>Пароль:</span><input type="password" name="password" required
                    pattern="^.{8,}$" title="Длина пароля от 8 символов"></div>
            <div class="login__item"><span>E-mail:</span><input type="email" name="email" required></div>
            <div class="login__item"><span>Имя:</span><input type="text" name="real_name" required
                    pattern="^[А-Яа-яЁё\s]+$" title="Пожалуйста, используйте только кириллические символы и пробелы">
            </div>
            <input class="btn" type="submit" name="submit" value="Зарегистрироваться">
        </form>
        <div class="login__item">
            <p>Есть аккаунт? </p><a class="login__link" href="login.php">Войти</a>
        </div>
    </div>
</body>

</html>