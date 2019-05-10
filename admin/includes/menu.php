  <?php

      $avisos = new AvisosLoja();

   
      

?>

<div class="slim-navbar">
      <div class="container">
        <ul class="nav">
          

          <li class="nav-item with-sub active">
            <a class="nav-link" href="javascript:void(0);">
              <img src="img/logo-menu.png">
              <span>SIS E-FOOD</span>
            </a>
            <div class="sub-item">
              <ul>
                <li><a href="home">VENDAS ANALÍTICO</a></li>                

                <li class="sub-with-sub">
                  <a href="javascript:void(0);">DESPESAS</a>
                  <ul>
                    <li><a href="despesas-categorias">CATEGORIAS</a></li>
                    <li><a href="despesas-nova">NOVA DESPESA</a></li>                    
                    <li><a href="despesas-relatorio">RELATÓRIOS</a></li>                    
                  </ul>
                </li> 

              </ul>
            </div><!-- dropdown-menu -->
          </li>


          <li class="nav-item with-sub">
            <a class="nav-link" href="javascript:void(0);">
              <i class="icon ion-ios-filing-outline"></i>
              <span>CADASTROS</span>
            </a>
            <div class="sub-item">
              <ul>                                
                
                <li class="sub-with-sub">
                  <a href="javascript:void(0);">USUÁRIOS</a>
                  <ul>
                    <li><a href="atendentes">LISTAGEM</a></li>
                    <li><a href="novo-atendente">NOVO USUÁRIO</a></li>                    
                  </ul>
                </li>	

                <li class="sub-with-sub">
                  <a href="javascript:void(0);">CATEGORIAS</a>
                  <ul>
                    <li><a href="categorias">LISTAGEM</a></li>
                    <li><a href="nova-categoria">NOVA CATEGORIA</a></li>                    
                  </ul>
                </li>


                <li class="sub-with-sub">
                  <a href="javascript:void(0);">CLIENTES</a>
                  <ul>
                    <li><a href="clientes">LISTAGEM</a></li>
                    <li><a href="novo-cliente">NOVO CLIENTE</a></li>                    
                  </ul>
                </li>



                <li class="sub-with-sub">
                  <a href="javascript:void(0);">PRODUTOS</a>
                  <ul>                    
                    <li><a href="novo-produto">NOVO PRODUTO</a></li>            
                    <li><a href="produtos">LISTAR TODOS</a></li>                                        
                    <?php
                    	$sel = $db->select("SELECT id, categoria FROM categorias WHERE ativo='1' ORDER BY categoria");
                    	while($row = $db->expand($sel)){
                    		echo '<li><a href="produtos-categoria/'.$row['id'].'" class="upper">LISTAR '.$row['categoria'].'</a></li>';
                    	}
                    ?>
                  </ul>
                </li>


                <li class="sub-with-sub">
                  <a href="javascript:void(0);">FORNECEDORES</a>
                  <ul>
                    <li><a href="fornecedores">LISTAGEM</a></li>
                    <li><a href="novo-fornecedor">NOVO FORNECEDOR</a></li>                    
                  </ul>
                </li> 

               
                               
              </ul>
            </div><!-- dropdown-menu -->
          </li>


          <li class="nav-item with-sub">
            <a class="nav-link" href="javascript:void(0);">
              <i class="icon ion-ios-book-outline"></i>
              <span>RELATÓRIOS</span>
            </a>
            <div class="sub-item">
              <ul>                
                <li style="display: none;"><a href="relatorio-clientes" target="_blank">CLIENTES CADASTRADOS</a></li>
                <li style="display: none;"><a href="relatorio-produtos-vendidos">PRODUTOS VENDIDOS</a></li>
                <li style="display: none;"><a href="relatorio-vendas-consolidadas">VENDAS CONSOLIDADAS</a></li>
                               
              </ul>
            </div><!-- dropdown-menu -->
          </li>
          

          <li class="nav-item with-sub">
            <a class="nav-link" href="javascript:void(0);" data-toggle="dropdown">
              <i class="icon ion-ios-gear-outline"></i>
              <span>CONFIGURAÇÕES</span>
            </a>
            <div class="sub-item">
              <ul>                
                <li><a href="modulos-fiscal">MÓDULO FISCAL</a></li>                                
                <li><a href="impressao">IMPRESSÃO</a></li>                                
                <li><a href="gerais">GERAIS</a></li>                
                <li><a href="formas-pagamento">FORMAS DE PAGAMENTO</a></li>                                
              </ul>
            </div><!-- dropdown-menu -->
          </li>
         
          

          <li class="nav-item with-sub">
            <a class="nav-link" href="javascript:void(0);">
              <i class="icon ion-ios-people"></i>
              <span><?php echo $nome_user; ?></span>
              <?php
                  $mensagens = $MensagensSistema->MensagensDesenvolvedor();
                  if($mensagens==1){
                    echo '<span class="square-8"></span>';
                  }
              ?>
            </a>
            <div class="sub-item">
              <ul>
                <li><a href="mensagens"><i class="icon ion-ios-bell-outline"></i>&nbsp;&nbsp;MENSAGENS</a> </li>                                
                <li><a href="profile"><i class="icon ion-compose"></i>&nbsp;&nbsp;EDITAR DADOS</a></li>                
                <li><a href="logout"><i class="icon ion-forward"></i>&nbsp;&nbsp;LOGOUT</a></li>                
              </ul>
            </div><!-- dropdown-menu -->
          </li>
         

        </ul>
      </div><!-- container -->
    </div><!-- slim-navbar -->


    <?php
      $mensagens = $MensagensSistema->MensagensImportantesDesenvolvedor();
      if($mensagens==1){     
        echo '<a href="mensagens">';   
          echo '<div class="alert alert-warning avisos-desenvolvedor">';
            echo '<div class="container">';
              echo '<i class="fa fa-exclamation-triangle fa-fw" aria-hidden="true"></i>&nbsp;';
              echo 'Existem mensagens importantes para seu estabelecimento. Clique aqui para ver mais.';
            echo '</div>';  
          echo '</div>';
        echo '</a>';  
      } 
    ?>


    <?php
      
      $avisos->Avisos(); 

    ?>
