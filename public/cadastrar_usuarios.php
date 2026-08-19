<?php

include "../infra/conexao.php";


$nome_usuario = $_POST["nome"];
$email = $_POST["email"];

$sql = "INSERT INTO usuarios (nome_usuario,email) VALUES (?,?)";

if($stmt = $conexao->prepare($sql)){
    $stmt-> bind_param("ss", $nome_usuario, $email);
    $stmt->execute();
    $stmt->close();

};
header("Location: ../index.php");
?>