<?php
/* Classe(DAO): Formas de Pagamentos
* Autor: Anderson Farias
* Última atualização: 03/07/2015
* Contato: andersonjfarias@yahoo.com.br
*/

class Fin_forma_pag_fatDao extends CI_Model {
    

    public function connect(){
        $this->load->database();
    }

    public function disconnect(){
        $this->db->close();
    }


    public function cadastrar($objForma){
        $sucess = $this->db->insert("fin_forma_pag_fat",$objForma->toArray());
        if(!$sucess){
            throw new Exception($this->db->_error_message(),$this->db->_error_number());
        }

        $cod_forma = $this->db->insert_id();

        return $cod_forma;
    }
    
    
    public function filtro($dados) {
     	
    	$this->db->from("fin_forma_pag_fat");
    	$this->db->order_by("data");
    
    	
    	if ($dados["id_forma"] != NULL):
    		$this->db->where("id_forma", $dados["id_forma"]);
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
    
    
       
    
    public function visualizar($id_forma_fat){
    	$this->db->from("fin_forma_pag_fat");
    	$this->db->where("id_forma_fat",$id_forma_fat);
      	$query = $this->db->get();
    
    	if($query==FALSE){
    		throw new Exception($this->db->_error_message(),$this->db->_error_number());
    	}

    	$objForma = NULL;
    
    	if($query->num_rows()>0){
    		$dados = $query->row_array();
    		$objForma = $this->Factory->createPojo("fin_forma_pag_fat",$dados);
    	}
    
    	return $objForma;
    
    
    }


    public function ajax_listar_faturamento($id_pedido){
        /*$this->db->from("fin_forma_pag_fat");
        $this->db->order_by("id_forma_fat");
        $this->db->where("id_pedido",$id_pedido);*/

        $this->db->select('*');
        $this->db->from("fin_forma_pag_fat");
        $this->db->join('fin_formas_recebimentos', 'fin_formas_recebimentos.id_forma = fin_forma_pag_fat.id_forma');
        $this->db->where("fin_forma_pag_fat.id_pedido",$id_pedido);
      
        
        $query = $this->db->get();

        if($query==FALSE){
            throw new Exception($this->db->_error_message(),  $this->db->_error_number());
        }

        $listFat = array();

          if($query!=NULL){
              foreach ($query->result_array() as $dados){

                // $objBandeira = $this->Factory->createPojo("fin_bandeira_cartao",$dados);
                // $listBandeira[] = $objBandeira;

                $listFat[] = array(
               'id_forma_fat'   => $dados['id_forma_fat'],
               'id_forma'   => $dados['id_forma'],
               'id_bandeira'      => $dados['id_bandeira'],
               'valor'      => $dados['valor'],
               'parcela'      => $dados['parcela'],
               'forma'      => $dados['forma'],
               );
                  
          }
          }

          return $listFat;

    }


      public function excluir($id_forma_fat){
        $this->db->where('id_forma_fat',$id_forma_fat);
        //$dados["deletado"] = DELETADO_SIM;
        $sucess = $this->db->delete("fin_forma_pag_fat");
         if(!$sucess){
             throw new Exception($this->db->_error_message(),$this->db->_error_number());
         }
    }

    
    
   


 }
?>
