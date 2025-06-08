<?php
require_once 'config.php';

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.php");
    exit();
}

// Busca informações do usuário
$usuario_id = $_SESSION['usuario_id'];
$query = "SELECT * FROM usuarios WHERE id = '$usuario_id'";
$resultado = mysqli_query($conexao, $query);
$usuario = mysqli_fetch_assoc($resultado);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Sistema de Visitantes</title>
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
            min-height: 100vh;
        }
        
        .navbar {
            background-color: #3498db;
            color: white;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        
        .navbar h1 {
            font-size: 1.5rem;
            font-weight: 600;
        }
        
        .navbar .user-info {
            display: flex;
            align-items: center;
        }
        
        .navbar .user-name {
            margin-right: 20px;
        }
        
        .navbar .logout-btn {
            background-color: #2980b9;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
            text-decoration: none;
            font-size: 14px;
        }
        
        .navbar .logout-btn:hover {
            background-color: #1c6ca1;
        }
        
        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
        }
        
        .welcome-card {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin-bottom: 30px;
            text-align: center;
        }
        
        .welcome-card h2 {
            color: #333;
            margin-bottom: 15px;
        }
        
        .welcome-card p {
            color: #666;
            line-height: 1.6;
        }
        
        .info-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }
        
        .card {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            padding: 20px;
            transition: transform 0.3s;
        }
        
        .card:hover {
            transform: translateY(-5px);
        }
        
        .card h3 {
            color: #3498db;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
        }
        
        .card h3 i {
            margin-right: 10px;
        }
        
        .card p {
            color: #666;
            line-height: 1.6;
        }
        
        .profile-info {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin-top: 30px;
        }
        
        .profile-info h2 {
            color: #333;
            margin-bottom: 20px;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
        }
        
        .profile-detail {
            display: flex;
            margin-bottom: 15px;
        }
        
        .profile-detail strong {
            width: 120px;
            color: #555;
        }
        
        .profile-detail span {
            color: #666;
        }
        
        @media screen and (max-width: 768px) {
            .navbar {
                flex-direction: column;
                padding: 15px;
            }
            
            .navbar h1 {
                margin-bottom: 10px;
            }
            
            .navbar .user-info {
                flex-direction: column;
                align-items: center;
            }
            
            .navbar .user-name {
                margin-right: 0;
                margin-bottom: 10px;
            }
            
            .info-cards {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="navbar">
        <h1>Sistema de Visitantes</h1>
        <div class="user-info">
            <div class="user-name">Olá, <?php echo htmlspecialchars($usuario['nome']); ?>!</div>
            <a href="logout.php" class="logout-btn">Sair</a>
        </div>
    </div>
    
    <div class="container">
        <div class="welcome-card">
            <h2>Bem-vindo ao Sistema de Visitantes</h2>
            <p>Gerencie seus visitantes de forma simples e eficiente.</p>
        </div>
        
        
        
        <div class="profile-info">
            <h2>Informações do Perfil</h2>
            
            <div class="profile-detail">
                <strong>Nome:</strong>
                <span><?php echo htmlspecialchars($usuario['nome']); ?></span>
            </div>
            
            <div class="profile-detail">
                <strong>Email:</strong>
                <span><?php echo htmlspecialchars($usuario['email']); ?></span>
            </div>
            
            <div class="profile-detail">
                <strong>Telefone:</strong>
                <span><?php echo htmlspecialchars($usuario['fone']) ?: 'Não informado'; ?></span>
            </div>
            
            <div class="profile-detail">
                <strong>Setor:</strong>
                <span><?php echo htmlspecialchars($usuario['setor']) ?: 'Não informado'; ?></span>
            </div>
            
            <div class="profile-detail">
                <strong>Cadastrado em:</strong>
                <span><?php echo date('d/m/Y H:i', strtotime($usuario['data_cadastro'])); ?></span>
            </div>
        </div>
    </div>
</body>
</html>