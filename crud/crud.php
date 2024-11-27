<?php
session_start();
include 'db_connection.php';

if (!isset($_SESSION['username'])) {
    header("Location: /login.php");
    exit();
}

if ($_SESSION['role'] !== 'admin') {
    header("Location: /index.php");
    exit();
}

$currentTable = 'models';

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
    <link rel="stylesheet" href="../styles.css">
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

    <header>
        <h1>Таблицы</h1>
        <nav>
            <ul class='crud__menu'>
                <li><a class='crud__item' href="?table=models">Мебель</a></li>
                <li><a class='crud__item' href="?table=customers">Покупатели</a></li>
                <li><a class='crud__item' href="?table=contracts">Контракты</a></li>
                <li><a class='crud__item' href="?table=sales">Продажи</a></li>
            </ul>
        </nav>
    </header>

    <div class='container'>
        <?php
        switch ($currentTable) {
            case 'models':
                include 'tables/models.php';
                break;
            case 'customers':
                include 'tables/customers.php';
                break;
            case 'contracts':
                include 'tables/contracts.php';
                break;
            case 'sales':
                include 'tables/sales.php';
                break;
            default:
                include 'tables/models.php';
                break;
        }
        ?>
    </div>

    <div id="editModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Редактировать</h2>
            <form id="editForm" method="POST">
                <!-- <input type="hidden" id="edit_id" name="edit_id"> -->
                <div id="editFields">
                    <?php
                    switch ($currentTable) {
                        case 'models':
                            include 'templates/models_fields.php';
                            break;
                        case 'customers':
                            include 'templates/customers_fields.php';
                            break;
                        case 'contracts':
                            include 'templates/contracts_fields.php';
                            break;
                        case 'sales':
                            include 'templates/sales_fields.php';
                            break;
                        default:
                            include 'templates/models_fields.php';
                            break;
                    }
                    ?>
                </div>
                <button type="submit" name="edit" class="btn">Сохранить</button>
            </form>
        </div>
    </div>

    <script src="scripts/modal.js"></script>
</body>

</html>