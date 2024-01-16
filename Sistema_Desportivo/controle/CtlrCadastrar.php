<?php
require '../dados/conexao.php';

session_start();

// Verifica se o usuário está autenticado
if (!isset($_SESSION["nome"])) {
    header("Location: ../visao/formAutenticar.php");
    exit;
}

// Verifica se o idTecnico está definido na sessão
if (!isset($_SESSION["idTecnico"])) {
    // O idTecnico não está definido na sessão
    // Adote a lógica apropriada para lidar com esse cenário, como exibir uma mensagem de erro ou redirecionar para uma página de erro.
}

// Processa o formulário quando o usuário envia
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os dados do formulário
    $nomeEquipe = $_POST["nomeEquipe"];
    $idTecnico = $_SESSION["idTecnico"]; // Usando o idTecnico da sessão

    // Adicione a verificação do ID do técnico existente
    $stmtVerificaTecnico = $pdo->prepare('SELECT COUNT(*) FROM Tecnico WHERE idTecnico = ?');
    $stmtVerificaTecnico->execute([$idTecnico]);
    $tecnicoExiste = $stmtVerificaTecnico->fetchColumn();

    if (!$tecnicoExiste) {
        // O idTecnico não existe na tabela Tecnico
        // Adote a lógica apropriada para lidar com esse cenário, como exibir uma mensagem de erro ou redirecionar para uma página de erro.
    }

    // Processa o formulário quando o usuário envia
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os dados do formulário
    $nomeEquipe = $_POST["nomeEquipe"];
    $idTecnico = $_SESSION["idTecnico"]; // Usando o idTecnico da sessão

    // Adicione a verificação do ID do técnico existente
    $stmtVerificaTecnico = $pdo->prepare('SELECT COUNT(*) FROM Tecnico WHERE idTecnico = ?');
    $stmtVerificaTecnico->execute([$idTecnico]);
    $tecnicoExiste = $stmtVerificaTecnico->fetchColumn();

    if (!$tecnicoExiste) {
        // O idTecnico não existe na tabela Tecnico
        $_SESSION['mensagem'] = 'Erro: ID do técnico não encontrado na base de dados.';
        $_SESSION['tipo_mensagem'] = 'danger';
        header("Location: ../visao/formListarEquipe.php"); // Redireciona para a página desejada após o erro
        exit;
    }

    try {
        // Inicia uma transação para garantir consistência na obtenção do último ID
        $pdo->beginTransaction();

        // Insere uma nova equipe para o técnico no banco de dados
        $stmt = $pdo->prepare('INSERT INTO Equipe (nomeEquipe, idTecnico) VALUES (?, ?)');
        $stmt->execute([$nomeEquipe, $idTecnico]);

        // Obtém o novo idEquipe gerado
        $idEquipe = $pdo->lastInsertId();

        // Commit da transação
        $pdo->commit();

        // Redireciona para a página desejada após o cadastro
        $_SESSION['mensagem'] = 'Equipe cadastrada com sucesso. ID da Equipe: ' . $idEquipe;
        $_SESSION['tipo_mensagem'] = 'success';
        header("Location: ../visao/formListarEquipe.php");
        exit;
    } catch (Exception $e) {
        // Rollback em caso de erro
        $pdo->rollBack();

        $_SESSION['mensagem'] = 'Erro ao cadastrar a equipe: ' . $e->getMessage();
        $_SESSION['tipo_mensagem'] = 'danger';
        header("Location: ../visao/formListarEquipe.php"); // Redireciona para a página desejada após o erro
        exit;
    }
}


    // Insere a nova equipe no banco de dados
    $stmt = $pdo->prepare('INSERT INTO Equipe (nomeEquipe, idTecnico) VALUES (?, ?)');
    $stmt->execute([$nomeEquipe, $idTecnico]);

    // Redireciona para a página desejada após o cadastro
    header("Location: ../visao/formListarEquipe.php");
    exit;
}
?>
