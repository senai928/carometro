<?php
// Iniciar sessão
session_start();

// Conexão com o banco de dados
$servidor = "db"; // altere de "localhost" para "db"
$usuario = "root";
$senha = "root";
$banco = "carometro";

$conexao = mysqli_connect($servidor, $usuario, $senha, $banco);


if (!$conexao) {
    die("Falha na conexão: " . mysqli_connect_error());
}

// Função para buscar alunos
function buscarAlunos($conexao, $turma = null, $termo = null) {
    $sql = "SELECT * FROM alunos WHERE 1=1";
    
    if ($turma) {
        $sql .= " AND turma = '$turma'";
    }
    
    if ($termo) {
        $sql .= " AND (nome LIKE '%$termo%' OR email LIKE '%$termo%' OR cpf LIKE '%$termo%')";
    }
    
    $resultado = mysqli_query($conexao, $sql);
    $alunos = [];
    
    while ($aluno = mysqli_fetch_assoc($resultado)) {
        $alunos[] = $aluno;
    }
    
    return $alunos;
}



// Função para contar alunos por turma
function contarAlunosPorTurma($conexao, $turma) {
    $sql = "SELECT COUNT(*) as total FROM alunos WHERE turma = '$turma'";
    $resultado = mysqli_query($conexao, $sql);
    $dados = mysqli_fetch_assoc($resultado);
    return $dados['total'];
}

// Processar ação de busca
$termo_busca = isset($_GET['busca']) ? $_GET['busca'] : '';

// Processar ação de exclusão
if (isset($_GET['excluir'])) {
    $id = $_GET['excluir'];
    $sql = "DELETE FROM alunos WHERE id = $id";
    
    if (mysqli_query($conexao, $sql)) {
        $_SESSION['mensagem'] = "Aluno excluído com sucesso!";
    } else {
        $_SESSION['mensagem'] = "Erro ao excluir aluno: " . mysqli_error($conexao);
    }
    
    header("Location: carometro.php");
    exit();
}

// Definir turma atual
$turma_atual = isset($_GET['turma']) ? $_GET['turma'] : 'Idev 2';
$alunos = buscarAlunos($conexao, $turma_atual, $termo_busca);

// Contar alunos por turma
$total_idev2 = contarAlunosPorTurma($conexao, 'Idev 2');
$total_idev3 = contarAlunosPorTurma($conexao, 'Idev 3');
$total_idev4 = contarAlunosPorTurma($conexao, 'Idev 4');
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carômetro Digital</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
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
        /* Estilos apenas para as fotos quadradas e maiores */
        .card .photo {
            width: 330px;
            height: 250px;
            margin: 0 auto 10px;
            overflow: hidden;
            border-radius: 0 !important;
        }
        
        .card .photo img {
            width: 100% !important;
            height: 100% !important;
            object-fit: cover !important;
            border-radius: 0 !important;
            -webkit-border-radius: 0 !important;
            -moz-border-radius: 0 !important;
        }
        
        /* Sobrescrever qualquer outro estilo que possa estar afetando */
        .cards-container .card .photo,
        .cards-container .card .photo img,
        .container .cards-container .card .photo img {
            border-radius: 0 !important;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <h1>Carômetro Alunos </h1>
        <div class="user-info">
            <div class="user-name">Olá, <?php echo htmlspecialchars($_SESSION['usuario_nome']); ?>!</div>
            <a href="logout.php" class="logout-btn">Sair</a>
        </div>
    </div>
    <div class="container">
        <header>
            <h1>Carômetro Senai</h1>
        </header>
        
        <div class="search-add">
            <form action="carometro.php" method="GET" class="search-form">
                <input type="hidden" name="turma" value="<?php echo $turma_atual; ?>">
                <input type="text" name="busca" placeholder="Buscar aluno..." value="<?php echo $termo_busca; ?>">
                <button type="submit" class="search-btn"><i class="fas fa-search"></i></button>
            </form>
            <a href="adicionar.php" class="add-btn"><i class="fas fa-plus"></i> Adicionar Aluno</a>
        </div>
        
        <div class="tabs">
            <a href="?turma=Idev 2" class="tab <?php echo $turma_atual == 'Idev 2' ? 'active' : ''; ?>">Idev 2</a>
            <a href="?turma=Idev 3" class="tab <?php echo $turma_atual == 'Idev 3' ? 'active' : ''; ?>">Idev 3</a>
            <a href="?turma=Idev 4" class="tab <?php echo $turma_atual == 'Idev 4' ? 'active' : ''; ?>">Idev 4</a>

        </div>
        
        <h2 class="turma-titulo">Turma <?php echo $turma_atual; ?> - <?php 
            $total = $turma_atual == 'Idev 2' ? $total_idev2 : ($turma_atual == 'Idev 3' ? $total_idev3 : $total_idev4);
            echo $total; 
        ?> Alunos</h2>
        
        <?php if (isset($_SESSION['mensagem'])): ?>
            <div class="mensagem">
                <?php 
                    echo $_SESSION['mensagem']; 
                    unset($_SESSION['mensagem']);
                ?>
            </div>
        <?php endif; ?>
        
        <div class="cards-container">
            <?php foreach ($alunos as $aluno): ?>
                <div class="card">
                    <div class="photo">
                        <img src="<?php echo !empty($aluno['foto']) ? 'uploads/' . $aluno['foto'] : 'img/perfil-padrao.jpg'; ?>" alt="<?php echo $aluno['nome']; ?>">
                    </div>
                    <h3><?php echo $aluno['nome']; ?></h3>
                    <p class="cpf">CPF: <?php echo $aluno['cpf']; ?></p>
                    <p class="telefone"><?php echo $aluno['telefone']; ?></p>
                    <p class="email"><?php echo $aluno['email']; ?></p>
                    <div class="acoes">
                        <a href="tel:<?php echo $aluno['telefone']; ?>" class="acao-btn ligar"><i class="fas fa-phone"></i></a>
                        <a href="mailto:<?php echo $aluno['email']; ?>" class="acao-btn email"><i class="fas fa-envelope"></i></a>
                        <a href="editar.php?id=<?php echo $aluno['id']; ?>" class="acao-btn editar"><i class="fas fa-edit"></i></a>
                        <a href="?excluir=<?php echo $aluno['id']; ?>&turma=<?php echo $turma_atual; ?>" class="acao-btn excluir" onclick="return confirm('Tem certeza que deseja excluir este aluno?')"><i class="fas fa-trash"></i></a>
                    </div>
                </div>
            <?php endforeach; ?>
            
            <?php if (empty($alunos)): ?>
                <p class="sem-alunos">Nenhum aluno encontrado nesta turma.</p>
            <?php endif; ?>
        </div>
    </div>
    
    <script src="js/script.js"></script>
</body>
</html>