<?php
ob_start();
@session_start();
unset($_SESSION['user_sisconnection_adm']);
header("location: acesso");

?>