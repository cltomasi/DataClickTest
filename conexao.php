<?php
$dbname="dataclick_test"; // Indique o nome do banco de dados que ser� aberto
$usuario="root"; // Indique o nome do usu�rio que tem acesso
$password="12345"; // Indique a senha do usu�rio

//1� passo - Conecta ao servidor MySQL
if(!($id = mysql_connect("localhost",$usuario,$password))) {
   echo "N�o foi poss�vel estabelecer uma conex�o com o gerenciador MySQL. Favor Contactar o Administrador.";
   exit;
}
//2� passo - Seleciona o Banco de Dados
if(!($con=mysql_select_db($dbname,$id))) {
   echo "N�o foi poss�vel estabelecer uma conex�o com o gerenciador MySQL. Favor Contactar o Administrador.";
   exit;
}

mysql_query("SET NAMES utf8");
mysql_query("SET CHARACTER_SET utf8");
?>