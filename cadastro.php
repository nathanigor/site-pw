<?php
    require_once './Crud/model/cliente.php';
    $objCliente = new Cliente();
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./Site/css/login.css">
    <link rel="shortcut icon" href="./Site/img/user-circle.svg">
    <title>Cadastro</title>
</head>

<header>
    <div class="cabecalho">
        <a class="imagem-esquerda" href="index.html"><img src="./Site/img/home.svg" title="Início"></a>
        <a href="categorias.html"><img class="imagem-direita" src="./Site/img/shopping-bag.svg" title="Categorias"></a>
    </div>
</header>

<body>
    <div class="box-caixa">
        <div class="info">
            <img src="./Site/img/user-circle.svg" alt="icone_user">
            <h1>Cadastro do Cliente</h1>
        </div>
        <div class="box-cadastro">
                <div class="cadastro">
                <form action="./Crud/controle/ctr_cliente.php" method="POST">
                    <input type="hidden" name="insert">
                    <p>Nome:</p>
                    <input class="nome" type="text" name="txtNome" placeholder="João Vitor" maxlength="35" required>
                    <p>E-mail:</p>
                    <input class="email" type="email" name="txtEmail" placeholder="seuemail@email.com" maxlength="40" required>
                    <p>Telefone:</p>
                    <input class="telefone" type="text" name="txtTelefone" placeholder="xxxxxxxxxxx" maxlength="12" required>
                    <p>Senha:</p>
                    <input class="senha" type="password" name="txtSenha" placeholder="********" maxlength="15" required>
                    <input class="button" type="submit" value="Entrar">
                </div>
                <div class="redes">
                    <p>Fazer cadastro com:</p>
                    <a href="#" class="fa fa-facebook"></a>
                    <a href="#" class="fa fa-google"></a>
                    <p class="cad">Já tem cadastro? <a href="./login.php">Entre</a> </p>
                </div>
            </form>
        </div>
    </div>

    <div id="footer">
        <footer>
            <p><a href="contato.html">Contato</a></p>
            <P><a href="Sobre.html">Sobre</a></P>
        </footer>
    </div>

</body>

</html>