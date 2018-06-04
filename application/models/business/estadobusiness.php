<?php
/* Classe(business): Unidade de medida
 * Autor: Anderson Farias
 * Última atualização: 27/06/2015
 * Contato: andersonjfarias@yahoo.com.br
 */

class EstadoBusiness extends CI_Model {

  

     //LISTA AJAX
    public function ajax_listar($pos){
        try {
            
            $categoriaDao = $this->Factory->createDao("estado");
            $categoriaDao->connect();
            $listCategoria = $categoriaDao->ajax_listar($pos);
            $categoriaDao->disconnect();
            
            return $listCategoria;

            } catch (Exception $exc) {
                throw $exc;
            }
    }

     public function filtro($dados=null){
        try {
            
            $produtoDao = $this->Factory->createDao("estado");
            $produtoDao->connect();
            $listProduto = $produtoDao->filtro();
            $produtoDao->disconnect();
            return $listProduto;

            } catch (Exception $exc) {
                throw $exc;
            }
    }

     //VISUALIZA
    public function visualizar($uf_id){
        try {
            $produtoDao = $this->Factory->createDao("estado");
            $produtoDao->connect();
            $objProduto = $produtoDao->visualizar($uf_id);
            $produtoDao->disconnect();
            return $objProduto;
                
            } catch (Exception $exc) {
                throw $exc;
            }
    }


    
    


}
?>
