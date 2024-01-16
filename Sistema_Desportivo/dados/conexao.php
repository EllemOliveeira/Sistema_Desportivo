<?php
// Informações de conexão com o banco de dados
    try {

        $pdo = new PDO('mysql:host=localhost;dbname=trabalho_db', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
    } catch(PDOException $e) {
        echo 'Erro: ' . $e->getMessage();
    }


?>