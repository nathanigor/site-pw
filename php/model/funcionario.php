<?php
    require_once 'db.php';

    class Funcionario {
        private $conn = null;

        public function __construct() {
            $database = new Database();
            $db = $database -> dbConnection();
            $this -> conn = $db;
        }

        public function runQuery($sql) {
            $stmt = $this -> conn -> prepare($sql);
            return $stmt;
        }

        public function insert($nome, $cpf, $telefone) {
            try {
                $sql = "INSERT INTO Funcionario(nome, cpf, telefone)
                        VALUES (:nome, :cpf, :telefone)";

                $stmt = $this -> conn -> prepare($sql);
                
                $stmt -> bindparam(":nome", $nome);
                $stmt -> bindparam(":cpf", $cpf);
                $stmt -> bindparam(":telefone", $telefone);
                $stmt -> execute();
                return $stmt;
            } catch (PDOException $e) {
                echo("Error: $e->getMessage()");
            } finally {
                $this -> conn = null;
            }
        }

        public function cadastro($nome, $cpf, $telefone) {
            try {
                $sql = "INSERT INTO funcionario(nome, cpf, telefone)
                        VALUES (:nome, :cpf, :telefone)";

                $stmt = $this -> conn -> prepare($sql);
                
                $stmt -> bindparam(":nome", $nome);
                $stmt -> bindparam(":cpf", $cpf);
                $stmt -> bindparam(":telefone", $telefone);
                $stmt -> execute();
                return $stmt;
            } catch (PDOException $e) {
                echo("Error: $e->getMessage()");
            } finally {
                $this -> conn = null;
            }
        }




        public function update($nome, $cpf, $telefone, $id){
            try {
                $sql = "UPDATE funcionario
                        SET NOME = :nome,
                        telefone = :telefone,
                            cpf = :cpf
                        WHERE id = :id";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindparam(":nome", $nome);
                $stmt->bindparam(":cpf", $cpf);
                $stmt->bindparam(":telefone", $telefone);
                $stmt->bindparam(":id", $id);
                $stmt->execute();
                return $stmt;
            }catch (PDOException $e) {
                echo("Error: ".$e->getMessage());
            }finally{
                $this->conn = null;
            }
        }

        public function delete($id) {
            try {
                $sql = "DELETE FROM funcionario WHERE id = :id";
                $stmt = $this -> conn -> prepare($sql);
                $stmt -> bindparam(":id", $id);
                $stmt -> execute();
                return $stmt;
            } catch (PDOException $e) {
                echo("Error: $e.getMessage()");
            } finally {
                $this -> conn = null;
            }
        }

        public function redirect($url) {
            header("Location: $url");
        }
    }
?>