<?php
include("../admin/class/class.db.php"); 
include("../admin/class/class.seguranca.php"); 

$id_logado = $_SESSION['usuario_sistema_sis_erp'];


unset($_SESSION['usuario_sistema_sis_erp']);
header("location: home");

?>