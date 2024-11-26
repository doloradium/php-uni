<?php
// Include database connection
include 'db_connection.php';

function createCustomer($customer_name, $address, $phone)
{
    global $conn;
    $sql = "INSERT INTO Customers (customer_name, address, phone) 
            VALUES ('$customer_name', '$address', '$phone')";
    return $conn->query($sql);
}

function getCustomers()
{
    global $conn;
    $sql = "SELECT * FROM Customers";
    return $conn->query($sql);
}

function updateCustomer($id, $customer_name, $address, $phone)
{
    global $conn;
    $sql = "UPDATE Customers SET customer_name='$customer_name', address='$address', phone='$phone' WHERE id=$id";
    return $conn->query($sql);
}

function deleteCustomer($id)
{
    global $conn;
    $sql = "DELETE FROM Customers WHERE id=$id";
    return $conn->query($sql);
}

// Handle POST request for creating and updating customers
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['create_customer'])) {
        createCustomer($_POST['customer_name'], $_POST['address'], $_POST['phone']);
    }

    if (isset($_POST['customer_id'])) {
        updateCustomer($_POST['customer_id'], $_POST['customer_name'], $_POST['customer_address'], $_POST['customer_phone']);
    }
}

// Handle GET request for deleting a customer
if (isset($_GET['delete_customer'])) {
    deleteCustomer($_GET['delete_customer']);
}

// Include the HTML structure for customers table and form
include 'templates/customers_table.php';
?>