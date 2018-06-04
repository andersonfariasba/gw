<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Categoria_model
 *
 * @author VANESSA PINHO
 */
class Categoria_model extends CI_Model {
    
    public function inserir($dados){
        $this->db->insert('cadastro', $dados);
    }
    
    public function listar(){
        $this->db->order_by('nome');        
        return $this->db->get('cadastro')->result();
    }
    
    
}

?>
