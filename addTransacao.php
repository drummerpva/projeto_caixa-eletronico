<?php
session_start();
require './config.php';
if (empty($_SESSION['banco'])) {
    header("Location: login.php");
}
if(!empty($_POST['valor'])){
    $tipo = $_POST['tipo'];
    $valor = number_format(str_replace(",", ".", $_POST['valor']),2,".","");
    $data = date("Y-m-d H:i:s");
    
    $sql = $pdo->prepare("INSERT INTO historico(idConta,tipo,valor,data_operacao) VALUES(:id,:tipo,:valor,:data)");
    $sql->bindValue(":id",$_SESSION['banco']);
    $sql->bindValue(":tipo",$tipo);
    $sql->bindValue(":valor",$valor);
    $sql->bindValue(":data",$data);
    $sql->execute();
    $sql = $pdo->prepare("SELECT * FROM contas WHERE id = :id");
    $sql->bindValue(":id",$_SESSION['banco']);
    $sql->execute();
    if($sql->rowCount() > 0){
        $sql = $sql->fetch();
        if($tipo == "0"){
            $valor = number_format(floatval($sql['saldo']) + $valor,2,".","");
        }else{
            $valor = number_format(floatval($sql['saldo']) - $valor,2,".","");
        }
        $sql = $pdo->prepare("UPDATE contas SET saldo = :saldo WHERE id = :id");
        $sql->bindValue(":saldo",$valor);
        $sql->bindValue(":id",$_SESSION['banco']);
        $sql->execute();
    }
    header("Location: ./");
    
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Caixa Eletrônico</title>
    </head> 
    <body>
<form method="POST" width="150">
    <fieldset>
        Tipo:<br/>
        <select name="tipo" required="">
            <option value="0">Depósito</option>
            <option value="1">Retirada</option>
        </select><br/><br/>
        Valor:<br/>
        <input type="text" name="valor" required pattern="[0-9.,]{1,}"/><br/><br/>
        <input type="submit" value="Enviar"/>
    </fieldset>
</form>
        
    </body>
</html>
