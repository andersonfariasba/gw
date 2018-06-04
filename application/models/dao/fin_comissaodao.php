<?php
/* Classe(DAO): Lançamentos
* Autor: Anderson Farias
* Última atualização: 12/07/2015
* Contato: andersonjfarias@yahoo.com.br
*/

class Fin_comissaoDao extends CI_Model {
    

    public function connect(){
        $this->load->database();
    }

    public function disconnect(){
        $this->db->close();
    }


    public function cadastrar($objLanc){
        $sucess = $this->db->insert("fin_comissao",$objLanc->toArray());
        if(!$sucess){
            throw new Exception($this->db->_error_message(),$this->db->_error_number());
        }

        $cod_lanc = $this->db->insert_id();

        return $cod_lanc;
    }

    //MOTRAR O TOTAL DA CONTA REFERENTE A UMA DATA
     public function filtro($dados) {

        $data_de = $dados["data_de"];
        $data_ate = $dados["data_ate"];
        $id_usuario = $dados['id_usuario'];
       
        $param = "";
           
         if ($data_de != NULL && $data_ate != NULL):
                 $objDateFormat = $this->DateFormat;
                 $data_de = $objDateFormat->date_mysql($data_de);
                 $data_ate = $objDateFormat->date_mysql($data_ate);
                
                  $param .= "and DATE(c.data) BETWEEN '$data_de' AND '$data_ate'"; 
         
         endif;
         

         if ($dados["id_usuario"] != NULL):
              $param .= " and c.id_usuario = $id_usuario";

         endif;
         

       
       $query = $this->db->query("select c.data,p.codigo,u.login,f.nome,c.valor_venda,c.percentual,(c.valor_venda/100) * c.percentual as 'receber'  from fin_comissao c
       inner join com_pedidos p
       on(c.id_pedido = p.id_pedido)
       inner join acesso_usuarios u
       on(c.id_usuario = u.id_usuario)
       inner join rh_colaboradores f
       on(u.id_colaborador = f.id_colaborador) ".$param." and p.faturado = 1 ");
       
       $result = $query->result_array();

        return $result;
        
     }

       
    


 }
?>
