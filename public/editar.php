<?php

include "../infra/conexao.php";

$id = $_GET["id"];
$sql = "SELECT * FROM pratos WHERE id = ?";
if ($stmt = $conexao->prepare($sql)) {
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $prato = mysqli_fetch_assoc($resultado);
    $stmt->close();

}
;


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD - Prato</title>
    <link rel="stylesheet" href="style/styles.css">
</head>

<body>
    <header>
        <h1>CRUD - Pratos</h1>
    </header>
    <main>
        <h2>Editando o prato
            <?php echo $prato["nome"] ?>!
        </h2>
        <form action="atualizar.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $prato["id"] ?>">

            <label for="nome">Nome: </label>
            <input type="text" name="nome" value="<?php echo $prato["nome"] ?>">
            <br>
            <label for="descricao">Descrição: </label>
            <input type="text" name="descricao" value="<?php echo $prato["descricao"] ?>">
            <br>
            <label for="preco">Preço: </label>
            <input type="number" name="preco" step="0.01" value="<?php echo $prato["preco"] ?>">
            <br>
            <label for="categoria">Categoria: </label>
            <input type="text" name="categoria" value="<?php echo $prato["categoria"] ?>">
            <br>
            <button type="submit">Atualizar</button>
        </form>

    </main>
    <footer>

    </footer>


</body>

</html>