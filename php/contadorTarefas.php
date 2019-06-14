<?php
    header('Access-Control-Allow-Origin: *');
    header("Content-Type: application/json; charset=UTF-8");

    $id_usuario = $_GET["id_usuario"];

    $host = "localhost";
    $db   = "todo";
    $user = "root";
    $pass = "usbw";
    // conecta ao banco de dados
    $conn = new mysqli($host, $user, $pass, $db); 
    $conn->set_charset("utf8");

    if ($conn->connect_error) {
        die("Falha na conexao: " . $conn->connect_error);
    } 

    // cria a instru��o SQL que vai selecionar os dados
    $sql = "SELECT COUNT(*) as contador FROM tarefas WHERE id_usuario=$id_usuario";
    // executa a query
    $result = $conn->query($sql);
    
    $outp = array();
    $outp = $result->fetch_all(MYSQLI_ASSOC);

    echo json_encode($outp);
    
    $conn->close();
    
?>