<?php
/* Classe(DAO): Pedidos Itens
* Autor: Anderson Farias
* Última atualização: 11/10/2015
* Contato: andersonjfarias@yahoo.com.br
*/

class Comp_itensDao extends CI_Model {
    

    public function connect(){
        $this->load->database();
    }

    public function disconnect(){
        $this->db->close();
    }


    public function cadastrar($objItem){
        $sucess = $this->db->insert("comp_itens",$objItem->toArray());
        if(!$sucess){
            throw new Exception($this->db->_error_message(),$this->db->_error_number());
        }

        $cod_iten = $this->db->insert_id();

        return $cod_iten;
    }
    
    

     public function listar($id_solicitacao) {
        
         //$query = $this->db->query("select e.id_produto,e.descricao, sum(i.qtd) as qtd,i.id_item from comp_itens i 
        //inner join est_produtos e
        //on(i.id_produto=e.id_produto)
        //where i.deletado = 0 and i.id_solicitacao=".$id_solicitacao." group by i.id_produto");

         /*$query = $this->db->query("select i.id_item,e.id_produto,e.descricao,f.nome_fantasia,c.data_entrega,
   (select sum(qtd) as qtd from comp_itens where id_solicitacao = ".$id_solicitacao." and id_produto=e.id_produto) as qtd,
   (select min(valor) from comp_cotacoes where c.id_item=i.id_item) as valor_menor
    from comp_itens i
    left join est_produtos e
    on(i.id_produto=e.id_produto)
    left join comp_cotacoes c
    on(c.id_item=i.id_item)
    left join com_fornecedores f
    on(c.id_fornecedor=f.id_fornecedor)
group by i.id_produto");
*/

$query = $this->db->query("select e.id_produto,e.descricao,sum(i.qtd) as qtd,i.id_item,
    
        (select min(valor) from comp_cotacoes c where c.id_item = i.id_item and c.status=1 and c.deletado=0 ) as menor_valor,
        
        (select f.nome_fantasia from com_fornecedores f 
            inner join comp_cotacoes c
            on(f.id_fornecedor=c.id_fornecedor)
            where c.id_item = i.id_item and c.status=1 and c.deletado=0
            group by c.id_item
           
        ) as menor_cotacao,
        
        (select c.valor from comp_cotacoes c where c.status=1 and c.id_item=i.id_item and c.deletado=0 ) as valor_final,
        (select data_entrega from comp_cotacoes where status=1 and id_item=i.id_item and deletado=0 limit 1 ) as data_entrega
        
        from comp_itens i
        left join est_produtos e
        on(i.id_produto=e.id_produto)
        
        where i.deletado=0 and i.id_solicitacao = ".$id_solicitacao."
        group by i.id_produto");
          



        $result = $query->result_array();

      

       
        return $result;
    }

     public function visualizar_soma($id_item) {
        
         $query = $this->db->query("select e.id_produto,e.descricao, sum(i.qtd) as qtd,i.id_item,i.id_solicitacao from comp_itens i 
        inner join est_produtos e
        on(i.id_produto=e.id_produto)
        where i.deletado = 0 and i.id_item=".$id_item." group by i.id_produto");
       
       //$result = $query->result_array();
         $result = $query->row_array();

      

       
        return $result;
    }
    


    //USADO ANTES
    public function filtro($id_solicitacao) {
     	
    	$this->db->from("comp_itens");
    	$this->db->order_by("id_item","desc");
    	$this->db->where("id_solicitacao",$id_solicitacao);
        $this->db->where("deletado",0);
    	
        
        $query = $this->db->get();
    
    	if ($query == FALSE) {
    		throw new Exception($this->db->_error_message(), $this->db->_error_number());
    	}
    
    	$listItens = array();
    
    	if ($query != NULL) {
    		foreach ($query->result_array() as $dados) {
    
    			$listItens[] = $this->visualizar($dados["id_item"]);
    		}
    	}
    	return $listItens;
    }
    
    

    
	
    
    public function visualizar($id_item){
    	$this->db->from("comp_itens");
    	$this->db->where("id_item",$id_item);
      	$query = $this->db->get();
    
    	if($query==FALSE){
    		throw new Exception($this->db->_error_message(),$this->db->_error_number());
    	}

    	$objItem = NULL;
    
    	if($query->num_rows()>0){
    		$dados = $query->row_array();
    		$objItem = $this->Factory->createPojo("comp_itens",$dados);
                
              
                //Custo
                $custoBusiness = $this->Factory->createBusiness("fin_centro_custos");
                $objCusto = $custoBusiness->visualizar($objItem->getId_custo());
                $objItem->setCusto($objCusto);
                
                //Produto
                $produtoBusiness = $this->Factory->createBusiness("est_produtos");
                $objProduto = $produtoBusiness->visualizar($objItem->getId_produto());
                $objItem->setProduto($objProduto);

    	}
    
    	return $objItem;
    
    
    }


      public function item_validar($id_solicitacao,$id_produto){
        $this->db->from("comp_itens");
        $this->db->where("id_solicitacao",$id_solicitacao);
        $this->db->where("id_produto",$id_produto);
        $this->db->where("deletado",0);

        $query = $this->db->get();
    
        if($query==FALSE){
            throw new Exception($this->db->_error_message(),$this->db->_error_number());
        }

        $objItem = NULL;
    
        if($query->num_rows()>0){
            $dados = $query->row_array();
            $objItem = $this->Factory->createPojo("comp_itens",$dados);
                
        }
    
        return $objItem;
    
    
    }

     
     public function editar_manual($dados){
        $this->db->where('id_item',$dados['id_item']);
        
        $sucess = $this->db->update("comp_itens",$dados);
         
         if(!$sucess){
             throw new Exception($this->db->_error_message(),$this->db->_error_number());
         }
     }

    
    
    public function alterar($dados){
    	$this->db->where('id_item',$dados['id_item']);
    	$sucess = $this->db->update("comp_itens",$dados);
    	
    	if(!$sucess){
    		throw new Exception($this->db->_error_message(),  $this->db->_error_number());
    	}
    
    }
    
    
    public function excluir($id_item){
        $this->db->where('id_item',$id_item);
        $dados["deletado"] = DELETADO_SIM;
        $sucess = $this->db->update("comp_itens",$dados);
         if(!$sucess){
             throw new Exception($this->db->_error_message(),$this->db->_error_number());
         }
    }


     public function excluir_por_pedido($id_solicitacao){
        $this->db->where('id_solicitacao',$id_solicitacao);
        $dados["deletado"] = DELETADO_SIM;
        $sucess = $this->db->update("comp_itens",$dados);
         if(!$sucess){
             throw new Exception($this->db->_error_message(),$this->db->_error_number());
         }
    }


    

  

 }
?>
