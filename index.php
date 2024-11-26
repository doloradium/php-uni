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
    <button class="button__logout">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M502.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-128-128c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L402.7 224 192 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l210.7 0-73.4 73.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l128-128zM160 96c17.7 0 32-14.3 32-32s-14.3-32-32-32L96 32C43 32 0 75 0 128L0 384c0 53 43 96 96 96l64 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-64 0c-17.7 0-32-14.3-32-32l0-256c0-17.7 14.3-32 32-32l64 0z"/></svg>
    </button>
    <div class="hub__wrapper">
        <h1>Лабораторные по PHP</h1>
        <div class="hub__items">
            <form method="get" action="report.php">
                <button type="submit">Отчет</button>
            </form>
            <form method="get" action="crud/crud.php">
                <button type="submit">CRUD</button>
            </form>
            <form method="get" action="report_task.php">
                <button type="submit">Отчет задание</button>
            </form>
        </div>
    </div>
</body>
</html>