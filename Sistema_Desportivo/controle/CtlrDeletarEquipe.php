<?php
require '../dados/conexao.php';

if (isset($_GET['idEquipe']) && is_numeric($_GET['idEquipe'])) {
    $idEquipe = $_GET['idEquipe'];

    // Verificar se a equipe tem atividades associadas
    $stmtVerificarAtividades = $pdo->prepare("SELECT COUNT(*) FROM Atividade WHERE idEquipe = ?");
    $stmtVerificarAtividades->execute([$idEquipe]);
    $numeroAtividades = $stmtVerificarAtividades->fetchColumn();

    if ($numeroAtividades > 0) {
        // Equipe não pode ser excluída se tiver atividades
        echo "Não é possível excluir a equipe, pois ela possui atividades associadas.";
    } else {
        // Excluir a equipe se não houver atividades associadas
        $stmtExcluirEquipe = $pdo->prepare("DELETE FROM Equipe WHERE idEquipe = ?");
        $stmtExcluirEquipe->execute([$idEquipe]);

        // Verificar se a exclusão foi bem-sucedida
        $linhasAfetadas = $stmtExcluirEquipe->rowCount();
        if ($linhasAfetadas > 0) {
            // Redirecionar para FormListarEquipe.php em caso de sucesso
            header('Location: ../visao/delete_equipe.php');
            exit();
        } else {
            echo "Erro ao excluir a equipe.";
        }
    }
} else {
    echo "ID da equipe inválido.";
}
?>
