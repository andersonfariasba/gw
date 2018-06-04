<?php
/* Classe Pojo (VO): Endereço de entrega dos clientes
 * Autor: Anderson Farias
 * Última atualização: 23/10/2015
 * Contato: andersonjfarias@yahoo.com.br
 */
class Com_clientes_end_entregaPojo extends CI_Model {

    private $id_endereco;
    private $id_cliente;
    private $endereco;
    private $bairro;
    private $cep;
    private $cidade;
    private $estado;
    private $observacao;
    private $deletado = false;
    
      
    public function populate($dados){
        if(isset($dados["id_endereco"]))
            $this->id_endereco = $dados["id_endereco"];

        if(isset($dados["id_cliente"]))
            $this->id_cliente = $dados["id_cliente"];

            
        if(isset($dados["endereco"]))
            $this->endereco = $dados["endereco"];
        
	   if(isset($dados["bairro"]))
            $this->bairro = $dados["bairro"];
	
       if(isset($dados["cep"]))
            $this->cep = $dados["cep"];
        
        if(isset($dados["cidade"]))
            $this->cidade = $dados["cidade"];
        
	    if(isset($dados["estado"]))
            $this->estado = $dados["estado"];
	
        if(isset($dados["observacao"]))
            $this->observacao = $dados["observacao"];

        if(isset($dados["deletado"]))
            $this->deletado = $dados["deletado"];
	}
	
	
	
       public function getId_endereco() {
            return $this->id_endereco;
        }

        public function getId_cliente() {
            return $this->id_cliente;
        }

        public function getEndereco() {
            return $this->endereco;
        }

        public function getBairro() {
            return $this->bairro;
        }

        public function getCep() {
            return $this->cep;
        }

        public function getCidade() {
            return $this->cidade;
        }

        public function getEstado() {
            return $this->estado;
        }

        public function getObservacao() {
            return $this->observacao;
        }

       
        public function getDeletado() {
            return $this->deletado;
        }

        public function setId_endereco($id_endereco) {
            $this->id_endereco = $id_endereco;
        }

        public function setId_cliente($id_cliente) {
            $this->id_cliente = $id_cliente;
        }

        public function setEndereco($endereco) {
            $this->endereco = $endereco;
        }

        public function setBairro($bairro) {
            $this->bairro = $bairro;
        }

        public function setCep($cep) {
            $this->cep = $cep;
        }

        public function setCidade($cidade) {
            $this->cidade = $cidade;
        }

        public function setEstado($estado) {
            $this->estado = $estado;
        }

        public function setObservacao($observacao) {
            $this->observacao = $observacao;
        }

     
        public function setDeletado($deletado) {
            $this->deletado = $deletado;
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

          
            return $inArray;
        }


 }
?>
