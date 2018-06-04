<?php
/* Classe(DAO): Centro de custos
* Autor: Anderson Farias
* Última atualização: 03/07/2015
* Contato: andersonjfarias@yahoo.com.br
*/

class Fin_plano_contasDao extends CI_Model {
    

    public function connect(){
        $this->load->database();
    }

    public function disconnect(){
        $this->db->close();
    }


    public function cadastrar($objCusto){
        $sucess = $this->db->insert("fin_plano_contas",$objCusto->toArray());
        if(!$sucess){
            throw new Exception($this->db->_error_message(),$this->db->_error_number());
        }

        $cod_custo = $this->db->insert_id();

        return $cod_custo;
    }
    
    
    public function filtro($dados) {
     	
    	
        $this->db->select("*");
        $this->db->from("fin_plano_contas_cat");
        $this->db->join('fin_plano_contas', 'fin_plano_contas.id_plano_categoria = fin_plano_contas_cat.id_plano_categoria');
        $this->db->where("fin_plano_contas.deletado",DELETADO);
        $this->db->order_by("fin_plano_contas.classificacao");

        if ($dados["nome"] != NULL):
    		$this->db->like("fin_plano_contas.nome", $dados["nome"]);
    	endif;

        if ($dados["tipo_conta"] != NULL):
            $this->db->where("fin_plano_contas_cat.tipo_conta", $dados["tipo_conta"]);
        endif;

        if ($dados["classificacao"] != NULL):
            $this->db->where("fin_plano_contas.classificacao", $dados["classificacao"]);
        endif;

         if ($dados["id_plano_categoria"] != NULL):
            $this->db->where("fin_plano_contas.id_plano_categoria", $dados["id_plano_categoria"]);
        endif;


    	 
        $query = $this->db->get();
    
    	if ($query == FALSE) {
    		throw new Exception($this->db->_error_message(), $this->db->_error_number());
    	}
    
    	$listCusto = array();
    
    	if ($query != NULL) {
    		foreach ($query->result_array() as $dados) {
    
    			$listCusto[] = $this->visualizar($dados["id_plano"]);
    		}
    	}
    	return $listCusto;
    }

    public function listar_por_categoria($id_plano_categoria) {
        
        
        $this->db->select("*");
        $this->db->from("fin_plano_contas_cat");
        $this->db->join('fin_plano_contas', 'fin_plano_contas.id_plano_categoria = fin_plano_contas_cat.id_plano_categoria');
        $this->db->where("fin_plano_contas.deletado",DELETADO);
        $this->db->order_by("fin_plano_contas.classificacao");
        $this->db->where("fin_plano_contas.id_plano_categoria",$id_plano_categoria);

               
        $query = $this->db->get();
    
        if ($query == FALSE) {
            throw new Exception($this->db->_error_message(), $this->db->_error_number());
        }
    
        $listCusto = array();
    
        if ($query != NULL) {
            foreach ($query->result_array() as $dados) {
    
                $listCusto[] = $this->visualizar($dados["id_plano"]);
            }
        }
        return $listCusto;
    }
    
    
    

    
	
    
    public function visualizar($id_plano){
    	$this->db->from("fin_plano_contas");
    	$this->db->where("id_plano",$id_plano);
      	$query = $this->db->get();
    
    	if($query==FALSE){
    		throw new Exception($this->db->_error_message(),$this->db->_error_number());
    	}

    	$objCusto = NULL;
    
    	if($query->num_rows()>0){
    		$dados = $query->row_array();
    		$objCusto = $this->Factory->createPojo("fin_plano_contas",$dados);

             $grupoBusiness = $this->Factory->createBusiness("fin_plano_contas_cat");
             $objGrupo = $grupoBusiness->visualizar($objCusto->getId_plano_categoria());
             $objCusto->setGrupo($objGrupo);

    	}
    
    	return $objCusto;
    
    
    }
    
    
    public function alterar($objCusto){
    	$this->db->where('id_plano',$objCusto->getId_plano());
    	$sucess = $this->db->update("fin_plano_contas",$objCusto->toArray());
    	
    	if(!$sucess){
    		throw new Exception($this->db->_error_message(),  $this->db->_error_number());
    	}
    
    }
    
    
    public function excluir($id_plano){
        $this->db->where('id_plano',$id_plano);
        $dados["deletado"] = DELETADO_SIM;
        $sucess = $this->db->update("fin_plano_contas",$dados);
         if(!$sucess){
             throw new Exception($this->db->_error_message(),$this->db->_error_number());
         }
    }


 }
?>
