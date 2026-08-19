<?php

include "../infra/conexao.php";

$id = $_POST["id_pratos"];
$prato = $_POST["nome_prato"];
$descricao = $_POST["descricao"];
$preco = $_POST["preco"];
$categoria = $_POST["categoria"];

$sql = "UPDATE pratos SET nome_prato= ?,descricao= ?,preco= ?,categoria= ? WHERE id_usuario = ?";

if($stmt = $conexao->prepare($sql)){
    $stmt-> bind_param("ssdsi", $prato, $descricao, $preco, $categoria, $id);
    $stmt->execute();
    $stmt->close();

};
header("Location: ../index.php");