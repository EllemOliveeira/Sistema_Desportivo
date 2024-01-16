<?php
// Inicie a sessão no início do script
session_start();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Cadastrar Atividade</title>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card border-0 shadow-sm p-3">
                    <h4 class="card-title text-center">Cadastrar Atividade</h4>
                    <div class="card-body">
                        <!-- Adicione um bloco para mensagens de erro ou sucesso -->
                        <?php
                            // Exibir mensagens se houver alguma
                            if (isset($_SESSION['mensagem'])) {
                                echo '<div class="alert alert-' . $_SESSION['tipo_mensagem'] . '">'
                                    . $_SESSION['mensagem'] .
                                    '</div>';
                                unset($_SESSION['mensagem']);
                                unset($_SESSION['tipo_mensagem']);
                            }
                        ?>
                        
                        <form action="../controle/CtlrCadastrarAtividade.php" method="post">
                            <div class="mb-3">
                                <label for="nomeAtividade" class="form-label">Descrição da Atividade</label>
                                <input type="text" class="form-control" id="nomeAtividade" name="nomeAtividade" placeholder="Descrição da Atividade" required>
                            </div> <div class="form-text">Máximo de 255 caracteres.</div>
                            
                            <div class="mb-3">
                                <label for="descricaoAtividade" class="form-label">Nome da Atividade</label>
                                <input type="text" class="form-control" id="descricaoAtividade" name="descricaoAtividade" placeholder="Nome da Atividade" required pattern=".{1,255}">
                                <div class="form-text">Máximo de 255 caracteres.</div>
                            </div>
                            <!-- Adicione um campo hidden para passar o ID da equipe da URL ou da sessão -->
                            <input type="hidden" name="idEquipe" value="<?php echo $_GET['idEquipe'] ?? ''; ?>">

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">CADASTRAR</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
