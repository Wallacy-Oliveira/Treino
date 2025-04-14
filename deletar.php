<?php
include 'conexao.php';

$id = $_GET['id'] ?? null;
$tipo = $_GET['tipo'] ?? null;

if ($id && $tipo && in_array($tipo, ['filosofia', 'poemas'])) {
    $tabela = $tipo;
    $stmt = $conn->prepare("DELETE FROM $tabela WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: index.php?msg=deletado");
        exit;
    } else {
        echo "Erro ao deletar: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Parâmetros inválidos.";
}

$conn->close();
?>
