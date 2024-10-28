<?php
require_once '../Config/Database.php';
require_once 'FilaDAO.php';
require_once '../Model/Fila.php';

class FilaDAOImpl implements FilaDAO
{
    private $conn;

    public function __construct()
    {
        $this->conn = Database::getConnection();
    }
    public function createFila($fila)
    {
        try {
            $statement = $this->conn->prepare("INSERT INTO fila (idEstabelecimento, nome, endereco, img, inicio, termino) 
                                           VALUES (:idEstabelecimento, :nome, :endereco, :img, :inicio, :termino)");

            // Use bindValue para associar os valores
            $statement->bindValue(':idEstabelecimento', $fila->getEstabelecimentoFila());
            $statement->bindValue(':nome', $fila->getNome());
            $statement->bindValue(':endereco', $fila->getEndereco());
            $statement->bindValue(':img', $fila->getImg());
            //$statement->bindValue(':inicio', $fila->getInicio());
            $statement->bindValue(':inicio', $fila->getInicio());
            $statement->bindValue(':termino', $fila->getTermino());

            // Executa e retorna o resultado da operação
            return $statement->execute();

        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }


    function updateFila($fila)
    {
        try {
            $sql = "UPDATE fila SET nome = :nome, endereco = :endereco, inicio = :inicio, termino = :termino  WHERE id = :idFila";

            $statement = $this->conn->prepare($sql);

            $statement->bindValue(':nome', $fila->getNome());
            $statement->bindValue(':endereco', $fila->getEndereco());

            $statement->bindValue(':idFila', $fila->getId());
            $statement->bindValue(':inicio', $fila->getInicio());
            $statement->bindValue(':termino', $fila->getTermino());

            return $statement->execute();

        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    function getFila($idFila)
    {
        $sql = "SELECT * FROM fila WHERE id = :idFila";

        $statement = $this->conn->prepare($sql);
        $statement->bindParam(':idFila', $idFila);
        $statement->execute();

        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    function getAllFilas()
    {

        $sql = "SELECT * FROM fila";

        $statement = $this->conn->query($sql);

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    function getAllFilasPorEstabelecimento($idEstabelecimento)
    {

        $sql = "SELECT * FROM fila where idEstabelecimento = :idEstabelecimento";
        $statement = $this->conn->prepare($sql);
        $statement->bindParam(':idEstabelecimento', $idEstabelecimento);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    function getFilaUsuario($idFila)
    {

        $sql = "SELECT * from fila left join fila_usuario on(fila.id = idFila) join users on(users.id = idUsuario) WHERE fila.id = $idFila;";

        $statement = $this->conn->query($sql);


        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    function GetFilaId($idFila)
    {
        $sql = "SELECT * from fila left join fila_usuario on(fila.id = idFila) WHERE fila.id = $idFila;";

        $statement = $this->conn->query($sql);

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    function deleteFila($idFila)
    {
        $sql = "DELETE FROM fila WHERE id = $idFila";

        $statement = $this->conn->prepare($sql);

        return $statement->execute();
    }
    function verificarFilaUsuario($idUsuario)
    {
        $sql = "SELECT * from fila_usuario where idUsuario = $idUsuario;";

        $statement = $this->conn->query($sql);

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    function entrarFila($idUsuario, $idFila)
    {
        try {
            $sql = "INSERT into fila_usuario (idFila ,idUsuario) values (:idFila, :idUsuario);";

            $statement = $this->conn->prepare($sql);
            $statement->bindParam(':idFila', $idFila);
            $statement->bindParam(':idUsuario', $idUsuario);

            return $statement->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    function passarUsuario($filaId)
    {
        try {
            $sql = "SELECT idUsuario FROM fila_usuario ORDER BY  idUsuario ASC LIMIT 1;";
            $stmt = $this->conn->query($sql);
            
            $primeiro_da_fila = $stmt->fetchColumn();

            if ($primeiro_da_fila != false) {
                $sql = "delete from fila_usuario where idfila = $filaId and idusuario = $primeiro_da_fila ;";
                $stmt = $this->conn->prepare($sql);

                return $stmt->execute();
            } else {
                return false;
            }
        } catch (PDOException $e) {
            return false;
        }

    }
    function voltarUsuario($filaId)
    {
    }
}
