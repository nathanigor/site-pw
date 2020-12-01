<?php
    require_once '../model/cliente.php';
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/login.css">
    <link rel="shortcut icon" href="./img/user-circle.svg">
    <title>Login</title>
</head>

<body>

    <header>
        <div class="cabecalho">
            <a class="imagem-esquerda" href="/pw/login/site-pw/index.html"><img src="./img/home.svg" title="Início"></a>
            <a class="imagem-direita" href="/pw/login/site-pw/categorias.html"><img src="./img/shopping-bag.svg" title="Categorias"></a>
        </div>
    </header>

    <div class="box-caixa">
        <div class="info">
            <img src="./img/user-circle.svg" alt="icone_user">
            <h1>Login do Cliente</h1>
        </div>
        <div class="box-login">
        <form action="" method="POST">
                <div class="login">
                    <input type="hidden" name="login">
                    <p>E-mail:</p>
                    <input class="email" type="email" name="txtEmail" placeholder="seuemail@email.com" maxlength="40" >
                    <p>Senha:</p>
                    <input class="senha" type="password" name="txtSenha" placeholder="********" maxlength="15" >
                    <input class="button" type="submit" name="acessar" value="Acessar">
                </div>
                <div class="redes">
                    <p>Fazer login com:</p>
                    <a href="#" class="fa fa-facebook"></a>
                    <a href="#" class="fa fa-google"></a>
                    <p class="cad">Não tem cadastro? <a href="./cadastro.php">Cadastre-se</a> </p>
                </div>
            </form>
        </div>
    </div>

    <div id="footer">
        <footer>
            <p><a href="/pw/login/site-pw/contato.html">Contato</a></p>
            <P><a href="/pw/login/site-pw/Sobre.html">Sobre</a></P>
        </footer>
    </div>
    
</body>

</html>