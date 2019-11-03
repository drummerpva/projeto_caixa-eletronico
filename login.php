<?php
session_start();
require './config.php';
if(!empty($_POST['agencia'])){
    $agencia = addslashes($_POST['agencia']);
    $conta = addslashes($_POST['conta']);
    $senha = md5($_POST['senha']);
    $sql = $pdo->prepare("SELECT * FROM contas where agencia = :agencia AND conta = :conta AND senha = :senha");
    $sql->bindValue(":agencia",$agencia);
    $sql->bindValue(":conta",$conta);
    $sql->bindValue(":senha",$senha);
    $sql->execute();
    if($sql->rowCount() > 0){
        $sql = $sql->fetch();
        $_SESSION['banco'] = $sql['id'];
        header("Location: ./");
        exit;
    }else{
        echo "<p>Dados não Conferem. Verifique e tente novamente!</p>";
    }
    
}
if(!empty($_SESSION['banco'])){
    header("Location: ./");
}
?>
<form method="POST" style="width: 150px;margin:auto;">
    <fieldset>
        Agência:<br/>
        <input type="tel" name="agencia" required/><br/><br/>
        Conta:<br/>
        <input type="tel" name="conta" required/><br/><br/>
        Senha:<br/>
        <input type="password" name="senha" required/><br/><br/>
        <input type="submit" value="Entrar">
    </fieldset>
</form>
