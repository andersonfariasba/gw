<?php
/* Classe(business): Perfil de usuários 
 * Autor: Anderson Farias
 * Última atualização: 23/06/2015
 * Contato: andersonjfarias@yahoo.com.br
 */

class Acesso_perfilBusiness extends CI_Model {

    //CADASTRA
	public function cadastrar($dados){
        try {

            $objPerfil = $this->Factory->createPojo("acesso_perfil",$dados);
            $perfilDao = $this->Factory->createDao("acesso_perfil");
            $perfilDao->connect();
            $cod_perfil = $perfilDao->cadastrar($objPerfil);
		    $perfilDao->disconnect();
		    return $cod_perfil;
	        
        } 
        
        catch (Exception $exc) {
	        throw $exc;
        }
    }

    //LISTA
    public function filtro($dados=null){
    	try {
    		
    	    $perfilDao = $this->Factory->createDao("acesso_perfil");
            $perfilDao->connect();
            $listPerfil = $perfilDao->filtro($dados);
            $perfilDao->disconnect();
            return $listPerfil;

            } catch (Exception $exc) {
                throw $exc;
            }
    }
    
    //VISUALIZA
    public function visualizar($id_perfil){
    	try {
    	    $perfilDao = $this->Factory->createDao("acesso_perfil");
            $perfilDao->connect();
            $objPerfil = $perfilDao->visualizar($id_perfil);
            $perfilDao->disconnect();
            return $objPerfil;
                
            } catch (Exception $exc) {
                throw $exc;
            }
    }
    
    
    //EDITAR
    public function editar($dados){
    	try {
    	    $objPerfil = $this->Factory->createPojo("acesso_perfil",$dados);
            $perfilDao = $this->Factory->createDao("acesso_perfil");
            $perfilDao->connect();
            $perfilDao->alterar($objPerfil);
            $perfilDao->disconnect();
                
            } catch (Exception $exc) {
                throw $exc;
            }
    }
    
    //EXCLUSÃO
    public function excluir($id_perfil){
    	try {
    	    $perfilDao = $this->Factory->createDao("acesso_perfil");
            $perfilDao->connect();
            $perfilDao->excluir($id_perfil);
            $perfilDao->disconnect();
    	} catch (Exception $exc) {
                throw $exc;
            }
    }




}
?>
