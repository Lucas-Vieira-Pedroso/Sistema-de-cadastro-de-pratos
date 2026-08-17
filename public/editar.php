<?php

include "../infra/conexao.php";

$id = $_GET["id"];
$sql = "SELECT * FROM pratos WHERE id = ?";
if($stmt = $conexao->prepare($sql)){
    $stmt-> bind_param("i", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $prato = mysqli_fetch_assoc($resultado);
    $stmt->close();

};


?>