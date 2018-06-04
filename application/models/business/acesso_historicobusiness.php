<?php
/* Classe(business): Perfil de usuários 
 * Autor: Anderson Farias
 * Última atualização: 23/06/2015
 * Contato: andersonjfarias@yahoo.com.br
 */

class Acesso_historicoBusiness extends CI_Model {

    //CADASTRA
	public function cadastrar($dados){
        try {

            $objHistorico = $this->Factory->createPojo("acesso_historico",$dados);
            $historicoDao = $this->Factory->createDao("acesso_historico");
            $historicoDao->connect();
            $id_acesso = $historicoDao->cadastrar($objHistorico);
		    $historicoDao->disconnect();
		    return $id_acesso;
	        
        } 
        
        catch (Exception $exc) {
	        throw $exc;
        }
    }

    //LISTA
    public function filtro($dados=null){
    	try {
    		
    	    $historicoDao = $this->Factory->createDao("acesso_historico");
            $historicoDao->connect();
            $listHistorico = $historicoDao->filtro($dados);
            $historicoDao->disconnect();
            return $listHistorico;

            } catch (Exception $exc) {
                throw $exc;
            }
    }
    
    //VISUALIZA
    public function visualizar($id_acesso){
    	try {
    	    $historicoDao = $this->Factory->createDao("acesso_historico");
            $historicoDao->connect();
            $objHistorico = $historicoDao->visualizar($id_acesso);
            $historicoDao->disconnect();
            return $objHistorico;
                
            } catch (Exception $exc) {
                throw $exc;
            }
    }
    
    
    //EDITAR
    public function editar($dados){
    	try {
    	    $objHistorico = $this->Factory->createPojo("acesso_historico",$dados);
            $historicoDao = $this->Factory->createDao("acesso_historico");
            $historicoDao->connect();
            $historicoDao->alterar($objHistorico);
            $historicoDao->disconnect();
                
            } catch (Exception $exc) {
                throw $exc;
            }
    }
    
    //EXCLUSÃO
    public function excluir($id_acesso){
    	try {
    	    $historicoDao = $this->Factory->createDao("acesso_historico");
            $historicoDao->connect();
            $historicoDao->excluir($id_acesso);
            $historicoDao->disconnect();
    	} catch (Exception $exc) {
                throw $exc;
            }
    }




}
?>
