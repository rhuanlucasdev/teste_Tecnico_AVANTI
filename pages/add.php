<?php
require_once "../config/db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];

    $sql = "INSERT INTO products (name, quantity, price) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sid", $name, $quantity, $price);

    if ($stmt->execute()) {
        header("Location: dashboard.php");
    } else {
        echo "Erro ao adicionar produto.";
    }
}
?>
