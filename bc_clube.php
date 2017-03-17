<?php
ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);
if (!ISSET($_POST['formulario'])) {$form = 0;} else {$form = $_POST['formulario'];}
if($form == '1')
{
   CarregaDados($_POST['nome'], '', '1');
}
else if($form == '2')
{
   if ($_POST['id'] == '')
   {InserirDados($_POST['nome']);}
   else  {AlterarDados($_POST['id'], $_POST['nome']);}
   echo 'ok';
}
else
{
   if($_GET['processo'] == 'excluir')
   {
      try
      {ExcluirDados($_GET['cod']);}
      catch(Exception$e)       {echo $e;}
      echo 'ok';
   }

   if($_GET['processo'] == 'listar')
   {
    if (ISSET($_GET['id'])) {$cons = $_GET['id'];} else {$cons = '';}
    CarregaDados('', $cons, '1');
   }
}

function InserirDados($nome)
{
   include "conexao.php";
   include "executa.php";
   $sql = "INSERT INTO clube (nome) VALUES ( '" . $nome . "');";

   $ins = mysqlexecuta($id, $sql);
}

function AlterarDados($cod, $nome)
{
   include "conexao.php";
   include "executa.php";
   $sql = "UPDATE clube SET nome   = '" . $nome . "' WHERE id = " . $cod . ";";
   $upd = mysqlexecuta($id, $sql);
}

function ExcluirDados($cod)
{
   include "conexao.php";
   include "executa.php";
   $sql = "DELETE from clube WHERE id = " . $cod . ";";
   $del = mysqlexecuta($id, $sql);
}

function CarregaDados($consulta, $cod, $page)
{
   include "conexao.php";
   include "executa.php";
   $where = "";
   $ind = (($page - 1) * 20);

   $cont = 20;
   if($consulta <> '')
   {
      $where .= " and nome like '%" . $consulta . "%'";
   }

   if ($cod <> '')
   {
       $where .= " and id = " . $cod;
   }

   $sql = "select id, nome from clube where 1 = 1 " . $where . " ORDER BY nome LIMIT " . $ind . "," . $cont;
   $con = mysqlexecuta($id, $sql);
   //Exibe as linhas encontradas na consulta

   while($row = mysql_fetch_array($con))
   {
      $vetor[] = array_map('htmlentities', $row);
   }
   //Passando vetor em forma de json
   echo json_encode($vetor);

}

?>