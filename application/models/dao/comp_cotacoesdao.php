<?php
/* Classe(DAO): Pedidos Itens
* Autor: Anderson Farias
* Última atualização: 11/10/2015
* Contato: andersonjfarias@yahoo.com.br
*/

class Comp_cotacoesDao extends CI_Model {
    

    public function connect(){
        $this->load->database();
    }

    public function disconnect(){
        $this->db->close();
    }


    public function cadastrar($objItem){

        $sucess = $this->db->insert("comp_cotacoes",$objItem->toArray());
        if(!$sucess){
            throw new Exception($this->db->_error_message(),$this->db->_error_number());
        }

        $cod_iten = $this->db->insert_id();



        return $cod_iten;
    }
    
    
    public function listar($id_item) {
     	
    	$this->db->from("comp_cotacoes");
    	$this->db->order_by("data_inclusao","desc");
    	$this->db->where("id_item",$id_item);
        $this->db->where("deletado",0);
    	
        
        $query = $this->db->get();
    
    	if ($query == FALSE) {
    		throw new Exception($this->db->_error_message(), $this->db->_error_number());
    	}
    
    	$listItens = array();
    
    	if ($query != NULL) {
    		foreach ($query->result_array() as $dados) {
    
    			$listItens[] = $this->visualizar($dados["id_cotacao"]);
    		}
    	}
    	return $listItens;
    }
    
    

    
	
    
    public function visualizar($id_cotacao){
    	$this->db->from("comp_cotacoes");
    	$this->db->where("id_cotacao",$id_cotacao);
      	$query = $this->db->get();
    
    	if($query==FALSE){
    		throw new Exception($this->db->_error_message(),$this->db->_error_number());
    	}

    	$objCotacao = NULL;
    
    	if($query->num_rows()>0){
    		$dados = $query->row_array();
    		$objCotacao = $this->Factory->createPojo("comp_cotacoes",$dados);
                
                //Pedidos
                $fornecedorBusiness = $this->Factory->createBusiness("com_fornecedores");
                $objFornecedor = $fornecedorBusiness->visualizar($objCotacao->getId_fornecedor());
                $objCotacao->setFornecedor($objFornecedor);
                
                //Produto
                $itemBusiness = $this->Factory->createBusiness("comp_itens");
                $objItem = $itemBusiness->visualizar($objCotacao->getId_item());
                $objCotacao->setItem($objItem);

    	}
    
    	return $objCotacao;
    
    
    }


   
     
        
    public function alterar_todos_itens($dados){
      $this->db->where('id_item',$dados['id_item']);
      $sucess = $this->db->update("comp_cotacoes",$dados);
      
      if(!$sucess){
        throw new Exception($this->db->_error_message(),  $this->db->_error_number());
      }
    
    }
    
    public function alterar($dados){
    	$this->db->where('id_cotacao',$dados['id_cotacao']);
    	$sucess = $this->db->update("comp_cotacoes",$dados);
    	
    	if(!$sucess){
    		throw new Exception($this->db->_error_message(),  $this->db->_error_number());
    	}
    
    }
    
    
    public function excluir($id_cotacao){
        $this->db->where('id_cotacao',$id_cotacao);
        $dados["deletado"] = DELETADO_SIM;
        $sucess = $this->db->update("comp_cotacoes",$dados);
         if(!$sucess){
             throw new Exception($this->db->_error_message(),$this->db->_error_number());
         }
    }


     public function ajax_listar_cotacao($id_item){
       $query = $this->db->query("select f.nome_fantasia,p.descricao,p.id_produto, ct.qtd, ct.valor,ct.data_entrega,ci.id_solicitacao,ct.id_cotacao,ct.status,ci.id_item,ct.lancada
        from comp_cotacoes ct
            inner join comp_itens ci
            on(ct.id_item = ci.id_item)
            inner join com_fornecedores f
            on(ct.id_fornecedor = f.id_fornecedor)
            inner join est_produtos p
            on(ci.id_produto = p.id_produto)
            where ct.deletado = 0 and ci.id_item = ".$id_item." group by ct.id_cotacao;");
       
         
        
          
        $listFat = array();

       
              foreach ($query->result_array() as $dados){

                // $objBandeira = $this->Factory->createPojo("fin_bandeira_cartao",$dados);
                // $listBandeira[] = $objBandeira;
                
               $objDateFormat = $this->DateFormat; 

                $listFat[] = array(
               'id_cotacao'   => $dados['id_cotacao'],
               'status'   => $dados['status'],
              'id_solicitacao'   => $dados['id_solicitacao'],
               'id_item'   => $dados['id_item'],
               'nome_fantasia'      => $dados['nome_fantasia'],
               'valor'      => number_format($dados['valor'], 2, ',', '.'),
               'qtd'      => $dados['qtd'],
               'descricao' => $dados['descricao'],
                'lancada' => $dados['lancada'],
               'id_produto' => $dados['id_produto'],
               'data_entrega'      => $objDateFormat->date_format($dados['data_entrega']),
               'sub_total' =>  number_format($dados['valor'] * $dados['qtd'] , 2, ',', '.'),
               );
                  
          }
          

          return $listFat;

    }


    public function ajax_listar_fornecedor($id_solicitacao){
       $query = $this->db->query("select f.nome_fantasia as fornecedor,p.descricao as produto,sum(c.valor * c.qtd) as total,s.id_solicitacao from comp_cotacoes c
  inner join comp_itens i
  on(i.id_item=c.id_item)
  inner join comp_solicitacao s
  on(i.id_solicitacao=s.id_solicitacao)
  inner join est_produtos p
  on(p.id_produto=c.id_produto)
  inner join com_fornecedores f
  on(c.id_fornecedor=f.id_fornecedor)
  where c.status = 1 and c.deletado=0 and s.id_solicitacao = ".$id_solicitacao." group by c.id_fornecedor");
       
         
        
          
        $listFat = array();

       
              foreach ($query->result_array() as $dados){

                // $objBandeira = $this->Factory->createPojo("fin_bandeira_cartao",$dados);
                // $listBandeira[] = $objBandeira;
                
               $objDateFormat = $this->DateFormat; 

                $listFat[] = array(
               'id_solicitacao'   => $dados['id_solicitacao'],
               'fornecedor'   => $dados['fornecedor'],
               'produto'   => $dados['id_solicitacao'],
               'total'   => number_format($dados['total'], 2, ',', '.'),
              
               );
                  
          }
          

          return $listFat;

    }




      //LISTAR ITENS DO PEDIDO DE COMPRA
     public function cotacao_lancada($id_solicitacao) {

      $query = $this->db->query("select c.id_item,c.lancada,s.id_solicitacao from comp_cotacoes c
        inner join comp_itens i
        on(c.id_item = i.id_item)
        inner join comp_solicitacao s
        on(i.id_solicitacao = s.id_solicitacao)
        where c.lancada = 1 and i.id_solicitacao = ".$id_solicitacao." 
        group by c.id_item limit 1");
       
       $result = $query->result_array();

      

       
        return $result;
        
     }


       //LISTAR ITENS DO PEDIDO DE COMPRA
     public function verificar_cotacao_parcial($id_solicitacao) {

      $query = $this->db->query("select c.id_cotacao,c.id_item,s.id_solicitacao,c.lancada,c.status,c.flag_parcial from comp_cotacoes c
        left join comp_itens i
        on(c.id_item = i.id_item)
        left join comp_solicitacao s
        on(i.id_solicitacao = s.id_solicitacao)
        where c.status=1 and isnull(c.flag_parcial) and i.id_solicitacao = ".$id_solicitacao."");
       
       $result = $query->result_array();

      

       
        return $result;
        
     }


      //LISTAR ITENS DO PEDIDO DE COMPRA
     public function qtd_cotacao_lancada($id_solicitacao) {

      $query = $this->db->query("select count(c.id_cotacao) as qtd_lancada,c.id_item,s.id_solicitacao,c.lancada,c.status,c.flag_parcial from comp_cotacoes c
        left join comp_itens i
        on(c.id_item = i.id_item)
        left join comp_solicitacao s
        on(i.id_solicitacao = s.id_solicitacao)
        where c.lancada=1 and i.id_solicitacao = ".$id_solicitacao." ");
       
       $result = $query->result_array();

      

       
        return $result[0]['qtd_lancada'];
        
     }


      public function listar_itens_fornecedor($id_solicitacao,$id_fornecedor) {

      
      
       
       $query = $this->db->query("SELECT i.id_item,e.id_produto,e.descricao,co.valor,i.qtd,co.data_entrega,f.nome_fantasia,f.id_fornecedor,i.id_solicitacao, co.valor * i.qtd as sub_total,co.id_cotacao,co.lancada,co.flag_parcial,co.status from comp_cotacoes co
        left join comp_itens i on(co.id_item = i.id_item) 
left join est_produtos e on(i.id_produto=e.id_produto) 
left join com_fornecedores f on(co.id_fornecedor=f.id_fornecedor) 
where i.id_solicitacao = ".$id_solicitacao." and co.status = 1 and 
co.deletado=0 and co.flag_parcial is not null and f.id_fornecedor = ".$id_fornecedor." ");
       
       $result = $query->result_array();

      

       
        return $result;
        
     }
    

  

 }
?>
