<?php
session_start();
require './connection.php'; //inclui o arquivo que se conecta com o banco de dados
$name = mysqli_real_escape_string($con,$_POST['nicklog']); //pega o nome do usuario
$pass = MD5(mysqli_real_escape_string($con,$_POST['passlog'])); //pega a senha do usuario
if (mysqli_connect_errno()) { //verifica se ocorreu um erro
      
	echo mysqli_connect_error(); //retorna o erro 

};
$query = "SELECT * FROM jogadores WHERE Nick = '$name' AND Pass = '$pass'"; //cria a query 
$queryres = mysqli_query($con,$query) or die(mysqli_error($con)); //efetua a query
$resrow = mysqli_num_rows($queryres); //vê quantos resultados há com o nome e senha iguais aos que o usuario digitou
if($resrow < 1) { 

		echo "[ERROR] Os dados estão incorretos!"; //retorna erro
		die();

  } else {

		$_SESSION['Nick'] = $name; //guarda o nome do usuario na sessão
		echo "O login foi efetuado com sucesso!"; //retorna mensagem de sucesso

  };

?>
