<?php
include 'db_connection.php';

function createContract($customer_id, $contract_date, $execution_date)
{
    global $conn;
    $sql = "INSERT INTO Contracts (customer_id, contract_date, execution_date) 
            VALUES ('$customer_id', '$contract_date', '$execution_date')";

    return $conn->query($sql);
}

function getCustomers()
{
    global $conn;
    return $conn->query("SELECT * FROM Customers ORDER BY id ASC");
}

function getContracts()
{
    global $conn;
    $sql = "SELECT c.id AS contract_id, c.contract_date, c.execution_date, c.customer_id,
                   cu.customer_name 
            FROM Contracts c
            JOIN Customers cu ON c.customer_id = cu.id
            ORDER BY contract_id ASC";

    return $conn->query($sql);
}

function updateContract($id, $customer_id, $contract_date, $execution_date)
{
    global $conn;
    $sql = "UPDATE Contracts SET customer_id='$customer_id', contract_date='$contract_date', execution_date='$execution_date' WHERE id=$id";
    return $conn->query($sql);
}

function deleteContract($id)
{
    global $conn;
    $sql = "DELETE FROM Contracts WHERE id=$id";
    return $conn->query($sql);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['create_contract'])) {
        createContract($_POST['customer_id'], $_POST['contract_date'], $_POST['execution_date']);
    }

    if (isset($_POST['contract_id'])) {
        updateContract($_POST['contract_id'], $_POST['contract_customer'], $_POST['contract_date'], $_POST['contract_execution']);
    }
}

if (isset($_GET['delete_contract'])) {
    deleteContract($_GET['delete_contract']);
}

include 'templates/contracts_table.php';
?>