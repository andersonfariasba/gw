<?php
/**
 * Autocomplete_Model
 *
 * @package autocomplete
 */

class Autocomplete_Model extends CI_Model
{
 
  //function BuscarCliente($options = array())
  function BuscarCliente($term)
    {
        $this->db->select('nome_fantasia,cnpj_cpf,id_cliente');
        $this->db->like('nome_fantasia', $term, 'after');
        //$this->db->like('nome_fantasia', $options['keyword'], 'after');
                
        $this->db->where("tipo", CLIENTE);
        $query = $this->db->get('com_clientes');
        return $query->result();
    }


      function BuscarProduto($term)
    {
        $this->db->select('descricao,codigo,id_produto,valor_venda');
        $this->db->like('descricao', $term, 'after');
        $this->db->where("deletado",DELETADO);
        $this->db->where("habilitado_venda",SIM);
        //$this->db->like('nome_fantasia', $options['keyword'], 'after');             
      
        $query = $this->db->get('est_produtos');
        return $query->result();
    }


}

