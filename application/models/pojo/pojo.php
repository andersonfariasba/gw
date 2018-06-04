<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Pojo
 *
 * @author wcs
 */
abstract class Pojo extends CI_Model {

    public abstract function populate($dados);
    public abstract function toArray();

    protected function convertToArray($pojoFilho) {
        $inArray = array();

        foreach (get_object_vars($pojoFilho) as $attribute => $value) {
            //se o atributo for um float
            if (is_float($pojoFilho->$attribute)) {
                //formata para poder inserir no banco
                $inArray[$attribute] = number_format($pojoFilho->$attribute, 4, ".", "");
            } else {
                $inArray[$attribute] = $pojoFilho->$attribute;
            }
        }
        return $inArray;
    }

}

?>
