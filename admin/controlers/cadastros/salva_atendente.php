<?php
require("../../config.php");

//UPDATE
if($id!=0){
	$insert = $db->select("UPDATE usuarios SET nome='$nome', usuario='$usuario', senha='$senha', vendedor='$vendedor', ativo='$ativo', comissao='$comissao' WHERE id='$id' LIMIT 1");


//INSERT
} else {
	$insert = $db->select("INSERT INTO usuarios (nome, usuario, senha, vendedor, ativo, comissao) VALUES ('$nome', '$usuario', '$senha', '$vendedor', '$ativo', '$comissao')");
}

//SESSIONS DE AVISO//
$_SESSION['avisos-admin-sis-classe'] = 'success';
$_SESSION['avisos-admin-sis-frase'] = 'Usuário cadastrado com sucesso.';


//REDIRECIONA PARA A PÁGINA//
if(isset($retorno) && $retorno==1){
	header("Location: ".ADMIN_DIR."novo-atendente");
} else {
	header("Location: ".ADMIN_DIR."atendentes");
}



?>