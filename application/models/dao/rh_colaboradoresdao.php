<?php
/* Classe(DAO): Colaboradores
* Autor: Anderson Farias
* Última atualização: 26/06/2015
* Contato: andersonjfarias@yahoo.com.br
*/

class Rh_colaboradoresDao extends CI_Model {
    

    public function connect(){
        $this->load->database();
    }

    public function disconnect(){
        $this->db->close();
    }


    public function cadastrar($objUser){
        $sucess = $this->db->insert("rh_colaboradores",$objUser->toArray());
        if(!$sucess){
            throw new Exception($this->db->_error_message(),$this->db->_error_number());
        }

        $cod_colaborador = $this->db->insert_id();

        return $cod_colaborador;
    }
    
    
    public function filtro($dados) {
     	
    	$this->db->from("rh_colaboradores");
    	$this->db->order_by("nome");
    	$this->db->where("deletado",DELETADO);
    	
    	if ($dados["nome"] != NULL):
    		$this->db->like("nome", $dados["nome"]);
    	endif;
        
        if ($dados["id_cargo"] != NULL):
    		$this->db->where("id_cargo", $dados["id_cargo"]);
    	endif;
                
    	 
        $query = $this->db->get();
    
    	if ($query == FALSE) {
    		throw new Exception($this->db->_error_message(), $this->db->_error_number());
    	}
    
    	$listColaborador = array();
    
    	if ($query != NULL) {
    		foreach ($query->result_array() as $dados) {
    
    			$listColaborador[] = $this->visualizar($dados["id_colaborador"]);
    		}
    	}
    	return $listColaborador;
    }
    
    
    public function visualizar($id_colaborador){
    	$this->db->from("rh_colaboradores");
    	$this->db->where("id_colaborador",$id_colaborador);
      	$query = $this->db->get();
    
    	if($query==FALSE){
    		throw new Exception($this->db->_error_message(),$this->db->_error_number());
    	}

    	$objColaborador = NULL;
    
    	if($query->num_rows()>0){
    		$dados = $query->row_array();
    		$objColaborador = $this->Factory->createPojo("rh_colaboradores",$dados);
                
                $cargoBusiness = $this->Factory->createBusiness("rh_cargos");
                $objCargo = $cargoBusiness->visualizar($objColaborador->getId_cargo());
                $objColaborador->setCargo($objCargo);
                
                
                
    	}
    
    	return $objColaborador;
    
    
    }
    
    
    public function alterar($objColaborador){
    	$this->db->where('id_colaborador',$objColaborador->getId_colaborador());
    	$sucess = $this->db->update("rh_colaboradores",$objColaborador->toArray());
    	
    	if(!$sucess){
    		throw new Exception($this->db->_error_message(),  $this->db->_error_number());
    	}
    
    }
    
    
    public function excluir($id_colaborador){
        $this->db->where('id_colaborador',$id_colaborador);
        $dados["deletado"] = DELETADO_SIM;
        $sucess = $this->db->update("rh_colaboradores",$dados);
         if(!$sucess){
             throw new Exception($this->db->_error_message(),$this->db->_error_number());
         }
    }



    public function comissao($dados) {
        
               
        $this->db->select('c.nome,c.id_colaborador');
        $this->db->from("rh_colaboradores c");
        $this->db->join('acesso_usuarios u', 'c.id_colaborador = u.id_colaborador');
        //$this->db->join('com_pedidos', 'fin_contas_receber.id_pedido = com_pedidos.id_pedido');
        //$this->db->order_by("fin_lancamentos_receber.data_vencimento", "desc");
        //$this->db->order_by("fin_lancamentos_receber.id_lancamento", "desc");
        //$this->db->where("fin_lancamentos_receber.deletado", 0);

        
        $objDateFormat = $this->DateFormat;

        /*if($dados==null){
        
          $primeiro_dia = date('Y-m-01'); 
          $ultimo_dia = date("Y-m-t");
          $this->db->where("DATE(fin_lancamentos_receber.data_vencimento) BETWEEN '$primeiro_dia' AND '$ultimo_dia'");
        
        }

        
        
        $data_de = $dados["data_de"];
        $data_ate = $dados["data_ate"];
           
         
         if ($data_de != NULL && $data_ate != NULL):
                 $objDateFormat = $this->DateFormat;
                 $data_de = $objDateFormat->date_mysql($data_de);
                 $data_ate = $objDateFormat->date_mysql($data_ate);
                
              $this->db->where("fin_lancamentos_receber.data_vencimento BETWEEN '$data_de' AND '$data_ate'");
         endif;

         */
         
      
                


        $query = $this->db->get();
    
        if ($query == FALSE) {
            throw new Exception($this->db->_error_message(), $this->db->_error_number());
        }
    
       $listColaborador = array();
    
        if ($query != NULL) {
            foreach ($query->result_array() as $dados) {
    
                $listColaborador[] = $this->visualizar($dados["id_colaborador"]);
            }
        }
        return $listColaborador;

    }





 }
?>
