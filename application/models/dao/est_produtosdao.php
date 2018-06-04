<?php
/* Classe(DAO): Produtos
* Autor: Anderson Farias
* Última atualização: 30/06/2015
* Contato: andersonjfarias@yahoo.com.br
*/

class Est_produtosDao extends CI_Model {
    

    public function connect(){
        $this->load->database();
    }

    public function disconnect(){
        $this->db->close();
    }


    public function cadastrar($objProduto){
        $sucess = $this->db->insert("est_produtos",$objProduto->toArray());
        if(!$sucess){
            throw new Exception($this->db->_error_message(),$this->db->_error_number());
        }

        $cod_produto = $this->db->insert_id();

        return $cod_produto;
    }

     public function verificar_qtd($id_produto) {

      
      $query = $this->db->query("select e.id_produto,
(select sum(IFNULL(qtd_mov,0))-sum(IFNULL(qtd_mov_saida, 0)) as saldo from est_movimentacao 
where id_produto = ".$id_produto." and deletado=0) as saldo
 from est_movimentacao e        
        where e.id_produto = ".$id_produto."  group by e.id_produto;");

        $result = $query->result_array();

        
        if(isset($result[0]['saldo'])){
         return $result[0]['saldo'];
        }
        else {
          return 0;
        }
        
     }


    
    

    //PESQUISA DE PRODUTOS E SERVIÇOS
     public function filtro($dados) {

        $id_categoria = $dados['id_categoria'];
        $codigo = $dados['codigo'];
        $descricao = $dados['descricao'];
      
       
        $param = "";
           
         /*if ($data_de != NULL && $data_ate != NULL):
                 $objDateFormat = $this->DateFormat;
                 $data_de = $objDateFormat->date_mysql($data_de);
                 $data_ate = $objDateFormat->date_mysql($data_ate);
                 $param .= "and DATE(c.data) BETWEEN '$data_de' AND '$data_ate'"; 
         
         endif;*/
         

        if ($dados["id_categoria"] != NULL):
              $param .= " and p.id_categoria = $id_categoria";
        endif;

     
        if ($dados["codigo"] != NULL):
              $param .= " and p.codigo = $codigo";
        endif; 

        if ($dados["descricao"] != NULL):
            $param .= " and p.descricao LIKE '%$descricao%' ";
           // $this->db->like("p.descricao", $descricao);
        endif;
         

         $query = $this->db->query("select p.tipo,p.id_produto,p.codigo,p.descricao as produto,p.valor_venda,p.valor_custo,p.qtd_minima,
 cat.categoria as categoria,u.sigla as unidade, 
(select sum(IFNULL(qtd_mov,0))-sum(IFNULL(qtd_mov_saida, 0)) as saldo from est_movimentacao where id_produto = m.id_produto and deletado = 0) as saldo
 from est_produtos p
        left join est_movimentacao m
        on(p.id_produto = m.id_produto)
        left join est_categorias cat
        on(p.id_categoria = cat.id_categoria)
        left join est_un_medida u
        on(p.id_unidade = u.id_unidade)
        where p.tipo = 1 and p.deletado = 0 ".$param."
        group by p.id_produto 
        order by p.descricao");

       
       /*$query = $this->db->query("select p.tipo,p.id_produto,p.codigo,p.descricao as produto,p.valor_venda,p.valor_custo,p.qtd_minima,f.nome_fantasia as fornecedor, cat.categoria as categoria,u.sigla as unidade, (select sum(qtd_mov) from est_movimentacao where tipo_movimentacao = 1 
    and id_produto = p.id_produto and deletado = 0) as 'Entrada',
       (select sum(qtd_mov) from est_movimentacao where tipo_movimentacao = 2 and id_produto = p.id_produto and deletado = 0) as 'Saida' from est_produtos p
        left join est_movimentacao m
        on(p.id_produto = m.id_produto)
        left join com_fornecedores f
        on(p.id_fornecedor = f.id_fornecedor)
        left join est_categorias cat
        on(p.id_categoria = cat.id_categoria)
        left join est_un_medida u
        on(p.id_unidade = u.id_unidade)
        where p.tipo = 1 and p.deletado = 0 ".$param."
         
        group by p.id_produto 
        order by p.descricao");*/


       
       $result = $query->result_array();

      

       
        return $result;
        
     }


     //PESQUISA DE PRODUTOS E SERVIÇOS
     public function pesquisa_geral($dados) {

        $id_categoria = $dados['id_categoria'];
        $codigo = $dados['codigo'];
        $descricao = $dados['descricao'];
        $id_fornecedor = $dados['id_fornecedor'];
       
        $param = "";
           
              

        if ($dados["id_categoria"] != NULL):
              $param .= " and p.id_categoria = $id_categoria";
        endif;

        if ($dados["id_fornecedor"] != NULL):
              $param .= " and p.id_fornecedor = $id_fornecedor";
        endif;

        if ($dados["codigo"] != NULL):
              $param .= " and p.codigo = $codigo";
        endif; 

        if ($dados["descricao"] != NULL):
            $param .= " and p.descricao LIKE '%$descricao%' ";
           // $this->db->like("p.descricao", $descricao);
        endif;
         

       
       $query = $this->db->query("select p.tipo,p.id_produto,p.codigo,p.descricao as produto,p.valor_venda,p.qtd_minima,f.nome_fantasia as fornecedor, cat.categoria as categoria,u.sigla as unidade, (select sum(qtd_mov) from est_movimentacao where tipo_movimentacao = 1 
    and id_produto = p.id_produto) as 'Entrada',
       (select sum(qtd_mov) from est_movimentacao where tipo_movimentacao = 2 and id_produto = p.id_produto) as 'Saida' from est_produtos p
        left join est_movimentacao m
        on(p.id_produto = m.id_produto)
        left join com_fornecedores f
        on(p.id_fornecedor = f.id_fornecedor)
        left join est_categorias cat
        on(p.id_categoria = cat.id_categoria)
        left join est_un_medida u
        on(p.id_unidade = u.id_unidade)
        where p.deletado = 0 and p.habilitado_venda = 1 ".$param."
         
        group by p.id_produto 
        order by p.descricao");
       
       $result = $query->result_array();

      

       
        return $result;
        
     }


      //PESQUISA DE PRODUTOS E SERVIÇOS
     public function ranking_produto_dash() {

       
               
       $query = $this->db->query("select sum(m.qtd_mov_saida) as qtd,p.descricao from est_movimentacao m
    inner join est_produtos p 
    on(m.id_produto = p.id_produto)
    where m.deletado = 0 and m.id_pedido > 0 group by m.id_produto order by qtd desc limit 10");
       
       $result = $query->result_array();

      

       
        return $result;
        
     }




     //PESQUISA DE PRODUTOS E SERVIÇOS
     public function ranking_produto($dados,$paramDash) {

        //$id_categoria = $dados['id_categoria'];
        //$codigo = $dados['codigo'];
        //$descricao = $dados['descricao'];
        //$id_fornecedor = $dados['id_fornecedor'];
         $data_de = $dados["data_de"];
         $data_ate = $dados["data_ate"];
       
        $param = "";
           
         if ($data_de != NULL && $data_ate != NULL):
                 $objDateFormat = $this->DateFormat;
                 $data_de = $objDateFormat->date_mysql($data_de);
                 $data_ate = $objDateFormat->date_mysql($data_ate);
                 $param .= " and DATE(m.data) BETWEEN '$data_de' AND '$data_ate'"; 
         
         endif;

         if($paramDash!=null){
           $paramDash = "limit 5";   
         }else {
            $paramDash = "";
         }
         

               
       $query = $this->db->query("select m.id_pedido,p.tipo,p.id_produto,p.codigo,p.descricao as produto,m.valor_unitario,p.qtd_minima,f.nome_fantasia as fornecedor,
m.tipo_retirada, cat.categoria as categoria,u.sigla as unidade,
(select sum(qtd_mov) from est_movimentacao where tipo_movimentacao = 1 
    and id_produto = p.id_produto and deletado = 0) as 'Entrada',
       (select sum(qtd_mov) from est_movimentacao where tipo_movimentacao = 2 and id_produto = p.id_produto and tipo_retirada = 1 and deletado = 0) as 'Saida' from est_produtos p
        inner join est_movimentacao m
        on(p.id_produto = m.id_produto)
        inner join com_fornecedores f
        on(p.id_fornecedor = f.id_fornecedor)
        inner join est_categorias cat
        on(p.id_categoria = cat.id_categoria)
        inner join est_un_medida u
        on(p.id_unidade = u.id_unidade)
        where p.tipo = 1 and p.deletado = 0 and m.tipo_retirada = 1
        ".$param."
         
        group by m.id_produto 
        order by Saida desc ".$paramDash." ");
       
       $result = $query->result_array();

      

       
        return $result;
        
     }



     //MOVIMENTCAO DE PRODUTOS POR DATA E AGRUPADO
     public function movimentacao_consolidado($dados) {

        //$id_categoria = $dados['id_categoria'];
        //$codigo = $dados['codigo'];
        //$descricao = $dados['descricao'];
        //$id_fornecedor = $dados['id_fornecedor'];
         $data_de = $dados["data_de"];
         $data_ate = $dados["data_ate"];
       
        $param = "";
           
         if ($data_de != NULL && $data_ate != NULL):
                 $objDateFormat = $this->DateFormat;
                 $data_de = $objDateFormat->date_mysql($data_de);
                 $data_ate = $objDateFormat->date_mysql($data_ate);
                 $param .= " and DATE(data) BETWEEN '$data_de' AND '$data_ate'"; 
         
         endif;
         

               
       $query = $this->db->query("select m.data,p.id_produto,p.codigo,p.descricao as produto,p.valor_venda,f.nome_fantasia as fornecedor, cat.categoria as categoria,u.sigla as unidade, (select sum(qtd_mov) from est_movimentacao where tipo_movimentacao = 1 and deletado = 0  
    and id_produto = p.id_produto ".$param.") as 'Entrada',
       (select sum(qtd_mov) from est_movimentacao where tipo_movimentacao = 2 and deletado = 0 and id_produto = p.id_produto ".$param.") as 'Saida' from est_produtos p
        left join est_movimentacao m
        on(p.id_produto = m.id_produto)
        left join com_fornecedores f
        on(p.id_fornecedor = f.id_fornecedor)
        left join est_categorias cat
        on(p.id_categoria = cat.id_categoria)
        left join est_un_medida u
        on(p.id_unidade = u.id_unidade)
        where p.tipo = 1 and p.deletado = 0 
        group by p.id_produto 
        order by p.descricao");
       
       $result = $query->result_array();

      

       
        return $result;
        
     }

     //PESQUISA DE PRODUTOS E SERVIÇOS
     public function listar_produto_servico() {

      

         $query = $this->db->query("select p.tipo,p.id_produto,p.codigo,p.descricao as produto,p.valor_venda,p.valor_custo,p.qtd_minima,
 cat.categoria as categoria,u.sigla as unidade, 
(select sum(IFNULL(qtd_mov,0))-sum(IFNULL(qtd_mov_saida, 0)) as saldo from est_movimentacao where id_produto = m.id_produto and deletado = 0) as saldo
 from est_produtos p
        left join est_movimentacao m
        on(p.id_produto = m.id_produto)
        left join est_categorias cat
        on(p.id_categoria = cat.id_categoria)
        left join est_un_medida u
        on(p.id_unidade = u.id_unidade)
        where p.habilitado_venda = 1 and p.deletado = 0 
        group by p.id_produto 
        order by p.descricao");

                   
       $result = $query->result_array();

      

       
        return $result;
        
     }


//LISTAR PRODUTOS LOCAÇÃO
public function listar_produto_servico_loc() {

      

         $query = $this->db->query("select p.tipo,p.id_produto,p.codigo,p.descricao as produto,p.valor_venda,p.valor_custo,p.qtd_minima,
 cat.categoria as categoria,u.sigla as unidade, 
(select sum(IFNULL(qtd_mov,0))-sum(IFNULL(qtd_mov_saida, 0)) as saldo from est_movimentacao where id_produto = m.id_produto and deletado = 0) as saldo
 from est_produtos p
        left join est_movimentacao m
        on(p.id_produto = m.id_produto)
        left join est_categorias cat
        on(p.id_categoria = cat.id_categoria)
        left join est_un_medida u
        on(p.id_unidade = u.id_unidade)
        where p.habilitado_locacao = 1 and p.deletado = 0 
        group by p.id_produto 
        order by p.descricao");

                   
       $result = $query->result_array();

      

       
        return $result;
        
     }




     public function listar_produto_servico__() {
        
        $this->db->from("est_produtos");
        $this->db->order_by("descricao");
        $this->db->where("deletado",DELETADO);
        $this->db->where("habilitado_venda",SIM);
        
        $query = $this->db->get();
    
        if ($query == FALSE) {
            throw new Exception($this->db->_error_message(), $this->db->_error_number());
        }
    
        $listProdutos = array();
    
        if ($query != NULL) {
            foreach ($query->result_array() as $dados) {
    
                $listProdutos[] = $this->visualizar($dados["id_produto"]);
            }
        }
        
        return $listProdutos;
    }



    
    
    public function visualizar($id_produto){
    	$this->db->from("est_produtos");
    	$this->db->where("id_produto",$id_produto);
      	$query = $this->db->get();
    
    	if($query==FALSE){
    		throw new Exception($this->db->_error_message(),$this->db->_error_number());
    	}

    	$objProduto = NULL;
    
    	if($query->num_rows()>0){
    		$dados = $query->row_array();
    		$objProduto = $this->Factory->createPojo("est_produtos",$dados);
                
                //Unidade de Medida
                $unidadeBusiness = $this->Factory->createBusiness("est_un_medida");
                $objUnidade = $unidadeBusiness->visualizar($objProduto->getId_unidade());
                $objProduto->setUnidade($objUnidade);
                
                //Categoria
                $categoriaBusiness = $this->Factory->createBusiness("est_categorias");
                $objCategoria = $categoriaBusiness->visualizar($objProduto->getId_categoria());
                $objProduto->setCategoria($objCategoria);
                
                //Fornecedor
                $fornecedorBusiness = $this->Factory->createBusiness("com_fornecedores");
                $objFornecedor = $fornecedorBusiness->visualizar($objProduto->getId_fornecedor());
                $objProduto->setFornecedor($objFornecedor);
                
                //Movimentação
                $est_movimentacaoBusiness = $this->Factory->createBusiness("est_movimentacao");
                $qtdEstoque = $est_movimentacaoBusiness->qtdEstoque($objProduto->getId_produto());
                $objProduto->setQtdEstoque($qtdEstoque);
                
        }
    
    	return $objProduto;
    
    
    }

    public function visualizar_por_codigo($codigo){
        $this->db->from("est_produtos");
        $this->db->where("codigo",$codigo);
        $this->db->where("deletado",DELETADO);
        //$this->db->where("habilitado_venda",SIM);
        
        $query = $this->db->get();
    
        if($query==FALSE){
            throw new Exception($this->db->_error_message(),$this->db->_error_number());
        }

        $objProduto = NULL;
    
        if($query->num_rows()>0){
            $dados = $query->row_array();
            $objProduto = $this->Factory->createPojo("est_produtos",$dados);
                
                //Unidade de Medida
                $unidadeBusiness = $this->Factory->createBusiness("est_un_medida");
                $objUnidade = $unidadeBusiness->visualizar($objProduto->getId_unidade());
                $objProduto->setUnidade($objUnidade);
                
                //Categoria
                $categoriaBusiness = $this->Factory->createBusiness("est_categorias");
                $objCategoria = $categoriaBusiness->visualizar($objProduto->getId_categoria());
                $objProduto->setCategoria($objCategoria);
                
                //Fornecedor
                $fornecedorBusiness = $this->Factory->createBusiness("com_fornecedores");
                $objFornecedor = $fornecedorBusiness->visualizar($objProduto->getId_fornecedor());
                $objProduto->setFornecedor($objFornecedor);
                
                //Movimentação
                $est_movimentacaoBusiness = $this->Factory->createBusiness("est_movimentacao");
                $qtdEstoque = $est_movimentacaoBusiness->qtdEstoque($objProduto->getId_produto());
                $objProduto->setQtdEstoque($qtdEstoque);
                
        }
    
        return $objProduto;
    
    
    }

    
    
    public function alterar($objProduto){
    	$this->db->where('id_produto',$objProduto->getId_produto());
    	$sucess = $this->db->update("est_produtos",$objProduto->toArray());
    	
    	if(!$sucess){
    		throw new Exception($this->db->_error_message(),  $this->db->_error_number());
    	}
    
    }
    
    
    public function excluir($id_produto){
        $this->db->where('id_produto',$id_produto);
        $dados["deletado"] = DELETADO_SIM;
        $sucess = $this->db->update("est_produtos",$dados);
         if(!$sucess){
             throw new Exception($this->db->_error_message(),$this->db->_error_number());
         }
    }



      public function ajax_listar_produto($dados){
        $this->db->from("est_produtos");
        $this->db->order_by("descricao","asc");
        $this->db->limit(50);
        
        if($dados["descricao"]!=NULL){
         $this->db->like("descricao", $dados["descricao"]);   
        }

        if($dados["codigo"]!=NULL){
         $this->db->where("codigo", $dados["codigo"]);   
        }



        $this->db->where("deletado",DELETADO);
        $this->db->where("habilitado_venda",SIM);

        $query = $this->db->get();

        if($query==FALSE){
            throw new Exception($this->db->_error_message(),  $this->db->_error_number());
        }

        $listProduto = array();

          if($query!=NULL){
              foreach ($query->result_array() as $dados){

                // $objBandeira = $this->Factory->createPojo("fin_bandeira_cartao",$dados);
                // $listBandeira[] = $objBandeira;

                $listProduto[] = array(
               'id_produto'   => $dados['id_produto'],
               'descricao'    => $dados['descricao'],
               'valor_venda'  => $dados['valor_venda'],
               'codigo'   => $dados['codigo'],
               );
                  
          }

          }

          return $listProduto;

    }

     public function ajax_visualizar_produto($id_produto){
      $this->db->from("est_produtos");
      $this->db->where("id_produto",$id_produto);
      $this->db->where("deletado",0);
      //$this->db->where("habilitado_venda",1);

        
        $query = $this->db->get();
        $listCategoria = array();
        if($query!=NULL){
              foreach ($query->result_array() as $dados){

               
                $listCategoria[] = array(
               'id_produto'   => $dados['id_produto'],
               'descricao'      => $dados['descricao'],
               'codigo'      => $dados['codigo'],
               'valor_venda'      => $dados['valor_venda'],

               );
                  
          }

      }

      return $listCategoria;

  }



    public function listar_categoria($id_categoria){
        $this->db->from("est_produtos");
        $this->db->order_by("descricao");
        $this->db->where("id_categoria",$id_categoria);
            $this->db->where("deletado",DELETADO);
             $this->db->where("habilitado_venda",SIM);
        
        $query = $this->db->get();

        if($query==FALSE){
            throw new Exception($this->db->_error_message(),  $this->db->_error_number());
        }

        $listProdutos = array();

          if($query!=NULL){
              foreach ($query->result_array() as $dados){

                  $objProdutos = $this->Factory->createPojo("est_produtos",$dados);
                  $listProdutos[] = $objProdutos;
                                
                              
                //Categoria
                //$categoriaBusiness = $this->Factory->createBusiness("est_categorias");
                //$objCategoria = $categoriaBusiness->visualizar($objProduto->getId_categoria());
                //$objProduto->setCategoria($objCategoria);
                  
                  
                  
              }
          }

          return $listProdutos;

    }


     public function valor_medio($id_produto) {
    
      $query = $this->db->query("SELECT id_produto,CAST(AVG(valor_unitario) AS DECIMAL(10,2)) as valor_medio FROM comp_pedidos_itens where id_produto = ".$id_produto." and deletado = 0 ");

      //$result = $query->result_array();

      $result = $query->row_array();

     return $result;
   }



  
    
    


  }

?>
