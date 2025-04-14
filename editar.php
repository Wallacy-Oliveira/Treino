<?php
include 'conexao.php';

$id = $_GET['id'] ?? null;
$tipo = $_GET['tipo'] ?? null;
$tabela = in_array($tipo, ['filosofia', 'poemas']) ? $tipo : null;

if (!$id || !$tabela) {
    die("Parâmetros inválidos.");
}

// Buscar dados existentes
$stmt = $conn->prepare("SELECT titulo, autor, " . ($tabela == 'filosofia' ? 'text_filo' : 'text_poema') . " FROM $tabela WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$registro = $result->fetch_assoc();
$stmt->close();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $texto = $_POST['texto'];

    $campo_texto = $tabela == 'filosofia' ? 'text_filo' : 'text_poema';
    $stmt = $conn->prepare("UPDATE $tabela SET titulo = ?, autor = ?, $campo_texto = ? WHERE id = ?");
    $stmt->bind_param("sssi", $titulo, $autor, $texto, $id);

    if ($stmt->execute()) {
        header("Location: index.php?msg=editado");
        exit;
    } else {
        echo "Erro ao atualizar: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <div class="titulo">
        <h1>Editando <?php echo ucfirst($tabela); ?></h1>
        <label>Altere os dados e clique em salvar</label>
    </div>
    <form method="post">
        <div class="form-group-container">
            <div class="form-group">
                <input type="text" name="titulo" placeholder="Título" value="<?= htmlspecialchars($registro['titulo']) ?>" required>
            </div>
            <div class="form-group">
                <input type="text" name="autor" placeholder="Autor" value="<?= htmlspecialchars($registro['autor']) ?>">
            </div>
        </div>

        <div class="form-group">
            <textarea name="texto" rows="6" required><?= htmlspecialchars($registro[$tabela == 'filosofia' ? 'text_filo' : 'text_poema']) ?></textarea>
        </div>

        <div class="form-group">
            <input type="submit" value="Salvar Alterações">
        </div>
    </form>
</body>
</html>
