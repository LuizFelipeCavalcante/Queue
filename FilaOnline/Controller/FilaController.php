<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include_once '../Model/Fila.php';
include_once '../DAO/FilaDAOImpl.php';

$action = isset($_GET['action']) ? $_GET['action'] : '';
$id = isset($_GET['id']) ? $_GET['id'] : null;

$filaDao = new FilaDAOImpl();

$conn = Database::getConnection();
$filaController = new FilaController($conn);
$fila = new Fila($conn);

class FilaController
{

    private FilaDAO $filaDAOl; // Propriedade declarada com tipo

    public function __construct($conn)
    {
        // Injeção de dependência do DAO
        $this->filaDAOl = new FilaDAOImpl($conn);
    }

    public function listarFilas($idEstabelecimento)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        // Obtém todas as filas do banco de dados via DAO
        $filas = $this->filaDAOl->getAllFilas($idEstabelecimento);
        $_SESSION['filas'] = $filas;

        echo ("A");
        header("Location: ../View/Estabelecimento/HomeEstabelecimento.php");
        exit();
    }
    public function listarFilaUsuario($idFila)
    {
        $filauser = $this->filaDAOl->getFilaUsuario($idFila);
        $_SESSION['filasuser'] = $filauser;

        echo ("A");
        header("Location: ../View/Estabelecimento/FilaExistente.php");
        exit();
    }
    public function listarFilaId($idFila)
    {
        $fila = $this->filaDAOl->GetFilaId($idFila);
        if (!empty($fila)) {
            $_SESSION['filaatual'] = $fila;
        }

        echo ("A");
        header("Location: ../View/Estabelecimento/FilaExistente.php");
        exit();
    }

}





switch ($action) {

    case 'create_fila':
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $fila->setEstabelecimentoFila($_SESSION['user_id']);
            $fila->setNome($_POST['nome']);
            $fila->setEndereco($_POST['endereco']);
            // $fila->setImg($_POST['img']);
            $fila->setInicio($_POST['inicio']);
            $fila->setTermino($_POST['termino']);

            if (
                $filaDao->createFila($fila)
            ) {
                displayMessage('Fila criada com sucesso!', '../Controller/FilaController?action=readall_fila');
            } else {
                displayMessage('Erro ao criar a fila.');
            }
        }
        break;


    case 'readall_fila':

        $filaController->listarFilas($_SESSION['user_id']);
        break;


    case 'readfila_filaid':
        $filaController->listarFilaid($id);
        break;
    case 'readfila_usuario':

        $filaController->listarFilaUsuario($id);
        break;


    case 'entrar_fila':
        $userid = $_SESSION['user_id'];
        $filaid = $id;

        if ($fila->entrarFila($userid, $filaid) != true) {

            displayMessage('Você está na fila! Lugar registrado com sucesso', '../View/Usuario/FilasPEstabelecimento');

        } else {
            displayMessage("$userid , $filaid ");
            displayMessage('Erro ao entrar na fila.');
        }

        break;

    case 'update_fila':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $fila->setNome($_POST['nome']);
            $fila->setEndereco($_POST['endereco']);
            // $fila->setImg($_POST['img']);
            $fila->setInicio($_POST['inicio']);
            $fila->setTermino($_POST['termino']);

            $conta = $contaDao->updateConta($fila);
            if ($conta) {
                $_SESSION['infoFila'] = $fila;
                header('Location: ../View/Estabelecimento/Perfil.php');
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


// Mensagem 
function displayMessage($message, $redirectUrl = null)
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
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