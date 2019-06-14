<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json;charset=UTF-8');

    $id = $_POST["id"];
    $texto=$_POST["descricao"];
    $data=$_POST["data"];
    $status=$_POST["status"];

    if(isset($_POST["id_usuario"])){
        $id_usuario=$_POST["id_usuario"];    
    }
    
    $dataFormat=$date=date("Y-m-d H:i:s", strtotime(str_replace("/", "-", $data)));

    $host = "localhost";
    $db = "todo";
    $user = "root";
    $pass = "usbw";

    $conn = new mysqli($host, $user, $pass, $db);
    $conn->set_charset("utf8");

    if($conn->connect_error){
        die("Falha na conexão: " .$conn->connect_error);
    }

    if($id==0){
        $sql="INSERT INTO tarefas(texto, status, data, id_usuario) VALUES('$texto', $status, '$dataFormat', $id_usuario)";
    }
    else{
        $sql="UPDATE tarefas SET texto='$texto', status=$status, data='$dataFormat' WHERE id=$id";
    }

    $conn->query($sql);
    $conn->close();

    header("location: todo.php");
?>