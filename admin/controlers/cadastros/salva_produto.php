<?php
require("../../config.php");
$Images = new UploadArquivoSis(); 

//UPDATE
if($id!=0){
	
		
	$grava = $db->select("UPDATE produtos SET estoque_minimo='$estoque_minimo', csosn='$csosn', ncm='$ncm', cst='$cst', cfop='$cfop', produto='$produto', categoria='$categoria', codigo='$codigo', ativo='$ativo', id_fornecedor='$fornecedor', estoque='$estoque', preco_venda='$preco_venda', preco_compra='$preco_compra', margem_lucro='$margem_lucro', fabricante='$fabricante' WHERE id='$id' LIMIT 1");	



//INSERT
} else {
	


	$grava = $db->select("INSERT INTO produtos (estoque_minimo, csosn, ncm, cst, cfop, produto, categoria, codigo, ativo, id_fornecedor, estoque, preco_venda, preco_compra, margem_lucro, fabricante) VALUES ('$estoque_minimo', '$csosn', '$ncm', '$cst', '$cfop', '$produto', '$categoria', '$codigo', '$ativo', '$fornecedor', '$estoque', '$preco_venda', '$preco_compra', '$margem_lucro', '$fabricante')");	

	


}


//SESSIONS DE AVISO//
$_SESSION['avisos-admin-sis-classe'] = 'success';
$_SESSION['avisos-admin-sis-frase'] = 'Produto cadastrado com sucesso.';


//REDIRECIONA PARA A PÁGINA//
if(isset($retorno) && $retorno==1){
	header("Location: ".ADMIN_DIR."novo-produto");
} else {
	header("Location: ".ADMIN_DIR."produtos-categoria/$categoria");
}



?>