<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Factory
 *
 * @author wcs
 */

class Factory extends CI_Model{

    /*
     * Retorna uma instancia da classe Business especificada
     */
    public function createBusiness($classe) {
        $classe = $classe."Business";
        
        $this->load->model("business/".$classe, $classe);
        return $this->$classe;
    }
    
    /*
     * Retorna uma instancia da classe Pojo especificada
     */
    public function createPojo($classe, $dados) {
        
        $classe = $classe."Pojo";
        
        $this->load->model("pojo/".$classe, $classe);
        unset($this->$classe);
        
        $pojo = new $classe();
        $pojo->populate($dados);
        
        return $pojo;
    }

    /*
     * Retorna uma instancia da classe Dao especificada
     */
    public function createDao($classe) {
        $classe = $classe."Dao";
        
        $this->load->model("dao/".$classe, $classe);
        
        return $this->$classe;
    }

    public function getCacheManager() {
        $this->load->model("business/CacheManager", "cacheManager");
        return $this->cacheManager;
    }
}
?>
