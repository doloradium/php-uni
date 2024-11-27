<?php
include '../db_connection.php';

function getUsers()
{
    global $conn;
    $sql = "SELECT id, username, role, email, real_name, count, last_login FROM users";
    return $conn->query($sql);
}

function updateUser($id, $username, $email, $real_name)
{
    global $conn;
    $sql = "UPDATE users SET username = ?, email = ?, real_name = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $username, $email, $real_name, $id);
    return $stmt->execute();
}

function deleteUser($id)
{
    global $conn;
    $sql = "DELETE FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    return $stmt->execute();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['user_id'])) {
        $id = $_POST['user_id'];
        $username = $_POST['user_username'] ?? null;
        $email = $_POST['user_email'] ?? null;
        $real_name = $_POST['user_name'] ?? null;

        if ($username && $email && $real_name) {
            updateUser($id, $username, $email, $real_name);
        }
    }
}

if (isset($_GET['delete_user'])) {
    deleteUser($_GET['delete_user']);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['user_id'])) {
        if (isset($_POST['promote_user'])) {
            promoteUser($_POST['user_id']);
        } else {
            updateUser($_POST['user_id'], $_POST['user_username'], $_POST['user_email'], $_POST['user_name']);
        }
    }
}

function promoteUser($id)
{
    global $conn;
    $sql = "UPDATE users SET role = 'editor' WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    return $stmt->execute();
}
?>