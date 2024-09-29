<?php

require_once '../Config/Database.php';
require_once 'ContaDAO.php';
require_once '../Model/Conta.php';

class ContaDAOImpl implements ContaDAO
{
    private $conn;

    public function __construct()
    {
        $this->conn = Database::getConnection();
    }


    public function validaConta($email, $senha)
    {
        $conta = new Conta();
        try {
            $statement = $this->conn->prepare("SELECT * FROM conta WHERE email = :email AND senha = :senha");
            $statement->bindParam(':email', $email);
            $statement->bindParam(':senha', $senha);
            $statement->execute();


            if ($statement->rowCount() > 0) {
                // passa as informações para o controller para ir pra uma sessão
                $row = $statement->fetch(PDO::FETCH_ASSOC);
                $conta->setId($row['id']);
                $conta->setNome($row['name']);
                $conta->setEmail($row['email']);
                $conta->setTelefone($row['telefone']);
                $conta->setSenha($row['senha']);
                return $conta;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        return $conta;
    }



    public function createConta($conta)
    {
        try {
            $statement = $this->conn->prepare("INSERT INTO conta (name, email, telefone,senha) VALUES (:name, :email, :telefone, :senha)");
            $statement->bindValue(':name', $conta->getNome());
            $statement->bindValue(':email', $conta->getEmail());
            $statement->bindValue(':telefone', $conta->getTelefone());
            $statement->bindValue(':senha', $conta->getSenha());
            //if (!empty($_FILES['foto'])) {
            //    $statement->bindValue(':foto', $conta->getFoto());
            //}
            if ($statement->execute()) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function updateConta($conta)
    {
        try {
            $statement = $this->conn->prepare("UPDATE conta SET name = :nome, email = :email, telefone = :telefone, foto = :foto WHERE id = :id");
            $statement->bindValue(':name', $conta->getNome());
            $statement->bindValue(':email', $conta->getEmail());
            $statement->bindValue(':telefone', $conta->getTelefone());
            $statement->bindValue(':foto', $conta->getFoto());
            $statement->bindValue(':id', $conta->getId());

            $statement->execute();


            if ($statement->rowCount() > 0) {
                // passa as informações para o controller para ir pra uma sessão
                $row = $statement->fetch(PDO::FETCH_ASSOC);
                return $conta;
            } else {
                return null;
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        return $conta;
    }
}

?>