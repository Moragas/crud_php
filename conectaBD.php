<?php
    $endereco = "localhost";
    $porta = "5432";
    $banco = "agenda_contatos";
    $usuario = "postgres";
    $senha = "123456";

    try{
        $pdo = new PDO("pgsql:host=$endereco;port=5432;dbname=$banco", $usuario, $senha, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    } catch(PDOException $e){
        echo "Erro ao conectar ao banco de dados";
        die($e->getMessage());
    }
?>