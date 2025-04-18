<?php
include 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $item_id = $_POST['item_id'];
    $tipo_item = $_POST['tipo_item'];

    $result = $conn->query("SELECT * FROM likes WHERE item_id = $item_id AND tipo_item = '$tipo_item'");
    if ($result->num_rows > 0) {
        $conn->query("UPDATE likes SET contador = contador + 1 WHERE item_id = $item_id AND tipo_item = '$tipo_item'");
    } else {
        $stmt = $conn->prepare("INSERT INTO likes (item_id, tipo_item, contador) VALUES (?, ?, 1)");
        $stmt->bind_param("is", $item_id, $tipo_item);
        $stmt->execute();
    }
}

header("Location: index.php");
exit();
?>