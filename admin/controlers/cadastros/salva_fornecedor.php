<?php
require("../../config.php");
$dt = date("Y-m-d");


//UPDATE
if($id!=0){
	$query = $db->select("UPDATE fornecedores SET cpf_cnpj='$cpf_cnpj', fornecedor='$nome', estado='$estado', telefone='$numero_telefone', contato='$contato', endereco='$endereco', numero='$numero', cidade='$cidade' WHERE id='$id' LIMIT 1");

//INSERT
} else {
	$query = $db->select("INSERT INTO fornecedores (cpf_cnpj, fornecedor, estado, telefone,  endereco, numero, cidade, contato) VALUES ('$cpf_cnpj', '$nome', '$estado', '$numero_telefone', '$endereco', '$numero', '$cidade', '$contato')");
}

//SESSIONS DE AVISO//
$_SESSION['avisos-admin-sis-classe'] = 'success';
$_SESSION['avisos-admin-sis-frase'] = 'Fornecedor cadastrado com sucesso.';

//REDIRECIONA PARA A PÁGINA//
if(isset($retorno) && $retorno==1){
	header("Location: ".ADMIN_DIR."novo-fornecedor");
} else {
	header("Location: ".ADMIN_DIR."fornecedores");
}

?>