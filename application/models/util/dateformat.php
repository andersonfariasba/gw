<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DateFormat
 *
 * @author wcs
 */
class DateFormat {

    //put your code here
    public function date_format_pedido($data) {
        if($data!="" || $data!=NULL) {
            return date("d/m/Y - H:i", strtotime($data));
        }
    }
    
    public function date_format($data) {
        if($data!="" || $data!=NULL) {
            return date("d/m/Y", strtotime($data));
        }
    }
    
     public function date_mysql($data){
        if($data!=null || $data!=""){
            return implode("-",array_reverse(explode("/",$data)));
           
        }
    }

}

?>
