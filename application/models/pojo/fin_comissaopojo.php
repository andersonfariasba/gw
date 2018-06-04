<?php
/* Classe Pojo (VO): Comissoes
 * Autor: Anderson Farias
 * Última atualização: 23/07/2016
 * Contato: andersonjfarias@yahoo.com.br
 */
class Fin_comissaoPojo extends CI_Model {

    private $id_comissao;
    private $id_usuario;
    private $id_pedido;
    private $data;
    private $percentual;
    private $valor_venda;
    private $valor_receber;        
    
    public function populate($dados){
        if(isset($dados["id_comissao"]))
            $this->id_comissao = $dados["id_comissao"];

        if(isset($dados["id_usuario"]))
            $this->id_usuario = $dados["id_usuario"];

         if(isset($dados["id_pedido"]))
            $this->id_pedido = $dados["id_pedido"];

        if(isset($dados["data"]))
            $this->data = $dados["data"];

        if(isset($dados["percentual"]))
            $this->percentual = $dados["percentual"];

        if(isset($dados["valor_venda"]))
            $this->valor_venda = $dados["valor_venda"];

        if(isset($dados["valor_receber"]))
            $this->valor_receber = $dados["valor_receber"];
    }
		
	
    public function getId_comissao(){
        return $this->id_comissao;
    }

    public function setId_comissao($id_comissao){
        $this->id_comissao = $id_comissao;
    }

    public function getId_usuario(){
        return $this->id_usuario;
    }

    public function setId_usuario($id_usuario){
        $this->id_usuario = $id_usuario;
    }

    public function getId_pedido(){
        return $this->id_pedido;
    }

    public function setId_pedido($id_pedido){
        $this->id_pedido = $id_pedido;
    }

    public function getData(){
        return $this->data;
    }

    public function setId_data($data){
        $this->data = $data;
    }

    public function getPercentual(){
        return $this->percentual;
    }

    public function setPercentual($percentual){
        $this->percentual = $percentual;
    }

    public function getValor_venda(){
        return $this->valor_venda;
    }

    public function setValor_venda($valor_venda){
        $this->valor_venda = $valor_venda;
    }

    public function getValor_receber(){
        return $this->valor_receber;
    }

    public function setValor_receber($valor_receber){
        $this->valor_receber = $valor_receber;
    }
    
        
        
    public function toArray(){
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

        //unset($inArray["cargo"]);
        return $inArray;
    }


 }


?>
