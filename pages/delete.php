<?php
session_start();
require_once "../config/db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = intval($_POST['id']);

    $sql = "DELETE FROM products WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: dashboard.php?status=success&msg=Produto excluído com sucesso!");
    } else {
        header("Location: dashboard.php?status=error&msg=Erro ao excluir produto.");
    }

    $stmt->close();
    $conn->close();
}
