<?php 
include 'conexao.php';
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Filosofias e Poemas Salvos</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="imagex/png" href="./img/casa.png">
    <link rel="stylesheet" href="./css/stylev.css">
</head>

<body>

    <!-- Barra de navegação -->
    <nav class="navbar">
        <ul>
            <li><a href="index.php">Início</a></li>
            <li><a href="filosofias.php">Criar Filosofia</a></li>
            <li><a href="poemas.php">Criar Poema</a></li>
            <li><a href="sobre.html">Sobre</a></li>
        </ul>
    </nav>

    <div class="titulo">
        <h1>Filosofias e Poemas Salvos</h1>
        <label>Veja abaixo tudo que foi registrado</label>
    </div>

    <?php if (isset($_GET['msg'])): ?>
        <div class="mensagem">
            <?php
            if ($_GET['msg'] === 'deletado')
                echo "❌ Deletado com sucesso.";
            if ($_GET['msg'] === 'editado')
                echo "✅ Editado com sucesso.";
            ?>
        </div>
    <?php endif; ?>
<!-- código HTML do <head> e nav mantido como está -->

<div class="container">
    <?php
    // Filosofias
    $sql = "SELECT id, titulo, autor, text_filo, data_criacao FROM filosofia ORDER BY id DESC";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $id = $row['id'];
            $likes = $conn->query("SELECT contador FROM likes WHERE item_id = $id AND tipo_item = 'filosofia'")
                         ->fetch_assoc()['contador'] ?? 0;

            echo "<div class='filo-card'>";
            echo "<h2> 🧠 " . htmlspecialchars($row['titulo']) . "</h2>";
            echo "<h4>por " . htmlspecialchars($row['autor']) . "</h4>";
            echo "<p>" . nl2br(htmlspecialchars($row['text_filo'])) . "</p>";
            echo "<small class='data-criacao'>Adicionado em: " . date("d/m/Y H:i", strtotime($row['data_criacao'])) . "</small>";

            echo "<div class='actions'>
                    <a href='editar.php?id=$id&tipo=filosofia' class='btn editar'>Editar</a>
                    <a href='deletar.php?id=$id&tipo=filosofia' class='btn deletar' onclick=\"return confirm('Tem certeza que deseja deletar este item?')\">Deletar</a>
                  </div>";

            echo "<form method='POST' action='salvar_like.php'>
                    <input type='hidden' name='item_id' value='$id'>
                    <input type='hidden' name='tipo_item' value='filosofia'>
                    <button type='submit'>Curtir 👍 ($likes)</button>
                  </form>";

            echo "<form method='POST' action='salvar_comentario.php'>
                    <textarea name='comentario' required></textarea>
                    <input type='hidden' name='item_id' value='$id'>
                    <input type='hidden' name='tipo_item' value='filosofia'>
                    <button type='submit'>Comentar</button>
                  </form>";

            $comentarios = $conn->query("SELECT comentario, data_comentario FROM comentarios WHERE item_id = $id AND tipo_item = 'filosofia'");
            while ($com = $comentarios->fetch_assoc()) {
                echo "<div class='comentario'><p>{$com['comentario']}</p><small>{$com['data_comentario']}</small></div>";
            }

            echo "</div>";
        }
    }

    // Poemas
    $sql = "SELECT id, titulo, autor, text_poema, data_criacao FROM poemas ORDER BY id DESC";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $id = $row['id'];
            $likes = $conn->query("SELECT contador FROM likes WHERE item_id = $id AND tipo_item = 'poema'")
                         ->fetch_assoc()['contador'] ?? 0;

            echo "<div class='filo-card'>";
            echo "<h2>📜 " . htmlspecialchars($row['titulo']) . "</h2>";
            echo "<h4>por " . htmlspecialchars($row['autor']) . "</h4>";
            echo "<p>" . nl2br(htmlspecialchars($row['text_poema'])) . "</p>";
            echo "<small class='data-criacao'>Adicionado em: " . date("d/m/Y H:i", strtotime($row['data_criacao'])) . "</small>";

            echo "<div class='actions'>
                    <a href='editar.php?id=$id&tipo=poemas' class='btn editar'>Editar</a>
                    <a href='deletar.php?id=$id&tipo=poemas' class='btn deletar' onclick=\"return confirm('Tem certeza que deseja deletar este item?')\">Deletar</a>
                  </div>";

            echo "<form method='POST' action='salvar_like.php'>
                    <input type='hidden' name='item_id' value='$id'>
                    <input type='hidden' name='tipo_item' value='poema'>
                    <button type='submit'>Curtir 👍 ($likes)</button>
                  </form>";

            echo "<form method='POST' action='salvar_comentario.php'>
                    <textarea name='comentario' required></textarea>
                    <input type='hidden' name='item_id' value='$id'>
                    <input type='hidden' name='tipo_item' value='poema'>
                    <button type='submit'>Comentar</button>
                  </form>";

            $comentarios = $conn->query("SELECT comentario, data_comentario FROM comentarios WHERE item_id = $id AND tipo_item = 'poema'");
            while ($com = $comentarios->fetch_assoc()) {
                echo "<div class='comentario'><p>{$com['comentario']}</p><small>{$com['data_comentario']}</small></div>";
            }

            echo "</div>";
        }
    }

    $conn->close();
    ?>
</div>
</body>

</html>