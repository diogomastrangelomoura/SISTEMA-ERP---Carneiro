<?php

function nomes_produtos_busca($str){

	$str = preg_replace('/[áàãâä]/ui', 'a', $str);
    $str = preg_replace('/[éèêë]/ui', 'e', $str);
    $str = preg_replace('/[íìîï]/ui', 'i', $str);
    $str = preg_replace('/[óòõôö]/ui', 'o', $str);
    $str = preg_replace('/[úùûü]/ui', 'u', $str);
    $str = preg_replace('/[ç]/ui', 'c', $str);
    $str = strtolower($str);
		
	return $str;		


}




function impostos_fiscais_produto($tipo,$produto,$categoria,$imposto_lei='',$valor_produto=0){

	$db = new DB();	
	$sql = $db->select("SELECT ncm, cfop, cst, csosn FROM produtos WHERE id='$produto' LIMIT 1");
	$dados_impostos_produtos = $db->expand($sql);

	
	if($tipo=='ncm'){

		if(empty($dados_impostos_produtos['ncm'])){
			
			$sql = $db->select("SELECT ncm_categoria FROM categorias WHERE id='$categoria' LIMIT 1");
			$dados_impostos_produtos = $db->expand($sql);

				if(empty($dados_impostos_produtos['ncm_categoria'])){

					$sql = $db->select("SELECT ncm_sistema FROM fiscal LIMIT 1");
					$dados_impostos_produtos = $db->expand($sql);	
					$retorno =  $dados_impostos_produtos['ncm_sistema'];

				} else {
					$retorno =  $dados_impostos_produtos['ncm_categoria'];
				}

					
		} else {
			$retorno =  $dados_impostos_produtos['ncm'];
		}

		$conta = strlen($retorno);
		
		if($conta<8){
			$falta = (8-$conta);
			$x=1;
			$add='';
			while($x<=$falta){
				$add .= '0';
				$x++;
			}
			$retorno = $add.$retorno;
		}

		if($conta>8){			
			$retorno = substr($retorno, 0,8);
		}
				

	}	



	if($tipo=='cst'){

		if(empty($dados_impostos_produtos['cst'])){
			
			$sql = $db->select("SELECT cst_categoria FROM categorias WHERE id='$categoria' LIMIT 1");
			$dados_impostos_produtos = $db->expand($sql);

				if(empty($dados_impostos_produtos['cst_categoria'])){

					$sql = $db->select("SELECT cst_sistema FROM fiscal LIMIT 1");
					$dados_impostos_produtos = $db->expand($sql);	
					$retorno =  $dados_impostos_produtos['cst_sistema'];

				} else {
					$retorno =  $dados_impostos_produtos['cst_categoria'];
				}

					
		} else {
			$retorno =  $dados_impostos_produtos['cst'];
		}
				

	}	


	if($tipo=='cfop'){

		if(empty($dados_impostos_produtos['cfop'])){
			
			$sql = $db->select("SELECT cfop_categoria FROM categorias WHERE id='$categoria' LIMIT 1");
			$dados_impostos_produtos = $db->expand($sql);

				if(empty($dados_impostos_produtos['cfop_categoria'])){

					$sql = $db->select("SELECT cfop_sistema FROM fiscal LIMIT 1");
					$dados_impostos_produtos = $db->expand($sql);	
					$retorno =  $dados_impostos_produtos['cfop_sistema'];

				} else {
					$retorno =  $dados_impostos_produtos['cfop_categoria'];
				}

					
		} else {
			$retorno =  $dados_impostos_produtos['cfop'];
		}
				

	}	



	if($tipo=='csosn'){

		if(empty($dados_impostos_produtos['csosn'])){
			
			$sql = $db->select("SELECT csosn_categoria FROM categorias WHERE id='$categoria' LIMIT 1");
			$dados_impostos_produtos = $db->expand($sql);

				if(empty($dados_impostos_produtos['csosn_categoria'])){

					$sql = $db->select("SELECT csosn_sistema FROM fiscal LIMIT 1");
					$dados_impostos_produtos = $db->expand($sql);	
					$retorno =  $dados_impostos_produtos['csosn_sistema'];

				} else {
					$retorno =  $dados_impostos_produtos['csosn_categoria'];
				}

					
		} else {
			$retorno =  $dados_impostos_produtos['csosn'];
		}
				

	}	



	if($imposto_lei!=''){

		$sql = $db->select("SELECT imposto_nacional_federal, imposto_estadual FROM fiscal_ncm WHERE codigo='$retorno' LIMIT 1");
		if($db->rows($sql)){
			$dados_impostos_produtos = $db->expand($sql);
			$soma = ($dados_impostos_produtos['imposto_nacional_federal']+$dados_impostos_produtos['imposto_estadual']);

			if($valor_produto!=0){
				$retorno = (($valor_produto*$soma)/100);
				$retorno = number_format($retorno,2,".",",");
				$retorno = str_replace(',', '', $retorno);
			}

		} else {
			$retorno = 0;
		}
		

	}

	return $retorno;


}




?>