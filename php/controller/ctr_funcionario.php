<?php
    require_once '../model/funcionario.php';
    $objFuncionario = new Funcionario();

    if(isset($_POST['delete_id'])){
        $id = $_POST['delete_id'];
        if($objFuncionario->delete($id)){
            $objFuncionario->redirect('/pw/login/site-pw/php/view/funcionario.php');
        }
    }

    if(isset($_POST['insert'])){
        $nome = $_POST['txtNome'];
        $cpf = $_POST['txtCpf'];
        $telefone = $_POST['txtTelefone'];
        if($objFuncionario->insert($nome, $cpf, $telefone)){
            $objFuncionario->redirect('/pw/login/site-pw/php/view/funcionario.php');
        }
    }

    if(isset($_POST['editar_id'])){
        $id = $_POST['editar_id'];
        $nome = $_POST['txtNome'];
        $telefone = $_POST['txtTelefone'];
        $cpf = $_POST['txtCPF'];
        if ($objFuncionario->update($nome, $telefone, $cpf, $id)) {
            $objFuncionario->redirect('/pw/login/site-pw/php/view/funcionario.php');
        }
    }

?>