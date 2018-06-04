<?php
/* Classe(DAO): Bandeira Cartão
* Autor: Anderson Farias
* Última atualização: 15/07/2015
* Contato: andersonjfarias@yahoo.com.br
*/

class Fin_bandeira_cartaoDao extends CI_Model {
    

    public function connect(){
        $this->load->database();
    }

    public function disconnect(){
        $this->db->close();
    }


    public function cadastrar($objBandeira){
        $sucess = $this->db->insert("fin_bandeira_cartao",$objBandeira->toArray());
        if(!$sucess){
            throw new Exception($this->db->_error_message(),$this->db->_error_number());
        }

        $cod_bandeira = $this->db->insert_id();

        return $cod_bandeira;
    }
    
    
    public function filtro($dados) {
     	
    	$this->db->from("fin_bandeira_cartao");
    	$this->db->order_by("bandeira");
    	$this->db->where("deletado",DELETADO);
    	
    	if ($dados["bandeira"] != NULL):
    		$this->db->like("bandeira", $dados["bandeira"]);
    	endif;
    	 
        $query = $this->db->get();
    
    	if ($query == FALSE) {
    		throw new Exception($this->db->_error_message(), $this->db->_error_number());
    	}
    
    	$listBandeira = array();
    
    	if ($query != NULL) {
    		foreach ($query->result_array() as $dados) {
    
    			$listBandeira[] = $this->visualizar($dados["id_bandeira"]);
    		}
    	}
    	return $listBandeira;
    }
    
    

    //NÃO USADO, LISTAGEM SIMPLES
    public function listar(){
        $this->db->from("fin_bandeira_cartao");
        $this->db->order_by("bandeira");
        $this->db->where("deletado",DELETADO);
		
        $query = $this->db->get();

        if($query==FALSE){
            throw new Exception($this->db->_error_message(),  $this->db->_error_number());
        }

        $listBandeira = array();

          if($query!=NULL){
              foreach ($query->result_array() as $dados){

                 $objBandeira = $this->Factory->createPojo("fin_bandeira_cartao",$dados);
                 $listBandeira[] = $objBandeira;
				  
	      }
          }

          return $listBandeira;

    }


     public function listarPorForma($id_forma){
        $this->db->from("fin_bandeira_cartao");
        $this->db->order_by("bandeira");
        $this->db->where("id_forma",$id_forma);
        $this->db->where("deletado",DELETADO);
        
        $query = $this->db->get();

        if($query==FALSE){
            throw new Exception($this->db->_error_message(),  $this->db->_error_number());
        }

        $listBandeira = array();

          if($query!=NULL){
              foreach ($query->result_array() as $dados){

                // $objBandeira = $this->Factory->createPojo("fin_bandeira_cartao",$dados);
                // $listBandeira[] = $objBandeira;

                $listBandeira[] = array(
               'id_bandeira'   => $dados['id_bandeira'],
               'bandeira'      => $dados['bandeira'],
               );
                  
          }
          }

          return $listBandeira;

    }


	
	
    
    public function visualizar($id_bandeira){
    	$this->db->from("fin_bandeira_cartao");
    	$this->db->where("id_bandeira",$id_bandeira);
      	$query = $this->db->get();
    
    	if($query==FALSE){
    		throw new Exception($this->db->_error_message(),$this->db->_error_number());
    	}

    	$objBandeira = NULL;
    
    	if($query->num_rows()>0){
    		$dados = $query->row_array();
    		$objBandeira = $this->Factory->createPojo("fin_bandeira_cartao",$dados);
                
                 //Forma de pagamento
                $formaBusiness = $this->Factory->createBusiness("fin_formas_recebimentos");
                $objForma = $formaBusiness->visualizar($objBandeira->getId_forma());
                $objBandeira->setForma($objForma);

                 //Forma de pagamento
                $operadoraBusiness = $this->Factory->createBusiness("fin_operadoras_cartao");
                $objOperadora = $operadoraBusiness->visualizar($objBandeira->getId_operadora());
                $objBandeira->setOperadora($objOperadora);
    	}
    
    	return $objBandeira;
    
    
    }
    
    
    public function alterar($objBandeira){
    	$this->db->where('id_bandeira',$objBandeira->getId_bandeira());
    	$sucess = $this->db->update("fin_bandeira_cartao",$objBandeira->toArray());
    	
    	if(!$sucess){
    		throw new Exception($this->db->_error_message(),  $this->db->_error_number());
    	}
    
    }
    
    
    public function excluir($id_bandeira){
        $this->db->where('id_bandeira',$id_bandeira);
        $dados["deletado"] = DELETADO_SIM;
        $sucess = $this->db->update("fin_bandeira_cartao",$dados);
         if(!$sucess){
             throw new Exception($this->db->_error_message(),$this->db->_error_number());
         }
    }


    public function listarPorOperadora($id_operadora){
        $this->db->from("fin_bandeira_cartao");
        $this->db->order_by("bandeira");
        $this->db->where("id_operadora",$id_operadora);
        $this->db->where("deletado",DELETADO);
        
        $query = $this->db->get();

        if($query==FALSE){
            throw new Exception($this->db->_error_message(),  $this->db->_error_number());
        }

        $listBandeira = array();

          if($query!=NULL){
              foreach ($query->result_array() as $dados){

                // $objBandeira = $this->Factory->createPojo("fin_bandeira_cartao",$dados);
                // $listBandeira[] = $objBandeira;

                $listBandeira[] = array(
               'id_bandeira'   => $dados['id_bandeira'],
               'bandeira'      => $dados['bandeira'],
               );
                  
          }
          }

          return $listBandeira;

    }




 }
?>
