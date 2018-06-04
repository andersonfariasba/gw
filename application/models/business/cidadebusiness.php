<?php
/* Classe(business): Unidade de medida
 * Autor: Anderson Farias
 * Última atualização: 27/06/2015
 * Contato: andersonjfarias@yahoo.com.br
 */

class CidadeBusiness extends CI_Model {

  

     //LISTA AJAX
    public function ajax_listar($uf){
        try {
            
            $categoriaDao = $this->Factory->createDao("cidade");
            $categoriaDao->connect();
            $listCategoria = $categoriaDao->ajax_listar($uf);
            $categoriaDao->disconnect();

            return $listCategoria;

            } catch (Exception $exc) {
                throw $exc;
            }
    }

    //LISTA AJAX
    public function ajax_visualizar($ct_id){
        try {
            
            $categoriaDao = $this->Factory->createDao("cidade");
            $categoriaDao->connect();
            $listCategoria = $categoriaDao->ajax_visualizar($ct_id);
            $categoriaDao->disconnect();

            return $listCategoria;

            } catch (Exception $exc) {
                throw $exc;
            }
    }


     public function filtro($id_estado=null){
        try {
            
            $produtoDao = $this->Factory->createDao("cidade");
            $produtoDao->connect();
            $listProduto = $produtoDao->filtro($id_estado);
            $produtoDao->disconnect();
            return $listProduto;

            } catch (Exception $exc) {
                throw $exc;
            }
    }

     //VISUALIZA
    public function visualizar($ct_id){
        try {
            $produtoDao = $this->Factory->createDao("cidade");
            $produtoDao->connect();
            $objProduto = $produtoDao->visualizar($ct_id);
            $produtoDao->disconnect();
            return $objProduto;
                
            } catch (Exception $exc) {
                throw $exc;
            }
    }


    
    


}
?>
