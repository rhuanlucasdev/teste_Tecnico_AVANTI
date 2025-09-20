<?php
session_start();
require_once "../config/db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $quantity = intval($_POST['quantity']);
    $price = floatval($_POST['price']);

    $sql = "INSERT INTO products (name, quantity, price) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sid", $name, $quantity, $price);

    if ($stmt->execute()) {
        header("Location: dashboard.php?status=success&msg=Produto adicionado com sucesso!");
    } else {
        header("Location: dashboard.php?status=error&msg=Erro ao adicionar produto.");
    }

    $stmt->close();
    $conn->close();
}
