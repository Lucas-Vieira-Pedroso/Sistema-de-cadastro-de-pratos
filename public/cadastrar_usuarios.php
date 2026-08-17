<?php

include "../infra/conexao.php";


$nome = $_POST["nome"];
$email = $_POST["email"];

$sql = "INSERT INTO usuarios (nome,email) VALUES (?,?)";

if($stmt = $conexao->prepare($sql)){
    $stmt-> bind_param("ss", $nome, $email);
    $stmt->execute();
    $stmt->close();

};
header("Location: ../index.php");
?>