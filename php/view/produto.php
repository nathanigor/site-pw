<?php
    require_once '../model/produto.php';
    $objProduto = new Produto();
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
    <title>Produtos</title>
</head>

<body>

    <header>
        <div class="cabecalho">
            <a class="imagem-esquerda" href="/pw/login/site-pw/index.html"><img src="./img/home.svg" title="Início"></a>
            <a class="imagem-direita" href="/pw/login/site-pw/categorias.html"><img src="./img/shopping-bag.svg"
                    title="Categorias"></a>
            <a class="imagem-direita" href="./login.php"><img src="./img/user.svg" title="Usuário"></a>
        </div>
    </header>

    <div class="box-caixa">
        <h2>Produtos</h2>
        <p>
            <a href="cliente.php">
                <button type="button" class="novo">
                    <span></span>Adicionar Cliente</button>
            </a>
            <a href="funcionario.php">
                <button type="button" class="novo">
                    <span></span>Adicionar Funcionario
                </button>
            </a>
            <button type="button" class="novo" data-toggle="modal" data-target="#myModalCadastrar">
                <span></span>Adicionar Produto
            </button>
            <a href="venda.php">
                <button type="button" class="novo">
                    <span></span>Adicionar Venda</button>
            </a>
        </p>
        <table class="Produto">
            <thead>
                <tr>
                    <th>Última alteração</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Tamanho</th>
                    <th>Valor</th>
                    <th>Quantidade</th>
                    <th>Editar</th>
                    <th>Excluir</th>
                </tr>
            </thead>
            <tbody>

                <?php
                    $query = "select * from produto";
                    $stmt = $objProduto -> runQuery($query);
                    $stmt -> execute();
                    if ($stmt -> rowCount() > 0) {
                        while($rowProduto = $stmt -> fetch(PDO::FETCH_ASSOC)) {
                ?>

                <tr>
                    <td><?php echo($rowProduto['datacad']);?></td>
                    <td><?php echo($rowProduto['nome']);?></td>
                    <td><?php echo($rowProduto['descricao']);?></td>
                    <td><?php echo($rowProduto['tamanho']);?></td>
                    <td><?php echo number_format($rowProduto['valor'],2,"," , ".");?></td>
                    <td><?php echo($rowProduto['quantidade']);?></td>
                    <td>
                        <p>
                            <button type="button">
                                <span data-toggle="modal" data-target="#myModalEditar"
                                    data-produtoid="<?php echo $rowProduto['id']; ?>"
                                    data-produtonome="<?php echo $rowProduto['nome']; ?>"
                                    data-produtotamanho="<?php echo $rowProduto['tamanho']; ?>"
                                    data-produtovalor="<?php echo $rowProduto['valor']; ?>"
                                    data-produtodescricao="<?php echo $rowProduto['descricao']; ?>"
                                    data-produtoquantidade="<?php echo $rowProduto['quantidade']; ?>">
                                    <img class="editar" src="./img/user-plus.svg" title="Editar Produto">
                                </span>
                            </button>
                    </td>
                    <td>

                        <p>
                            <button type="button">
                                <span data-toggle="modal" data-target="#myModalDeletar"
                                    data-produtoid="<?php print $rowProduto['id']; ?>"
                                    data-produtonome="<?php print $rowProduto['nome']; ?>">
                                    <img class="excluir" src="./img/user-times.svg" title="Excluir Produto">
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
            <h3>Adicionar Produto</h3>
            <form action="../controller/ctr_produto.php" method="POST">
                <input type="hidden" name="insert">
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control" id="nome" name="txtNome" placeholder="Ex:Camisa, Short"
                        maxlength="35" required>
                </div>
                <div class="form-group">
                    <label for="descricao">Descrição</label>
                    <input type="text" class="form-control" id="descricao" name="txtDescricao"
                        placeholder="Ex: Ano, Time, Jogador" required>
                </div>
                <div class="form-group">
                    <label for="valor">Valor</label>
                    <input type="number" min="0.00" max="10000.00" step="0.01" class="form-control" id="valor" name="txtValor" placeholder="R$:120,00" required>
                </div>
                <div class="form-group">
                    <label for="tamanho">Tamanho</label>
                    <input type="text" class="form-control" id="tamanho" name="txtTamanho" placeholder="Ex: P, M, G, GG"
                        required>
                </div>
                <div class="form-group">
                    <label for="quantidade">Quantidade</label>
                    <input type="text" class="form-control" id="quantidade" name="txtQuantidade" placeholder="Ex: 10, 50, 100"
                        required>
                </div>
                <button class="novo" type="submit">Enviar</button>
            </form>
        </div>
    </div>

    <div id="myModalDeletar" class="modal-container">
        <div class="modal">
            <button class="fechar">X</button>
            <div class="modal-content">
                <h4 class="modal-title">Editar Produto</h4>
            </div>
            <form action="../controller/ctr_produto.php" method="POST">
                <input type="hidden" name="delete_id" value="" id="recipient-id">
                <div class="form-group">
                    <label for="nome">Nome do Produto</label>
                    <input type="text" class="form-control" id="recipient-nome" name="txtNome" readonly>
                </div>
                <button type="submit">Deletar</button>
            </form>
        </div>
    </div>

    <!-- Modal Editar-->
    <div id="myModalEditar" class="modal-container">
        <div class="modal">
            <button class="fechar">X</button>
            <div class="modal-content">
                <h4 class="modal-title">Editar Produto</h4>
            </div>
            <div class="modal-body">
                <form action="../controller/ctr_produto.php" method="POST">
                    <input type="hidden" name="editar_id" id="recipient-id">
                    <div class="form-group">
                        <label for="nome">Nome</label>
                        <input type="text" class="form-control" id="recipient-nome" name="txtNome">
                    </div>
                    <div class="form-group">
                        <label for="descricao">Descriçao</label>
                        <input type="text" class="form-control" id="recipient-descricao" name="txtDescricao">
                    </div>
                    <div class="form-group">
                        <label for="valor">Valor</label>
                        <input type="number" min="0.00" max="10000.00" step="0.01" class="form-control" id="recipient-valor" name="txtValor" maxlength="12">
                    </div>
                    <div class="form-group">
                        <label for="tamanho">Tamanho</label>
                        <input type="text" class="form-control" id="recipient-tamanho" name="txtTamanho" maxlength="1">
                    </div>
                    <div class="form-group">
                        <label for="quantidade">Quantidade</label>
                        <input type="text" class="form-control" id="recipient-quantidade" name="txtQuantidade" maxlength="10">
                    </div>
                    <button type="submit">Editar</button>
                </form>
            </div>
        </div>
    </div>

    <script>
    $('#myModalDeletar').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var recipientid = button.data('produtoid');
        var recipientnome = button.data('produtonome');

        var modal = $(this)
        modal.find('.modal-title').text('Tem certeza que deseja deletar o produto ' + recipientnome + '?');
        modal.find('#recipient-id').val(recipientid);
        modal.find('#recipient-nome').val(recipientnome);
    })
    </script>
    <script>
    $('#myModalEditar').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var recipientid = button.data('produtoid');
        var recipientnome = button.data('produtonome');
        var recipientdescricao = button.data('produtodescricao');
        var recipientvalor = button.data('produtovalor');
        var recipienttamanho = button.data('produtotamanho');
        var recipientquantidade = button.data('produtoquantidade');



        var modal = $(this)
        modal.find('.modal-title').text('Tem certeza que deseja editar o Produto ' + recipientnome + '?');
        modal.find('#recipient-id').val(recipientid);
        modal.find('#recipient-nome').val(recipientnome);
        modal.find('#recipient-descricao').val(recipientdescricao);
        modal.find('#recipient-valor').val(recipientvalor);
        modal.find('#recipient-tamanho').val(recipienttamanho);
        modal.find('#recipient-quantidade').val(recipientquantidade);


    });
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