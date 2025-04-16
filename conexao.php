<?php
$servidor = "localhost";
$usuario = "root";
$senha = "";
$banco = "treinamento3"; 

$conn = new mysqli($servidor, $usuario, $senha, $banco);

// Verificando a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
} else {
  //  echo "Conectado com sucesso!";
}
?>