<?php
session_start();
require './config.php';
if (!empty($_SESSION['banco'])) {
    $id = $_SESSION['banco'];
    $sql = $pdo->prepare("SELECT * FROM contas WHERE id = :id");
    $sql->bindValue(":id", $id);
    $sql->execute();
    if ($sql->rowCount() > 0) {
        $info = $sql->fetch();
    } else {
        unset($_SESSION['banco']);
        header("Location: login.php");
    }
} else {
    header("Location: login.php");
    exit;
}
?>
<html>
    <head>
        <title>Caixa Eletrônico</title>
    </head>
    <body>
        <h1>Banco XYZ</h1>
        Titular:  <?php echo $info['titular']; ?><br/>
        Agência: <?php echo $info['agencia']; ?><br/>
        Conta: <?php echo $info['conta']; ?><br/>
        Saldo: <?php echo number_format($info['saldo'],2,",","."); ?><br/><br/>
        <a href="logout.php">Sair</a><br>
        <hr/>
        <h3 align="center">Movimentação/Extrato</h3>
        <a href="addTransacao.php">Adicionar Transação</a>
        
        <table border="1" style="width: 40%;margin:auto;">
            <tr>
                <th>Data</th>
                <th>Valor</th>
            </tr>
            <?php
            $sql = $pdo->prepare("SELECT * FROM historico WHERE idConta = :id");
            $sql->bindValue(":id", $id);
            $sql->execute();
            if ($sql->rowCount() > 0) {
                foreach ($sql->fetchAll() as $item) {
                    ?>
                    <tr>
                        <td><?php echo date('d/m/Y H:i',strtotime($item['data_operacao']));?></td>
                        <td><?php if($item['tipo'] == 0){?>
                            <font color="green"> <?php }else{ ?>
                            <font color="red"> -<?php } ?>      
                            R$ <?php echo number_format($item['valor'],2,",",".");?>
                        </font>
                        </td>
                    </tr>
                    <?php
                }
            }
            ?>
        </table>
    </body>
</html>    