<?php
include 'conexao.php';
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Filosofias e Poemas Salvos</title>
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
                echo "❌ Pensamento deletado com sucesso.";
            if ($_GET['msg'] === 'editado')
                echo "✅ Pensamento editado com sucesso.";
            ?>
        </div>
    <?php endif; ?>

    <div class="container">
        <?php
        // Filosofias
        $sql = "SELECT id, titulo, autor, text_filo, data_criacao FROM filosofia ORDER BY id DESC";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='filo-card'>";
                echo "<h2>" . htmlspecialchars($row['titulo']) . "</h2>";
                echo "<h4>por " . htmlspecialchars($row['autor']) . "</h4>";
                echo "<p>" . nl2br(htmlspecialchars($row['text_filo'])) . "</p>";
                echo "<small class='data-criacao'>Adicionado em: " . date("d/m/Y H:i", strtotime($row['data_criacao'])) . "</small>";
                echo "<div class='actions'>";
                echo "<a href='editar.php?id=" . $row['id'] . "&tipo=filosofia' class='btn editar'>Editar</a>";
                echo "<a href='deletar.php?id=" . $row['id'] . "&tipo=filosofia' class='btn deletar' onclick=\"return confirm('Tem certeza que deseja deletar este item?')\">Deletar</a>";
                echo "</div>";
                echo "</div>";
            }
        }

        // Poemas
        $sql = "SELECT id, titulo, autor, text_poema, data_criacao FROM poemas ORDER BY id DESC";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='filo-card'>";
                echo "<h2>" . htmlspecialchars($row['titulo']) . "</h2>";
                echo "<h4>por " . htmlspecialchars($row['autor']) . "</h4>";
                echo "<p>" . nl2br(htmlspecialchars($row['text_poema'])) . "</p>";
                echo "<small class='data-criacao'>Adicionado em: " . date("d/m/Y H:i", strtotime($row['data_criacao'])) . "</small>";
                echo "<div class='actions'>";
                echo "<a href='editar.php?id=" . $row['id'] . "&tipo=poemas' class='btn editar'>Editar</a>";
                echo "<a href='deletar.php?id=" . $row['id'] . "&tipo=poemas' class='btn deletar' onclick=\"return confirm('Tem certeza que deseja deletar este item?')\">Deletar</a>";
                echo "</div>";
                echo "</div>";
            }
        }

        $conn->close();
        ?>
    </div>
</body>

</html>
