<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include_once '../Model/Conta.php';
include_once '../DAO/ContaDAOImpl.php';

$action = isset($_GET['action']) ? $_GET['action'] : '';
$id = isset($_GET['id']) ? $_GET['id'] : null;
$contaDao = new ContaDAOImpl();
$conta = new Conta();

$conn = Database::getConnection();
$contaController = new ContaController();
class ContaController
{

    private ContaDAO $contaDAOl; // Propriedade declarada com tipo

    public function __construct()
    {
        // Injeção de dependência do DAO
        $this->contaDAOl = new ContaDAOImpl();
    }
    public function validaConta($email, $senha)
    {
        $contas = $this->contaDAOl->validaConta($email, $senha);
        if ($contas == null) {
            displayMessage('Nome de usuário ou senha incorretos', '../View/Usuario/Login.php');
        } else {
            session_start();
            $_SESSION['user_id'] = $contas->getId();
            $_SESSION['user_name'] = $contas->getNome();
            $_SESSION['email'] = $contas->getEmail();
            $_SESSION['telefone'] = $contas->getTelefone();
            $_SESSION['senha'] = $contas->getSenha();
            $_SESSION['estabelecimento'] = false;
            if ($contas->getFoto() != null) {
                $_SESSION['foto'] = $contas->getFoto();
            }
            ;
            header("Location: ../Controller/EstabelecimentoController?action=readall_estabelecimento");
            exit();
            
        }
    }
}
switch ($action) {
    case 'create_conta':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $conta->setNome($_POST['nome']);
            $conta->setEmail($_POST['email']);
            $conta->setTelefone($_POST['telefone']);
            $conta->setSenha($_POST['senha']);


            $file = $_FILES['foto']['tmp_name'];
            if (is_uploaded_file($file)) {
                $imageData = file_get_contents($file);
                $base64 = base64_encode($imageData);
                $conta->setFoto($base64);
            } else {//colocar foto padrao
            }
            if (
                $contaDao->createConta($conta)
            ) {

                $contaController->validaConta($conta->getEmail(), $conta->getSenha());

            } else {
                displayMessage('Erro ao inserir o registro.');
            }
            
            exit();
        }
        break;

    case 'valida_conta':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $senha = $_POST['senha'];
            $contaController->validaConta($email, $senha);
            break;  
            }
        break;

    case 'update_conta':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $conta->setNome($_POST['nome']);
            $conta->setEmail($_POST['email']);
            $conta->setTelefone($_POST['telefone']);
            $conta->setId($_SESSION['user_id']);
            $file = $_FILES['foto']['tmp_name'];
            if ($file != null) {
                $imageData = file_get_contents($file);
                $base64 = base64_encode($imageData);
                $conta->setFoto($base64);
            } else {
                if (!empty($_SESSION['foto'])) {
                    $conta->setFoto($_SESSION['foto']);
                } else {
                }
            }
            $contas = $contaDao->updateConta($conta);
            if ($contas) {
                $_SESSION['user_id'] = $contas->getId();
                $_SESSION['user_name'] = $contas->getNome();
                $_SESSION['email'] = $contas->getEmail();
                $_SESSION['telefone'] = $contas->getTelefone();
                $_SESSION['senha'] = $contas->getSenha();
                $_SESSION['foto'] = $contas->getFoto();

                header('Location: ../View/Usuario/Perfil.php');
                exit();
            } else {
                displayMessage('Erro ao atualizar o registro.');
            }
        }
        break;


    default:
        displayMessage('Ação não reconhecida.');
        break;
}


//Processar Imagem
function uploadImagem($imagem, $targetDir)
{
    // Gera o caminho completo para o arquivo
    $targetFile = $targetDir . basename($imagem["name"]);
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Verifica se o arquivo é uma imagem
    $check = getimagesize($imagem["tmp_name"]);
    if ($check !== false) {
        // Verifica se o diretório existe, caso contrário cria
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        // Faz o upload da imagem
        if (move_uploaded_file($imagem["tmp_name"], $targetFile)) {
            return $targetFile; // Retorna o caminho completo da imagem
        } else {
            throw new Exception("Erro ao fazer upload da imagem.");
        }
    } else {
        throw new Exception("Arquivo enviado não é uma imagem.");
    }
}
;

// Mensagem 
function displayMessage($message, $redirectUrl = null)
{
    echo '<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            color: #333;
        }
        .container {
            text-align: center;
            padding: 20px;
            border-radius: 8px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            margin: auto;
        }
        a {
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <p>' . htmlspecialchars($message) . '</p>';
    if ($redirectUrl) {
        echo '<a href="' . htmlspecialchars($redirectUrl) . '">Voltar</a>';
    }
    echo '  </div>
</body>
</html>';
}