<?php
include 'db_connection.php';

function createSale($contract_id, $model_id, $quantity)
{
    global $conn;
    $sql = "INSERT INTO Sales (contract_id, model_id, quantity) 
            VALUES ('$contract_id', '$model_id', '$quantity')";
    return $conn->query($sql);
}

function getSales()
{
    global $conn;
    $sql = "SELECT s.contract_id, s.model_id, s.quantity, s.id,  
                   c.customer_id, c.contract_date, c.execution_date, cu.customer_name AS customer_name,
                   m.name AS model_name, m.model AS model_number
            FROM Sales s
            JOIN Contracts c ON s.contract_id = c.id
            JOIN Customers cu ON c.customer_id = cu.id
            JOIN Models m ON s.model_id = m.id
            ORDER BY s.contract_id ASC";
    return $conn->query($sql);
}

function getContracts()
{
    global $conn;
    return $conn->query("SELECT c.id, cu.customer_name FROM Contracts c JOIN Customers cu ON c.customer_id = cu.id ORDER BY c.id ASC");
}

function getModels()
{
    global $conn;
    return $conn->query("SELECT * FROM Models ORDER BY id ASC");
}

function updateSale($id, $contract_id, $model_id, $quantity)
{
    global $conn;
    $sql = "UPDATE Sales SET quantity='$quantity', contract_id='$contract_id', model_id='$model_id' WHERE id=$id";
    return $conn->query($sql);
}

function deleteSale($contract_id, $model_id)
{
    global $conn;
    $sql = "DELETE FROM Sales WHERE contract_id=$contract_id AND model_id=$model_id";
    return $conn->query($sql);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['sale_id'])) {
        updateSale($_POST['sale_id'], $_POST['sale_customer'], $_POST['sale_model'], $_POST['sale_quantity']);
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['create_sale'])) {
        createSale($_POST['contract_id'], $_POST['model_id'], $_POST['quantity']);
    }
}

if (isset($_GET['delete_sale'])) {
    deleteSale($_GET['delete_sale'], $_GET['model_id']);
}

include 'templates/sales_table.php';
?>