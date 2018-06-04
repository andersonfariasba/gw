<?php
/* Classe(business): Centro de custos
 * Autor: Anderson Farias
 * Última atualização: 03/07/2015
 * Contato: andersonjfarias@yahoo.com.br
 */

class Fin_plano_contasBusiness extends CI_Model {

    //CADASTRA
	public function cadastrar($dados){
        try {

            $objCusto = $this->Factory->createPojo("fin_plano_contas",$dados);
            $custoDao = $this->Factory->createDao("fin_plano_contas");
            $custoDao->connect();
            $cod_custo = $custoDao->cadastrar($objCusto);
	    $custoDao->disconnect();
            return $cod_custo;
	        
        } 
        
        catch (Exception $exc) {
	        throw $exc;
        }
    }

    //LISTA
    public function filtro($dados=null){
    	try {
    		
    	    $custoDao = $this->Factory->createDao("fin_plano_contas");
            $custoDao->connect();
            $listCusto = $custoDao->filtro($dados);
            $custoDao->disconnect();
            return $listCusto;

            } catch (Exception $exc) {
                throw $exc;
            }
    }

     //LISTA
    public function listar_por_categoria($id_plano_categoria){
        try {
            
            $custoDao = $this->Factory->createDao("fin_plano_contas");
            $custoDao->connect();
            $listCusto = $custoDao->listar_por_categoria($id_plano_categoria);
            $custoDao->disconnect();
            return $listCusto;

            } catch (Exception $exc) {
                throw $exc;
            }
    }
    
    //VISUALIZA
    public function visualizar($id_plano){
    	try {
    	    $custoDao = $this->Factory->createDao("fin_plano_contas");
            $custoDao->connect();
            $objCusto = $custoDao->visualizar($id_plano);
            $custoDao->disconnect();
            return $objCusto;
                
            } catch (Exception $exc) {
                throw $exc;
            }
    }
    
    
    //EDITAR
    public function editar($dados){
    	try {
    	    $objCusto = $this->Factory->createPojo("fin_plano_contas",$dados);
            $custoDao = $this->Factory->createDao("fin_plano_contas");
            $custoDao->connect();
            $custoDao->alterar($objCusto);
            $custoDao->disconnect();
                
            } catch (Exception $exc) {
                throw $exc;
            }
    }
    
    //EXCLUSÃO
    public function excluir($id_plano){
    	try {
    	    $custoDao = $this->Factory->createDao("fin_plano_contas");
            $custoDao->connect();
            $custoDao->excluir($id_plano);
            $custoDao->disconnect();
    	} catch (Exception $exc) {
                throw $exc;
            }
    }




}
?>
