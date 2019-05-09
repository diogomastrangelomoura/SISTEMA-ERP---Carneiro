<?php
require("../../admin/class/class.db.php");
require("../../admin/class/class.seguranca.php");
require("../../includes/verifica_session.php");

$dt = date("Y-m-d");
$hora = date("H:i:s");


$abre = $db->select("INSERT INTO caixa (id_usuario, data_abertura, hora_abertura, valor_inicial) VALUES ('$id_usuario', '$dt', '$hora', '$valor_inicial')");
$id_cx_original = $db->last_id($abre);

echo 1;

?>