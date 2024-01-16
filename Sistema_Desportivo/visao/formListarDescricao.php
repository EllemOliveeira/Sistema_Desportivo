<?php
require '../dados/conexao.php';

if (isset($_GET['idAtividade']) && is_numeric($_GET['idAtividade'])) {
    $idAtividade = $_GET['idAtividade'];

    // Consultar informações da atividade
    $stmt = $pdo->prepare('SELECT * FROM atividade WHERE idAtividade = ?');
    $stmt->bindParam(1, $idAtividade);
    $stmt->execute();
    $atividade = $stmt->fetch();

    if (!$atividade) {
        echo "Atividade não encontrada.";
        exit();
    }

    // Exibir detalhes da atividade
    echo "<h2>Detalhes da Atividade</h2>";
    echo "<p>Número: " . $atividade['idAtividade'] . "</p>";
    echo "<p>Descrição: " . $atividade['descricaoAtividade'] . "</p>";
    // Adicione mais informações conforme necessário
} else {
    echo "ID da atividade inválido.";
}
?>
