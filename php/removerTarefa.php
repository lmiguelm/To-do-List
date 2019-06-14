<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json;charset=UTF-8');

    $host = "localhost";
    $db = "todo";
    $user = "root";
    $pass = "usbw";
    
    $id = $_POST["id"];

    $conn = new mysqli($host, $user, $pass, $db);
    $conn->set_charset("utf8");

    if($conn->connect_error){
        die("Falha na conexão: " .$conn->connect_error);
    }
    
    $sql="DELETE FROM tarefas WHERE id=$id";

    $conn->query($sql);
    $conn->close();
?>