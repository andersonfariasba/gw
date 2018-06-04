<?php
/* Classe(DAO): Centro de custos
* Autor: Anderson Farias
* Última atualização: 03/07/2015
* Contato: andersonjfarias@yahoo.com.br
*/

class Fin_plano_contas_catDao extends CI_Model {
    

    public function connect(){
        $this->load->database();
    }

    public function disconnect(){
        $this->db->close();
    }


    public function cadastrar($objCusto){
        $sucess = $this->db->insert("fin_plano_contas_cat",$objCusto->toArray());
        if(!$sucess){
            throw new Exception($this->db->_error_message(),$this->db->_error_number());
        }

        $cod_custo = $this->db->insert_id();

        return $cod_custo;
    }
    
    
    public function filtro($dados) {
     	
    	$this->db->from("fin_plano_contas_cat");
    	$this->db->order_by("classificacao");
    	$this->db->where("deletado",DELETADO);
    	
    	if ($dados["nome"] != NULL):
    		$this->db->like("nome", $dados["nome"]);
    	endif;
    	 
        $query = $this->db->get();
    
    	if ($query == FALSE) {
    		throw new Exception($this->db->_error_message(), $this->db->_error_number());
    	}
    
    	$listCusto = array();
    
    	if ($query != NULL) {
    		foreach ($query->result_array() as $dados) {
    
    			$listCusto[] = $this->visualizar($dados["id_plano_categoria"]);
    		}
    	}
    	return $listCusto;
    }

     public function listar_por_tipo($tipo_conta) {
      
      $this->db->from("fin_plano_contas_cat");
      $this->db->order_by("classificacao");
      $this->db->where("deletado",DELETADO);
      $this->db->where("tipo_conta",$tipo_conta);
      
           
        $query = $this->db->get();
    
      if ($query == FALSE) {
        throw new Exception($this->db->_error_message(), $this->db->_error_number());
      }
    
      $listCusto = array();
    
      if ($query != NULL) {
        foreach ($query->result_array() as $dados) {
    
          $listCusto[] = $this->visualizar($dados["id_plano_categoria"]);
        }
      }
      return $listCusto;
    }

     //Listar por tipo de conta
     public function ajax_listar_tipo($tipo_conta){
        $this->db->from("fin_plano_contas_cat");
        $this->db->where("tipo_conta",$tipo_conta);
         $this->db->where("deletado",DELETADO);
        $this->db->order_by("classificacao","asc");

        $query = $this->db->get();

        if($query==FALSE){
            throw new Exception($this->db->_error_message(),  $this->db->_error_number());
        }

        $listCategoria = array();

          if($query!=NULL){
              foreach ($query->result_array() as $dados){

                // $objBandeira = $this->Factory->createPojo("fin_bandeira_cartao",$dados);
                // $listBandeira[] = $objBandeira;

                $listCategoria[] = array(
               'id_plano_categoria'   => $dados['id_plano_categoria'],
               'classificacao'      => $dados['classificacao'],
               'nome'      => $dados['nome'],
               );
                  
          }

          }

          return $listCategoria;

    }

    public function ajax_visualizar_grupo($id_plano_categoria){
        $this->db->from("fin_plano_contas_cat");
        $this->db->where("id_plano_categoria",$id_plano_categoria);
        //$this->db->where("deletado",DELETADO);
        //$this->db->order_by("classificacao","asc");

        $query = $this->db->get();

        if($query==FALSE){
            throw new Exception($this->db->_error_message(),  $this->db->_error_number());
        }

        $listCategoria = array();

          if($query!=NULL){
              foreach ($query->result_array() as $dados){

                // $objBandeira = $this->Factory->createPojo("fin_bandeira_cartao",$dados);
                // $listBandeira[] = $objBandeira;

                $listCategoria[] = array(
               'id_plano_categoria'   => $dados['id_plano_categoria'],
               'classificacao'      => $dados['classificacao'],
               'nome'      => $dados['nome'],
               );
                  
          }

          }

          return $listCategoria;

    }

    
    

    
	
    
    public function visualizar($id_plano_categoria){
    	$this->db->from("fin_plano_contas_cat");
    	$this->db->where("id_plano_categoria",$id_plano_categoria);
      	$query = $this->db->get();
    
    	if($query==FALSE){
    		throw new Exception($this->db->_error_message(),$this->db->_error_number());
    	}

    	$objCusto = NULL;
    
    	if($query->num_rows()>0){
    		$dados = $query->row_array();
    		$objCusto = $this->Factory->createPojo("fin_plano_contas_cat",$dados);
    	}
    
    	return $objCusto;
    
    
    }
    
    
    public function alterar($objCusto){
    	$this->db->where('id_plano_categoria',$objCusto->getId_plano_categoria());
    	$sucess = $this->db->update("fin_plano_contas_cat",$objCusto->toArray());
    	
    	if(!$sucess){
    		throw new Exception($this->db->_error_message(),  $this->db->_error_number());
    	}
    
    }
    
    
    public function excluir($id_plano_categoria){
        $this->db->where('id_plano_categoria',$id_plano_categoria);
        $dados["deletado"] = DELETADO_SIM;
        $sucess = $this->db->update("fin_plano_contas_cat",$dados);
         if(!$sucess){
             throw new Exception($this->db->_error_message(),$this->db->_error_number());
         }
    }


 }
?>
