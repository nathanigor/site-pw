<?php
    require_once '../model/funcionario.php';
    $objFuncionario = new Funcionario();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="./css/crud.css">
    <link rel="stylesheet" href="./css/modal.css">
    <link rel="shortcut icon" href="./img/user-circle.svg">
    <title>Funcionarios</title>
</head>

<body>

    <header>
        <div class="cabecalho">
        <a class="imagem-esquerda" href="/pw/login/site-pw/index.html"><img src="./img/home.svg" title="Início"></a>
            <a class="imagem-direita" href="/pw/login/site-pw/categorias.html"><img src="./img/shopping-bag.svg" title="Categorias"></a>
            <a class="imagem-direita" href="./login.php"><img src="./img/user.svg" title="Usuário"></a>
        </div>
    </header>

    <div class="box-caixa">
        <h2>Funcionarios</h2>
        <p>
            <a href="cliente.php">
            <button type="button" class="novo">
                <span></span>Adicionar Cliente</button>
            </a>
            <button type="button" class="novo"data-toggle="modal" data-target="#myModalCadastrar">
               <span></span>Adicionar Funcionario
            </button>
        </p>
        <table class="cliente">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Telefone</th>
                    <th>Cpf</th>
                </tr>
            </thead>
            <tbody>

                <?php
                    $query = "select * from funcionario";
                    $stmt = $objFuncionario -> runQuery($query);
                    $stmt -> execute();
                    if ($stmt -> rowCount() > 0) {
                        while($rowFuncionario = $stmt -> fetch(PDO::FETCH_ASSOC)) {
                ?>

                <tr>
                    <td><?php echo($rowFuncionario['nome']);?></td>
                    <td><?php echo($rowFuncionario['telefone']);?></td>
                    <td><?php echo($rowFuncionario['cpf']);?></td>

                    <td>
                        <p>
                            <button type="button">
                                <span data-toggle="modal" data-target="#myModalEditar"
                                    data-funcionarioid="<?php echo $rowFuncionario['id']; ?>"
                                    data-funcionarionome="<?php echo $rowFuncionario['nome']; ?>"
                                    data-funcionariotelefone="<?php echo $rowFuncionario['telefone']; ?>"
                                    data-funcionariocpf="<?php echo $rowFuncionario['cpf']; ?>">
                                    <img class="editar" src="./img/user-plus.svg" title="Editar Funcionário">
                                </span>
                            </button>
                    </td>
                    <td>

                        <p>
                            <button type="button">
                                <span data-toggle="modal" data-target="#myModalDeletar"
                                      data-funcionarioid="<?php print $rowFuncionario['id']; ?>"
                                      data-funcionarionome="<?php print $rowFuncionario['nome']; ?>">
                                      <img class="excluir" src="./img/user-times.svg" title="Excluir Funcionário">
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
            <h3>Adicionar Funcionário</h3>
            <form action="../controller/ctr_funcionario.php" method="POST">
                <input type="hidden" name="insert">
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control" id="nome" name="txtNome" placeholder="João Vitor" maxlength="35" required>
                </div>
                <div class="form-group">
                    <label for="cpf">Cpf</label>
                    <input type="text" class="form-control" id="cpf" name="txtCpf" placeholder="000.000.000-05" maxlength="14" required>
                </div>

                <div class="form-group">
                    <label for="telefone">telefone</label>
                    <input class="telefone" type="text" name="txtTelefone" placeholder="xxxxxxxxxxx" maxlength="12" required>
                </div>
                <button class="novo" type="submit">Enviar</button>
            </form>
        </div>
    </div>

    <div id="myModalDeletar" class="modal-container">
        <div class="modal">
            <button class="fechar">X</button>
            <div class="modal-content">
                    <h4 class="modal-title">Editar Funcionário</h4>
                </div>
                <form action="../controller/ctr_funcionario.php" method="POST">
                    <input type="hidden" name="delete_id" value="" id="recipient-id">
                <div class="form-group">
                    <label for="nome">Nome do Funcionário</label>
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
                    <h4 class="modal-title">Editar Funcionario</h4>
                </div>
                <div class="modal-body">
                <form action="../controller/ctr_funcionario.php" method="POST">
                    <input type="hidden" name="editar_id" id="recipient-id">
                        <div class="form-group">
                            <label for="nome">Nome</label>
                            <input type="text" class="form-control" id="recipient-nome" name="txtNome">
                        </div>
                        <div class="form-group">
                            <label for="cpf">Cpf</label>
                            <input type="text" class="form-control" id="recipient-cpf" name="txtCpf">
                        </div>
                        <div class="form-group">
                        <label for="telefone">Telefone</label>
                            <input type="text" class="form-control" id="recipient-telefone" name="txtTelefone">
                        </div>
                        <button type="submit">Enviar</button>
                    </form>
                </div>
            </div>
        </div>

    <script>
    $('#myModalDeletar').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var recipientid = button.data('funcionarioid');
        var recipientnome = button.data('funcionarionome');

        var modal = $(this)
        modal.find('.modal-title').text('Tem certeza que deseja deletar o Funcionario ' + recipientnome + '?');
        modal.find('#recipient-id').val(recipientid);
        modal.find('#recipient-nome').val(recipientnome);
    })
    </script>
    <script>
    $('#myModalEditar').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var recipientid = button.data('funcionarioid');
        var recipientnome = button.data('funcionarionome');
        var recipienttelefone = button.data('funcionariotelefone');
        var recipientcpf = button.data('funcionariocpf');


        var modal = $(this)
        modal.find('.modal-title').text('Tem certeza que deseja editar o Funcionario ' + recipientnome + '?');
        modal.find('#recipient-id').val(recipientid);
        modal.find('#recipient-nome').val(recipientnome);
        modal.find('#recipient-telefone').val(recipienttelefone);
        modal.find('#recipient-cpf').val(recipientcpf);
    })
    </script>

    </div>

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