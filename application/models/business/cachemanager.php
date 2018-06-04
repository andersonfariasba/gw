<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CacheManager
 *
 * @author wcs
 */

class CacheManager extends CI_Model {

    private $cache;

    public function __construct() {
        
        $this->load->model("business/Cache");
        $this->cache = $this->Cache;

        parent::__construct();
    }

    public function getUsuario($cod_usuario) {
        $objUsuario = $this->cache->getUsuario($cod_usuario);

        if ($objUsuario == NULL) {
            $usuarioBus = $this->Factory->createBusiness("Usuario");
            $objUsuario = $usuarioBus->visualizar($cod_usuario);

            if ($objUsuario != NULL) {
                $this->cache->addUsuario($objUsuario);
            }
        }

        return $objUsuario;
    }

    public function getCliente($cod_cliente) {
        $objCliente = $this->cache->getCliente($cod_cliente);

        if ($objCliente == NULL) {
            $clienteBus = $this->Factory->createBusiness("Cliente");
            $objCliente = $clienteBus->visualizar($cod_cliente);

            if ($objCliente != NULL) {
                $this->cache->addCliente($objCliente);
            }
        }

        return $objCliente;
    }

    public function getDespachante($cod_despachante) {
        $objDespachante = $this->cache->getDespachante($cod_despachante);

        if ($objDespachante == NULL) {
            $despachanteBus = $this->Factory->createBusiness("Despachante");
            $objDespachante = $despachanteBus->visualizar($cod_despachante);
            
            if ($objDespachante != NULL) {                
                $this->cache->addDespachante($objDespachante);
            }
        }

        return $objDespachante;
    }

}

?>
