<?php
$dbname="dataclick_test"; // Indique o nome do banco de dados que será aberto
$usuario="root"; // Indique o nome do usuário que tem acesso
$password="12345"; // Indique a senha do usuário

//1º passo - Conecta ao servidor MySQL
if(!($id = mysql_connect("localhost",$usuario,$password))) {
   echo "Não foi possível estabelecer uma conexão com o gerenciador MySQL. Favor Contactar o Administrador.";
   exit;
}
//2º passo - Seleciona o Banco de Dados
if(!($con=mysql_select_db($dbname,$id))) {
   echo "Não foi possível estabelecer uma conexão com o gerenciador MySQL. Favor Contactar o Administrador.";
   exit;
}

mysql_query("SET NAMES utf8");
mysql_query("SET CHARACTER_SET utf8");
?>