<?php
session_start();
include '../db_connection.php';
include '../tables/users.php';

if (!isset($_SESSION['username'])) {
    header("Location: /login.php");
    exit();
}

if ($_SESSION['role'] !== 'admin') {
    header("Location: /index.php");
    exit();
}

$currentTable = 'users';

if (isset($_GET['table'])) {
    $currentTable = $_GET['table'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD</title>
    <link rel="stylesheet" href="../../styles.css">
    <link href='https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap' rel='stylesheet'>
</head>

<body data-table="<?php echo $currentTable; ?>">

    <div class="controls">
        <a class="button__back" onclick="window.location.replace('https://mysite.local/')">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                <path
                    d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z" />
            </svg>
        </a>

        <a href="/login.php?logout=true" class="button__logout">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                <path
                    d="M502.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-128-128c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L402.7 224 192 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l210.7 0-73.4 73.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l128-128zM160 96c17.7 0 32-14.3 32-32s-14.3-32-32-32L96 32C43 32 0 75 0 128L0 384c0 53 43 96 96 96l64 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-64 0c-17.7 0-32-14.3-32-32l0-256c0-17.7 14.3-32 32-32l64 0z" />
            </svg>
        </a>
    </div>

    <div class='container'>
        <h2>Список пользователей</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Имя пользователя</th>
                <th>Почта</th>
                <th>Имя</th>
                <th>Роль</th>
                <th>Количество авторизаций</th>
                <th>Последний вход</th>
                <th>Действия</th>
            </tr>
            <?php
            $users = getUsers();
            while ($row = $users->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row['id'] . '</td>';
                echo '<td>' . htmlspecialchars($row['username'] ?? '') . '</td>';
                echo '<td>' . htmlspecialchars($row['email'] ?? '') . '</td>';
                echo '<td>' . htmlspecialchars($row['real_name'] ?? '') . '</td>';
                echo '<td>' . htmlspecialchars($row['role'] ?? '') . '</td>';
                echo '<td>' . htmlspecialchars($row['count'] ?? '0') . '</td>';
                echo '<td>' . htmlspecialchars($row['last_login'] ?? '') . '</td>';
                echo '<td class="full-width">';
                if ($row['role'] === 'guest') {
                    echo '<form method="POST" style="display:inline;">
                            <input type="hidden" name="user_id" value="' . $row['id'] . '">
                            <button type="submit" name="promote_user" class="btn">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z"/></svg>
                            </button>
                          </form>';
                }
                echo '<button class="btn edit-user-btn" data-id="' . $row['id'] . '" 
                    data-username="' . htmlspecialchars($row['username']) . '" 
                     data-email="' . htmlspecialchars($row['email']) . '" 
                      data-name="' . htmlspecialchars($row['real_name']) . '" 
                    data-role="' . htmlspecialchars($row['role']) . '">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160L0 416c0 53 43 96 96 96l256 0c53 0 96-43 96-96l0-96c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 96c0 17.7-14.3 32-32 32L96 448c-17.7 0-32-14.3-32-32l0-256c0-17.7 14.3-32 32-32l96 0c17.7 0 32-14.3 32-32s-14.3-32-32-32L96 64z"/>
                        </svg>
                    </button> ';
                echo '<a href="?delete_user=' . $row['id'] . '" class="btn">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                        <path d="M135.2 17.7L128 32 32 32C14.3 32 0 46.3 0 64S14.3 96 32 96l384 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-96 0-7.2-14.3C307.4 6.8 296.3 0 284.2 0L163.8 0c-12.1 0-23.2 6.8-28.6 17.7zM416 128L32 128 53.2 467c1.6 25.3 22.6 45 47.9 45l245.8 0c25.3 0 46.3-19.7 47.9-45L416 128z"/>
                    </svg>
                </a>';
                echo '</td>';
                echo '</tr>';
            }
            ?>
        </table>
    </div>

    <div id="editUserModal" class="modal">
        <div class="modal-content">
            <span class="closeUser">&times;</span>
            <h2>Редактировать</h2>
            <form id="editUser" method="POST">
                <div id="userFields">
                    <input type="hidden" id="user_id" name="user_id">
                    <input type="text" id="user_username" name="user_username" placeholder="Никнейм"><br>
                    <input type="email" id="user_email" name="user_email" placeholder="Почта"><br>
                    <input type="text" id="user_name" name="user_name" placeholder="Имя"><br>
                </div>
                <button type="submit" name="edit_user" class="btn">Сохранить</button>
            </form>
        </div>
    </div>

    <script src="../scripts/modal.js"></script>
</body>

</html>