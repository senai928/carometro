<?php
require_once 'config.php';

// Verifica se o usuário já está logado
if (isset($_SESSION['usuario_id'])) {
    header("Location: visitante.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistema de Visitantes</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        
        .container {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: 400px;
            max-width: 100%;
        }
        
        .header {
            background-color: #3498db;
            padding: 20px;
            text-align: center;
        }
        
        .header h2 {
            color: white;
            font-weight: 600;
            margin: 0;
        }
        
        .form {
            padding: 30px 40px;
        }
        
        .form-control {
            margin-bottom: 20px;
            position: relative;
        }
        
        .form-control label {
            display: block;
            margin-bottom: 8px;
            color: #555;
            font-weight: 500;
        }
        
        .form-control input {
            border: 2px solid #f0f0f0;
            border-radius: 4px;
            display: block;
            width: 100%;
            padding: 12px;
            font-size: 14px;
        }
        
        .form-control input:focus {
            outline: none;
            border-color: #3498db;
        }
        
        .form button {
            background-color: #3498db;
            border: none;
            color: white;
            display: block;
            width: 100%;
            padding: 12px;
            font-size: 16px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        
        .form button:hover {
            background-color: #2980b9;
        }
        
        .link-cadastro {
            text-align: center;
            margin-top: 20px;
        }
        
        .link-cadastro a {
            color: #3498db;
            text-decoration: none;
        }
        
        .link-cadastro a:hover {
            text-decoration: underline;
        }
        
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 4px;
        }
        
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Login</h2>
        </div>
        
        <form class="form" action="processar_login.php" method="POST">
            <?php
            if (isset($_SESSION['mensagem'])) {
                $tipo_classe = (strpos($_SESSION['mensagem'], 'sucesso') !== false) ? 'alert-success' : 'alert-danger';
                echo '<div class="alert ' . $tipo_classe . '">' . $_SESSION['mensagem'] . '</div>';
                unset($_SESSION['mensagem']);
            }
            ?>
            
            <div class="form-control">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="Seu email" required>
            </div>
            
            <div class="form-control">
                <label for="senha">Senha</label>
                <input type="password" name="senha" id="senha" placeholder="Sua senha" required>
            </div>
            
            <button type="submit">Entrar</button>
            
            <div class="link-cadastro">
                <p>Não tem uma conta? <a href="cadastro.php">Cadastre-se</a></p>
            </div>
        </form>
    </div>
</body>
</html>