<?php
// Configurações de conexão com o banco de dados
$servidor = "db"; // altere de "localhost" para "db"
$usuario = "root";
$senha = "root";
$banco = "carometro";

// Estabelece a conexão com o banco de dados
$conexao = mysqli_connect($servidor, $usuario, $senha, $banco);

// Verifica se houve erro na conexão
if (mysqli_connect_errno()) {
    die("Falha na conexão com o banco de dados: " . mysqli_connect_error());
}

// Define o charset da conexão para UTF-8
mysqli_set_charset($conexao, "utf8");

// Inicia a sessão em todas as páginas que incluem config.php
session_start();
?>