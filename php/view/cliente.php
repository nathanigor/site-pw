<?php
    require_once '../model/cliente.php';
    $objCliente = new Cliente();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="./crud.css">
    <link rel="stylesheet" href="./modal.css">
    <link rel="shortcut icon" href="/site-pw/img/envelope-open-text.svg">
    <title>Crud</title>
</head>

<body>

    <header>
        <div class="cabecalho">
        <a class="imagem-esquerda" href="/pw/login/site-pw/index.html"><img src="./home.svg" title="Início"></a>
            <a class="imagem-direita" href="/pw/login/site-pw/categorias.html"><img src="./shopping-bag.svg" title="Categorias"></a>
            <a class="imagem-direita" href="./login.php"><img src="./user.svg" title="Usuário"></a>
        </div>
    </header>

    <div class="box-caixa">
        <h2>Cliente</h2>
        <p>
            <button type="button" class="novo" data-toggle="modal" data-target="#myModalCadastrar">
                <span></span>Adicionar Cliente
            </button>
           <a href=""><button type="button" class="novo"><span></span>Adicionar Funcionario</button></a> 

        </p>
        <table class="cliente">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Telefone</th>
                </tr>
            </thead>
            <tbody>

                <?php
                    $query = "select * from cliente";
                    $stmt = $objCliente -> runQuery($query);
                    $stmt -> execute();
                    if ($stmt -> rowCount() > 0) {
                        while($rowCliente = $stmt -> fetch(PDO::FETCH_ASSOC)) {
                ?>

                <tr>
                    <td><?php echo($rowCliente['nome']);?></td>
                    <td><?php echo($rowCliente['email']);?></td>
                    <td><?php echo($rowCliente['telefone']);?></td>

                    <td>
                        <p>
                            <button type="button">
                                <span data-toggle="modal" data-target="#myModalEditar"
                                    data-clienteid="<?php echo $rowCliente['id']; ?>"
                                    data-clientenome="<?php echo $rowCliente['nome']; ?>"
                                    data-clienteemail="<?php echo $rowCliente['email']; ?>"
                                    data-clientetelefone="<?php echo $rowCliente['telefone']; ?>"><img class="editar"
                                    src="./user-plus.svg" title="Editar Usuário">
                                </span>
                            </button>
                    </td>
                    <td>

                        <p>
                            <button type="button">
                                <span data-toggle="modal" data-target="#myModalDeletar"
                                      data-clienteid="<?php print $rowCliente['id']; ?>"
                                      data-clientenome="<?php print $rowCliente['nome']; ?>"><img class="excluir"
                                      src="./user-times.svg" title="Excluir Usuário">
                                </span>
                            </button>
                        </p>
                    </td>
                </tr>
                <?php
                        }
                    }
                ?>
            </tbody>

        </table>
    </div>

    </div>
    <div id="myModalCadastrar" class="modal-container">
        <div class="modal">
            <button class="fechar">X</button>
            <h3>Adicionar Usúario</h3>
            <form action="../controller/ctr_cliente.php" method="POST">
                <input type="hidden" name="insert">
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control" id="nome" name="txtNome" placeholder="João Vitor" maxlength="35" required>
                </div>
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="text" class="form-control" id="email" name="txtEmail" placeholder="seuemail@email.com" maxlength="40" required>
                    <div class="form-group">
                        <p>Telefone:</p>
                        <input class="telefone" type="text" name="txtTelefone" placeholder="xxxxxxxxxxx" maxlength="12"
                            required>
                    </div>
                    <div class="form-group">
                        <p>Senha:</p>
                        <input class="senha" type="password" name="txtSenha" placeholder="********" maxlength="15"
                            required>
                    </div>

                </div>
                <button class="novo" type="submit">Enviar</button>
            </form>
        </div>
    </div>

    <div id="myModalDeletar" class="modal-container">
        <div class="modal">
            <button class="fechar">X</button>
            <div class="modal-content">
                    <h4 class="modal-title">Editar Cliente</h4>
                </div>
                <form action="../controller/ctr_cliente.php" method="POST">
                    <input type="hidden" name="delete_id" value="" id="recipient-id">
                <div class="form-group">
                    <label for="nome">Nome do Usuário</label>
                    <input type="text" class="form-control" id="recipient-nome" name="txtNome" readonly>
                </div>
                <button type="submit">Deletar</button>
            </form>
        </div>
    </div>

        <!-- Modal Editar-->
        <div class="modal-container" id="myModalEditar">
            <div class="modal">
                <button class="fechar">X</button>
                <div class="modal-content">
                    <h4 class="modal-title">Editar Cliente</h4>
                </div>
                <div class="modal-body">
                    <form action="../controller/ctr_cliente.php" method="POST">
                        <input type="hidden" name="editar_id" id="recipient-id">
                        <div class="form-group">
                            <label for="nome">Nome</label>
                            <input type="text" class="form-control" id="recipient-nome" name="txtNome">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" id="recipient-email" name="txtEmail">
                        </div>
                        <div class="form-group">
                            <label for="telefone">Telefone</label>
                            <input type="text" class="form-control" id="recipient-telefone" name="txtTelefone">
                        </div>
                        <button type="submit">Editar</button>
                    </form>
                </div>
            </div>
        </div>

    <script>
    $('#myModalDeletar').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var recipientid = button.data('clienteid');
        var recipientnome = button.data('clientenome');

        var modal = $(this)
        modal.find('.modal-title').text('Tem certeza que deseja deletar o cliente ' + recipientnome + '?');
        modal.find('#recipient-id').val(recipientid);
        modal.find('#recipient-nome').val(recipientnome);
    })
    </script>
    <script>
    $('#myModalEditar').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var recipientid = button.data('clienteid');
        var recipientnome = button.data('clientenome');
        var recipientemail = button.data('clienteemail');
        var recipienttelefone = button.data('clientetelefone');

        var modal = $(this)
        modal.find('.modal-title').text('Tem certeza que deseja editar o cliente ' + recipientnome + '?');
        modal.find('#recipient-id').val(recipientid);
        modal.find('#recipient-nome').val(recipientnome);
        modal.find('#recipient-email').val(recipientemail);
        modal.find('#recipient-telefone').val(recipienttelefone);
    })
    </script>

    </div>

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