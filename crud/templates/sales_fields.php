<input type="hidden" id="sale_id" name="sale_id">
<select id="sale_customer" name="sale_customer" required>
    <?php
    $contracts = getContracts();
    while ($contract = $contracts->fetch_assoc()) {
        echo '<option value="' . $contract['id'] . '">' . htmlspecialchars($contract['id']) . ' - ' . htmlspecialchars($contract['customer_name']) . '</option>';
    }
    ?>
</select><br>
<select id="sale_model" name="sale_model" required>
    <?php
    $models = getModels();
    while ($model = $models->fetch_assoc()) {
        echo '<option value="' . $model['id'] . '">' . htmlspecialchars($model['name']) . ' (' . htmlspecialchars($model['model']) . ')</option>';
    }
    ?>
</select><br>
<input type="number" id="sale_quantity" name="sale_quantity" placeholder="Дата заключения" required><br>