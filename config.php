<?php
// Configurações de conexão com o banco de dados
$host = "localhost";
$usuario_db = "root";
$senha_db = "";
$banco_db = "carometro";

// Estabelece a conexão com o banco de dados
$conexao = mysqli_connect($host, $usuario_db, $senha_db, $banco_db);

// Verifica se houve erro na conexão
if (mysqli_connect_errno()) {
    die("Falha na conexão com o banco de dados: " . mysqli_connect_error());
}

// Define o charset da conexão para UTF-8
mysqli_set_charset($conexao, "utf8");

// Inicia a sessão em todas as páginas que incluem config.php
session_start();
?>