<?php
include "../infra/conexao.php";

$usuarios = mysqli_query($conexao, "SELECT id_usuario, nome_usuario FROM usuarios ORDER BY nome_usuario");

$id_usuario_selecionado = isset($_GET["id_usuario"]) ? (int) $_GET["id_usuario"] : 0;
$pratos = false;

if ($id_usuario_selecionado > 0) {
    $sql = "SELECT pratos.*, usuarios.nome_usuario
            FROM pratos
            INNER JOIN usuarios ON pratos.id_usuario = usuarios.id_usuario
            WHERE pratos.id_usuario = ?
            ORDER BY pratos.nome_prato";

    if ($stmt = $conexao->prepare($sql)) {
        $stmt->bind_param("i", $id_usuario_selecionado);
        $stmt->execute();
        $pratos = $stmt->get_result();
        $stmt->close();
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pratos por usuário</title>
</head>

<body>
    <h1>Pratos pertencentes a um usuário</h1>

    <form action="pertence.php" method="GET">
        <label for="id_usuario">Usuário Responsável:</label>
        <select name="id_usuario" id="id_usuario" required>
            <option value="">Selecione um usuário...</option>
            <?php while ($usuario = mysqli_fetch_assoc($usuarios)) { ?>
                <option value="<?php echo $usuario['id_usuario']; ?>" <?php echo $id_usuario_selecionado === (int) $usuario['id_usuario'] ? 'selected' : ''; ?>>
                    <?php echo $usuario['nome_usuario']; ?>
                </option>
            <?php } ?>
        </select>
        <button type="submit">Procurar</button>
    </form>

    <?php if ($id_usuario_selecionado > 0) { ?>
        <h2>Resultado</h2>
        <table border="1">
            <tr>
                <th>Usuário</th>
                <th>ID</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Preço</th>
                <th>Categoria</th>
            </tr>
            <?php if ($pratos && mysqli_num_rows($pratos) > 0) { ?>
                <?php while ($prato = mysqli_fetch_assoc($pratos)) { ?>
                    <tr>
                        <td><?php echo $prato["nome_usuario"]; ?></td>
                        <td><?php echo $prato["id_pratos"]; ?></td>
                        <td><?php echo $prato["nome_prato"]; ?></td>
                        <td><?php echo $prato["descricao"]; ?></td>
                        <td><?php echo $prato["preco"]; ?></td>
                        <td><?php echo $prato["categoria"]; ?></td>
                    </tr>
                <?php } ?>
            <?php } ?>
            <?php } ?>
        </table>
    <?php ?>
</body>

</html>