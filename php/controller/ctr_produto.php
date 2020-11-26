<?php
    require_once '../model/produto.php';
    $objFuncionario = new Produto();

    if(isset($_POST['delete_id'])){
        $id = $_POST['delete_id'];
        if($objFuncionario->delete($id)){
            $objFuncionario->redirect('/pw/login/site-pw/php/view/produto.php');
        }
    }

    if(isset($_POST['insert'])){
        $nome = $_POST['txtNome'];
        $valor = $_POST['txtValor'];
        $tamanho = $_POST['txtTamanho'];
        $descricao = $_POST['txtDescricao'];
        $quantidade = $_POST['txtQuantidade'];
        if($objFuncionario->insert($nome, $valor, $tamanho, $descricao, $quantidade)){
            $objFuncionario->redirect('/pw/login/site-pw/php/view/produto.php');
        }
    }

    if(isset($_POST['editar_id'])){
        $id = $_POST['editar_id'];
        $nome = $_POST['txtNome'];
        $valor = $_POST['txtValor'];
        $tamanho = $_POST['txtTamanho'];
        $descricao = $_POST['txtDescricao'];
        $quantidade = $_POST['txtQuantidade'];
        if($objFuncionario->update($nome, $valor, $tamanho, $descricao, $quantidade, $id)){
            $objFuncionario->redirect('/pw/login/site-pw/php/view/produto.php');
        }
    }

?>