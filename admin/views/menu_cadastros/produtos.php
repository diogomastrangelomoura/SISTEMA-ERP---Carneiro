<?php require("../../includes/topo.php"); ?>


<div class="slim-pageheader">
  <a href="novo-produto"><button type="button" class="btn btn-primary  pull-right">NOVO PRODUTO</button></a>
  <h6 class="slim-pagetitle">LISTAGEM DE PRODUTOS</h6>
</div><!-- slim-pageheader -->


<form method="post" action="produtos">
<div class="section-wrapper">
          
  <label class="section-title">FILTROS DE PESQUISA</label>

      <div class="form-layout">
            <div class="row row-xs">
          
          <input type="hidden" name="pesquisa" value="1">

         
         <div class="col-lg-3">              
              <div class="input-group">

              <select id="categoria" name="categoria" class="form-control select2-show-search upper" data-placeholder="ESCOLHA A CATEGORIA" onchange="javascript:carrega_produtos(this.value);">
                <option value="" label="Categoria"></option>
                <option value="0">NENHUM</option>
                <?php

                    if(isset($categoria) && $categoria!='' && $categoria!='0'){
                      $sel = $db->select("SELECT id, categoria FROM categorias WHERE id='$categoria' LIMIT 1");
                      $row = $db->expand($sel);
                      echo '<option value="'.$row['id'].'" selected>'.$row['categoria'].'</option>';                    
                    }

                    $sel = $db->select("SELECT id, categoria FROM categorias ORDER BY categoria");
                    while($row = $db->expand($sel)){
                      echo '<option value="'.$row['id'].'">'.$row['categoria'].'</option>';
                    }
                ?>
              </select>                  
                
              </div>
         </div>





         <div class="col-lg-3">              
              <div class="input-group">

              <select id="produto" name="produto" class="form-control select2-show-search upper" >
                <option value="">ESCOLHA O PRODUTO</option>
                <option value="0">NENHUM</option>
                <?php

                    if(isset($produto) && $produto!='' && $produto!='0'){
                      $sel = $db->select("SELECT id, produto FROM produtos WHERE id='$produto' LIMIT 1");
                      $row = $db->expand($sel);
                      echo '<option value="'.$row['id'].'" selected>'.$row['produto'].'</option>';                    
                    }

                    if(isset($categoria) && $categoria!=''){
                      $sel = $db->select("SELECT id, produto FROM produtos WHERE id!='$produto' AND categoria='$categoria' ORDER BY produto");
                      while($row = $db->expand($sel)){
                        echo '<option value="'.$row['id'].'">'.$row['produto'].'</option>';                   
                      }
                    }
                ?>
              </select>                  
                
              </div>
         </div>


         <div class="col-lg-3">              
              <div class="input-group">

              <select id="categoria" name="fornecedor" class="form-control select2-show-search upper" data-placeholder="ESCOLHA O FORNECEDOR" >
                <option value="" label="Fornecedor"></option>
                <option value="0">NENHUM</option>
                <?php

                    if(isset($fornecedor) && $fornecedor!='' && $fornecedor!='0'){
                      $sel = $db->select("SELECT id, fornecedor FROM fornecedores WHERE id='$fornecedor' LIMIT 1");
                      $row = $db->expand($sel);
                      echo '<option value="'.$row['id'].'" selected>'.$row['fornecedor'].'</option>';                   
                    }

                    $sel = $db->select("SELECT id, fornecedor FROM fornecedores ORDER BY fornecedor");
                    while($row = $db->expand($sel)){
                      echo '<option value="'.$row['id'].'">'.$row['fornecedor'].'</option>';
                    }
                ?>
              </select>                  
                
              </div>
         </div>


         <div class="col-lg-3">  
          <button type="submit" class="btn btn-primary bd-0">FILTRAR</button> 
         </div> 


      </div><!-- row -->
  </div><!-- form-layout -->         
  
</div>
</form>


<div class="row row-sm">        

<?php if(isset($pesquisa)) { ?>  

<div class="col-lg-12" style="margin-top: 15px">
  <div class="card card-table">
  
              <div class="card-header">
                <h6 class="slim-card-title">LISTAGEM DE PRODUTOS</h6>
              </div>
              

              <div class="table-responsive">
                <table class="table mg-b-0 tx-13">
                  <thead>
                    <tr class="tx-10">                      
                      <th class="pd-y-5" width="40">Cód</th>
                      <th class="pd-y-5">Produto/Categoria</th>                      
                      <th class="pd-y-5">Preço Custo</th>
                      <th class="pd-y-5">Preço Venda</th>
                      <th class="pd-y-5">Estoque Atual</th>
                      <th class="pd-y-5 tx-center"></th>
                    </tr>
                  </thead>
                  <tbody>

                

                <?php       

                    $busca = "produtos.id!='0'";
                    if($categoria!='' && $categoria!='0'){$busca .= " AND produtos.categoria='$categoria'";}
                    if($produto!='' && $produto!='0'){$busca .= " AND produtos.id='$produto'";}
                    if($fornecedor!='' && $fornecedor!='0'){$busca .= " AND produtos.id_fornecedor='$fornecedor'";}


                  $sel = $db->select("SELECT produtos.*, categorias.categoria AS cat       
                FROM produtos 
                LEFT JOIN categorias on produtos.categoria=categorias.id
                WHERE $busca
                ORDER BY produtos.ativo DESC, produtos.produto");
                
                if($db->rows($sel)){
                  $x=1; 
                  while($yy = $db->expand($sel)){  
                    
                    $ativo = ativo_produto($yy['ativo']);
                    $id_produto = $yy['id'];
                    
                      

                ?>    

                    <tr>
                      
                      <td class="valign-middle"><?php echo $yy['codigo']; ?></td>
                      
                      <td>
                        <a href="javascript:void(0);" class="tx-inverse tx-14 tx-medium d-block">
                          <span class="tx-primary upper">   
                            <small class="upper">[<?php echo $yy['cat']; ?>]</small><br>
                          </span>  
                          <span class="upper"><?php echo $yy['produto']; ?></span></a>
                                                 
                      </td>
                      
                      <td class="valign-middle"> <?php echo $yy['preco_compra']; ?></td>
                      <td class="valign-middle"> <?php echo $yy['preco_venda']; ?></td>
                      <td class="valign-middle"> <?php echo $yy['estoque']; ?></td>

                      <td class="valign-middle tx-center">
                        <a href="#" data-toggle="dropdown" class="tx-gray-600 tx-24">
                          <i class="icon ion-android-more-horizontal"></i>
                        </a>
                        <div class="dropdown-menu">
                          <nav class="nav dropdown-nav">
                            <a href="produtos/edit/<?php echo $id_produto; ?>"  class="nav-link"><i class="icon ion-edit"></i> Editar Ítem</a>
                            <a href="produtos/delete/<?php echo $id_produto; ?>" class="nav-link"><i class="icon ion-android-delete"></i> Excluir Ítem</a>                            
                          </nav>
                        </div>
                      </td>
                    </tr>
                  
                  <?php
                    }
                  }

                  ?>  

                  </tbody>
                </table>
              </div><!-- table-responsive -->

                
              
             
  </div>
</div>

<?php } ?>

</div>

<?php require("../../includes/rodape.php"); ?>