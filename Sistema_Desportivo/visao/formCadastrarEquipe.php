<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Cadastrar Equipe</title>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card border-0 shadow-sm p-3">
                    <h4 class="card-title text-center">Cadastrar Equipe</h4>
                    <div class="card-body">
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
                        <form action="../controle/CtlrCadastrar.php" method="post">
                            <div class="mb-3">
                                <!-- Adicione um campo oculto para armazenar o ID do técnico -->
                                <input type="hidden" name="idTecnico" value="<?php echo $_SESSION['idTecnico']; ?>">
                                <label for="nomeEquipe" class="form-label">Nome da Equipe</label>
                                <input type="text" class="form-control" id="nomeEquipe" name="nomeEquipe" placeholder="Nome da Equipe" required>
                            </div>
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
