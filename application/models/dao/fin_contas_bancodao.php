<?php
/* Classe(DAO): Categoria de produtos
* Autor: Anderson Farias
* Última atualização: 28/06/2015
* Contato: andersonjfarias@yahoo.com.br
*/

class Fin_contas_bancoDao extends CI_Model {
    

    public function connect(){
        $this->load->database();
    }

    public function disconnect(){
        $this->db->close();
    }


    public function cadastrar($objConta){
        $sucess = $this->db->insert("fin_contas_banco",$objConta->toArray());
        if(!$sucess){
            throw new Exception($this->db->_error_message(),$this->db->_error_number());
        }

        $cod_banco = $this->db->insert_id();

        return $cod_banco;
    }
    
    
    public function filtro($dados) {
     	
    	$this->db->from("fin_contas_banco");
    	$this->db->order_by("banco");
    	$this->db->where("deletado",DELETADO);
    	
    	if ($dados["banco"] != NULL):
    		$this->db->like("banco", $dados["banco"]);
    	endif;

        if ($dados["id_filial"] != NULL):
            $this->db->where("id_filial", $dados["id_filial"]);
        endif;


    	 
        $query = $this->db->get();
    
    	if ($query == FALSE) {
    		throw new Exception($this->db->_error_message(), $this->db->_error_number());
    	}
    
    	$listConta = array();
    
    	if ($query != NULL) {
    		foreach ($query->result_array() as $dados) {
    
    			$listConta[] = $this->visualizar($dados["id_conta_banco"]);
    		}
    	}
    	return $listConta;
    }
    
    

    //NÃO USADO, LISTAGEM SIMPLES
    public function listar(){
        $this->db->from("fin_contas_banco");
        $this->db->order_by("banco");
        $this->db->where("deletado",DELETADO);
		
        $query = $this->db->get();

        if($query==FALSE){
            throw new Exception($this->db->_error_message(),  $this->db->_error_number());
        }

        $listConta = array();

          if($query!=NULL){
              foreach ($query->result_array() as $dados){

                 $objConta = $this->Factory->createPojo("fin_contas_banco",$dados);
                 $listConta[] = $objConta;
				  
	      }
          }

          return $listConta;

    }


 
    
    public function visualizar($id_conta){
    	$this->db->from("fin_contas_banco");
    	$this->db->where("id_conta_banco",$id_conta);
      	$query = $this->db->get();
    
    	if($query==FALSE){
    		throw new Exception($this->db->_error_message(),$this->db->_error_number());
    	}

    	$objConta = NULL;
    
    	if($query->num_rows()>0){
    		$dados = $query->row_array();
    		$objConta = $this->Factory->createPojo("fin_contas_banco",$dados);

             //FILIAL
             $filialBusiness = $this->Factory->createBusiness("fin_filiais");
             $objFilial = $filialBusiness->visualizar($objConta->getId_filial());
             $objConta->setFilial($objFilial);
    	}
    
    	return $objConta;
    
    
    }
    
    
    public function alterar($objConta){
    	$this->db->where('id_conta_banco',$objConta->getId_conta_banco());
    	$sucess = $this->db->update("fin_contas_banco",$objConta->toArray());
    	
    	if(!$sucess){
    		throw new Exception($this->db->_error_message(),  $this->db->_error_number());
    	}
    
    }
    
    
    public function excluir($id_conta){
        $this->db->where('id_conta_banco',$id_conta);
        $dados["deletado"] = DELETADO_SIM;
        $sucess = $this->db->update("fin_contas_banco",$dados);
         if(!$sucess){
             throw new Exception($this->db->_error_message(),$this->db->_error_number());
         }
    }

     

 }
?>
