<?php
include 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $comentario = $_POST['comentario'];
    $item_id = $_POST['item_id'];
    $tipo_item = $_POST['tipo_item'];

    $stmt = $conn->prepare("INSERT INTO comentarios (item_id, tipo_item, comentario) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $item_id, $tipo_item, $comentario);
    $stmt->execute();
}

header("Location: index.php");
exit();
?>