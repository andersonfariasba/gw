<?php
/* Classe(DAO): Lançamentos
* Autor: Anderson Farias
* Última atualização: 12/07/2015
* Contato: andersonjfarias@yahoo.com.br
*/

class Fin_lancamentosDao extends CI_Model {
    

    public function connect(){
        $this->load->database();
    }

    public function disconnect(){
        $this->db->close();
    }


    public function cadastrar($objLanc){
        $sucess = $this->db->insert("fin_lancamentos",$objLanc->toArray());
        if(!$sucess){
            throw new Exception($this->db->_error_message(),$this->db->_error_number());
        }

        $cod_lanc = $this->db->insert_id();

        return $cod_lanc;
    }
    
    
    public function filtro($tipo,$dados) {
     	
    	       
        $this->db->select('*');
        $this->db->from("fin_contas");
        $this->db->join('fin_lancamentos', 'fin_lancamentos.id_conta = fin_contas.id_conta');
        $this->db->where("fin_contas.tipo",$tipo);
        $this->db->order_by("fin_lancamentos.data_vencimento", "desc");
        $this->db->where("fin_lancamentos.deletado", 0);
        
         $objDateFormat = $this->DateFormat;

        if($dados==null){
          //BUSCAR A DATA DO MÊS
          $primeiro_dia = date('Y-m-01'); 
          $ultimo_dia = date("Y-m-t");
          $this->db->where("DATE(fin_lancamentos.data_vencimento) BETWEEN '$primeiro_dia' AND '$ultimo_dia'");
        //FINAL DATA DO MÊS
        }

        
    	
        $data_de = $dados["data_de"];
        $data_ate = $dados["data_ate"];
           
         
         if ($data_de != NULL && $data_ate != NULL):
                 $objDateFormat = $this->DateFormat;
                 $data_de = $objDateFormat->date_mysql($data_de);
                 $data_ate = $objDateFormat->date_mysql($data_ate);
                
              $this->db->where("fin_lancamentos.data_vencimento BETWEEN '$data_de' AND '$data_ate'");
         endif;
         
         
         if($dados['status']!=NULL){
             $this->db->where("status",$dados['status']);
         }

         if($dados['id_forma']!=NULL){
             $this->db->where("fin_lancamentos.id_forma",$dados['id_forma']);
         }

        //dados adicionais de contas pagar
        if($tipo==CONTAS_PAGAR){
         if ($dados["descricao"] != NULL):
            $this->db->like("fin_contas.descricao", $dados["descricao"]);
         endif;

          if($dados['id_custo']!=NULL){
             $this->db->where("fin_contas.id_custo",$dados['id_custo']);
          }




        }

        if($tipo==CONTAS_RECEBER){
             if ($dados["id_pedido"] != NULL):
                $this->db->where("fin_contas.id_pedido",$dados['id_pedido']);
             endif;
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
    	$this->db->from("fin_lancamentos");
    	$this->db->where("id_lancamento",$id_lancmento);
      	$query = $this->db->get();
    
    	if($query==FALSE){
    		throw new Exception($this->db->_error_message(),$this->db->_error_number());
    	}

    	$objLanc = NULL;
    
    	if($query->num_rows()>0){
    		$dados = $query->row_array();
    		$objLanc = $this->Factory->createPojo("fin_lancamentos",$dados);
                
                //Conta
                $contaBusiness = $this->Factory->createBusiness("fin_contas");
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
        $this->db->from("fin_contas");
        $this->db->join('fin_lancamentos', 'fin_lancamentos.id_conta = fin_contas.id_conta');
        $this->db->order_by("fin_lancamentos.data_vencimento", "desc");
        $this->db->where("fin_contas.id_pedido",$id_pedido);
        
                     
        
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
    	$sucess = $this->db->update("fin_lancamentos",$objLanc->toArray());
    	
    	if(!$sucess){
    		throw new Exception($this->db->_error_message(),  $this->db->_error_number());
    	}
    
    }
    
    
    public function excluir($id_lancamento){
        $this->db->where('id_lancamento',$id_lancamento);
        $dados["deletado"] = DELETADO_SIM;
        $sucess = $this->db->update("fin_lancamentos",$dados);
         if(!$sucess){
             throw new Exception($this->db->_error_message(),$this->db->_error_number());
         }
    }

     public function excluir_por_conta($id_conta){
        $this->db->where('id_conta',$id_conta);
        $dados["deletado"] = DELETADO_SIM;
        $sucess = $this->db->update("fin_lancamentos",$dados);
         if(!$sucess){
             throw new Exception($this->db->_error_message(),$this->db->_error_number());
         }
    }


    public function alterar_forma_pagamento($dados){
        $this->db->where('id_lancamento',$dados['id_lancamento']);
                
        $sucess = $this->db->update("fin_lancamentos",$dados);
         if(!$sucess){
             throw new Exception($this->db->_error_message(),$this->db->_error_number());
         }
    }

    


     public function confirmar_faturamento_lanc($id_conta){
        $this->db->where('id_conta',$id_conta);
        $dados["deletado"] = DELETADO;
        $sucess = $this->db->update("fin_lancamentos",$dados);
         if(!$sucess){
             throw new Exception($this->db->_error_message(),$this->db->_error_number());
         }
    }


 }
?>
