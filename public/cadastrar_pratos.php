<?php

include "../infra/conexao.php";



$nome = $_POST["nomeprato"];
$descricao = $_POST["descricao"];
$preco = $_POST["preco"];
$categoria = $_POST["categoria"];

$sql = "INSERT INTO pratos (nome,descricao,preco,categoria) VALUES (?,?,?,?)";

if($stmt = $conexao->prepare($sql)){
    $stmt-> bind_param("ssss", $nome, $descricao, $preco, $categoria);
    $stmt->execute();
    $stmt->close();

};
header("Location: ../index.php");
?>