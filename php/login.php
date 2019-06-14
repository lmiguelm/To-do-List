<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json;
     charset=UTF-8');

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

    $sql = "SELECT * FROM usuarios WHERE 
        usuario=\"$usuario\" AND senha=\"$senha\"";
    
    $result = $conn->query($sql);

    $nome = "";

    if($result->num_rows > 0){
        $row = $result->fetch_object();
        setcookie("id_usuario", $row->id);
        setcookie("nome_usuario", $row->usuario);
        setcookie("senha_usuario", $row->senha);
        setcookie("nome", $row->nome);
        header("Location: todo.php");
    }else{
        header("Location: ../login.html");
    }

    $conn->close();

?>