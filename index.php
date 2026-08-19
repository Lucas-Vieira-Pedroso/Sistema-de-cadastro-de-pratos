
<?php

include "infra/conexao.php";
$sqlPratos = "SELECT pratos.*, usuarios.nome 
              FROM pratos 
              LEFT JOIN usuarios ON pratos.id = usuarios.id";
$pratos = mysqli_query($conexao, $sqlPratos);

$usuarios = mysqli_query($conexao, "SELECT * FROM usuarios");
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD - Livraria</title>
    <link rel="stylesheet" href="style/styles.css">
</head>

<body>
    <header>
        <h1>CRUD - Livraria</h1>
    </header>
    <main>
        <h2>Adicione um novo Usuário!</h2>
        <form action="public/cadastrar_usuarios.php" method="POST">
            <label for="nome">Nome:</label>
            <input type="text" name="nome" required>
            <br>
            <label for="email">Email:</label>
            <input type="email" name="email" required>
            <br>
            <button type="submit">Cadastrar</button>
        </form>

        <h2>Adicione um novo Prato!</h2>
        <form action="public/cadastrar_pratos.php" method="POST">
            <label for="id">Usuário Responsável:</label>
            <select name="id" id="id" required>
                <option value="">Selecione um usuário...</option>
                <?php while ($usuario = mysqli_fetch_assoc($usuarios)) { ?>
                    <option value="<?php echo $usuario['id']; ?>">
                        <?php echo $usuario['nome']; ?>
                    </option>
                <?php } ?>
            </select>
            <br>
            <label for="nomeprato">Nome:</label>
            <input type="text" name="nomeprato" required>
            <br>
            <label for="descricao">Descrição</label>
            <input type="text" name="descricao" required>
            <br>
            <label for="preco">Preço: </label>
            <input type="number" step="0.01" name="preco" required>
            <br>
            <label for="categoria">Categoria</label>
            <input type="text" name="categoria" required>
            <br>
            <button type="submit">Cadastrar</button>
        </form>

        <div>
            <h2>Pratos Cadastrados</h2>
            <table border="1">
                <tr>
                    <th>Usuário</th>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Preço</th>
                    <th>Categoria</th>
                    <th>Ações</th>
                </tr>
                <?php while ($prato = mysqli_fetch_assoc($pratos)) { ?>
                    <tr>
                        <td><?php echo $prato["nome"] ?? 'Sem usuário'; ?></td>
                        <td><?php echo $prato["id"]; ?></td>
                        <td><?php echo $prato["nome"]; ?></td>
                        <td><?php echo $prato["descricao"]; ?></td>
                        <td><?php echo $prato["preco"]; ?></td>
                        <td><?php echo $prato["categoria"]; ?></td>
                        <td>
                            <a href="public/editar.php?id=<?php echo $prato["id"]; ?>">Editar</a>
                            <a href="public/excluir.php?id=<?php echo $prato["id"]; ?>">Excluir</a>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </main>
    <footer></footer>
</body>

</html>

```