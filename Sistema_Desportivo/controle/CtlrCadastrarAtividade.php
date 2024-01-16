<?php
require '../dados/conexao.php';

session_start();

// Verifica se o usuário está autenticado
if (!isset($_SESSION["nome"])) {
    header("Location: ../visao/formAutenticar.php");
    exit;
}

// Processa o formulário quando o usuário envia
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os dados do formulário
    $nomeAtividade = $_POST["nomeAtividade"];
    $descricaoAtividade = $_POST["descricaoAtividade"];
    $idEquipe = $_POST["idEquipe"]; // Obtendo o idEquipe do formulário

    // Adicione a verificação do ID da equipe existente
    $stmtVerificaEquipe = $pdo->prepare('SELECT COUNT(*) FROM Equipe WHERE idEquipe = ?');
    $stmtVerificaEquipe->execute([$idEquipe]);
    $equipeExiste = $stmtVerificaEquipe->fetchColumn();

    if (!$equipeExiste) {
        // O idEquipe não existe na tabela Equipe
        $_SESSION['mensagem'] = 'Erro: ID da equipe não encontrado na base de dados.';
        $_SESSION['tipo_mensagem'] = 'danger';
        header("Location: ../visao/formListarEquipe.php"); // Redireciona para a página desejada após o erro
        exit;
    }

    try {
        // Inicia uma transação para garantir consistência na obtenção do último ID
        $pdo->beginTransaction();

        // Insere uma nova atividade para a equipe no banco de dados
        $stmt = $pdo->prepare('INSERT INTO Atividade (nomeAtividade, descricaoAtividade, idEquipe) VALUES (?, ?, ?)');
        $stmt->execute([$nomeAtividade, $descricaoAtividade, $idEquipe]);

        // Obtém o novo idAtividade gerado
        $idAtividade = $pdo->lastInsertId();

        // Commit da transação
        $pdo->commit();

        // Redireciona para a página desejada após o cadastro
        $_SESSION['mensagem'] = 'Atividade cadastrada com sucesso. ID da Atividade: ' . $idAtividade;
        $_SESSION['tipo_mensagem'] = 'success';
        header("Location: ../visao/formAtividade.php?idEquipe=" . $idEquipe);
        exit;
    } catch (Exception $e) {
        // Rollback em caso de erro
        $pdo->rollBack();

        $_SESSION['mensagem'] = 'Erro ao cadastrar a atividade: ' . $e->getMessage();
        $_SESSION['tipo_mensagem'] = 'danger';
        header("Location: ../visao/formAtividade.php?idEquipe=" . $idEquipe); // Redireciona para a página desejada após o erro
        exit;
    }
}

// Se não for uma requisição POST, redireciona para a página desejada
$idEquipe = $_GET["idEquipe"] ?? null;

// Verifica se o ID da equipe está presente na URL
if (!$idEquipe) {
    // O ID da equipe não está presente na URL
    // Adote a lógica apropriada para lidar com esse cenário, como exibir uma mensagem de erro ou redirecionar para uma página de erro.
}

// Define o idEquipe na sessão
$_SESSION["idEquipe"] = $idEquipe;

// Obtendo o nome da equipe para exibição no formulário
$stmtNomeEquipe = $pdo->prepare('SELECT nomeEquipe FROM Equipe WHERE idEquipe = ?');
$stmtNomeEquipe->execute([$idEquipe]);
$dadosEquipe = $stmtNomeEquipe->fetch();
$nomeEquipe = $dadosEquipe['nomeEquipe'] ?? '';

?>
