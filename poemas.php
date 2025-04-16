<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="shortcut icon" type="imagex/png" href="./img/editar.png">
    <title>Área de escrita</title>
</head>

<body>
    <nav class="navbar">
        <ul>
            <li><a href="index.php">Inicio</a></li>
            <li><a href="filosofias.php">Criar Filosofia</a></li>
            <li><a href="poemas.php">Criar Poema</a></li>
            <li><a href="sobre.html">Sobre</a></li>
        </ul>
    </nav>

    <div class="titulo">
        <h1>Área de escrita</h1>
        <label>Escreva seu poema abaixo</label>
    </div>
    <form action="poemas.php" method="post">
        <div class="form-group-container">
            <div class="form-group">
                <input type="text" name="titulo" placeholder="Título" required>
            </div>
            <div class="form-group">
                <input type="text" name="autor" placeholder="Autor (opcional )">
            </div>
        </div>

        <div class="form-group">
            <textarea name="text_poema" placeholder="escreva seu poema" rows="6" required></textarea>
        </div>


        <div class="form-group">
            <input type="submit" value="Salvar">
        </div>
    </form>

    <?php
    include 'conexao.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Verifica se os campos estão definidos e não estão vazios
        $titulo = $_POST['titulo'] ?? '';
        $autor = $_POST['autor'] ?? '';
        $text_poema = $_POST['text_poema'] ?? '';

        if ($titulo && $autor && $text_poema) {
            // Prepara o SQL com placeholders
            $stmt = $conn->prepare("INSERT INTO poemas (titulo, autor, text_poema) VALUES (?, ?, ?)");

            if ($stmt) {
                // Vincula os parâmetros (s = string, s = string, s = string)
                $stmt->bind_param("sss", $titulo, $autor, $text_poema);

                if ($stmt->execute()) {
                    echo "<p class='success'>✅ poema inserido com sucesso!</p>";
                } else {
                    //  echo "<p class='error'>❌ Erro ao inserir: " . $stmt->error . "</p>";
                }

                $stmt->close();
            } else {
                // echo "<p class='error'>❌ Erro ao preparar: " . $conn->error . "</p>";
            }
        } else {
            // echo "<p class='error'>❌ Por favor, preencha todos os campos!</p>";
        }

        $conn->close();

    }
    ?>

</body>

</html>