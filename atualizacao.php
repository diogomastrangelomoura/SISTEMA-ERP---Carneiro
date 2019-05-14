<?php
	require_once("admin/class/class.db.php");
	require_once("admin/class/class.seguranca.php");

	
	//CRIA CAMPOS//
	$sql = $db->select("ALTER TABLE produtos ADD estoque_minimo INT(10) NOT NULL",0);
	$sql = $db->select("ALTER TABLE contas_clientes ADD parcelas INT(10) NOT NULL",0);
	$sql = $db->select("ALTER TABLE arquivos_imprimir ADD usuario INT(10) NOT NULL",0);
	


	//RODA O SCRIPT//
	if(isset($instalacao)){
		$nome_do_arquivo = "../../atualizacoes/atualizacoes.sql"; 	
	} else {
		$nome_do_arquivo = "atualizacoes/atualizacoes.sql"; 	
	}
	
	if(file_exists($nome_do_arquivo)){			
		$arquivo = Array();
		$arquivo = file($nome_do_arquivo);  
		$prepara = "";  
		foreach($arquivo as $v)$prepara.=$v; 
		$sql = explode(";",$prepara); 
		foreach($sql as $v) $db->select($v,0);		
	}
	

	////TABELA DE NCM
	$sql = $db->select("SELECT id FROM fiscal_ncm LIMIT 1",0);
	if(!$db->rows($sql)){
		
		//RODA O SCRIPT//
		if(isset($instalacao)){			
			$nome_do_arquivo = "../../atualizacoes/tabela_ncm.sql"; 
		} else {
			$nome_do_arquivo = "atualizacoes/tabela_ncm.sql"; 
		}	
		
		if(file_exists($nome_do_arquivo)){	
			$arquivo = Array();
			$arquivo = file($nome_do_arquivo);  
			$prepara = "";  
			foreach($arquivo as $v)$prepara.=$v; 
			$sql = explode(";",$prepara); 
			foreach($sql as $v) $db->select($v,0);				
		}	
	} 


	



?>	
