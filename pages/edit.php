<?php
require_once "../config/db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];

    $sql = "UPDATE products SET name=?, quantity=?, price=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sidi", $name, $quantity, $price, $id);

    if ($stmt->execute()) {
        header("Location: dashboard.php");
    } else {
        echo "Erro ao editar produto.";
    }
}
?>
