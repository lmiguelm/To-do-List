<?php
	
	if(isset($_COOKIE["nome_usuario"]))
	{
		$nome_usuario=$_COOKIE["nome_usuario"];
	}
	if(isset($_COOKIE["senha_usuario"]))
	{
		$senha_usuario=$_COOKIE["senha_usuario"];
	}

	if(empty($nome_usuario) or empty($senha_usuario))
	{
		setcookie("id_usuario", "");
		setcookie("nome_usuario", "");
		setcookie("senha_usuario", "");
		setcookie("nome", "");

		header("location: ../login.html");
		exit;
	}
?>