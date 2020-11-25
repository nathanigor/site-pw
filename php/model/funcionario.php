<?php
    require_once 'db.php';

    class Funcionario{
        private $conn = null;

        public function __construct(){
            $database = new Database();
            $db = $database -> dbConnection();
            $this -> conn = $db;
        }

        public function runQuery($sql) {
            $stmt =  $this -> conn ->prepare($sql);
            return $stmt;
        }
        public function insert($nome, $cpf, $sexo) {
            try{
                $sql = "INSERT INTO funcionario(nome, cpf, sexo)
                        VALUES (:nome, :cpf)";
                $stmt = $this -> conn -> prepare($sql);
                $stmt -> bindparam(":nome", $nome);
                $stmt -> bindparam(":cpf", $cpf);
                $stmt -> bindparam(":sexo", $sexo);

                return $stmt;
            } catch (PDOException $e) {
                echo("Error: $e->getMessage()");
            } finally {
                $this -> conn = null;
            }
        }

        public function update($nome, $cpf, $id, $sexo) {
            try {
                $sql = "UPDATE funcionario
                        SET nome = :nome,
                        cpf = :cpf,
                        WHERE id = :id";
                $stmt = $this -> conn -> prepare($sql);
                $stmt -> bindparam(":nome", $nome);
                $stmt -> bindparam(":cpf", $cpf);
                $stmt -> bindparam(":id", $id);
                $stmt -> bindparam(":sexo", $sexo);

                $stmt -> execute();
                return $stmt;
            } catch(PDOException $e) {
                echo("Error: $e.getMessage()");
            } finally {
                $this -> conn = null;
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