<?php
session_start();
include('crud/db_connection.php');

function RegisterUser($username, $password, $email, $real_name)
{
    global $pdo;

    // Check if email already exists in the database
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute(['email' => $email]);
    if ($stmt->rowCount() > 0) {
        return 'Email already registered';
    }

    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert the new user into the database
    $stmt = $pdo->prepare("INSERT INTO users (username, password, email, real_name, role) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$username, $hashed_password, $email, $real_name, 'guest']); // Default role as 'guest'

    return true;
}

if (isset($_POST['submit'])) {
    // Get user input from the form
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $real_name = $_POST['real_name'];

    // Attempt to register the user
    $result = RegisterUser($username, $password, $email, $real_name);

    if ($result === true) {
        header("Location: login.php"); // Redirect to login page after successful registration
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

    <div class="hub__wrapper">
        <h1>Register</h1>
        <form action="" method="post">
            Username: <br />
            <input type="text" name="username" required><br />
            Password: <br />
            <input type="password" name="password" required><br />
            Email: <br />
            <input type="email" name="email" required><br />
            Real Name: <br />
            <input type="text" name="real_name" required><br />
            <input class="btn" type="submit" name="submit" value="Register">
        </form>
        <p>Already have an account? </p><a href="login.php">Log in</a>
    </div>
</body>

</html>