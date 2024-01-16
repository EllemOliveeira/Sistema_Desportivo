<?php
session_start();

require '../dados/conexao.php';

// Verifica se o usuário está autenticado e se a chave "idTecnico" está definida na sessão
if (!isset($_SESSION["nome"]) || !isset($_SESSION["idTecnico"])) {
    header("Location: ../visao/formAutenticar.php");
    exit;
}

// Verifique se os dados do formulário foram recebidos
if (isset($_POST["nome"]) && isset($_POST["descricao"]) && isset($_POST["idEquipe"])) {
    // Receba os dados do formulário
    $nome = $_POST["nome"];
    $descricao = $_POST["descricao"];
    $idEquipe = $_POST["idEquipe"]; // Certifique-se de ajustar o nome do campo conforme necessário

    // Crie uma consulta preparada para inserir uma nova atividade
    $stmt = $pdo->prepare('INSERT INTO Atividade (nomeAtividade, descricaoAtividade, idEquipe) VALUES (?, ?, ?)');
    $stmt->bindValue(1, $nome);
    $stmt->bindValue(2, $descricao);
    $stmt->bindValue(3, $idEquipe);
    
    // Execute a consulta
    $stmt->execute();

    // Redirecione para a página desejada após o cadastro
    header("Location: ../visao/formAtividade.php?idEquipe=" . $idEquipe);
    exit();
} else {
    // Se os dados do formulário não foram recebidos, redirecione para a página de cadastro
    header("Location: ../visao/formCadastrarAtividade.php");
    exit();
}
?>
