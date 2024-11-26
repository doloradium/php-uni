<input type="hidden" id="contract_id" name="contract_id">
<select id="contract_customer" name="contract_customer" required>
    <?php
    $customers = getCustomers();
    while ($customer = $customers->fetch_assoc()) {
        echo '<option value="' . $customer['id'] . '">' . htmlspecialchars($customer['customer_name']) . '</option>';
    }
    ?>
</select><br>

<input type="date" id="contract_date" name="contract_date" placeholder="Дата заключения" required><br>
<input type="date" id="contract_execution" name="contract_execution" placeholder="Дата исполнения" required><br>