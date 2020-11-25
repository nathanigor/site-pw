<?php
    require_once 'db.php';

    class Cliente {
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

        public function insert($nome, $email, $telefone, $senha) {
            try {
                $sql = "INSERT INTO cliente(nome, email, telefone, senha)
                        VALUES (:nome, :email, :telefone, :senha)";

                $stmt = $this -> conn -> prepare($sql);
                
                $stmt -> bindparam(":nome", $nome);
                $stmt -> bindparam(":email", $email);
                $stmt -> bindparam(":telefone", $telefone);
                $stmt -> bindparam(":senha", md5($senha));
                $stmt -> execute();
                return $stmt;
            } catch (PDOException $e) {
                echo("Error: $e->getMessage()");
            } finally {
                $this -> conn = null;
            }
        }

        public function cadastro($nome, $email, $telefone, $senha) {
            try {
                $sql = "INSERT INTO cliente(nome, email, telefone, senha)
                        VALUES (:nome, :email, :telefone, :senha)";

                $stmt = $this -> conn -> prepare($sql);
                
                $stmt -> bindparam(":nome", $nome);
                $stmt -> bindparam(":email", $email);
                $stmt -> bindparam(":telefone", $telefone);
                $stmt -> bindparam(":senha", md5($senha));
                $stmt -> execute();
                return $stmt;
            } catch (PDOException $e) {
                echo("Error: $e->getMessage()");
            } finally {
                $this -> conn = null;
            }
        }


        public function login($email, $senha){
            $sql = "SELECT * FROM cliente WHERE email AND senha
            VALUES (:email, :senha)";
            $stmt = $this -> conn -> prepare($sql);
            $stmt->bindValue("email", $email);
            $stmt->bindValue("senha", md5($senha));
            $stmt->execute();
            if($sql->rowCount() > 0){
                $dado = $sql->fetch();

                echo $dado['id'];
            }
        }


        public function update($nome, $email, $telefone, $id){
            try {
                $sql = "UPDATE cliente
                        SET NOME = :nome,
                            email = :email,
                            telefone = :telefone
                        WHERE id = :id";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindparam(":nome", $nome);
                $stmt->bindparam(":email", $email);
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
                $sql = "DELETE FROM cliente WHERE id = :id";
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