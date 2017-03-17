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
   {InserirDados($_POST['nome'], $_POST['selecionados']);}
   else  {AlterarDados($_POST['id'], $_POST['nome'], $_POST['selecionados']);}
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

   if($_GET['processo'] == 'listarclubesel')
   {
     ListarClubesSel($_GET['id']);
   }
}

function InserirDados($nome, $selecionados)
{
   include "conexao.php";
   include "executa.php";
   $sql = "INSERT INTO socio (nome) VALUES ( '" . $nome . "');";
   $ins = mysqlexecuta($id, $sql);
   $id_socio = mysql_insert_id();

   $clubes = explode(",", $selecionados);
   foreach ($clubes as $id_clube) {
     $sql = "INSERT INTO clube_socio (id_socio, id_clube) VALUES ( '" . $id_socio . "', '" . $id_clube . "' );";
     $ins = mysqlexecuta($id, $sql);
   }
}

function AlterarDados($cod, $nome, $selecionados)
{
   include "conexao.php";
   include "executa.php";
   $sql = "UPDATE socio SET nome   = '" . $nome . "' WHERE id = " . $cod . ";";
   $upd = mysqlexecuta($id, $sql);

   $sql = "DELETE from clube_socio WHERE id_socio = " . $cod . ";";
   $del = mysqlexecuta($id, $sql);

   $clubes = explode(",", $selecionados);
   foreach ($clubes as $id_clube) {
     $sql = "INSERT INTO clube_socio (id_socio, id_clube) VALUES ( '" . $cod . "', '" . $id_clube . "' );";
     $ins = mysqlexecuta($id, $sql);
   }
}

function ExcluirDados($cod)
{
   include "conexao.php";
   include "executa.php";

   $sql = "DELETE from clube_socio WHERE id_socio = " . $cod . ";";
   $del = mysqlexecuta($id, $sql);

   $sql = "DELETE from socio WHERE id = " . $cod . ";";
   $del = mysqlexecuta($id, $sql);
}

function ListarClubesSel($cod)
{
   include "conexao.php";
   include "executa.php";

   $sql = "select id_clube from clube_socio where id_socio = " . $cod;
   $con = mysqlexecuta($id, $sql);
   //Exibe as linhas encontradas na consulta

   while($row = mysql_fetch_array($con))
   {
      $vetor[] = array_map('htmlentities', $row);
   }
   //Passando vetor em forma de json
   echo json_encode($vetor);
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

   $sql = "select id, nome from socio where 1 = 1 " . $where . " ORDER BY nome LIMIT " . $ind . "," . $cont;
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