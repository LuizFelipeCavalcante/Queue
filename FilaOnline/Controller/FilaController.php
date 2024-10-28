<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include_once '../Model/Fila.php';
include_once '../Model/Conta.php';
include_once '../DAO/FilaDAOImpl.php';
include_once '../DAO/ContaDAOImpl.php';

$action = isset($_GET['action']) ? $_GET['action'] : '';
$id = isset($_GET['id']) ? $_GET['id'] : null;

$filaDao = new FilaDAOImpl();
$contaDao = new ContaDAOImpl();


$conn = Database::getConnection();
$filaController = new FilaController();
$fila = new Fila();

class FilaController
{

    private FilaDAO $filaDAOl; // Propriedade declarada com tipo

    public function __construct()
    {
        // Injeção de dependência do DAO
        $this->filaDAOl = new FilaDAOImpl();
    }

    function listarAllFilas()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $filas = $this->filaDAOl->getAllFilas();
        $_SESSION['filas'] = $filas;
    }
    public function listarFilasPorEstabelecimento($idEstabelecimento)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        // Obtém todas as filas do banco de dados via DAO
        //mudar aqui ó
        $filas = $this->filaDAOl->getAllFilasPorEstabelecimento($idEstabelecimento);
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
        if (empty($fila)) {
        } else {
            $_SESSION['filaatual'] = $fila;
        }

        echo ("A");
        header("Location: ../View/Estabelecimento/FilaExistente.php");
        exit();
    }
    public function contarPessoasFila($idFila)
    {
        $x = 0;
        $fila = $this->filaDAOl->GetFilaId($idFila);
        if (empty($fila)) {
            return 0;
        } else {
            foreach ($fila as $pessoa) {
                $x++;
            }
            ;
            return $x;
        }
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

            $file = $_FILES['logo']['tmp_name'];
            $imageData = file_get_contents($file);
            $base64 = base64_encode($imageData);
            $fila->setImg($base64);

            $fila->setInicio($_POST['inicio']);
            $fila->setTermino($_POST['termino']);

            if (
                $filaDao->createFila($fila)
            ) {
                displayMessage('Fila criada com sucesso!', '../Controller/FilaController?action=readfila_estabelecimentoid&id=' . htmlspecialchars($fila->getEstabelecimentoFila()));

            } else {
                displayMessage('Erro ao criar a fila.');
            }
        }
        break;


    case 'readall_fila':

        $filaController->listarAllFilas();
        header('Location: ../View/Estabelecimento/HomeEstabelecimento');
        break;


    case 'readfila_estabelecimentoid':
        $filaController->listarFilasPorEstabelecimento($id);
        break;
    case 'readfila_filaid':
        $filaController->listarFilaId($id);
        break;
    case 'readfila_usuario':
        $filaController->listarFilaUsuario($id);
        break;
    case 'entrar_fila':
        $filaid = $id;
        if
        ($filaDao->GetFilaId($id) != null) {
            if (!isset($_SESSION['user_id'])) {
                $_SESSION['user_id'] = $contaDao->createUser();
            }
            $userid = $_SESSION['user_id'];

            if (empty($filaDao->verificarFilaUsuario($userid))) {
                if ($filaDao->entrarFila($userid, $filaid)) {

                    displayMessage('Você está na fila! Lugar registrado com sucesso', '../View/Usuario/FilasPEstabelecimento');

                } else {
                    displayMessage("$userid , $filaid ");
                    displayMessage('Erro ao entrar na fila.');
                }
            } else {
                displayMessage('Você já está em uma fila', '../View/Usuario/FilasPEstabelecimento');
            }
        } else {
            displayMessage('Fila não existente', '../View/Usuario/FilasPEstabelecimento');
        }
        break;

    case 'update_fila':
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $fila->setId($id);
            $fila->setNome($_POST['nome']);
            $fila->setEndereco($_POST['endereco']);

            //$file = $_FILES['logo']['tmp_name'];
            //$imageData = file_get_contents($file);
            //$base64 = base64_encode($imageData);
            //$fila->setImg($base64);
            $fila->setInicio($_POST['inicio']);
            $fila->setTermino($_POST['termino']);

            if (
                $filaDao->updateFila($fila)
            ) {
                displayMessage('Fila atualizada com sucesso!', '../Controller/FilaController?action=readfila_estabelecimentoid&id=' . htmlspecialchars($_SESSION['user_id']));
            } else {
                displayMessage('Erro ao atualizar a fila.');
            }
        }
        break;

    case 'delete_fila':

        $filaD = $filaDao->deleteFila($id);
        if ($filaD) {
            displayMessage('Fila excluida com sucesso!', '../Controller/FilaController?action=readfila_estabelecimentoid&id=' . htmlspecialchars($_SESSION['user_id']));
        } else {
            displayMessage('Erro ao deletar o registro.');
        }

        break;
        case 'proxima_pessoa':
            //chamar metodo do dao
            echo("a");
            $filaDao->passarUsuario($id);
            $filaController->listarFilaId($id);
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