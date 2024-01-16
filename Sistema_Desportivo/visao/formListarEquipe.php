<?php
session_start();

require '../dados/conexao.php';

// Verifica se o usuário está autenticado e se a chave "idTecnico" está definida na sessão
if (!isset($_SESSION["nome"]) || !isset($_SESSION["idTecnico"])) {
    header("Location: ../visao/formAutenticar.php");
    exit;
}

// Use a stored procedure to list the teams of the specific technician
$idTecnico = $_SESSION["idTecnico"];
$stmtListarEquipes = $pdo->prepare('CALL listarEquipe(?)');
$stmtListarEquipes->execute([$idTecnico]);
$resultados = $stmtListarEquipes->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Equipes</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
        <a class="navbar-brand" href="/projetoDS2/visao/formListarEquipe.php">
            <?php echo($_SESSION["nome"]); ?>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="/projetoDS2/controle/CtrlSair.php">SAIR</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<br>
<br>
<div class="container">
    <div class="row">
        <div class="col">
            <h2>Equipes</h2>
        </div>
        <div class="col text-end">
            <a href="/projetoDS2/visao/formCadastrarEquipe.php" class="btn btn-primary">Cadastrar</a>
        </div>
    </div>
    <table class="table">
        <thead>
        <tr>
            <th>Número</th>
            <th>Nome</th>
            <th>Ação</th>
        </tr>
        </thead>
        <tbody>
        <?php
      // ...

foreach ($resultados as $linha) {
    echo("<tr>");
    echo(" <td>" . $linha['idEquipe'] . "</td>");
    echo(" <td>" . $linha['nomeEquipe'] . "</td>");
    echo("<td>");
    
    // Adiciona um link para a página de exclusão
    echo("<a href='../controle/CtlrDeletarEquipe.php?idEquipe=" . $linha['idEquipe'] . "' class='btn btn-danger' onclick='return confirm(\"Tem certeza que deseja excluir a equipe?\")'>Excluir</a>");

    
    // Adiciona um link para a página formAtividade.php passando o idEquipe como parâmetro
    $urlFormAtividade = '/projetoDS2/visao/formAtividade.php?idEquipe=' . $linha['idEquipe'];
    echo("<a href='" . $urlFormAtividade . "' class='btn btn-success'>Visualizar</a>");

    // Armazena o idEquipe na sessão
    $_SESSION['idEquipe'] = $linha['idEquipe'];

    echo("</td>");
    echo("</tr>");
}

// ...

        ?>
        </tbody>
    </table>
</div>
</body>
</html>
