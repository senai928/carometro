<?php
require_once 'config.php';

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recebe os dados do formulário
    $nome = mysqli_real_escape_string($conexao, $_POST['nome']);
    $email = mysqli_real_escape_string($conexao, $_POST['email']);
    $senha = $_POST['senha'];
    $confirmar_senha = $_POST['confirmar_senha'];
    $fone = mysqli_real_escape_string($conexao, $_POST['fone']);
    $setor = mysqli_real_escape_string($conexao, $_POST['setor']);
    
    // Validações básicas
    if (empty($nome) || empty($email) || empty($senha)) {
        $_SESSION['mensagem'] = "Preencha todos os campos obrigatórios.";
        header("Location: cadastro.php");
        exit();
    }
    
    // Verifica se as senhas coincidem
    if ($senha !== $confirmar_senha) {
        $_SESSION['mensagem'] = "As senhas não coincidem.";
        header("Location: cadastro.php");
        exit();
    }
    
    // Verifica se o email já está cadastrado
    $query = "SELECT id FROM usuarios WHERE email = '$email'";
    $resultado = mysqli_query($conexao, $query);
    
    if (mysqli_num_rows($resultado) > 0) {
        $_SESSION['mensagem'] = "Este email já está cadastrado.";
        header("Location: cadastro.php");
        exit();
    }
    
    // Criptografa a senha
    $senha_criptografada = password_hash($senha, PASSWORD_DEFAULT);
    
    // Insere o usuário no banco de dados
    $query = "INSERT INTO usuarios (nome, email, senha, fone, setor) VALUES ('$nome', '$email', '$senha_criptografada', '$fone', '$setor')";
    
    if (mysqli_query($conexao, $query)) {
        $_SESSION['mensagem'] = "Cadastro realizado com sucesso! Faça login para continuar.";
        header("Location: index.php");
        exit();
    } else {
        $_SESSION['mensagem'] = "Erro ao cadastrar: " . mysqli_error($conexao);
        header("Location: cadastro.php");
        exit();
    }
} else {
    // Se alguém tentou acessar diretamente este arquivo
    header("Location: cadastro.php");
    exit();
}
?>
