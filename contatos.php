<?php
    include_once 'conectaBD.php';

    $sql = "SELECT * FROM tbcontatos";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $contatos = $stmt->fetchAll();
    $json = json_encode($contatos);
    echo $json;
?>