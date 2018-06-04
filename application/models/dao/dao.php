<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Dao
 *
 * @author wcs
 */
abstract class Dao extends CI_Model {
    
    public function connect() {
        $this->load->database();
        $this->db->trans_rollback(); //caso ocorra algum erro e nao feche a transacao iniciada anteriormente
    }

    public function disconnect() {
        $this->db->close();
    }

    public abstract function insert($pojo);

    public abstract function getById($id);

    public abstract function update($pojo);

    public abstract function delete($id);

    public abstract function listAll();
}

?>
