<?php
try{
    $pdo = new PDO("mysql:dbname=projeto_caixaeletronico;host=localhost","root","");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch (PDOException $ex) {
    echo "Erro ao conectar ao BD Erro: ".$ex->getMessage();
    die();
}