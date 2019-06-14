<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json;
     charset=UTF-8');

    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $usuario = $_POST["usuario"];
    $senha = $_POST["senha"];

    $host = "localhost";
    $db = "todo";
    $user = "root";
    $pass = "usbw";

    $conn = new mysqli($host, $user, $pass, $db);
    $conn->set_charset("utf8");

    if($conn->connect_error){
        die("Falha na conexão: " .$conn->connect_error);
    }

    $sql = "INSERT INTO usuarios(usuario, senha, nome, email) VALUES('$usuario', '$senha', '$nome', '$email')";
    
    $conn->query($sql);

    $conn->close();
    header("location: ../login.html");

?>