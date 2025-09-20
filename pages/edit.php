<?php
session_start();
require_once "../config/db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = intval($_POST['id']);
    $name = trim($_POST['name']);
    $quantity = intval($_POST['quantity']);
    $price = floatval($_POST['price']);

    $sql = "UPDATE products SET name = ?, quantity = ?, price = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sidi", $name, $quantity, $price, $id);

    if ($stmt->execute()) {
        header("Location: dashboard.php?status=success&msg=Produto atualizado com sucesso!");
    } else {
        header("Location: dashboard.php?status=error&msg=Erro ao atualizar produto.");
    }

    $stmt->close();
    $conn->close();
}
