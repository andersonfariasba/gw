<?php
/* Classe Pojo (VO): Clientes
 * Autor: Anderson Farias
 * Última atualização: 03/07/2015
 * Contato: andersonjfarias@yahoo.com.br
 */
class Fin_filiaisPojo extends CI_Model {

    private $id_filial;
    private $nome_fantasia;
    private $cnpj_cpf;
    private $insc_estadual;
    private $insc_municipal;
    private $endereco;
    private $bairro;
    private $cep;
    private $cidade;
    private $estado;
    private $id_estado;
    private $id_cidade;
    private $site;
    private $email;
    private $telefone1;
    private $contato1;
    private $telefone2;
    private $contato2;
    private $celular;
    private $observacao;
    private $data_cadastro;
    private $logo;
    private $status;

    private $mod_vendas;
    private $mod_locacao;
    private $mod_compras;
    private $mod_caixa;
    private $mod_bar;

    private $deletado = false;

    private $estadoObj;
    private $cidadeObj;
    
   
    //status
    private static $ATIVO = "<span class='btn btn-success btn-small buttom_width'>ATIVO</span>";
    private static $BLOQUEADO = "<span class='btn btn-warning btn-small buttom_width'>BLOQUEADO</span>";

    //status
    private static $SIM = "<span class='btn btn-success btn-small buttom_width'>DISPONIVEL</span>";
    private static $NAO = "<span class='btn btn-warning btn-small buttom_width'>INDISPONIVEL</span>";
    
    
    public function populate($dados){
        if(isset($dados["id_filial"]))
            $this->id_filial = $dados["id_filial"];

        	
        if(isset($dados["nome_fantasia"]))
            $this->nome_fantasia = $dados["nome_fantasia"];
	
        if(isset($dados["cnpj_cpf"]))
            $this->cnpj_cpf = $dados["cnpj_cpf"];
	
        if(isset($dados["insc_estadual"]))
            $this->insc_estadual = $dados["insc_estadual"];
	
        if(isset($dados["insc_municipal"]))
            $this->insc_municipal = $dados["insc_municipal"];
	
        
        if(isset($dados["endereco"]))
            $this->endereco = $dados["endereco"];
        
	if(isset($dados["bairro"]))
            $this->bairro = $dados["bairro"];
	
        if(isset($dados["bairro"]))
            $this->bairro = $dados["bairro"];
	        
        if(isset($dados["cep"]))
            $this->cep = $dados["cep"];
        
        if(isset($dados["cidade"]))
            $this->cidade = $dados["cidade"];
        
	if(isset($dados["estado"]))
            $this->estado = $dados["estado"];

          if(isset($dados["id_cidade"]))
            $this->id_cidade = $dados["id_cidade"];
        
         if(isset($dados["id_estado"]))
            $this->id_estado = $dados["id_estado"];
	
        if(isset($dados["site"]))
            $this->site = $dados["site"];
        
        if(isset($dados["email"]))
            $this->email = $dados["email"];
        
        if(isset($dados["telefone1"]))
            $this->telefone1 = $dados["telefone1"];
        
        if(isset($dados["contato1"]))
            $this->contato1 = $dados["contato1"];
	
	if(isset($dados["telefone2"]))
            $this->telefone2 = $dados["telefone2"];
        
        if(isset($dados["contato2"]))
            $this->contato2 = $dados["contato2"];
       
         if(isset($dados["celular"]))
            $this->celular = $dados["celular"];
               
         if(isset($dados["observacao"]))
            $this->observacao = $dados["observacao"];
	
        if(isset($dados["data_cadastro"]))
            $this->data_cadastro = $dados["data_cadastro"];
        
        if(isset($dados["status"]))
            $this->status = $dados["status"];

         if(isset($dados["logo"]))
            $this->logo = $dados["logo"];

          if(isset($dados["mod_vendas"]))
            $this->mod_vendas = $dados["mod_vendas"];

          if(isset($dados["mod_locacao"]))
            $this->mod_locacao = $dados["mod_locacao"];

          if(isset($dados["mod_compras"]))
            $this->mod_compras = $dados["mod_compras"];

          if(isset($dados["mod_caixa"]))
            $this->mod_caixa = $dados["mod_caixa"];

          if(isset($dados["mod_bar"]))
            $this->mod_bar = $dados["mod_bar"];
        
        if(isset($dados["deletado"]))
            $this->deletado = $dados["deletado"];
	}
	
	
	
        public function getId_filial() {
            return $this->id_filial;
        }

        public function getNome_fantasia() {
            return $this->nome_fantasia;
        }

        public function getCnpj_cpf() {
            return $this->cnpj_cpf;
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

         public function getCidadeObj() {
            return $this->cidadeObj;
        }

        public function getEstadoObj() {
            return $this->estadoObj;
        }

         public function getId_cidade() {
            return $this->id_cidade;
        }

        public function getId_estado() {
            return $this->id_estado;
        }

        public function getSite() {
            return $this->site;
        }

        public function getEmail() {
            return $this->email;
        }

        public function getTelefone1() {
            return $this->telefone1;
        }

        public function getContato1() {
            return $this->contato1;
        }

        public function getTelefone2() {
            return $this->telefone2;
        }

        public function getContato2() {
            return $this->contato2;
        }

        public function getData_cadastro() {
            return $this->data_cadastro;
        }

        public function getStatus() {
            return $this->status;
        }

        public function getDeletado() {
            return $this->deletado;
        }

        public function setId_filial($id_filial) {
            $this->id_filial = $id_filial;
        }

   
        public function setNome_fantasia($nome_fantasia) {
            $this->nome_fantasia = $nome_fantasia;
        }

        public function setCnpj_cpf($cnpj_cpf) {
            $this->cnpj_cpf = $cnpj_cpf;
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

         public function setId_cidade($id_cidade) {
            $this->id_cidade = $id_cidade;
        }

        public function setId_estado($id_estado) {
            $this->id_estado = $id_estado;
        }

         public function setCidadeObj($cidadeObj) {
            $this->cidadeObj = $cidadeObj;
        }

        public function setEstadoObj($estadoObj) {
            $this->estadoObj = $estadoObj;
        }

        public function setSite($site) {
            $this->site = $site;
        }

        public function setEmail($email) {
            $this->email = $email;
        }

        public function setTelefone1($telefone1) {
            $this->telefone1 = $telefone1;
        }

        public function setContato1($contato1) {
            $this->contato1 = $contato1;
        }

        public function setTelefone2($telefone2) {
            $this->telefone2 = $telefone2;
        }

        public function setContato2($contato2) {
            $this->contato2 = $contato2;
        }

        public function setData_cadastro($data_cadastro) {
            $this->data_cadastro = $data_cadastro;
        }

        public function setStatus($status) {
            $this->status = $status;
        }

        public function setDeletado($deletado) {
            $this->deletado = $deletado;
        }
        
        public function getObservacao() {
            return $this->observacao;
        }

        public function setObservacao($observacao) {
            $this->observacao = $observacao;
        }
        
        public function getInsc_estadual() {
            return $this->insc_estadual;
        }

        public function getInsc_municipal() {
            return $this->insc_municipal;
        }

        public function setInsc_estadual($insc_estadual) {
            $this->insc_estadual = $insc_estadual;
        }

        public function setInsc_municipal($insc_municipal) {
            $this->insc_municipal = $insc_municipal;
        }
        
        public function getCelular() {
            return $this->celular;
        }

        public function setCelular($celular) {
            $this->celular = $celular;
        }

         public function getLogo() {
            return $this->logo;
        }

        public function setLogo($logo) {
            $this->logo = $logo;
        }

    public function getMod_vendas(){
        return $this->mod_vendas;
    }

    public function setMod_vendas($mod_vendas){
        $this->mod_vendas = $mod_vendas;
    }

    public function getMod_locacao(){
        return $this->mod_locacao;
    }

    public function setMod_locacao($mod_locacao){
        $this->mod_locacao = $mod_locacao;
    }

    public function getMod_compras(){
        return $this->mod_compras;
    }

    public function setMod_compras($mod_compras){
        $this->mod_compras = $mod_compras;
    }

    public function getMod_caixa(){
        return $this->mod_caixa;
    }

    public function setMod_caixa($mod_caixa){
        $this->mod_caixa = $mod_caixa;
    }

     public function getMod_bar(){
        return $this->mod_bar;
    }

    public function setMod_bar($mod_bar){
        $this->mod_bar = $mod_bar;
    }

          public function estadoIs($estado){
        return $this->id_estado == $estado;
       }


    public function cidadeIs($cidade){
        return $this->id_cidade == $cidade;
       }

    public function modLocacaoIs($mod_locacao){
        return $this->mod_locacao == $mod_locacao;
       }

    
    public function modCaixaIs($mod_caixa){
        return $this->mod_caixa == $mod_caixa;
    }

    public function modVendasIs($mod_vendas){
        return $this->mod_vendas == $mod_vendas;
    }

     public function modComprasIs($mod_compras){
        return $this->mod_compras == $mod_compras;
    }

     public function modBarIs($mod_bar){
        return $this->mod_bar == $mod_bar;
    }

   
    public function statusIs($status){
        return $this->status == $status;
      }
        
        public function printStatus() {
        switch ($this->status) {
            case ATIVO:
                    echo fin_filiaisPojo::$ATIVO;
                break;

            case BLOQUEADO:
                    echo fin_filiaisPojo::$BLOQUEADO;
                break;
            
            default:
         
            break;
        }
    }

      public function printModLocacao() {
        switch ($this->mod_locacao) {
            case SIM:
                    echo fin_filiaisPojo::$SIM;
                break;

            case NAO:
                    echo fin_filiaisPojo::$NAO;
                break;
            
            default:
         
            break;
        }
    }

      public function printModCaixa() {
        switch ($this->mod_caixa) {
            case SIM:
                    echo fin_filiaisPojo::$SIM;
                break;

            case NAO:
                    echo fin_filiaisPojo::$NAO;
                break;
            
            default:
         
            break;
        }
    }

     public function printModVendas() {
        switch ($this->mod_vendas) {
            case SIM:
                    echo fin_filiaisPojo::$SIM;
                break;

            case NAO:
                    echo fin_filiaisPojo::$NAO;
                break;
            
            default:
         
            break;
        }
    }

      public function printModCompras() {
        switch ($this->mod_compras) {
            case SIM:
                    echo fin_filiaisPojo::$SIM;
                break;

            case NAO:
                    echo fin_filiaisPojo::$NAO;
                break;
            
            default:
         
            break;
        }
    }

    public function printModBar() {
        switch ($this->mod_bar) {
            case SIM:
                    echo fin_filiaisPojo::$SIM;
                break;

            case NAO:
                    echo fin_filiaisPojo::$NAO;
                break;
            
            default:
         
            break;
        }
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

          
            
            unset($inArray["estadoObj"]);
            unset($inArray["cidadeObj"]);
            return $inArray;
        }


 }
?>
