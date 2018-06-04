<?php
/* Classe(DAO): Contas
* Autor: Anderson Farias
* Última atualização: 12/07/2015
* Contato: andersonjfarias@yahoo.com.br
*/

class Fin_contasDao extends CI_Model {
    

    public function connect(){
        $this->load->database();
    }

    public function disconnect(){
        $this->db->close();
    }


    public function cadastrar($objConta){
        $sucess = $this->db->insert("fin_contas",$objConta->toArray());
        if(!$sucess){
            throw new Exception($this->db->_error_message(),$this->db->_error_number());
        }

        $cod_conta = $this->db->insert_id();

        return $cod_conta;
    }
    
    
    public function filtro($dados) {
     	
    	$this->db->from("fin_contas");
    	$this->db->order_by("data");
    	$this->db->where("deletado",DELETADO);
    	
        $data_de = $dados["data_de"];
        $data_ate = $dados["data_ate"];
           
         if ($data_de != NULL && $data_ate != NULL):
                 $objDateFormat = $this->DateFormat;
                 $data_de = $objDateFormat->date_mysql($data_de);
                 $data_ate = $objDateFormat->date_mysql($data_ate);
                
              $this->db->where("DATE(data) BETWEEN '$data_de' AND '$data_ate'");
         endif;
        
        $query = $this->db->get();
    
    	if ($query == FALSE) {
    		throw new Exception($this->db->_error_message(), $this->db->_error_number());
    	}
    
    	$listContas = array();
    
    	if ($query != NULL) {
    		foreach ($query->result_array() as $dados) {
    
    			$listContas[] = $this->visualizar($dados["id_conta"]);
    		}
    	}
    	return $listContas;
    }


     //MOTRAR O TOTAL DA CONTA REFERENTE A UMA DATA
     public function filtro_pedido_total($dados) {
        

        $this->db->select_sum('valor_total');
        $this->db->select('data');
         $this->db->select('count(id_conta) as qtd');
        $this->db->where("tipo",CONTAS_RECEBER);
        $this->db->where("deletado",DELETADO);
        $this->db->group_by("data");
          $this->db->order_by("data","desc"); 
       

        $data_de = $dados["data_de"];
        $data_ate = $dados["data_ate"];
           
         if ($data_de != NULL && $data_ate != NULL):
                 $objDateFormat = $this->DateFormat;
                 $data_de = $objDateFormat->date_mysql($data_de);
                 $data_ate = $objDateFormat->date_mysql($data_ate);
                
              $this->db->where("DATE(data) BETWEEN '$data_de' AND '$data_ate'");
         endif;
        
        $query = $this->db->get('fin_contas');
        $result = $query->result_array();

        return $result;
        
     }


      //MOTRAR O TOTAL DA CONTA REFERENTE A UMA DATA
     public function filtro_compra_total($dados) {
        

        $this->db->select_sum('valor_total');
        $this->db->select('data');
         $this->db->select('count(id_conta) as qtd');
        $this->db->where("tipo",CONTAS_PAGAR);
        $this->db->where("deletado",DELETADO);
        $this->db->group_by("data");
          $this->db->order_by("data","desc"); 
       

        $data_de = $dados["data_de"];
        $data_ate = $dados["data_ate"];
           
         if ($data_de != NULL && $data_ate != NULL):
                 $objDateFormat = $this->DateFormat;
                 $data_de = $objDateFormat->date_mysql($data_de);
                 $data_ate = $objDateFormat->date_mysql($data_ate);
                
              $this->db->where("DATE(data) BETWEEN '$data_de' AND '$data_ate'");
         endif;
        
        $query = $this->db->get('fin_contas');
        $result = $query->result_array();

        return $result;
        
     }




         //MOTRAR O TOTAL DA CONTA REFERENTE A UMA DATA
     public function filtro_recebimento_resumo($dados) {

        $data_de = $dados["data_de"];
        $data_ate = $dados["data_ate"];
        $id_forma = $dados['id_forma'];
       // $id_operadora = $dados['id_operadora'];
        $param = "";
           
         if ($data_de != NULL && $data_ate != NULL):
                 $objDateFormat = $this->DateFormat;
                 $data_de = $objDateFormat->date_mysql($data_de);
                 $data_ate = $objDateFormat->date_mysql($data_ate);
                
             // $this->db->where("DATE(l.data_vencimento) BETWEEN '$data_de' AND '$data_ate'");
                $param .= "and DATE(l.data_vencimento) BETWEEN '$data_de' AND '$data_ate'"; 
         
         endif;

         if ($dados["id_forma"] != NULL):
              $param .= " and l.id_forma = $id_forma";

         endif;
         

       
       $query = $this->db->query("select sum(l.valor_titulo) as valor,count(c.id_pedido) as qtd_pedido, c.tipo,f.forma,l.data_vencimento from fin_lancamentos l
       inner join fin_contas c
       on(l.id_conta = c.id_conta)
       inner join fin_formas_pagamentos f
       on(l.id_forma=f.id_forma) where c.tipo = 2 and l.deletado = 0 ".$param."
      group by f.id_forma, l.data_vencimento order by l.data_vencimento desc");
       

       $result = $query->result_array();

        return $result;
        
     }




         //MOTRAR O TOTAL DA CONTA REFERENTE A UMA DATA
     public function filtro_contas_cartao($dados) {



        $data_de = $dados["data_de"];
        $data_ate = $dados["data_ate"];
        $id_bandeira = $dados['id_bandeira'];
        $id_operadora = $dados['id_operadora'];
        $param = "";
           
         if ($data_de != NULL && $data_ate != NULL):
                 $objDateFormat = $this->DateFormat;
                 $data_de = $objDateFormat->date_mysql($data_de);
                 $data_ate = $objDateFormat->date_mysql($data_ate);
                
             // $this->db->where("DATE(l.data_vencimento) BETWEEN '$data_de' AND '$data_ate'");
                $param .= "and DATE(l.data_vencimento) BETWEEN '$data_de' AND '$data_ate'"; 
         
         endif;

         if ($dados["id_operadora"] != NULL):
              $param .= " and o.id_operadora = $id_operadora ";

         endif;

           if ($dados["id_bandeira"] != NULL):
           $param = "and l.id_bandeira = $id_bandeira";

         endif;
      
       

       $query = $this->db->query("select sum(l.valor_titulo) as valor,c.tipo,f.forma,b.bandeira,o.empresa as operadora,l.data_vencimento from fin_lancamentos l
       inner join fin_contas c
       on(l.id_conta = c.id_conta)
       inner join fin_formas_pagamentos f
       on(l.id_forma=f.id_forma)
     inner join fin_bandeira_cartao b
       on(b.id_bandeira = l.id_bandeira )
     inner join fin_operadoras_cartao o
     on(b.id_operadora=o.id_operadora)
       where c.tipo = 2 and l.deletado = 0 ".$param."
      group by f.id_forma");

       $result = $query->result_array();

        return $result;
        
     }

    
    
    

    
	
    
    public function visualizar($id_conta){
    	$this->db->from("fin_contas");
    	$this->db->where("id_conta",$id_conta);
      	$query = $this->db->get();
    
    	if($query==FALSE){
    		throw new Exception($this->db->_error_message(),$this->db->_error_number());
    	}

    	$objConta = NULL;
    
    	if($query->num_rows()>0){
    		$dados = $query->row_array();
    		$objConta = $this->Factory->createPojo("fin_contas",$dados);
                
                //Forncedor
                $fornecedorBusiness = $this->Factory->createBusiness("com_fornecedores");
                $objFornecedor = $fornecedorBusiness->visualizar($objConta->getId_fornecedor());
                $objConta->setFornecedor($objFornecedor);
                
                //Centro de Custos
                $custoBusiness = $this->Factory->createBusiness("fin_centro_custos");
                $objCusto = $custoBusiness->visualizar($objConta->getId_custo());
                $objConta->setCusto($objCusto);

                 //Cliente
                $clienteBusiness = $this->Factory->createBusiness("com_clientes");
                $objCliente = $clienteBusiness->visualizar($objConta->getId_cliente());
                $objConta->setCliente($objCliente);

                //Pedidos
                $pedidosBusiness = $this->Factory->createBusiness("com_pedidos");
                $objPedido = $pedidosBusiness->visualizar($objConta->getId_pedido());
                $objConta->setPedido($objPedido);



    	}
    
    	return $objConta;
    
    
    }


    public function visualizar_por_pedido($id_pedido){
        $this->db->from("fin_contas");
        $this->db->where("id_pedido",$id_pedido);
        $query = $this->db->get();
    
        if($query==FALSE){
            throw new Exception($this->db->_error_message(),$this->db->_error_number());
        }

        $objConta = NULL;
    
        if($query->num_rows()>0){
            $dados = $query->row_array();
            $objConta = $this->Factory->createPojo("fin_contas",$dados);
                
                //Forncedor
                $fornecedorBusiness = $this->Factory->createBusiness("com_fornecedores");
                $objFornecedor = $fornecedorBusiness->visualizar($objConta->getId_fornecedor());
                $objConta->setFornecedor($objFornecedor);
                
                //Centro de Custos
                $custoBusiness = $this->Factory->createBusiness("fin_centro_custos");
                $objCusto = $custoBusiness->visualizar($objConta->getId_custo());
                $objConta->setCusto($objCusto);

                 //Cliente
                $clienteBusiness = $this->Factory->createBusiness("com_clientes");
                $objCliente = $clienteBusiness->visualizar($objConta->getId_cliente());
                $objConta->setCliente($objCliente);

                //Pedidos
                $pedidosBusiness = $this->Factory->createBusiness("com_pedidos");
                $objPedido = $pedidosBusiness->visualizar($objConta->getId_pedido());
                $objConta->setPedido($objPedido);



        }
    
        return $objConta;
    
    
    }
    
    
    public function alterar($objConta){
    	$this->db->where('id_conta',$objConta->getId_conta());
    	$sucess = $this->db->update("fin_contas",$objConta->toArray());
    	
    	if(!$sucess){
    		throw new Exception($this->db->_error_message(),  $this->db->_error_number());
    	}
    
    }
    
    
    public function excluir($id_conta){
        $this->db->where('id_conta',$id_conta);
        $dados["deletado"] = DELETADO_SIM;
        $sucess = $this->db->update("fin_contas",$dados);
         if(!$sucess){
             throw new Exception($this->db->_error_message(),$this->db->_error_number());
         }
    }

     public function excluir_por_pedido($id_pedido){
        $this->db->where('id_pedido',$id_pedido);
        $dados["deletado"] = DELETADO_SIM;
        $sucess = $this->db->update("fin_contas",$dados);
         if(!$sucess){
             throw new Exception($this->db->_error_message(),$this->db->_error_number());
         }
    }


     public function editar_tela_lanc($dados){

        $this->db->where('id_conta',$dados['id_conta']);
        $sucess = $this->db->update("fin_contas",$dados);
        
        if(!$sucess){
            throw new Exception($this->db->_error_message(),  $this->db->_error_number());
        }
    
    }



 }
?>
