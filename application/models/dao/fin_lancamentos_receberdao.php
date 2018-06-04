<?php
/* Classe(DAO): Lançamentos
* Autor: Anderson Farias
* Última atualização: 12/07/2015
* Contato: andersonjfarias@yahoo.com.br
*/

class fin_lancamentos_receberDao extends CI_Model {
    

    public function connect(){
        $this->load->database();
    }

    public function disconnect(){
        $this->db->close();
    }


    public function cadastrar($objLanc){
        $sucess = $this->db->insert("fin_lancamentos_receber",$objLanc->toArray());
        if(!$sucess){
            throw new Exception($this->db->_error_message(),$this->db->_error_number());
        }

        $cod_lanc = $this->db->insert_id();

        return $cod_lanc;
    }
    
    
    public function filtro($dados) {
     	
    	       
        $this->db->select('*');
        $this->db->from("fin_contas_receber");
        $this->db->join('fin_lancamentos_receber', 'fin_lancamentos_receber.id_conta = fin_contas_receber.id_conta','left');
        $this->db->join('com_pedidos', 'fin_contas_receber.id_pedido = com_pedidos.id_pedido','left');
        $this->db->order_by("fin_lancamentos_receber.data_vencimento", "desc");
        $this->db->order_by("fin_lancamentos_receber.id_lancamento", "desc");
        if($dados['status']==null){
         $this->db->where_not_in('fin_lancamentos_receber.status',CANCELADO);
        }

        $this->db->where("fin_lancamentos_receber.deletado", 0);


        
         $objDateFormat = $this->DateFormat;

        if($dados==null){
          //BUSCAR A DATA DO MÊS
          $primeiro_dia = date('Y-m-01'); 
          $ultimo_dia = date("Y-m-t");
          $this->db->where("DATE(fin_lancamentos_receber.data_vencimento) BETWEEN '$primeiro_dia' AND '$ultimo_dia'");
        //FINAL DATA DO MÊS
        }

        
    	
        $data_de = $dados["data_de"];
        $data_ate = $dados["data_ate"];
           
         
         if ($data_de != NULL && $data_ate != NULL):
                 $objDateFormat = $this->DateFormat;
                 $data_de = $objDateFormat->date_mysql($data_de);
                 $data_ate = $objDateFormat->date_mysql($data_ate);
                
              $this->db->where("fin_lancamentos_receber.data_vencimento BETWEEN '$data_de' AND '$data_ate'");
         endif;
         
         
         if($dados['status']!=NULL){
             $this->db->where("fin_lancamentos_receber.status",$dados['status']);
         }

         if($dados['id_forma']!=NULL){
             $this->db->where("fin_lancamentos_receber.id_forma",$dados['id_forma']);
         }

         if($dados['id_cliente']!=null){
          
            //$this->db->where("com_pedidos.id_cliente",$dados['id_cliente']);
          $this->db->where("fin_contas_receber.id_cliente",$dados['id_cliente']);
          }

          if($dados['codigo']!=null){
            //$this->db->join('com_pedidos', 'fin_contas_receber.id_pedido = com_pedidos.id_pedido');
            $this->db->where("com_pedidos.codigo",$dados['codigo']);
          }

                


        $query = $this->db->get();
    
    	if ($query == FALSE) {
    		throw new Exception($this->db->_error_message(), $this->db->_error_number());
    	}
    
    	$listLanc = array();
    
    	if ($query != NULL) {
    		foreach ($query->result_array() as $dados) {
    
    			$listLanc[] = $this->visualizar($dados["id_lancamento"]);
    		}
    	}
    	return $listLanc;
    }



    
    public function visualizar($id_lancmento){
    	$this->db->from("fin_lancamentos_receber");
    	$this->db->where("id_lancamento",$id_lancmento);
      	$query = $this->db->get();
    
    	if($query==FALSE){
    		throw new Exception($this->db->_error_message(),$this->db->_error_number());
    	}

    	$objLanc = NULL;
    
    	if($query->num_rows()>0){
    		$dados = $query->row_array();
    		$objLanc = $this->Factory->createPojo("fin_lancamentos_receber",$dados);
                
                //Conta
                $contaBusiness = $this->Factory->createBusiness("fin_contas_receber");
                $objConta = $contaBusiness->visualizar($objLanc->getId_conta());
                $objLanc->setConta($objConta);


                 //Forma de pagamento
                $formaBusiness = $this->Factory->createBusiness("fin_formas_recebimentos");
                $objForma = $formaBusiness->visualizar($objLanc->getId_forma());
                $objLanc->setForma($objForma);

                //Bandeira Cartão
                $bandeiraBusiness = $this->Factory->createBusiness("fin_bandeira_cartao");
                $objBandeira = $bandeiraBusiness->visualizar($objLanc->getId_bandeira());
                $objLanc->setBandeira($objBandeira);
            

    	}
    
    	return $objLanc;
    
    
    }

      public function listar_por_pedido($id_pedido) {
        
               
        $this->db->select('*');
        $this->db->from("fin_contas_receber");
        $this->db->join('fin_lancamentos_receber', 'fin_lancamentos_receber.id_conta = fin_contas_receber.id_conta');
        $this->db->order_by("fin_lancamentos_receber.data_vencimento", "desc");
        $this->db->where("fin_contas_receber.id_pedido",$id_pedido);
         $this->db->where("fin_lancamentos_receber.deletado",DELETADO);
        
                     
        
        $query = $this->db->get();
    
        if ($query == FALSE) {
            throw new Exception($this->db->_error_message(), $this->db->_error_number());
        }
    
        $listLanc = array();
    
        if ($query != NULL) {
            foreach ($query->result_array() as $dados) {
    
                $listLanc[] = $this->visualizar($dados["id_lancamento"]);
            }
        }
        return $listLanc;
    }

    
    
    public function alterar($objLanc){
    	$this->db->where('id_lancamento',$objLanc->getId_lancamento());
    	$sucess = $this->db->update("fin_lancamentos_receber",$objLanc->toArray());
    	
    	if(!$sucess){
    		throw new Exception($this->db->_error_message(),  $this->db->_error_number());
    	}
    
    }
    
    
    public function excluir($id_lancamento){
        $this->db->where('id_lancamento',$id_lancamento);
        //$dados["deletado"] = DELETADO_SIM;
        //$sucess = $this->db->update("fin_lancamentos_receber",$dados);
        $sucess = $this->db->delete("fin_lancamentos_receber");
         if(!$sucess){
             throw new Exception($this->db->_error_message(),$this->db->_error_number());
         }
    }

    
     public function excluir_por_faturamento($id_forma_fat){
        $this->db->where('id_forma_fat',$id_forma_fat);
        //$dados["deletado"] = DELETADO_SIM;
        //$sucess = $this->db->update("fin_lancamentos_receber",$dados);
        $sucess = $this->db->delete("fin_lancamentos_receber");
         if(!$sucess){
             throw new Exception($this->db->_error_message(),$this->db->_error_number());
         }
    }


    public function excluir_por_conta($id_conta){
        $this->db->where('id_conta',$id_conta);
        //$dados["deletado"] = DELETADO_SIM;
        //$sucess = $this->db->update("fin_lancamentos_receber",$dados);
        $sucess = $this->db->delete("fin_lancamentos_receber");
         if(!$sucess){
             throw new Exception($this->db->_error_message(),$this->db->_error_number());
         }
    }


    public function alterar_forma_pagamento($dados){
        $this->db->where('id_lancamento',$dados['id_lancamento']);
                
        $sucess = $this->db->update("fin_lancamentos_receber",$dados);
         if(!$sucess){
             throw new Exception($this->db->_error_message(),$this->db->_error_number());
         }
    }

     public function confirmar_faturamento_lanc($id_conta){
        $this->db->where('id_conta',$id_conta);
         //$this->db->where('deletado',DELETADO_FATURADO);
        $dados["deletado"] = DELETADO;
        $sucess = $this->db->update("fin_lancamentos_receber",$dados);
         if(!$sucess){
             throw new Exception($this->db->_error_message(),$this->db->_error_number());
         }
    }


    public function total_venda($id_pedido){
        //$query = $this->db->select_sum('valor_unitario * qtd', 'Amount');
        //$query = $this->db->where("id_pedido",$id_pedido);
        //$query = $this->db->where("deletado",DELETADO);
        //$query = $this->db->get('com_pedidos_itens');

        $this->db->select_sum('valor_titulo');
        $this->db->from("fin_contas_receber");
        $this->db->join('fin_lancamentos_receber', 'fin_lancamentos_receber.id_conta = fin_contas_receber.id_conta');
        $this->db->where("fin_contas_receber.id_pedido",$id_pedido);
        $this->db->where("fin_lancamentos_receber.deletado",DELETADO);
        
                     
        
        $query = $this->db->get();
        
        $result = $query->result();

        return $result[0]->valor_titulo;
            
    }



     public function total_recebimento() {
      
             
        $this->db->select('*');
        $this->db->select_sum('valor_titulo');
        $this->db->from("fin_contas_receber");
        $this->db->join('fin_lancamentos_receber', 'fin_lancamentos_receber.id_conta = fin_contas_receber.id_conta','left');
        $this->db->join('com_pedidos', 'fin_contas_receber.id_pedido = com_pedidos.id_pedido','left');
        $this->db->order_by("fin_lancamentos_receber.data_vencimento", "desc");
        $this->db->order_by("fin_lancamentos_receber.id_lancamento", "desc");
        /*if($dados['status']==null){
         $this->db->where_not_in('fin_lancamentos_receber.status',CANCELADO);
        }*/

        $this->db->where("fin_lancamentos_receber.deletado", 0);


        
         $objDateFormat = $this->DateFormat;

        //if($dados==null){
          //BUSCAR A DATA DO MÊS
          $primeiro_dia = date('Y-m-01'); 
          $ultimo_dia = date("Y-m-t");
          $this->db->where("DATE(fin_lancamentos_receber.data_vencimento) BETWEEN '$primeiro_dia' AND '$ultimo_dia'");
        //FINAL DATA DO MÊS
        //}

        
      
       
      
        $query = $this->db->get();
        
        $result = $query->result();

        return $result[0]->valor_titulo;    
                        


      
    }



    




 }
?>
