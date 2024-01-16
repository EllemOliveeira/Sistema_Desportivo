<?php
session_start();

require '../dados/conexao.php';

// Verifica se o usuário está autenticado e se a chave "idTecnico" está definida na sessão
if (!isset($_SESSION["nome"]) || !isset($_SESSION["idTecnico"])) {
    header("Location: ../visao/formAutenticar.php");
    exit;
}

// Use uma consulta SELECT para listar as equipes do técnico específico
$idTecnico = $_SESSION["idTecnico"];
$stmt = $pdo->prepare('SELECT * FROM Equipe WHERE idTecnico = ?');
// Execute a consulta com o ID do técnico
$stmt->execute([$idTecnico]);
// Obtenha os resultados
$resultados = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- restante do código -->
</head>
<body>
    <!-- restante do código -->
</body>
</html>
