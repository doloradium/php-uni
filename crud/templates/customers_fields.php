<input type="hidden" id="customer_id" name="customer_id">
<input type="text" id="customer_name" name="customer_name" placeholder="Имя" required pattern="^[А-Яа-яЁё\s]+$"
    title="Пожалуйста, используйте только кириллические символы и пробелы"><br>
<input type="text" id="customer_address" name="customer_address" placeholder="Адрес" required
    pattern="^[\u0400-\u04FF0-9.,\- ]+$"
    title="Пожалуйста, используйте только кириллические символы, цифры и пробелы"><br>
<input type="text" id="customer_phone" name="customer_phone" placeholder="Телефон" required pattern="^[\d\s\(\)\-\+]+$"
    title="Пожалуйста, используйте только цифры"><br>