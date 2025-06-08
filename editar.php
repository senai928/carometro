<?php
// Iniciar sessão
session_start();

// Conexão com o banco de dados
$servidor = "localhost";
$usuario = "root";
$senha = "";
$banco = "carometro";

$conexao = mysqli_connect($servidor, $usuario, $senha, $banco);

if (!$conexao) {
    die("Falha na conexão: " . mysqli_connect_error());
}

// Verificar se o ID foi fornecido
if (!isset($_GET['id']) || empty($_GET['id'])) {
    $_SESSION['mensagem'] = "ID do aluno não fornecido!";
    header("Location: carometro.php");
    exit();
}

$id = mysqli_real_escape_string($conexao, $_GET['id']);

// Buscar dados do aluno
$sql = "SELECT * FROM alunos WHERE id = $id";
$resultado = mysqli_query($conexao, $sql);

if (mysqli_num_rows($resultado) == 0) {
    $_SESSION['mensagem'] = "Aluno não encontrado!";
    header("Location: carometro.php");
    exit();
}

$aluno = mysqli_fetch_assoc($resultado);

// Processar o formulário enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = mysqli_real_escape_string($conexao, $_POST['nome']);
    $cpf = mysqli_real_escape_string($conexao, $_POST['cpf']);
    $telefone = mysqli_real_escape_string($conexao, $_POST['telefone']);
    $email = mysqli_real_escape_string($conexao, $_POST['email']);
    $turma = mysqli_real_escape_string($conexao, $_POST['turma']);
    
    $foto = $aluno['foto']; // Manter a foto existente
    $diretorio_destino = "uploads/";
    
    // Processar foto capturada pela câmera
    if (!empty($_POST['foto_camera'])) {
        // Criar diretório se não existir
        if (!file_exists($diretorio_destino)) {
            mkdir($diretorio_destino, 0777, true);
        }
        
        // Processar a imagem base64 enviada
        $img = $_POST['foto_camera'];
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace('data:image/jpeg;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        
        $nome_arquivo = uniqid() . '.png';
        $caminho_arquivo = $diretorio_destino . $nome_arquivo;
        
        if (file_put_contents($caminho_arquivo, $data)) {
            // Remover foto antiga se existir
            if (!empty($aluno['foto']) && file_exists($diretorio_destino . $aluno['foto'])) {
                unlink($diretorio_destino . $aluno['foto']);
            }
            $foto = $nome_arquivo;
        } else {
            $_SESSION['mensagem'] = "Erro ao salvar a imagem capturada!";
            header("Location: editar.php?id=$id");
            exit();
        }
    }
    // Processar upload de nova foto
    elseif (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        // Criar diretório se não existir
        if (!file_exists($diretorio_destino)) {
            mkdir($diretorio_destino, 0777, true);
        }
        
        $extensao = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
        $nome_arquivo = uniqid() . '.' . $extensao;
        $caminho_arquivo = $diretorio_destino . $nome_arquivo;
        
        // Verificar tamanho e tipo de arquivo
        $permitidos = ['jpg', 'jpeg', 'png', 'gif'];
        if (in_array(strtolower($extensao), $permitidos)) {
            if (move_uploaded_file($_FILES['foto']['tmp_name'], $caminho_arquivo)) {
                // Remover foto antiga se existir
                if (!empty($aluno['foto']) && file_exists($diretorio_destino . $aluno['foto'])) {
                    unlink($diretorio_destino . $aluno['foto']);
                }
                $foto = $nome_arquivo;
            } else {
                $_SESSION['mensagem'] = "Erro ao fazer upload da foto!";
                header("Location: editar.php?id=$id");
                exit();
            }
        } else {
            $_SESSION['mensagem'] = "Tipo de arquivo não permitido!";
            header("Location: editar.php?id=$id");
            exit();
        }
    }
    
    // Atualizar no banco de dados
    $sql = "UPDATE alunos 
            SET nome = '$nome', cpf = '$cpf', telefone = '$telefone', 
                email = '$email', turma = '$turma', foto = '$foto' 
            WHERE id = $id";
    
    if (mysqli_query($conexao, $sql)) {
        $_SESSION['mensagem'] = "Aluno atualizado com sucesso!";
        header("Location: carometro.php?turma=$turma");
        exit();
    } else {
        $_SESSION['mensagem'] = "Erro ao atualizar aluno: " . mysqli_error($conexao);
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Aluno - Carômetro Digital</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .camera-container {
            max-width: 500px;
            margin: 10px 0;
            display: none;
        }
        #video {
            width: 100%;
            height: auto;
            background-color: #f0f0f0;
            border: 1px solid #ddd;
        }
        #canvas {
            display: none;
        }
        .camera-buttons {
            margin-top: 10px;
            display: flex;
            gap: 10px;
        }
        .captured-photo {
            max-width: 200px;
            margin-top: 10px;
            border: 1px solid #ddd;
            display: none;
        }
        .upload-option, .camera-option {
            margin-right: 15px;
            cursor: pointer;
        }
        .tab-buttons {
            margin-bottom: 15px;
        }
        .tab-buttons button {
            padding: 8px 15px;
            background-color: #f0f0f0;
            border: 1px solid #ddd;
            cursor: pointer;
        }
        .tab-buttons button.active {
            background-color: #007bff;
            color: white;
            border-color: #007bff;
        }
        .upload-container, .camera-container {
            display: none;
        }
        .upload-container.active, .camera-container.active {
            display: block;
        }
        .foto-atual {
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
            display: inline-block;
        }
        .foto-atual img {
            display: block;
            margin-bottom: 5px;
        }
        .foto-atual p {
            margin: 0;
            font-size: 0.9em;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>Carômetro Digital</h1>
            <p>Editar Aluno</p>
        </header>
        
        <?php if (isset($_SESSION['mensagem'])): ?>
            <div class="mensagem">
                <?php 
                    echo $_SESSION['mensagem']; 
                    unset($_SESSION['mensagem']);
                ?>
            </div>
        <?php endif; ?>
        
        <div class="form-container">
            <form action="editar.php?id=<?php echo $id; ?>" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="nome">Nome Completo:</label>
                    <input type="text" id="nome" name="nome" value="<?php echo $aluno['nome']; ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="cpf">CPF:</label>
                    <input type="text" id="cpf" name="cpf" value="<?php echo $aluno['cpf']; ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="telefone">Telefone:</label>
                    <input type="text" id="telefone" name="telefone" value="<?php echo $aluno['telefone']; ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="email">E-mail:</label>
                    <input type="email" id="email" name="email" value="<?php echo $aluno['email']; ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="turma">Turma:</label>
                    <select id="turma" name="turma" required>
                        <option value="prof" <?php echo $aluno['turma'] == 'prof' ? 'selected' : ''; ?>>Profesores</option>
                        <option value="Idev 2" <?php echo $aluno['turma'] == 'Idev 2' ? 'selected' : ''; ?>>Idev 2</option>
                        <option value="Idev 3" <?php echo $aluno['turma'] == 'Idev 3' ? 'selected' : ''; ?>>Idev 3</option>
                        <option value="Idev 4" <?php echo $aluno['turma'] == 'Idev 4' ? 'selected' : ''; ?>>Idev 4</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label>Foto:</label>
                    
                    <?php if (!empty($aluno['foto'])): ?>
                        <div class="foto-atual">
                            <img src="uploads/<?php echo $aluno['foto']; ?>" alt="<?php echo $aluno['nome']; ?>" style="max-width: 100px; max-height: 100px;">
                            <p>Foto atual</p>
                        </div>
                    <?php endif; ?>
                    
                    <div class="tab-buttons">
                        <button type="button" id="upload-tab" class="active">Upload de arquivo</button>
                        <button type="button" id="camera-tab">Usar câmera</button>
                    </div>
                    
                    <div class="upload-container active">
                        <input type="file" id="foto" name="foto" accept="image/*">
                        <small>Deixe em branco para manter a foto atual</small>
                    </div>
                    
                    <div class="camera-container">
                        <video id="video" autoplay playsinline></video>
                        <canvas id="canvas"></canvas>
                        <div class="camera-buttons">
                            <button type="button" id="capture" class="btn">Capturar Foto</button>
                            <button type="button" id="recapture" class="btn" style="display: none;">Nova Foto</button>
                        </div>
                        <img id="captured-photo" class="captured-photo" alt="Foto capturada">
                        <input type="hidden" name="foto_camera" id="foto_camera">
                        <small>Deixe sem capturar para manter a foto atual</small>
                    </div>
                </div>
                
                <div class="form-buttons">
                    <a href="carometro.php" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                </div>
            </form>
        </div>
    </div>
    
    <script>
        // Máscara para o CPF
        document.getElementById('cpf').addEventListener('input', function (e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length > 11) value = value.slice(0, 11);
            
            if (value.length > 9) {
                value = value.replace(/^(\d{3})(\d{3})(\d{3})(\d{1,2})$/, "$1.$2.$3-$4");
            } else if (value.length > 6) {
                value = value.replace(/^(\d{3})(\d{3})(\d{1,3})$/, "$1.$2.$3");
            } else if (value.length > 3) {
                value = value.replace(/^(\d{3})(\d{1,3})$/, "$1.$2");
            }
            
            e.target.value = value;
        });
        
        // Máscara para o telefone
        document.getElementById('telefone').addEventListener('input', function (e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length > 11) value = value.slice(0, 11);
            
            if (value.length > 10) {
                value = value.replace(/^(\d{2})(\d{5})(\d{4})$/, "($1) $2-$3");
            } else if (value.length > 6) {
                value = value.replace(/^(\d{2})(\d{4})(\d{0,4})$/, "($1) $2-$3");
            } else if (value.length > 2) {
                value = value.replace(/^(\d{2})(\d{0,5})$/, "($1) $2");
            }
            
            e.target.value = value;
        });

        // Funcionalidade de captura de câmera
        const uploadTab = document.getElementById('upload-tab');
        const cameraTab = document.getElementById('camera-tab');
        const uploadContainer = document.querySelector('.upload-container');
        const cameraContainer = document.querySelector('.camera-container');
        const video = document.getElementById('video');
        const canvas = document.getElementById('canvas');
        const captureButton = document.getElementById('capture');
        const recaptureButton = document.getElementById('recapture');
        const capturedPhoto = document.getElementById('captured-photo');
        const fotoCameraInput = document.getElementById('foto_camera');
        let stream;

        // Alternar entre as opções de upload e câmera
        uploadTab.addEventListener('click', function() {
            uploadTab.classList.add('active');
            cameraTab.classList.remove('active');
            uploadContainer.classList.add('active');
            cameraContainer.classList.remove('active');
            stopCamera();
        });

        cameraTab.addEventListener('click', function() {
            cameraTab.classList.add('active');
            uploadTab.classList.remove('active');
            cameraContainer.classList.add('active');
            uploadContainer.classList.remove('active');
            startCamera();
        });

        // Iniciar a câmera
        function startCamera() {
            if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
                navigator.mediaDevices.getUserMedia({ video: true })
                    .then(function(mediaStream) {
                        stream = mediaStream;
                        video.srcObject = mediaStream;
                        video.play();
                    })
                    .catch(function(err) {
                        console.log("Ocorreu um erro ao acessar a câmera: " + err);
                        alert("Não foi possível acessar a câmera. Verifique as permissões ou use o upload de arquivo.");
                    });
            } else {
                alert("Seu navegador não suporta acesso à câmera. Por favor, use o upload de arquivo.");
            }
        }

        // Parar a câmera
        function stopCamera() {
            if (stream) {
                stream.getTracks().forEach(track => {
                    track.stop();
                });
                video.srcObject = null;
            }
        }

        // Capturar foto
        captureButton.addEventListener('click', function() {
            const context = canvas.getContext('2d');
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            context.drawImage(video, 0, 0, canvas.width, canvas.height);
            
            // Mostrar a imagem capturada
            const imageDataUrl = canvas.toDataURL('image/png');
            capturedPhoto.src = imageDataUrl;
            capturedPhoto.style.display = 'block';
            
            // Armazenar a imagem no campo oculto
            fotoCameraInput.value = imageDataUrl;
            
            // Mostrar botão para nova captura
            captureButton.style.display = 'none';
            recaptureButton.style.display = 'inline-block';
            
            // Pausar o vídeo
            video.pause();
        });

        // Capturar uma nova foto
        recaptureButton.addEventListener('click', function() {
            capturedPhoto.style.display = 'none';
            fotoCameraInput.value = '';
            captureButton.style.display = 'inline-block';
            recaptureButton.style.display = 'none';
            
            // Retomar o vídeo
            video.play();
        });

        // Parar a câmera quando o formulário for enviado
        document.querySelector('form').addEventListener('submit', function() {
            stopCamera();
        });

        // Limpar tudo ao sair da página
        window.addEventListener('beforeunload', function() {
            stopCamera();
        });
    </script>
</body>
</html>