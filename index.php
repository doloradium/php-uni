<?php
session_start();
include 'crud/db_connection.php';

// Check if the user is not logged in (unauthorized)
if (!isset($_SESSION['username'])) {
    // Show the login and registration buttons for unauthorized users
    $unauthorized = true;
} else {
    // If the user is logged in, fetch user data
    $username = $_SESSION['username'];
    $role = $_SESSION['role'];

    // Update SQL query to fetch real_name instead of username
    $stmt = $conn->prepare("SELECT real_name, count, last_login FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if (!$user) {
        header("Location: login.php");
        exit();
    }

    $unauthorized = false;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Макей</title>
    <link href='https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap' rel='stylesheet'>
    <link rel='stylesheet' href='styles.css'>
</head>

<body>

    <?php if (!$unauthorized) { ?>
        <div class="controls">
            <a class="button__back inactive" onclick="window.location.replace('https://mysite.local/')">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                    <path
                        d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z" />
                </svg>
            </a>

            <a href="login.php?logout=true" class="button__logout">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <path
                        d="M502.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-128-128c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L402.7 224 192 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l210.7 0-73.4 73.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l128-128zM160 96c17.7 0 32-14.3 32-32s-14.3-32-32-32L96 32C43 32 0 75 0 128L0 384c0 53 43 96 96 96l64 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-64 0c-17.7 0-32-14.3-32-32l0-256c0-17.7 14.3-32 32-32l64 0z" />
                </svg>
            </a>
        </div>
    <?php } ?>

    <div class="main__container">
        <!-- If the user is logged in, show the user info and control panel -->
        <?php if (!$unauthorized) { ?>
            <div class="info__wrapper">
                <!-- Display real_name instead of username -->
                <h1>Добро пожаловать, <?php echo htmlspecialchars($user['real_name']); ?>!</h1>
                <?php if ($role === 'guest') { ?>
                    <p>Подождите, пока администратор одобрит вашу заявку</p>
                <?php } ?>
                <?php if ($role === 'admin' || $role === 'editor') { ?>
                    <p><strong>Количество авторизаций: </strong> <?php echo htmlspecialchars($user['count']); ?></p>
                    <p><strong>Последний вход: </strong> <?php echo htmlspecialchars($user['last_login']); ?></p>
                <?php } ?>
            </div>

            <?php if ($role === 'admin' || $role === 'editor') { ?>
                <div class="hub__wrapper">
                    <h1>Панель управления</h1>
                    <div class="hub__items">
                        <?php if ($role === 'admin') { ?>
                            <form method="get" action="crud/templates/users_table.php">
                                <button type="submit">Пользователи</button>
                            </form>
                        <?php } ?>
                        <?php if ($role === 'admin') { ?>
                            <form method="get" action="crud/crud.php">
                                <button type="submit">Управление БД</button>
                            </form>
                        <?php } ?>
                        <form method="get" action="report_task.php">
                            <button type="submit">Создать отчет</button>
                        </form>
                    </div>
                </div>
            <?php } ?>
        <?php } ?>

        <!-- If the user is not logged in, show login and register buttons -->
        <?php if ($unauthorized) { ?>
            <div class="main__container hub__wrapper welcome__wrapper">
                <h1>Добро пожаловать на сайт!</h1>
                <p>Для пользования необходимо авторизоваться. Информация об авторе: Макей Валерий Валерьевич, ТУВР41</p>
                <div class="guest__buttons">
                    <form method="get" action="register.php">
                        <button type="submit">Зарегистрироваться</button>
                    </form>
                    <form method="get" action="login.php">
                        <button type="submit">Войти</button>
                    </form>
                </div>
            </div>
        <?php } ?>
    </div>
</body>

</html>