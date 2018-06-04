<?php

class AgendaPojo extends CI_Model {

    private $id;
    private $usuario;
    private $observacao;
    private $status;
    private $start;
    private $end;
    private $deletado = false;
   
    
    public function populate($dados){
        if(isset($dados["id"]))
            $this->id = $dados["id"];

        if(isset($dados["usuario"]))
            $this->usuario = $dados["usuario"];

        if(isset($dados["observacao"]))
            $this->observacao = $dados["observacao"];
        
        if(isset($dados["status"]))
            $this->status = $dados["status"];

         if(isset($dados["start"]))
            $this->start = $dados["start"];

         if(isset($dados["end"]))
            $this->end = $dados["end"];

			
	if(isset($dados["deletado"]))
            $this->deletado = $dados["deletado"];

     }
     
     
        public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getUsuario(){
        return $this->usuario;
    }

    public function setUsuario($usuario){
        $this->usuario = $usuario;
    }

    public function getObservacao(){
        return $this->observacao;
    }

    public function setObservacao($observacao){
        $this->observacao = $observacao;
    }

    public function getStart(){
        return $this->start;
    }

    public function setStart($start){
        $this->start = $start;
    }

    public function getEnd(){
        return $this->end;
    }

    public function setEnd($end){
        $this->end = $end;
    }

    public function getStatus(){
        return $this->status;
    }

    public function setStatus($status){
        $this->status = $status;
    }

    public function getDeletado(){
        return $this->deletado;
    }

    public function setDeletado($deletado){
        $this->deletado = $deletado;
    }

    public function toArray()
        {
            $inArray = array();
            foreach(get_object_vars($this) as $attribute => $value){
                if(is_float($this->$attribute)){
                    $inArray[$attribute] = number_format($this->$attribute,4,".","");
                }
                else
                {
                    $inArray[$attribute] = $this->$attribute;
                }
            }

             
                      

            return $inArray;
        }


    


}
?>
