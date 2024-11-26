<?php
session_start();
include 'crud/db_connection.php';

function Login($username, $password, $remember)
{
    global $conn;

    if ($username == '' || $password == '') {
        echo "Username or password is empty!<br>"; // Debugging message
        return false;
    }

    // Prepare and execute query to fetch user data
    $stmt = $conn->prepare("SELECT username, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if (!$user) {
        echo "User not found!<br>"; // Debugging message
        return false;
    }

    // Show both entered password and stored password for debugging
    echo "Entered Password: " . htmlspecialchars($password) . "<br>";
    echo "Stored Password: " . htmlspecialchars($user['password']) . "<br>";

    // Directly compare the entered password with the stored password (plain text)
    if ($password === $user['password']) {
        // Password is correct, proceed with login
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $user['role'];

        // Increment login count and update last login time
        $updateStmt = $conn->prepare("UPDATE users SET count = count + 1, last_login = NOW() WHERE username = ?");
        $updateStmt->bind_param("s", $username);
        $updateStmt->execute();

        if ($remember) {
            setcookie('username', $username, time() + 3600 * 24 * 7);
        }

        return true;
    } else {
        echo "Password verification failed!<br>"; // Debugging message
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

// Check if the form was submitted and process the login
if (count($_POST) > 0) {
    // Check if 'remember' checkbox is set, otherwise default to false
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
</head>

<body>
    <h1>Login to the site</h1>

    <?php if (isset($error_message)) {
        echo "<p style='color: red;'>$error_message</p>";
    } ?>

    <form action="" method="post">
        Username: <br />
        <input type="text" name="username" required><br />
        Password: <br />
        <input type="password" name="password" required><br />
        <input type="checkbox" name="remember"> Remember me<br />
        <input type="submit" value="Login">
    </form>
</body>

</html>