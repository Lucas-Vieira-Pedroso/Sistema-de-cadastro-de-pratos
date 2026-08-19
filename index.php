<?php

include "infra/conexao.php";

$usuarios = mysqli_query($conexao, "SELECT * FROM usuarios");

$filtroIdUsuario = isset($_GET['id_usuario']) ? (int) $_GET['id_usuario'] : 0;

$sqlPratos = "SELECT pratos.*, usuarios.nome_usuario
              FROM pratos
              LEFT JOIN usuarios ON pratos.id_usuario = usuarios.id_usuario";

if ($filtroIdUsuario > 0) {
    $sqlPratos .= " WHERE pratos.id_usuario = $filtroIdUsuario";
}

$pratos = mysqli_query($conexao, $sqlPratos);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#0f172a">
    <title>CRUD - Livraria</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles/style.css">
</head>

<body class="app-shell">
    <header class="topbar">
        <div class="container brand-row">
            <div class="brand-wrap">
                <span class="brand-mark">P</span>
                <div>
                    <p class="eyebrow">Dashboard</p>
                    <h1>Pratos</h1>
                </div>
            </div>
        </div>
    </header>

    <main class="container page-content">
        <section class="dashboard-grid">
            <article class="panel form-panel">
                <div class="panel-header">
                    <p class="eyebrow">Usuários</p>
                    <h2>Adicionar novo usuário</h2>
                </div>

                <form action="public/cadastrar_usuarios.php" method="POST" class="stacked-form">
                    <div class="field-group">
                        <label for="nome">Nome</label>
                        <input type="text" id="nome" name="nome" class="form-control" placeholder="Ex: Maria Silva" required>
                    </div>

                    <div class="field-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="exemplo@email.com" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Cadastrar usuário</button>
                </form>
            </article>

            <article class="panel form-panel">
                <div class="panel-header">
                    <p class="eyebrow">Cardápio</p>
                    <h2>Adicionar novo prato</h2>
                </div>

                <form action="public/cadastrar_pratos.php" method="POST" class="stacked-form">
                    <div class="field-group">
                        <label for="id_usuario">Usuário responsável</label>
                        <select name="id_usuario" id="id_usuario" class="form-select" required>
                            <option value="">Selecione um usuário...</option>
                            <?php while ($usuario = mysqli_fetch_assoc($usuarios)) { ?>
                                <option value="<?php echo $usuario['id_usuario']; ?>">
                                    <?php echo $usuario['nome_usuario']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="field-group">
                        <label for="nome_prato">Nome</label>
                        <input type="text" id="nome_prato" name="nome_prato" class="form-control" placeholder="Ex: Risoto de cogumelos" required>
                    </div>

                    <div class="field-group">
                        <label for="descricao">Descrição</label>
                        <input type="text" id="descricao" name="descricao" class="form-control" placeholder="Descreva o prato" required>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="field-group">
                                <label for="preco">Preço</label>
                                <input type="number" id="preco" step="0.01" name="preco" class="form-control" placeholder="0.00" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="field-group">
                                <label for="categoria">Categoria</label>
                                <input type="text" id="categoria" name="categoria" class="form-control" placeholder="Ex: Italiana" required>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Cadastrar prato</button>
                </form>
            </article>
        </section>

        <article class="panel form-panel">
            <div class="panel-header">
                <p class="eyebrow">Busca</p>
                <h2>Filtrar por usuário</h2>
            </div>

            <form method="GET" class="stacked-form">
                <div class="field-group">
                    <label for="id_usuario_filtro">Usuário</label>
                    <select id="id_usuario_filtro" name="id_usuario" class="form-select">
                        <option value="">Todos</option>
                        <?php
                        $usuariosReset = mysqli_query($conexao, "SELECT * FROM usuarios");
                        while ($usuario = mysqli_fetch_assoc($usuariosReset)) {
                            $selecionado = ($filtroIdUsuario === (int) $usuario['id_usuario']) ? 'selected' : '';
                            echo "<option value='{$usuario['id_usuario']}' {$selecionado}>{$usuario['nome_usuario']}</option>";
                        }
                        ?>
                    </select>
                </div>

                <button type="submit" class="btn btn-secondary">Filtrar</button>
            </form>
        </article>

        <section class="panel table-panel" aria-label="Pratos cadastrados">
            <div class="panel-header">
                <div>
                    <p class="eyebrow">Catálogo</p>
                    <h2>Pratos cadastrados</h2>
                </div>
            </div>

            <div class="table-wrap">
                <table class="table modern-table">
                    <thead>
                        <tr>
                            <th>Usuário</th>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Descrição</th>
                            <th>Preço</th>
                            <th>Categoria</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($pratos && mysqli_num_rows($pratos) > 0) { ?>
                            <?php while ($prato = mysqli_fetch_assoc($pratos)) { ?>
                                <tr>
                                    <td><?php echo $prato['nome_usuario'] ?? 'Sem usuário'; ?></td>
                                    <td><?php echo $prato['id_pratos']; ?></td>
                                    <td><?php echo $prato['nome_prato']; ?></td>
                                    <td><?php echo $prato['descricao']; ?></td>
                                    <td>R$ <?php echo number_format((float) $prato['preco'], 2, ',', '.'); ?></td>
                                    <td><?php echo $prato['categoria']; ?></td>
                                    <td class="table-actions">
                                        <a href="public/editar.php?id=<?php echo $prato['id_pratos']; ?>" class="action-link edit">Editar</a>
                                        <a href="public/excluir.php?id=<?php echo $prato['id_pratos']; ?>" class="action-link delete">Excluir</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        <?php } else { ?>
                            <tr>
                                <td colspan="7" class="empty-state">Nenhum prato encontrado.</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </section>
        </div>
    </main>
</body>

</html>

```