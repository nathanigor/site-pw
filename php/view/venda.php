<?php session_start()?>
<?php #session_destroy() ?>
<?php
    if(isset($_SESSION['venda'])){
    }else{
        $_SESSION['venda'] = array();
    }
    if(isset($_GET['par'])){
        $Produto = $_GET['par'];
        $_SESSION['venda'][$Produto] = 1;
    }
    if(isset($_GET['del'])){
        $Del = $_GET['del'];
        unset($_SESSION['venda'][$Del]);
    }
?>

<?php
    require_once '../model/produto.php';
    require_once '../model/cliente.php';
    require_once '../model/funcionario.php';
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
    <title>Venda</title>
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
            <a href="produto.php">
                <button type="button" class="novo">
                    <span></span>Adicionar Produto
                </button>
            </a>
        </p>
        <div class="box-caixa">
            <table class="Produto">
                <h2>Produtos Disponíveis</h2>
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>Tamanho</th>
                        <th>Valor</th>
                        <th>Quantidade</th>
                    </tr>
                <tbody>

                    <?php
                        $query = "select * from produto";
                        $stmt = $objProduto -> runQuery($query);
                        $stmt -> execute();
                        if ($stmt -> rowCount() > 0) {
                            while($rowProduto = $stmt -> fetch(PDO::FETCH_ASSOC)) {
                    ?>

                    <tr>
                        <td><a
                                href="venda.php?par=<?php echo $rowProduto['id']?>"><?php echo($rowProduto['nome']);?></a>
                        </td>
                        <td><?php echo($rowProduto['descricao']);?></td>
                        <td><?php echo($rowProduto['tamanho']);?></td>
                        <td><?php echo number_format($rowProduto['valor'],2,"," , "."); ?></td>
                        <td><?php echo($rowProduto['quantidade']);?></td>
                    </tr>
                    <?php
        }
    }
            ?>

                </tbody>
                </thead>

        </div>
        <table>
            <thead>
                <h2>Carrinho</h2>
                <tr>
                    <th>Produto</th>
                    <th>Valor</th>
                    <th>Quantidade</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <?php
            $Total = 0;
            $QuantiProdutos = 0;
        foreach($_SESSION['venda'] as $Prod => $Quantidade):
            $link = mysqli_connect("localhost", "root", "", "nssports");
            $SqlCarrinho = mysqli_query($link, "SELECT * FROM produto Where id = '$Prod' ");
            $ResAssoc = mysqli_fetch_assoc($SqlCarrinho);

            echo'<tr>';
                echo '<td>'.$ResAssoc['nome'].'</td>';
                echo '<td>'.number_format($ResAssoc['valor'],2,",",".").'</td>';
                echo '<td>'.$Quantidade.'</td>';
                echo '<td><a  href="venda.php?del='.$ResAssoc['id'].'"><img src="./img/trash-alt.svg" width="20px" alt=""></a></td>';
                $Total += $ResAssoc['valor'] * $Quantidade;
                $QuantiProdutos += $Quantidade;
            echo '</tr>';

        endforeach;
        echo '<tr>';
            echo '<td colspan="4">'.'Quantidade Total de Produtos: '.$QuantiProdutos.'</td>';
            echo '<td colspan="4">'.'Total R$: '.number_format($Total,2,",",".").'</td>';
        echo '</tr>';

    ?>
            <?php
            
        if(isset($_POST['enviar'])){
            $link = mysqli_connect("localhost", "root", "", "nssports");
            $SqlInserirVenda = mysqli_query($link,"INSERT INTO venda(valor) Values ('$Total')");
            $idvenda = mysqli_insert_id($link);

            foreach($_SESSION['venda'] as $ProdInsert => $Qtd):
                
                $SqlInserirItens = mysqli_query($link,"INSERT INTO itensvendas(id_venda, id_prod, qtd) Values ('$idvenda','$ProdInsert','$Qtd')");

            endforeach;
            echo "<script>alert('Venda concluida com sucesso!!')</script>";
        }
    ?>
        </table>
        <form action="" enctype="multipart/form-data" method="post">
            <input type="submit" name="enviar" value="Finalizar Pedido" />
        </form>
    </div>

</html>