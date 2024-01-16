<?php
session_start();

require '../dados/conexao.php';

// Verifica se o usuário está autenticado
if (isset($_SESSION["idTecnico"])) {
    // Obtém o ID da equipe da URL
    $idEquipe = isset($_GET['idEquipe']) ? intval($_GET['idEquipe']) : 0;

    // Verifica se o ID da equipe foi fornecido na URL
    if ($idEquipe > 0) {
        // Obtém o nome da equipe
        $queryNomeEquipe = $pdo->prepare('SELECT nomeEquipe FROM Equipe WHERE idEquipe = ?');
        $queryNomeEquipe->bindValue(1, $idEquipe);
        $queryNomeEquipe->execute();
        $dadosEquipe = $queryNomeEquipe->fetch();

        if ($dadosEquipe) {
            $nomeEquipeSelecionada = $dadosEquipe['nomeEquipe'];

            // Lista as atividades da equipe usando a procedure
            $queryAtividades = $pdo->prepare('CALL listarAtividades(?)');
            $queryAtividades->bindValue(1, $idEquipe);
            $queryAtividades->execute();

            // Obtém as atividades da equipe
            $atividadesEquipe = $queryAtividades->fetchAll();
            
            // Construa a URL para o formulário "formCadastrarAtividade.php" com o parâmetro "idEquipe"
            $urlFormCadastrarAtividade = "formCadastrarAtividade.php?idEquipe=$idEquipe";
        } else {
            echo "Equipe não encontrada.";
            exit();
        }
    } else {
        echo "ID da equipe não fornecido ou inválido.";
        exit();
    }
} else {
    header("Location: ../visao/formAtividade.php");
    exit();
}

// Adicione esta linha após o bloco PHP
$nomeEquipe = isset($nomeEquipeSelecionada) ? $nomeEquipeSelecionada : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Atividades da Equipe</title>
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
            <h2>Atividades da Equipe</h2>
        </div>
        <div class="col text-end">
            <!-- Agora, use a variável $urlFormCadastrarAtividade na tag <a> -->
            <a href="<?php echo $urlFormCadastrarAtividade; ?>" class="btn btn-primary">Cadastrar Atividade</a>
        </div>
    </div>
    <table class="table">
        <thead>
        <tr>
            <th>Número</th>
            <th>Nome da Equipe</th>
            <th>Ações</th>
        </tr>
        </thead>
        <tbody>
        <?php
// Verifica se $atividadesEquipe está definido e não é nulo
if (isset($atividadesEquipe) && is_array($atividadesEquipe)) {
    // Itera sobre as atividades da equipe
    foreach ($atividadesEquipe as $linhaAtividade) {
        echo("<tr>");
        echo("<td>" . $linhaAtividade['idAtividade'] . "</td>");

        // Verifica se a chave 'DescricaoAtividade' existe no array antes de acessá-la
        echo("<td>" . $linhaAtividade['descricaoAtividade'] . "</td>");

        echo("<td>
        <a href='../visao/formListarDescricao.php?idAtividade=" . $linhaAtividade['idAtividade'] . "' class='btn btn-success'>Visualizar</a>
    </td>");


        // Adiciona um botão "Excluir"
        echo("<td>
                <a href='../controle/CtlrDeletarAtividade.php?idAtividade=" . $linhaAtividade['idAtividade'] . "' class='btn btn-danger' onclick='return confirm(\"Tem certeza que deseja excluir esta atividade?\")'>Excluir</a>
            </td>");

        echo("</tr>");
    }
} else {
    echo("<tr><td colspan='4'>Nenhuma atividade encontrada para a equipe.</td></tr>");
}
?>

        </tbody>
    </table>
</div>
</body>
</html>
