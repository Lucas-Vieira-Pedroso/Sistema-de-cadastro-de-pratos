<?php

include "../infra/conexao.php";

$id_pratos = $_GET["id"];
$sql = "SELECT * FROM pratos WHERE id_pratos = ?";
if ($stmt = $conexao->prepare($sql)) {
    $stmt->bind_param("i", $id_pratos);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $prato = mysqli_fetch_assoc($resultado);
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#0f172a">
    <title>CRUD - Prato</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../styles/style.css">
</head>

<body class="page-shell">
    <main class="container page-content page-card">
        <article class="panel form-panel">
            <div class="panel-header">
                <p class="eyebrow">Edição</p>
                <h1>Atualizar prato</h1>
            </div>

            <p class="subtle-note">Editando o prato <strong><?php echo $prato["nome_prato"] ?></strong>.</p>

            <form action="atualizar.php" method="POST" class="stacked-form">
                <input type="hidden" name="id_pratos" value="<?php echo $prato["id_pratos"] ?>">

                <div class="field-group">
                    <label for="nome_prato">Nome</label>
                    <input type="text" id="nome_prato" name="nome_prato" class="form-control" value="<?php echo $prato["nome_prato"] ?>">
                </div>

                <div class="field-group">
                    <label for="descricao">Descrição</label>
                    <input type="text" id="descricao" name="descricao" class="form-control" value="<?php echo $prato["descricao"] ?>">
                </div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="field-group">
                            <label for="preco">Preço</label>
                            <input type="number" id="preco" name="preco" class="form-control" step="0.01" value="<?php echo $prato["preco"] ?>">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="field-group">
                            <label for="categoria">Categoria</label>
                            <input type="text" id="categoria" name="categoria" class="form-control" value="<?php echo $prato["categoria"] ?>">
                        </div>
                    </div>
                </div>

                <div class="inline-actions">
                    <button type="submit" class="btn btn-primary">Atualizar</button>
                    <a href="../index.php" class="btn btn-secondary">Voltar</a>
                </div>
            </form>
        </article>
    </main>
</body>

</html>