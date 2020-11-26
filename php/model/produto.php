<?php
    require_once 'db.php';

    class Produto {
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

        public function insert($nome, $valor, $tamanho, $descricao, $quantidade) {
            try {
                $sql = "INSERT INTO produto(nome, valor, tamanho, descricao, quantidade)
                        VALUES (:nome, :valor, :tamanho, :descricao, :quantidade)";

                $stmt = $this -> conn -> prepare($sql);
                $stmt -> bindparam(":nome", $nome);
                $stmt -> bindparam(":valor", $valor);
                $stmt -> bindparam(":tamanho", $tamanho);
                $stmt -> bindparam(":descricao", $descricao);
                $stmt -> bindparam(":quantidade", $quantidade);
                $stmt -> execute();
                return $stmt;
            } catch (PDOException $e) {
                echo("Error: $e->getMessage()");
            } finally {
                $this -> conn = null;
            }
        }

        public function update($nome, $valor, $tamanho, $descricao, $quantidade, $id){
            try {
                $sql = "UPDATE produto
                        SET nome = :nome,
                        valor  = :valor,
                        tamanho = :tamanho,
                        descricao  = :descricao,
                        quantidade = :quantidade
                        WHERE id = :id";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindparam(":nome", $nome);
                $stmt->bindparam(":valor", $valor);
                $stmt->bindparam(":tamanho", $tamanho);
                $stmt->bindparam(":descricao", $descricao);
                $stmt -> bindparam(":quantidade", $quantidade);
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
                $sql = "DELETE FROM produto WHERE id = :id";
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