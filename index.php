
<?php

include "infra/conexao.php";
$sqlPratos = "SELECT pratos.*, usuarios.nome_usuario
              FROM pratos 
              LEFT JOIN usuarios ON pratos.id_pratos = usuarios.id_usuario";
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
            <label for="id_usuario">Usuário Responsável:</label>
            <select name="id_usuario" id="id" required>
                <option value="">Selecione um usuário...</option>
                <?php while ($usuario = mysqli_fetch_assoc($usuarios)) { ?>
                    <option value="<?php echo $usuario['id_usuario']; ?>">
                        <?php echo $usuario['nome_usuario']; ?>
                    </option>
                <?php } ?>
            </select>
            <br>
            <label for="nome_prato">Nome:</label>
            <input type="text" name="nome_prato" required>
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
                        <td><?php echo $usuario["nome"] ?? 'Sem usuário'; ?></td>
                        <td><?php echo $prato["id_pratos"]; ?></td>
                        <td><?php echo $prato["nome_prato"]; ?></td>
                        <td><?php echo $prato["descricao"]; ?></td>
                        <td><?php echo $prato["preco"]; ?></td>
                        <td><?php echo $prato["categoria"]; ?></td>
                        <td>
                            <a href="public/editar.php?id=<?php echo $prato["id_pratos"]; ?>">Editar</a>
                            <a href="public/excluir.php?id=<?php echo $prato["id_pratos"]; ?>">Excluir</a>
                        </td>
                    </tr>
                <?php } ?>
                
                             
            </table>
        </div>
        <a href="public/pertence.php">procurar</a>
    </main>
    <footer></footer>
</body>

</html>

```