<?php
    require_once '../model/cliente.php';
    $objCliente = new Cliente();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cliente</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
        <h2>Cliente</h2>
        <p>
            <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#myModalCadastrar">
                <span class="glyphicon glyphicon-plus"></span> Novo Cliente
            </button>
        </p>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Idade</th>
                    <th>Sexo</th>
                    <th>Editar</th>
                    <th>Excluir</th>
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
                    <td><?php echo($rowCliente['idade']);?></td>
                    <td><?php echo($rowCliente['sexo']);?></td>
                    <td>
                        <p>
                            <button type="button" class="btn btn-default btn-sm">
                                <span class="glyphicon glyphicon-pencil"></span>
                            </button>
                    </td>
                    <td>

                        <p>

                            <a href="#">
                                <span class="glyphicon glyphicon-trash" data-toggle="modal"
                                    data-target="#myModalDeletar" data-clienteid="<?php print $rowCliente['id']; ?>"
                                    data-clientenome="<?php print $rowCliente['nome']; ?>">
                                </span>
                            </a>
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

    <!-- Modal Cadastrar Cliente -->
    <div class="modal fade" id="myModalCadastrar" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Cadastrar Cliente</h4>
                </div>
                <div class="modal-body">
                    <form action="../controle/ctr_cliente.php" method="POST">
                        <input type="hidden" name="insert">
                        <div class="form-group">
                            <label for="nome">Nome</label>
                            <input type="text" class="form-control" id="nome" name="txtNome" required>
                        </div>
                        <div class="form-group">
                            <label for="idade">Idade</label>
                            <input type="number" class="form-control" id="idade" name="txtIdade" required>
                        </div>
                        <div class="form-group">
                            <label for="sexo">Sexo</label>
                            <input type="text" class="form-control" id="sexo" name="txtSexo" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <!-- Modal Deletar Cliente -->
    <div class="modal fade" id="myModalDeletar" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <form action="../controle/ctr_cliente.php" method="POST">
                        <input type="hidden" name="delete_id" value="" id="recipient-id">
                        <div class="form-group">
                            <label for="nome">Nome</label>
                            <input type="text" class="form-control" id="recipient-nome" name="txtNome" readonly>
                        </div>
                        <button type="submit" class="btn btn-danger">Deletar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
    $('#myModalDeletar').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var recipientid = button.data('clienteid');
        var recipientnome = button.data('clientenome');

        var modal = $(this);
        modal.find('.modal-title').text('Tem certeza que deseja deletar o cliente ' + recipientnome);
        modal.find('#recipient-id').val(recipientid);
        modal.find('#recipient-nome').val(recipientnome);

    })
    </script>
</body>

</html>