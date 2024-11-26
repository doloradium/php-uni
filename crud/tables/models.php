<?php
// Include database connection
include 'db_connection.php';

function createModel($name, $model, $characteristics, $price)
{
    global $conn;
    $sql = "INSERT INTO Models (name, model, characteristics, price) 
            VALUES ('$name', '$model', '$characteristics', '$price')";
    return $conn->query($sql);
}

function getModels()
{
    global $conn;
    $sql = "SELECT * FROM Models";
    return $conn->query($sql);
}

function updateModel($id, $name, $model, $characteristics, $price)
{
    global $conn;
    $sql = "UPDATE Models SET name='$name', model='$model', characteristics='$characteristics', price='$price' WHERE id=$id;";
    return $conn->query($sql);
}

function deleteModel($id)
{
    global $conn;
    $sql = "DELETE FROM Models WHERE id=$id";
    return $conn->query($sql);
}

// Handle POST request for creating and updating models
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['create_model'])) {
        createModel($_POST['name'], $_POST['model'], $_POST['characteristics'], $_POST['price']);
    }

    if (isset($_POST['model_id'])) {
        updateModel($_POST["model_id"], $_POST["model_name"], $_POST["model_model"], $_POST["model_characteristics"], $_POST["model_price"]);
    }
}

// Handle GET request for deleting a model
if (isset($_GET['delete_model'])) {
    deleteModel($_GET['delete_model']);
}

// Include the HTML structure for models table and form
include 'templates/models_table.php';
?>