<?php
/* Classe(DAO): Pedidos
* Autor: Anderson Farias
* Última atualização: 01/10/2015
* Contato: andersonjfarias@yahoo.com.br
*/

class Comp_pedidosDao extends CI_Model {
    

    public function connect(){
        $this->load->database();
    }

    public function disconnect(){
        $this->db->close();
    }


    public function cadastrar($objPedido){
        $sucess = $this->db->insert("comp_pedidos",$objPedido->toArray());
        if(!$sucess){
            throw new Exception($this->db->_error_message(),$this->db->_error_number());
        }

        $cod_pedido = $this->db->insert_id();

        return $cod_pedido;
    }
    
    
    public function filtro($dados) {
     	
       $id_fornecedor = $dados['id_fornecedor'];
       $numero_nf = $dados['numero_nf'];
       $id_pedido = $dados['id_pedido'];
       $id_status = $dados['id_status'];
       $data_de = $dados['data_de'];
       $data_ate = $dados['data_ate'];
       
       $param = "";

       if ($dados["id_fornecedor"] != NULL):
              $param .= " and p.id_fornecedor = $id_fornecedor";
       endif;

        if ($dados["id_pedido"] != NULL):
              $param .= " and p.id_pedido = $id_pedido";
       endif;

       if ($dados["numero_nf"] != NULL):
              $param .= " and p.numero_nf = $numero_nf";
       endif;

        if ($dados["id_status"] != NULL):
              $param .= " and p.id_status = $id_status";
       endif;

        if ($data_de != NULL && $data_ate != NULL):
                 $objDateFormat = $this->DateFormat;
                 $data_de = $objDateFormat->date_mysql($data_de);
                 $data_ate = $objDateFormat->date_mysql($data_ate);
                 $param .= "and DATE(p.data) BETWEEN '$data_de' AND '$data_ate'"; 
         
         endif;

      $query = $this->db->query("select p.id_pedido,f.nome_fantasia as fornecedor,rh.nome as solicitante,p.data,p.valor_nf,p.numero_nf,t.nome_fantasia as transportadora,p.forma_pagamento,p.data_vencimento,p.data_envio_financeiro,st.status,p.id_status
        from comp_pedidos p
        left join com_fornecedores f
        on(p.id_fornecedor=f.id_fornecedor)
        left join comp_solicitacao s 
        on(p.id_solicitacao = s.id_solicitacao)
        left join rh_colaboradores rh
        on(s.id_solicitante=rh.id_colaborador)
        left join com_transportadoras t
        on(p.id_transportadora=t.id_transportadora)
        left join conf_status st
        on(p.id_status=st.id_status)
        where p.deletado = 0 ".$param." order by p.id_pedido desc");
        

        /*$query = $this->db->query("select p.id_pedido,f.nome_fantasia as fornecedor,p.data,p.valor_nf,p.numero_nf,t.nome_fantasia as transportadora,p.forma_pagamento,p.data_vencimento,p.data_envio_financeiro
        from comp_pedidos p
        left join com_fornecedores f
        on(p.id_fornecedor=f.id_fornecedor)
        left join com_transportadoras t
        on(p.id_transportadora=t.id_transportadora)
        where p.deletado = 0 ".$param." order by p.id_pedido desc");*/
       
       $result = $query->result_array();

      

       
        return $result;

    }
    
    

    
	
    
    public function visualizar($id_pedido){
    	$this->db->from("comp_pedidos");
    	$this->db->where("id_pedido",$id_pedido);
      	$query = $this->db->get();
    
    	if($query==FALSE){
    		throw new Exception($this->db->_error_message(),$this->db->_error_number());
    	}

    	$objPedido = NULL;
    
    	if($query->num_rows()>0){
    		$dados = $query->row_array();
    		$objPedido = $this->Factory->createPojo("comp_pedidos",$dados);
                
                //Usuário
                /*$usuarioBusiness = $this->Factory->createBusiness("acesso_usuarios");
                $objUsuario = $usuarioBusiness->visualizar($objPedido->getId_usuario());
                $objPedido->setUsuario($objUsuario);
                */

              
                //Fornecedor
                $fornecedorBusiness = $this->Factory->createBusiness("com_fornecedores");
                $objFornecedor = $fornecedorBusiness->visualizar($objPedido->getId_fornecedor());
                $objPedido->setFornecedor($objFornecedor);

                 //Fornecedor
                $transBusiness = $this->Factory->createBusiness("com_transportadoras");
                $objTrans = $transBusiness->visualizar($objPedido->getId_transportadora());
                $objPedido->setTransportadora($objTrans);

                $statusBusiness = $this->Factory->createBusiness("conf_status");
                $objStatus = $statusBusiness->visualizar($objPedido->getId_status());
                $objPedido->setObjStatus($objStatus);

                $solBusiness = $this->Factory->createBusiness("comp_solicitacao");
                $objSol = $solBusiness->visualizar($objPedido->getId_solicitacao());
                $objPedido->setSolicitacao($objSol);
             

                  //Cliente
                
                /*$itensBusiness = $this->Factory->createBusiness("comp_pedidos_itens");
                $objItem = $itensBusiness->valor_total($objPedido->getId_pedido());
                $objPedido->setTotal_itens($objItem);
                */
                

                 


    	}
    
    	return $objPedido;
    
    
    }
    

    public function visualizar_por_solicitacao($id_solicitacao,$id_fornecedor){
        $this->db->from("comp_pedidos");
        $this->db->where("id_solicitacao",$id_solicitacao);
         $this->db->where("id_fornecedor",$id_fornecedor);
         $this->db->where("deletado",DELETADO);
        $query = $this->db->get();
    
        if($query==FALSE){
            throw new Exception($this->db->_error_message(),$this->db->_error_number());
        }

        $objPedido = NULL;
    
        if($query->num_rows()>0){
            $dados = $query->row_array();
            $objPedido = $this->Factory->createPojo("comp_pedidos",$dados);
                
                             


        }
    
        return $objPedido;
    
    
    }
    
    public function alterar($dados){
    	$this->db->where('id_pedido',$dados['id_pedido']);
    	$sucess = $this->db->update("comp_pedidos",$dados);
    	
    	if(!$sucess){
    		throw new Exception($this->db->_error_message(),  $this->db->_error_number());
    	}
    
    }
    
    
    public function excluir($id_pedido){
        $this->db->where('id_pedido',$id_pedido);
        $dados["deletado"] = DELETADO_SIM;
        $sucess = $this->db->update("comp_pedidos",$dados);
         if(!$sucess){
             throw new Exception($this->db->_error_message(),$this->db->_error_number());
         }
    }


     public function ultima_compra($id_produto) {
    
      $query = $this->db->query("select p.id_pedido,f.nome_fantasia,i.id_produto,i.valor_unitario from comp_pedidos p
  left join com_fornecedores f
  on(p.id_fornecedor = f.id_fornecedor)
  left join comp_pedidos_itens i
  on(i.id_pedido = p.id_pedido)
  where i.deletado = 0 and p.faturar=1 and i.id_produto = ".$id_produto." order by id_pedido_item desc");

      //$result = $query->result_array();

      $result = $query->row_array();

     return $result;
   }


  public function listar_centro_custo($id_pedido) {
      
       
      $query = $this->db->query("select c.codigo as custo, sum(i.valor_unitario * i.qtd) as total from comp_pedidos_itens i
    left join fin_centro_custos c
    on(i.id_custo = c.id_custo)
    where i.deletado = 0 and i.id_pedido = ".$id_pedido."
    group by i.id_custo");
       
        $result = $query->result_array();

      

       
        return $result;

  }
     





 }
?>
