<?php
require_once 'config.php';

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recebe os dados do formulário
    $email = mysqli_real_escape_string($conexao, $_POST['email']);
    $senha = $_POST['senha'];
    
    // Validações básicas
    if (empty($email) || empty($senha)) {
        $_SESSION['mensagem'] = "Preencha todos os campos.";
        header("Location: index.php");
        exit();
    }
    
    // Busca o usuário no banco de dados
    $query = "SELECT id, nome, email, senha FROM usuarios WHERE email = '$email'";
    $resultado = mysqli_query($conexao, $query);
    
    if (mysqli_num_rows($resultado) == 1) {
        $usuario = mysqli_fetch_assoc($resultado);
        
        // Verifica se a senha está correta
        if (password_verify($senha, $usuario['senha'])) {
            // Guarda os dados do usuário na sessão
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario_nome'] = $usuario['nome'];
            $_SESSION['usuario_email'] = $usuario['email'];
            
            // Redireciona para a página de carometro
            header("Location: carometro.php");
            exit();
        } else {
            $_SESSION['mensagem'] = "Email ou senha incorretos.";
            header("Location: index.php");
            exit();
        }
    } else {
        $_SESSION['mensagem'] = "Email ou senha incorretos.";
        header("Location: index.php");
        exit();
    }
} else {
    // Se alguém tentou acessar diretamente este arquivo
    header("Location: index.php");
    exit();
}
?>