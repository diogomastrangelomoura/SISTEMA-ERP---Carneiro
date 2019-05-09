<?php 
require("../../admin/class/class.db.php");
require("../../admin/class/class.seguranca.php");
require("../../includes/verifica_session.php");

$query = $db->select("UPDATE clientes SET nome='$nome', telefone='$telefone', celular='$celular', endereco='$endereco', numero='$numero', bairro='$bairro', cidade='$cidade', estado='$estado' WHERE id='$id' LIMIT 1");


echo 1;


?>	