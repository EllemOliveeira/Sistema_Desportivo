<?php
require '../dados/conexao.php';
session_start();

$email = $_POST["email"];
$senha = $_POST["senha"];

// Use uma consulta preparada com placeholders para maior segurança
$stmt = $pdo->prepare('SELECT idTecnico, nome FROM Tecnico WHERE email = ? AND senha = ?');

// Execute a consulta com os valores diretamente no execute
$stmt->execute([$email, $senha]);

// Obtenha o primeiro resultado (se existir)
$tecnico = $stmt->fetch(PDO::FETCH_ASSOC);

if ($tecnico) {
    // Se as credenciais estiverem corretas, armazene as informações na sessão e redirecione
    $_SESSION["nome"] = $tecnico['nome'];
    $_SESSION["idTecnico"] = $tecnico['idTecnico'];
    header("Location: ../visao/formListarEquipe.php");
    exit;
} else {
    // Se as credenciais estiverem incorretas, redirecione para a página de login com uma mensagem de erro
    $_SESSION["mensagemErro"] = "Credenciais inválidas. Tente novamente.";
    header("Location: ../visao/formAutenticar.php");
    exit;
}
?>
