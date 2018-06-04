<?php
/**
 * Autocomplete_Model
 *
 * @package autocomplete
 */

class Produtos_servicos_Model extends CI_Model
{
    function GetAutocomplete($options = array())
    {
	    $this->db->select('descricao,valor,cod_produto');
	    $this->db->like('descricao', $options['keyword'], 'after');
   		$query = $this->db->get('produtos');
		return $query->result();
    }
}