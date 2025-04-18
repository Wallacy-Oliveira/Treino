<?php include 'conexao.php'; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Filosofias e Poemas Salvos</title>
  <link rel="stylesheet" href="./treino/css/stylev.css">
</head>
<body>

<div class="container">
<?php
// Exibe Filosofias
$sql = "SELECT * FROM filosofia ORDER BY id DESC";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
    $id = $row['id'];
    $likes = $conn->query("SELECT contador FROM likes WHERE item_id = $id AND tipo_item = 'filosofia'")->fetch_assoc()['contador'] ?? 0;
    echo "<div class='filo-card'>";
    echo "<h2>{$row['titulo']}</h2>";
    echo "<p>{$row['text_filo']}</p>";
    echo "<small>{$row['data_criacao']}</small>";

    echo "<form method='POST' action='salvar_like.php'>
            <input type='hidden' name='item_id' value='{$id}'>
            <input type='hidden' name='tipo_item' value='filosofia'>
            <button type='submit'>Curtir 👍 ($likes)</button>
          </form>";

    echo "<form method='POST' action='salvar_comentario.php'>
            <textarea name='comentario' required></textarea>
            <input type='hidden' name='item_id' value='{$id}'>
            <input type='hidden' name='tipo_item' value='filosofia'>
            <button type='submit'>Comentar</button>
          </form>";

    // Mostrar comentários
    $comentarios = $conn->query("SELECT comentario, data_comentario FROM comentarios WHERE item_id = $id AND tipo_item = 'filosofia'");
    while ($com = $comentarios->fetch_assoc()) {
        echo "<div class='comentario'><p>{$com['comentario']}</p><small>{$com['data_comentario']}</small></div>";
    }

    echo "</div>";
}
?>
</div>
</body>
</html>
