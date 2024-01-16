<?php
require '../dados/conexao.php';
session_start(); // Inicie a sessão no início do script

if (isset($_GET['idAtividade']) && is_numeric($_GET['idAtividade'])) {
    $idAtividade = $_GET['idAtividade'];

    // Excluir a atividade
    $stmtExcluirAtividade = $pdo->prepare("DELETE FROM Atividade WHERE idAtividade = ?");
    $stmtExcluirAtividade->execute([$idAtividade]);

    // Verificar se a exclusão foi bem-sucedida
    $linhasAfetadas = $stmtExcluirAtividade->rowCount();
    if ($linhasAfetadas > 0) {
        // Configurar mensagem de sucesso
        $_SESSION['mensagem'] = 'Atividade excluída com sucesso';
        $_SESSION['tipo_mensagem'] = 'success';

        // Redirecionar para a página que lista as atividades em caso de sucesso
        header('Location: ../visao/delete_success.php');
        exit();
    } else {
        echo "Erro ao excluir a atividade.";
    }
} else {
    echo "ID da atividade inválido.";
}
?>
