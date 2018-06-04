<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Cache
 *
 * @author wcs
 */
class Cache extends CI_Model {

    /*********************   USUARIOS   ************************************/
    private $usuarios = array();

    public function getUsuario($cod_usuario) {

        if (array_key_exists($cod_usuario, $this->usuarios)) {
            return $this->usuarios[$cod_usuario];
        }

        return NULL;
    }

    public function addUsuario($objUsuario) {
        $this->deleteUsuario($objUsuario->getCod_usuario());
        
        $this->usuarios[$objUsuario->getCod_usuario()] = $objUsuario;
    }

    public function deleteUsuario($cod_usuario) {
        if (array_key_exists($cod_usuario, $this->usuarios)) {
            unset($this->usuarios[$cod_usuario]);
        }
    }

    /*********************   CLIENTES  ************************************/
    private $clientes = array();

    public function getCliente($cod_cliente) {

        if (array_key_exists($cod_cliente, $this->clientes)) {            
            return $this->clientes[$cod_cliente];
        }

        return NULL;
    }

    public function addCliente($objCliente) {
        $this->deleteCliente($objCliente->getCod_cliente());

        $this->clientes[$objCliente->getCod_cliente()] = $objCliente;
    }

    public function deleteCliente($cod_cliente) {
        if (array_key_exists($cod_cliente, $this->clientes)) {
            unset($this->clientes[$cod_cliente]);
        }
    }

    /*********************   DESPACHANTES  ************************************/
    private $despachantes = array();

    public function getDespachante($cod_despachante) {

        if (array_key_exists($cod_despachante, $this->despachantes)) {
            return $this->despachantes[$cod_despachante];
        }

        return NULL;
    }

    public function addDespachante($objDespachante) {
        $this->deleteDespachante($objDespachante->getCod_despachante());

        $this->despachantes[$objDespachante->getCod_despachante()] = $objDespachante;
    }

    public function deleteDespachante($cod_despachante) {
        if (array_key_exists($cod_despachante, $this->despachantes)) {
            unset($this->despachantes[$cod_despachante]);
        }
    }

}

?>
