<?php
/* Classe(DAO): Formas de Pagamentos
* Autor: Anderson Farias
* Última atualização: 03/07/2015
* Contato: andersonjfarias@yahoo.com.br
*/

class Fin_formas_pagamentosDao extends CI_Model {
    

    public function connect(){
        $this->load->database();
    }

    public function disconnect(){
        $this->db->close();
    }


    public function cadastrar($objForma){
        $sucess = $this->db->insert("fin_formas_pagamentos",$objForma->toArray());
        if(!$sucess){
            throw new Exception($this->db->_error_message(),$this->db->_error_number());
        }

        $cod_forma = $this->db->insert_id();

        return $cod_forma;
    }
    
    
    public function filtro($dados) {
     	
    	$this->db->from("fin_formas_pagamentos");
    	$this->db->order_by("forma");
    	$this->db->where("deletado",DELETADO);
    	
    	
       if(isset($dados['forma'])):
        if($dados["forma"] != NULL):
    		$this->db->like("forma", $dados["forma"]);
    	endif;
       endif;

            
         
        $query = $this->db->get();
    
    	if ($query == FALSE) {
    		throw new Exception($this->db->_error_message(), $this->db->_error_number());
    	}
    
    	$listForma = array();
    
    	if ($query != NULL) {
    		foreach ($query->result_array() as $dados) {
    
    			$listForma[] = $this->visualizar($dados["id_forma"]);
    		}
    	}
    	return $listForma;
    }
    
    
    public function visualizarFormaCartao($cartao) {
     	
    	$this->db->from("fin_formas_pagamentos");
    	$this->db->order_by("forma");
    	$this->db->where("deletado",DELETADO);
    	
    	if($cartao != NULL):
    		$this->db->where("cartao",$cartao);
    	endif;
        
         
        $query = $this->db->get();
    
    	if ($query == FALSE) {
    		throw new Exception($this->db->_error_message(), $this->db->_error_number());
    	}
    
    	$listForma = array();
    
    	if ($query != NULL) {
    		foreach ($query->result_array() as $dados) {
    
    			$listForma[] = $this->visualizar($dados["id_forma"]);
    		}
    	}
    	return $listForma;
    }
    
    
    public function visualizar($id_forma){
    	$this->db->from("fin_formas_pagamentos");
    	$this->db->where("id_forma",$id_forma);
      	$query = $this->db->get();
    
    	if($query==FALSE){
    		throw new Exception($this->db->_error_message(),$this->db->_error_number());
    	}

    	$objForma = NULL;
    
    	if($query->num_rows()>0){
    		$dados = $query->row_array();
    		$objForma = $this->Factory->createPojo("fin_formas_pagamentos",$dados);
    	}
    
    	return $objForma;
    
    
    }
    
    
    public function alterar($objForma){
    	$this->db->where('id_forma',$objForma->getId_forma());
    	$sucess = $this->db->update("fin_formas_pagamentos",$objForma->toArray());
    	
    	if(!$sucess){
    		throw new Exception($this->db->_error_message(),  $this->db->_error_number());
    	}
    
    }
    
    
    public function excluir($id_forma){
        $this->db->where('id_forma',$id_forma);
        $dados["deletado"] = DELETADO_SIM;
        $sucess = $this->db->update("fin_formas_pagamentos",$dados);
         if(!$sucess){
             throw new Exception($this->db->_error_message(),$this->db->_error_number());
         }
    }


      public function ajax_listar($disponivel){
        $this->db->from("fin_formas_pagamentos");
        $this->db->order_by("forma");
        $this->db->where("deletado",DELETADO);
          $this->db->where("status",ATIVO);
     
        
        $query = $this->db->get();

        if($query==FALSE){
            throw new Exception($this->db->_error_message(),  $this->db->_error_number());
        }

        $listForma = array();

          if($query!=NULL){
              foreach ($query->result_array() as $dados){

                // $objBandeira = $this->Factory->createPojo("fin_bandeira_cartao",$dados);
                // $listBandeira[] = $objBandeira;

                $listForma[] = array(
               'id_forma'   => $dados['id_forma'],
               'forma'      => $dados['forma'],
               'cartao'      => $dados['cartao'],
               );
                  
          }
          }

          return $listForma;

    }



     public function verificar_cartao($id_forma){
        $this->db->from("fin_formas_pagamentos");
        $this->db->order_by("forma");
        $this->db->where("deletado",DELETADO);
        $this->db->where('id_forma',$id_forma);
         $this->db->where('cartao',SIM);

        
        $query = $this->db->get();

        if($query==FALSE){
            throw new Exception($this->db->_error_message(),  $this->db->_error_number());
        }

        $listForma = array();

          if($query!=NULL){
              foreach ($query->result_array() as $dados){

                // $objBandeira = $this->Factory->createPojo("fin_bandeira_cartao",$dados);
                // $listBandeira[] = $objBandeira;

                $listForma[] = array(
               'id_forma'   => $dados['id_forma'],
               'forma'      => $dados['forma'],
               'cartao'      => $dados['cartao'],
               );
                  
          }
          }

          return $listForma;

    }



 }
?>
