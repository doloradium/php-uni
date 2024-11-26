<h2>Создайте новую продажу</h2>
<form method="POST">
    <select name="contract_id" required>
        <option value="">Выберите контракт</option>
        <?php
        // Fetch contracts for dropdown
        $contracts = getContracts();
        while ($contract = $contracts->fetch_assoc()) {
            echo '<option value="' . $contract['id'] . '">' . htmlspecialchars($contract['id']) . ' - ' . htmlspecialchars($contract['customer_name']) . '</option>';
        }
        ?>
    </select><br>

    <select name="model_id" required>
        <option value="">Выберите модель</option>
        <?php
        // Fetch models for dropdown
        $models = getModels();
        while ($model = $models->fetch_assoc()) {
            echo '<option value="' . $model['id'] . '">' . htmlspecialchars($model['name']) . ' (' . htmlspecialchars($model['model']) . ')</option>';
        }
        ?>
    </select><br>

    <input type="number" name="quantity" placeholder="Количество" required><br>
    <button type="submit" name="create_sale" class="btn">Создать продажу</button>
</form>

<h2>Список продаж</h2>
<table>
    <tr>
        <th>ID контракта</th>
        <th>Модель</th>
        <th>Количество</th>
        <th>Действия</th>
    </tr>
    <?php
    $sales = getSales();
    while ($row = $sales->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . htmlspecialchars($row['contract_id']) . ' - ' . htmlspecialchars($row['customer_name']) . '</td>';
        echo '<td>' . htmlspecialchars($row['model_name']) . ' (' . htmlspecialchars($row['model_number']) . ')</td>'; // Show model details
        echo '<td>' . htmlspecialchars($row['quantity']) . '</td>';
        echo '<td>
                <button class="btn edit-btn" data-contract_id="' . $row['contract_id'] . '" 
                data-model_id="' . $row['model_id'] . '" 
                data-quantity="' . $row['quantity'] . '"
                data-id="' . $row['id'] . '" >
             <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160L0 416c0 53 43 96 96 96l256 0c53 0 96-43 96-96l0-96c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 96c0 17.7-14.3 32-32 32L96 448c-17.7 0-32-14.3-32-32l0-256c0-17.7 14.3-32 32-32l96 0c17.7 0 32-14.3 32-32s-14.3-32-32-32L96 64z"/>
                    </svg>
                </button>
                <a href="?table=sales&delete_sale=' . $row['contract_id'] . '&model_id=' . $row['model_id'] . '" class="btn">
                   <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                        <path d="M135.2 17.7L128 32 32 32C14.3 32 0 46.3 0 64S14.3 96 32 96l384 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-96 0-7.2-14.3C307.4 6.8 296.3 0 284.2 0L163.8 0c-12.1 0-23.2 6.8-28.6 17.7zM416 128L32 128 53.2 467c1.6 25.3 22.6 45 47.9 45l245.8 0c25.3 0 46.3-19.7 47.9-45L416 128z"/>
                    </svg>
                </a>
            </td>';
        echo '</tr>';
    }
    ?>
</table>