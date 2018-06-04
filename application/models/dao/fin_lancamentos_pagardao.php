<?php
/* Classe(DAO): Lançamentos
* Autor: Anderson Farias
* Última atualização: 12/07/2015
* Contato: andersonjfarias@yahoo.com.br
*/

class fin_lancamentos_pagarDao extends CI_Model {
    

    public function connect(){
        $this->load->database();
    }

    public function disconnect(){
        $this->db->close();
    }


    public function cadastrar($objLanc){
        $sucess = $this->db->insert("fin_lancamentos_pagar",$objLanc->toArray());
        if(!$sucess){
            throw new Exception($this->db->_error_message(),$this->db->_error_number());
        }

        $cod_lanc = $this->db->insert_id();

        return $cod_lanc;
    }
    
    
    public function filtro($dados) {
     	
    	       
        $this->db->select('*');
        $this->db->from("fin_contas_pagar");
        $this->db->join('fin_lancamentos_pagar', 'fin_lancamentos_pagar.id_conta = fin_contas_pagar.id_conta');
        $this->db->order_by("fin_lancamentos_pagar.data_vencimento", "desc");
        $this->db->where("fin_lancamentos_pagar.deletado", 0);
        
         $objDateFormat = $this->DateFormat;

        if($dados==null){
          //BUSCAR A DATA DO MÊS
          $primeiro_dia = date('Y-m-01'); 
          $ultimo_dia = date("Y-m-t");
          $this->db->where("DATE(fin_lancamentos_pagar.data_vencimento) BETWEEN '$primeiro_dia' AND '$ultimo_dia'");
        //FINAL DATA DO MÊS
        }

        
    	
        $data_de = $dados["data_de"];
        $data_ate = $dados["data_ate"];
           
         
         if ($data_de != NULL && $data_ate != NULL):
                 $objDateFormat = $this->DateFormat;
                 $data_de = $objDateFormat->date_mysql($data_de);
                 $data_ate = $objDateFormat->date_mysql($data_ate);
                
              $this->db->where("fin_lancamentos_pagar.data_vencimento BETWEEN '$data_de' AND '$data_ate'");
         endif;
         
         
         if($dados['status']!=NULL){
             $this->db->where("status",$dados['status']);
         }

         if($dados['id_conta_banco']!=NULL){
             $this->db->where("fin_lancamentos_pagar.id_conta_banco",$dados['id_conta_banco']);
         }

         if ($dados["descricao"] != NULL){
            $this->db->like("fin_lancamentos_pagar.descricao", $dados["descricao"]);
         }
         

        if($dados['id_forma']!=NULL){
             $this->db->where("fin_lancamentos_pagar.id_forma",$dados['id_forma']);
        }

        if($dados['id_fornecedor']!=NULL){
             $this->db->where("fin_contas_pagar.id_fornecedor",$dados['id_fornecedor']);
        }

          if($dados['id_plano']!=NULL){
             $this->db->where("fin_contas_pagar.id_plano",$dados['id_plano']);
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



     public function listar_por_conta($id_conta) {
      
             
        $this->db->select('*');
        $this->db->from("fin_contas_pagar");
        $this->db->join('fin_lancamentos_pagar', 'fin_lancamentos_pagar.id_conta = fin_contas_pagar.id_conta');
        $this->db->order_by("fin_lancamentos_pagar.data_vencimento", "desc");
        $this->db->where("fin_lancamentos_pagar.deletado", 0);
        $this->db->where("fin_lancamentos_pagar.id_conta", $id_conta);
        
        

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
    	$this->db->from("fin_lancamentos_pagar");
    	$this->db->where("id_lancamento",$id_lancmento);
      	$query = $this->db->get();
    
    	if($query==FALSE){
    		throw new Exception($this->db->_error_message(),$this->db->_error_number());
    	}

    	$objLanc = NULL;
    
    	if($query->num_rows()>0){
    		$dados = $query->row_array();
    		$objLanc = $this->Factory->createPojo("fin_lancamentos_pagar",$dados);
                
                //Conta
                $contaBusiness = $this->Factory->createBusiness("fin_contas_pagar");
                $objConta = $contaBusiness->visualizar($objLanc->getId_conta());
                $objLanc->setConta($objConta);


                 //Forma de pagamento
                $formaBusiness = $this->Factory->createBusiness("fin_formas_pagamentos");
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
        $this->db->from("fin_contas_pagar");
        $this->db->join('fin_lancamentos_pagar', 'fin_lancamentos_pagar.id_conta = fin_contas_pagar.id_conta');
        $this->db->order_by("fin_lancamentos_pagar.data_vencimento", "desc");
        $this->db->where("fin_contas_pagar.id_pedido",$id_pedido);
        
                     
        
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
    	$sucess = $this->db->update("fin_lancamentos_pagar",$objLanc->toArray());
    	
    	if(!$sucess){
    		throw new Exception($this->db->_error_message(),  $this->db->_error_number());
    	}
    
    }
    
    
    public function excluir($id_lancamento){
        $this->db->where('id_lancamento',$id_lancamento);
        $dados["deletado"] = DELETADO_SIM;
        $sucess = $this->db->update("fin_lancamentos_pagar",$dados);
         if(!$sucess){
             throw new Exception($this->db->_error_message(),$this->db->_error_number());
         }
    }

     public function excluir_por_conta($id_conta){
        $this->db->where('id_conta',$id_conta);
        $dados["deletado"] = DELETADO_SIM;
        $sucess = $this->db->update("fin_lancamentos_pagar",$dados);
         if(!$sucess){
             throw new Exception($this->db->_error_message(),$this->db->_error_number());
         }
    }


    public function alterar_forma_pagamento($dados){
        $this->db->where('id_lancamento',$dados['id_lancamento']);
                
        $sucess = $this->db->update("fin_lancamentos_pagar",$dados);
         if(!$sucess){
             throw new Exception($this->db->_error_message(),$this->db->_error_number());
         }
    }

     public function baixa($dados){

        $this->db->where('id_lancamento',$dados['id_lancamento']);
        $sucess = $this->db->update("fin_lancamentos_pagar",$dados);
        
        if(!$sucess){
            throw new Exception($this->db->_error_message(),  $this->db->_error_number());
        }
    
    }



    public function total_pagamento() {
      
             
        $this->db->select('*');
         $this->db->select_sum('valor_titulo');
        $this->db->from("fin_contas_pagar");
        $this->db->join('fin_lancamentos_pagar', 'fin_lancamentos_pagar.id_conta = fin_contas_pagar.id_conta');
        $this->db->order_by("fin_lancamentos_pagar.data_vencimento", "desc");
        $this->db->where("fin_lancamentos_pagar.deletado", 0);
        
         $objDateFormat = $this->DateFormat;

        
          //BUSCAR A DATA DO MÊS
          $primeiro_dia = date('Y-m-01'); 
          $ultimo_dia = date("Y-m-t");
          $this->db->where("DATE(fin_lancamentos_pagar.data_vencimento) BETWEEN '$primeiro_dia' AND '$ultimo_dia'");
       

         $query = $this->db->get();
        
        $result = $query->result();

        return $result[0]->valor_titulo;    





    }



    public function lancamentos_vencidos_cp($dados) {
      
             
        
        $data_atual = date('Y-m-d'); 
        $this->db->select('*');
        $this->db->from("fin_contas_pagar");
        $this->db->join('fin_lancamentos_pagar', 'fin_lancamentos_pagar.id_conta = fin_contas_pagar.id_conta');
        $this->db->order_by("fin_lancamentos_pagar.data_vencimento", "desc");
        $this->db->where("fin_lancamentos_pagar.deletado", 0);
        $this->db->where("fin_lancamentos_pagar.status", ABERTO);
        $this->db->where("DATE(fin_lancamentos_pagar.data_vencimento) < '".$data_atual."' ");
        $this->db->limit(5);
         
        
        

        
        /*
        $objDateFormat = $this->DateFormat;
        if($dados==null){
          
          $primeiro_dia = date('Y-m-01'); 
          $ultimo_dia = date("Y-m-t");
          $this->db->where("DATE(fin_lancamentos_pagar.data_vencimento) BETWEEN '$primeiro_dia' AND '$ultimo_dia'");
       
        }

        
      
        $data_de = $dados["data_de"];
        $data_ate = $dados["data_ate"];
           
         
         if ($data_de != NULL && $data_ate != NULL):
                 $objDateFormat = $this->DateFormat;
                 $data_de = $objDateFormat->date_mysql($data_de);
                 $data_ate = $objDateFormat->date_mysql($data_ate);
                
              $this->db->where("fin_lancamentos_pagar.data_vencimento BETWEEN '$data_de' AND '$data_ate'");
         endif;

         */
         
                  
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


    public function lancamentos_vencidos(){
      
             
         
        $data_atual = date('Y-m-d'); 
        $this->db->select('*');
        $this->db->from("fin_contas_pagar");
        $this->db->join('fin_lancamentos_pagar', 'fin_lancamentos_pagar.id_conta = fin_contas_pagar.id_conta');
        $this->db->order_by("fin_lancamentos_pagar.data_vencimento", "desc");
        $this->db->where("fin_lancamentos_pagar.deletado", 0);
        $this->db->where("fin_lancamentos_pagar.status", ABERTO);
        $this->db->where("DATE(fin_lancamentos_pagar.data_vencimento) < '".$data_atual."' ");
                   
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






 }
?>
