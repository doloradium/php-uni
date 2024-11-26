<?php
$servername = "MySQL-8.0";
$username = "root";
$password = "";
$dbname = "mebel";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$yearQuery = "SELECT DISTINCT YEAR(contract_date) AS year FROM Contracts ORDER BY year DESC";
$yearResult = $conn->query($yearQuery);

$year = isset($_GET['year']) ? intval($_GET['year']) : null;

$sql = "
    SELECT 
        s.contract_id,
        c.contract_date,
        m.name AS model_name,
        m.model AS model,
        s.quantity,
        m.price,
        (s.quantity * m.price) AS total_price
    FROM Sales s
    JOIN Models m ON s.model_id = m.id
    JOIN Contracts c ON s.contract_id = c.id
    WHERE c.contract_date LIKE '" . ($year ? $year . "-%" : "%") . "'
    ORDER BY s.contract_id, m.name
";

$result = $conn->query($sql);


echo "<!DOCTYPE html>";
echo "<html lang='en'>";
echo "<head>";
echo "<meta charset='UTF-8'>";
echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
echo "<title>Отчет</title>";
echo "<link href='https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap' rel='stylesheet'>";
echo "<link rel='stylesheet' href='styles.css'>";
echo "</head>";
echo "<body>";

echo '<button class="button__back" onclick="window.location.replace(`https://mysite.local/`)" ><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z"/></svg></button>';

echo '<button class="button__logout">';
echo '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M502.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-128-128c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L402.7 224 192 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l210.7 0-73.4 73.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l128-128zM160 96c17.7 0 32-14.3 32-32s-14.3-32-32-32L96 32C43 32 0 75 0 128L0 384c0 53 43 96 96 96l64 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-64 0c-17.7 0-32-14.3-32-32l0-256c0-17.7 14.3-32 32-32l64 0z"/></svg>';
echo '</button>';

echo "<div class='container'>";
echo "<h1>Отчет о выполнении договоров на продажу мебели за</h1>";

echo "<form method='get' action=''>";
echo "<select name='year' required>";
echo "<option value=''>Выберите год</option>";

if ($yearResult->num_rows > 0) {
    while ($row = $yearResult->fetch_assoc()) {
        $selected = ($year == $row['year']) ? "selected" : "";
        echo "<option value='" . $row['year'] . "' $selected>" . $row['year'] . "</option>";
    }
}
echo "</select>";
echo "<button type='submit'>Сгенерировать отчет</button>";
echo "</form>";

$current_contract_id = null;
$contractTotal = 0;
$grandTotal = 0;

while ($row = $result->fetch_assoc()) {
    if ($current_contract_id != $row['contract_id']) {
        if ($current_contract_id != null) {
            echo "</table>";
            echo "<h3>Номер договора: " . $current_contract_id . " - Итого по договору: " . number_format($contractTotal, 2) . "</h3>";
            $grandTotal += $contractTotal;
        }
        $current_contract_id = $row['contract_id'];
        $contractTotal = 0;

        echo "<table>";
        echo "<tr><th>Название мебели</th><th>Модель</th><th>Количество, шт.</th><th>Цена модели, руб.</th><th>Стоимость модели, руб.</th></tr>";
    }

    echo "<tr>";
    echo "<td>" . $row["model_name"] . "</td>";
    echo "<td>" . $row["model"] . "</td>";
    echo "<td>" . $row["quantity"] . "</td>";
    echo "<td>" . number_format($row["price"], 2) . "</td>";
    echo "<td>" . number_format($row["total_price"], 2) . "</td>";
    echo "</tr>";

    $contractTotal += $row["total_price"];
}

echo "</table>";
echo "<h3>Номер договора: " . $current_contract_id . " - Итого по договору: " . number_format($contractTotal, 2) . "</h3>";
$grandTotal += $contractTotal;

echo "<h2>Итого: " . number_format($grandTotal, 2) . "</h2>";

$conn->close();

echo "</div>";
echo "</body>";
echo "</html>";
?>