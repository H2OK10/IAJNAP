<?php
session_start();
require './connection.php'; //inclui o arquivo que se conecta com o banco de dados
$name = mysqli_real_escape_string($con,$_POST['nickcad']); //recebe o nome  do usuario
$pass = MD5(mysqli_real_escape_string($con,$_POST['passcad'])); //recebe a senha do usuario
if (mysqli_connect_errno()) { //verifica se ocorreu um erro

	echo mysqli_connect_error(); //caso ocorra um erro, retorna o erro

};
$query = "SELECT Nick FROM jogadores WHERE Nick = '$name'"; //cria a query
$queryres = mysqli_query($con,$query); //efetua a query
$resarray = mysqli_fetch_assoc($queryres);
$arrayname = $resarray['Nick'];
if(($name == "" || $name == null) || ($pass == "" || $pass == null)) { //verifica se há algum campo vazio

    echo "[ERROR]Os dados nao podem estar vazios!"; //retorna erro caso algum campo esteja vazio                  
     
   } else {
	   
	if($arrayname == $name) { //verifica se o nome já existe

	   echo "[ERROR]Esse nome já existe!"; //retorna erro caso o nome já exista
	   die();

}  else{

	    $query2 = "INSERT INTO jogadores (Nick,Pass) VALUES ('$name','$pass')"; //cria uma query para inserir os dados no banco de dados
	    $queryres2 = mysqli_query($con,$query2); //efetua a query

    if($queryres2) { //verifica se a query foi bem-sucedida

	    $_SESSION['Nick'] = $name; //guarda o nome do usuario na sessão
	    echo "Conta criada com sucesso!!"; //retorna mensagem de sucesso

    } else {

    	echo "[ERROR]Ocorreu um erro inesperado!"; //retorna uma mensagem de erro

    }

}
};
   
?>
