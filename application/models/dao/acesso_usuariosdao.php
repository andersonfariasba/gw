<?php
/* Classe(DAO): Usuários
* Autor: Anderson Farias
* Última atualização: 25/06/2015
* Contato: andersonjfarias@yahoo.com.br
*/

class Acesso_usuariosDao extends CI_Model {
    

    public function connect(){
        $this->load->database();
    }

    public function disconnect(){
        $this->db->close();
    }


    public function cadastrar($objUser){
        $sucess = $this->db->insert("acesso_usuarios",$objUser->toArray());
        if(!$sucess){
            throw new Exception($this->db->_error_message(),$this->db->_error_number());
        }

        $cod_user = $this->db->insert_id();

        return $cod_user;
    }
    
    
    public function filtro($dados) {
     	
    	$this->db->from("acesso_usuarios");
    	$this->db->order_by("login");
    	$this->db->where("deletado",DELETADO);
         $this->db->where_not_in('id_usuario',CODIGO_VELLORE);
    	
    	if ($dados["login"] != NULL):
    		$this->db->like("login", $dados["login"]);
    	endif;


        if ($dados["id_perfil"] != NULL):
            $this->db->where("id_perfil", $dados["id_perfil"]);
        endif;
    	 
        $query = $this->db->get();
    
    	if ($query == FALSE) {
    		throw new Exception($this->db->_error_message(), $this->db->_error_number());
    	}
    
    	$listUser = array();
    
    	if ($query != NULL) {
    		foreach ($query->result_array() as $dados) {
    
    			$listUser[] = $this->visualizar($dados["id_usuario"]);
    		}
    	}
    	return $listUser;
    }

    public function listar_por_perfil($id_perfil) {
        
        //$this->db->from("acesso_usuarios");
        //$this->db->order_by("login");
        //$this->db->where("deletado",DELETADO);
        $this->db->select('*');
        $this->db->from("acesso_usuarios");
        $this->db->join('rh_colaboradores', 'rh_colaboradores.id_colaborador = acesso_usuarios.id_colaborador');
        $this->db->where("acesso_usuarios.id_perfil",$id_perfil);
        $this->db->order_by("rh_colaboradores.nome", "asc");
        $this->db->where("acesso_usuarios.deletado", 0);
  
      
         
        $query = $this->db->get();
    
        if ($query == FALSE) {
            throw new Exception($this->db->_error_message(), $this->db->_error_number());
        }
    
        $listUser = array();
    
        if ($query != NULL) {
            foreach ($query->result_array() as $dados) {
    
                $listUser[] = $this->visualizar($dados["id_usuario"]);
            }
        }
        return $listUser;
    }
    
    
    public function visualizar_por_email($email){
    	$this->db->from("acesso_usuarios");
    	$this->db->where("email",$email);
      	$query = $this->db->get();
    
    	if($query==FALSE){
    		throw new Exception($this->db->_error_message(),$this->db->_error_number());
    	}

    	$objUser = NULL;
    
    	if($query->num_rows()>0){
    		$dados = $query->row_array();
    		$objUser = $this->Factory->createPojo("acesso_usuarios",$dados);
                
                $perfilBusiness = $this->Factory->createBusiness("acesso_perfil");
                $objPerfil = $perfilBusiness->visualizar($objUser->getId_perfil());
                $objUser->setPerfil($objPerfil);

                $colaboradorBusiness = $this->Factory->createBusiness("rh_colaboradores");
                $objColaborador = $colaboradorBusiness->visualizar($objUser->getId_colaborador());
                $objUser->setColaborador($objColaborador);
                
                
                
    	}
    
    	return $objUser;
    
    
    }

    

    public function visualizar($id_usuario){
        $this->db->from("acesso_usuarios");
        $this->db->where("id_usuario",$id_usuario);
        $query = $this->db->get();
    
        if($query==FALSE){
            throw new Exception($this->db->_error_message(),$this->db->_error_number());
        }

        $objUser = NULL;
    
        if($query->num_rows()>0){
            $dados = $query->row_array();
            $objUser = $this->Factory->createPojo("acesso_usuarios",$dados);
                
                $perfilBusiness = $this->Factory->createBusiness("acesso_perfil");
                $objPerfil = $perfilBusiness->visualizar($objUser->getId_perfil());
                $objUser->setPerfil($objPerfil);

                $colaboradorBusiness = $this->Factory->createBusiness("rh_colaboradores");
                $objColaborador = $colaboradorBusiness->visualizar($objUser->getId_colaborador());
                $objUser->setColaborador($objColaborador);
                
                
                
        }
    
        return $objUser;
    
    
    }
    
    
    
    public function alterar($objUser){
    	$this->db->where('id_usuario',$objUser->getId_usuario());
    	$sucess = $this->db->update("acesso_usuarios",$objUser->toArray());
    	
    	if(!$sucess){
    		throw new Exception($this->db->_error_message(),  $this->db->_error_number());
    	}
    
    }
    
    
    public function excluir($id_usuario){
        $this->db->where('id_usuario',$id_usuario);
        $dados["deletado"] = DELETADO_SIM;
        $sucess = $this->db->update("acesso_usuarios",$dados);
         if(!$sucess){
             throw new Exception($this->db->_error_message(),$this->db->_error_number());
         }
    }
    
    
    //visualiza os dados referente a um cargo.
    public function getByLoginSenha($login,$senha){
        $this->db->from("acesso_usuarios"); //tabela
        $this->db->where("login",$login); //coluna e o código passado como parametro
         $this->db->where("senha",md5($senha.CRIPTOGRAFIA));
        //$this->db->where("senha",$senha);
        $this->db->where("deletado",DELETADO);
        
        $query = $this->db->get();

        if($query==FALSE){
            throw new Exception($this->db->_error_message(),$this->db->_error_number());
        }
        $objUser = NULL;

        if($query->num_rows()>0){
            //pega os dados
            $dados = $query->row_array();
            $objUser = $this->Factory->createPojo("acesso_usuarios",$dados);
            
            //visualizar perfil
                $perfilBussiness = $this->Factory->createBusiness("acesso_perfil");
                $objPerfil = $perfilBussiness->visualizar($objUser->getId_perfil());
                $objUser->setPerfil($objPerfil);

                 $colaboradorBusiness = $this->Factory->createBusiness("rh_colaboradores");
                $objColaborador = $colaboradorBusiness->visualizar($objUser->getId_colaborador());
                $objUser->setColaborador($objColaborador);
            
                           
        }

        return $objUser;

        
    }

     public function listar_aprovador($perfil){
        
        //$this->db->from("acesso_usuarios");
        //$this->db->order_by("login");
        //$this->db->where("deletado",DELETADO);
        $this->db->select('*');
        $this->db->from("acesso_usuarios");
        $this->db->join('rh_colaboradores', 'rh_colaboradores.id_colaborador = acesso_usuarios.id_colaborador');
        $this->db->where_in("acesso_usuarios.id_perfil",$perfil);
        $this->db->order_by("rh_colaboradores.nome", "asc");
        $this->db->where("acesso_usuarios.deletado", 0);
  
      
         
        $query = $this->db->get();
    
        if ($query == FALSE) {
            throw new Exception($this->db->_error_message(), $this->db->_error_number());
        }
    
        $listUser = array();
    
        if ($query != NULL) {
            foreach ($query->result_array() as $dados) {
    
                $listUser[] = $this->visualizar($dados["id_usuario"]);
            }
        }
        return $listUser;
    }



 }
?>
