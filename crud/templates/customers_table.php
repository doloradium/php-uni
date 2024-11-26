<h2>Создайте нового покупателя</h2>
<form method="POST">
    <input type="text" name="customer_name" placeholder="Имя" required><br>
    <input type="text" name="address" placeholder="Адрес" required><br>
    <input type="text" name="phone" placeholder="Телефон" required><br>
    <button type="submit" name="create_customer" class="btn">Создать покупателя</button>
</form>

<h2>Список покупателей</h2>
<table>
    <tr>
        <th>ID</th>
        <th>Имя</th>
        <th>Адрес</th>
        <th>Телефон</th>
        <th>Действия</th>
    </tr>
    <?php
    $customers = getCustomers();
    while ($row = $customers->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row['id'] . '</td>';
        echo '<td>' . $row['customer_name'] . '</td>';
        echo '<td>' . $row['address'] . '</td>';
        echo '<td>' . $row['phone'] . '</td>';
        echo '<td>
                <button class="btn edit-btn" data-id="' . $row['id'] . '" 
                data-customer_name="' . $row['customer_name'] . '" 
                data-address="' . $row['address'] . '" 
                data-phone="' . $row['phone'] . '">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160L0 416c0 53 43 96 96 96l256 0c53 0 96-43 96-96l0-96c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 96c0 17.7-14.3 32-32 32L96 448c-17.7 0-32-14.3-32-32l0-256c0-17.7 14.3-32 32-32l96 0c17.7 0 32-14.3 32-32s-14.3-32-32-32L96 64z"/>
                    </svg>
                </button>
                <a href="?table=customers&delete_customer=' . $row['id'] . '" class="btn">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                        <path d="M135.2 17.7L128 32 32 32C14.3 32 0 46.3 0 64S14.3 96 32 96l384 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-96 0-7.2-14.3C307.4 6.8 296.3 0 284.2 0L163.8 0c-12.1 0-23.2 6.8-28.6 17.7zM416 128L32 128 53.2 467c1.6 25.3 22.6 45 47.9 45l245.8 0c25.3 0 46.3-19.7 47.9-45L416 128z"/>
                    </svg>
                </a>
            </td>';
        echo '</tr>';
    }
    ?>
</table>
