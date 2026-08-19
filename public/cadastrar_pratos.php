<?php

include "../infra/conexao.php";



$nome_prato = $_POST["nome_prato"];
$id_usuario = $_POST["id_usuario"];
$descricao = $_POST["descricao"];
$preco = $_POST["preco"];
$categoria = $_POST["categoria"];

$sql = "INSERT INTO pratos (id_usuario,nome_prato,descricao,preco,categoria) VALUES (?,?,?,?,?)";

if($stmt = $conexao->prepare($sql)){
    $stmt-> bind_param("issss", $id_usuario,$nome_prato, $descricao, $preco, $categoria);
    $stmt->execute();
    $stmt->close();

};
header("Location: ../index.php");
?>