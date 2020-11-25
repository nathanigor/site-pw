<?php
    require_once '../model/cliente.php';

if(isset($_POST['txtEmail']) && !empty($_POST['txtEmail']) && isset($_POST['txtSenha']) && !empty($_POST['txtSenha'])){
    $email = addcslashes($_POST['txtEmail']);
    $senha = addcslashes($_POST['txtSenha']);
    login($email, $senha);

}else{
    header("location:/pw/login/site-pw/index.html");
}

?>