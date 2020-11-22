<?php
    require_once '../model/cliente.php';
    $objCliente = new Cliente();

    if(isset($_POST['delete_id'])){
        $id = $_POST['delete_id'];
        if($objCliente->delete($id)){
            $objCliente->redirect('/pw/login/site-pw/crud.php');
        }
    }

    if(isset($_POST['insert'])){
        $nome = $_POST['txtNome'];
        $email = $_POST['txtEmail'];
        $telefone = $_POST['txtTelefone'];
        $senha = $_POST['txtSenha'];
        if($objCliente->insert($nome, $email, $telefone, $senha)){
            $objCliente->redirect('/pw/login/site-pw/crud.php');
        }
    }

    if(isset($_POST['editar_id'])){
        $id = $_POST['editar_id'];
        $email = $_POST['txtNome'];
        if($objCliente->update($nome, $email)){
            $objCliente->redirect('/pw/login/site-pw/crud.php');
        }
    }

?>