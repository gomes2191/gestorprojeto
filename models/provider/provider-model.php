<?php

/**
 *  @Autor: F.A.G.A <gomes.tisystem@gmail.com>
 *  @Class: AgendaModel
 *  @Descrição: Classe para registro de consultas
 *
 *  @Pacote: OdontoControl
 *  @Versão: 0.1
 */
class ProviderModel extends MainModel
{

    /**
     * $form_data
     *
     * @Descrição: Armazena os dados recebido do post.
     *
     * @Acesso: public
     */
    public $form_data;

    /**
     * $form_msg
     *
     * @Descrição: As mensagens de feedback para o usuário.
     *
     * @Acesso: public
     */
    public $form_msg;

    /**
     * $db
     *
     * @Descrição: O objeto da nossa conexão PDO
     *
     * @Acesso: public
     */
    public $db;

    /**
     * 
     *
     * @Descrição: Construtor, carrega  o DB.
     *
     * @since 0.1
     * @access public
     */
    public function __construct( $db = FALSE ) {
            $this->db = $db;
    }
    
    /**
    *   @Acesso: public
    *   @Autor: Gomes - F.A.G.A <gomes.tisystem@gmail.com>
    *   @Função: validate_register_form()
    *   @Versão: 0.2 
    *   @Descrição: Método que trata o fromulário, verifica o tipo de dados passado e executa as validações necessarias.
    *   @Obs: Este método pode inserir ou atualizar dados dependendo do tipo de requisição solicitada pelo usuário.
    **/ 
    public function validate_register_form () {
        // Cria o vetor que vai receber os dados do post
        $this->form_data = [];

        // Verifica se algo foi postado no formulário
        if ( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST ) ) {
            
            # Faz o loop dos dados do formulário inserindo os no vetor @form_data.
            foreach ( $_POST as $key => $value ) {
                
                # Configura os dados do post para a propriedade $form_data
                $this->form_data[$key] = $value;
                
            } //Faz lop dos dados do post
            
            # Não será permitido campos vazios
            if ( empty( $this->form_data['provider_nome'] ) ) {
                // Feedback para o usuário
                $this->form_msg = [0 => 'alert-danger', 1 =>'Erro! ',  2 => 'Campo nome não foi preenchido.'];

                // Termina
                return;

            } //--> End

        }else {
            
            // Finaliza se nada foi enviado
            return;
            
        } //--> End finaliza se nada foi enviado
        
        // Verifica se o registro já existe.
        $db_check_ag = $this->db->query (' SELECT count(*) FROM `providers` WHERE `provider_id` = ? ',[
            chk_array($this->form_data, 'provider_id')
        ]);
        
        // Verifica se a consulta foi realizada com sucesso
        if ( ($db_check_ag->fetchColumn()) >= 1 ) {
            $this->updateRegister(chk_array($this->form_data, 'provider_id'));
            return;
        }else{
             $this->insertRegister();
             return;
        }
        
    } #--> End validate_register_form()
    
    /**
    *   @Acesso: public
    *   @Autor: Gomes - F.A.G.A <gomes.tisystem@gmail.com>
    *   @Função: insertRegister()
    *   @Versão: 0.1 
    *   @Descrição: Insere o registro no BD.
    *   @Obs: Este método só funcionara se for chamado no método validate_register_form() ambos trabalham em conjunto.
    **/ 
    public function insertRegister(){
        
        # Se o ID do agendamento estiver vazio, insere os dados
        $query_ins = $this->db->insert('providers',[
            'provider_nome'         =>  $this->avaliar(chk_array($this->form_data, 'provider_nome')),
            'provider_cpf_cnpj'     =>  $this->avaliar(chk_array($this->form_data, 'provider_cpf_cnpj')),
            'provider_rs'           =>  $this->avaliar(chk_array($this->form_data, 'provider_rs')),
            'provider_at'           =>  $this->avaliar(chk_array($this->form_data, 'provider_at')),
            'provider_end'          =>  $this->avaliar(chk_array($this->form_data, 'provider_end')),
            'provider_bair'         =>  $this->avaliar(chk_array($this->form_data, 'provider_bair')),
            'provider_cid'          =>  $this->avaliar(chk_array($this->form_data, 'provider_cid')),
            'provider_uf'           =>  $this->avaliar(chk_array($this->form_data, 'provider_uf')),
            'provider_pais'         =>  $this->avaliar(chk_array($this->form_data, 'provider_pais')),
            'provider_cep'          =>  $this->avaliar(chk_array($this->form_data, 'provider_cep')),
            'provider_cel'          =>  $this->avaliar(chk_array($this->form_data, 'provider_cel')),
            'provider_tel_1'        =>  $this->avaliar(chk_array($this->form_data, 'provider_tel_1')),
            'provider_tel_2'        =>  $this->avaliar(chk_array($this->form_data, 'provider_tel_2')),
            'provider_insc_uf'      =>  $this->avaliar(chk_array($this->form_data, 'provider_insc_uf')),
            'provider_web_url'      =>  $this->avaliar(chk_array($this->form_data, 'provider_web_url')),
            'provider_email'        =>  $this->avaliar(chk_array($this->form_data, 'provider_email')),
            'provider_rep_nome'     =>  $this->avaliar(chk_array($this->form_data, 'provider_rep_nome')),
            'provider_rep_apelido'  =>  $this->avaliar(chk_array($this->form_data, 'provider_rep_apelido')),
            'provider_rep_email'    =>  $this->avaliar(chk_array($this->form_data, 'provider_rep_email')),
            'provider_rep_cel'      =>  $this->avaliar(chk_array($this->form_data, 'provider_rep_cel')),
            'provider_rep_tel_1'    =>  $this->avaliar(chk_array($this->form_data, 'provider_rep_tel_1')),
            'provider_rep_tel_2'    =>  $this->avaliar(chk_array($this->form_data, 'provider_rep_tel_2')),
            'provider_banco_1'      =>  $this->avaliar(chk_array($this->form_data, 'provider_banco_1')),
            'provider_agencia_1'    =>  $this->avaliar(chk_array($this->form_data, 'provider_agencia_1')),
            'provider_conta_1'      =>  $this->avaliar(chk_array($this->form_data, 'provider_conta_1')),
            'provider_titular_1'    =>  $this->avaliar(chk_array($this->form_data, 'provider_titular_1')),
            'provider_banco_2'      =>  $this->avaliar(chk_array($this->form_data, 'provider_banco_2')),
            'provider_agencia_2'    =>  $this->avaliar(chk_array($this->form_data, 'provider_agencia_2')),
            'provider_conta_2'      =>  $this->avaliar(chk_array($this->form_data, 'provider_conta_2')),
            'provider_titular_2'    =>  $this->avaliar(chk_array($this->form_data, 'provider_titular_2')),
            'provider_obs'          =>  $this->avaliar(chk_array($this->form_data, 'provider_obs'))
        ]);

        # Verifica se a consulta está OK se sim envia o Feedback para o usuário.
        if ( $query_ins ) {

            # Destroy variáveis não mais utilizadas.
            unset($query_ins);
            
            # Feedback para o usuário
            $this->form_msg = [0 => 'alert-info', 1 =>'Sucesso! ',  2 => 'O registro foi efetuado com sucesso!'];
            
            # Redireciona de volta para a página após dez segundos
            echo '<meta http-equiv="Refresh" content="3; url=' . HOME_URI . '/providers/cad">';

            # Finaliza execução.
            return;
        }
        
    }
    
    /**
    *   @Acesso: public
    *   @Autor: Gomes - F.A.G.A <gomes.tisystem@gmail.com>
    *   @Função: updateRegister()
    *   @Versão: 0.1 
    *   @Descrição: Atualiza um registro especifico no BD.
    *   @Obs: Este método só funcionara se for chamado no método validate_register_form() ambos trabalham em conjunto.
    **/ 
    public function updateRegister( $agenda_id = NULL ){
        
        # Se o ID não estiver vazio, atualiza os dados
        if ( $agenda_id ) {
            
            # Atualiza os dados
            $query = $this->db->update('agendas', 'agenda_id', $agenda_id,[
                'agenda_start'          =>  $this->_formatar (chk_array($this->form_data, 'from')),
                'agenda_end'            =>  $this->_formatar(chk_array($this->form_data, 'to')),
                'agenda_start_normal'   =>  chk_array($this->form_data, 'from'),
                'agenda_end_normal'     =>  chk_array($this->form_data, 'to'),
                'agenda_class'          =>  $this->avaliar(chk_array($this->form_data, 'agenda_class')),
                'agenda_proc'           =>  $this->avaliar(chk_array($this->form_data, 'agenda_proc')),
                'agenda_pac'            =>  $this->avaliar(chk_array($this->form_data, 'agenda_pac')),
                'agenda_desc'           =>  $this->avaliar(chk_array($this->form_data, 'agenda_desc'))
            ]);

            // Verifica se a consulta foi realizada com sucesso
            if ( $query ) {
                // Feedback para o usuário.
                $this->form_msg = [0 => 'alert-info', 1 =>'Sucesso!',  2 => 'Os dados foram atualizados com sucesso!'];
                
                // Destroy variáveis nao utilizadas
                unset($agenda_id, $query);
                
                // Finaliza execução.
                return;
            }
        }
    } # End updateRegister()
    
    /**
    *   @Acesso: public
    *   @Autor: Gomes - F.A.G.A <gomes.tisystem@gmail.com>
    *   @Função: get_register_form()
    *   @Versão: 0.1 
    *   @Descrição: Obtém os dados de agendamentos cadastrados método usado para edição de agendamentos.
    **/ 
    public function get_register_form ( $parametros ) {
        
        $id = intval($this->encode_decode(0, $parametros));
        
        // Verifica na base de dados
        $query = $this->db->query('SELECT * FROM `providers` WHERE `provider_id` = ?', [ $id ]  );

        // Verifica se a consulta foi realizada com sucesso!
        if ( ! $query ) {
                $this->form_msg = '<p class="form_error">Agendamento não existe.</p>';
                return;
        }

        // Obtém os dados da consulta
        $fetch_userdata = $query->fetch();

        // Verifica se os dados da consulta estão vazios
        if ( empty( $fetch_userdata ) ) {
                $this->form_msg = '<p class="form_error">Agendamento não existe.</p>';
                return;
        }

        // Faz um loop dos dados do formulário, guardando os no vetor $form_data
        foreach ( $fetch_userdata as $key => $value ) {
            $this->form_data[$key] = $value;
        }
        
        // Destroy variaveis não mais utilizadas
        unset($id, $query, $fetch_userdata);
    } // get_register_form
        
        
    /**
    *   @Acesso: public
    *   @Autor: Gomes - F.A.G.A <gomes.tisystem@gmail.com>
    *   @Função: del_agendamento()
    *   @Versão: 0.1 
    *   @Descrição: Recebe o id passado no método e executa a exclusão caso exista o id se não retorna um erro.
    **/ 
    public function delRegister ( $id ) {

        # Recebe o ID do registro converte de string para inteiro.
        $parametro = intval($this->encode_decode(0, $id));
        //echo $ag_id; die();
        
        $search = $this->db->query("SELECT count(*) FROM `providers` WHERE `provider_id` = $parametro ");
        if($search->fetchColumn() < 1){

            // Feedback para o usuário
            $this->form_msg = [0 => 'alert-danger', 1 =>'Erro!',  2 => 'Erro interno do sistema. Contate o administrador.'];

            //Destroy variáveis não mais utilizadas
            unset($parametro, $search, $id);

            # Redireciona de volta para a página após dez segundos
            echo '<meta http-equiv="Refresh" content="3; url=' . HOME_URI . '/providers">';

            // Finaliza
            return;
        } else {
            # Deleta o registro
            $query_del = $this->db->delete('providers', 'provider_id', $parametro);
            
            // Feedback para o usuário
            $this->form_msg = [0 => 'alert-info', 1 =>'Sucesso!',  2 => 'Registro removido com sucesso!'];
            
            // Destroy variáveis não mais utilizadas
            unset($parametro, $query_del, $search, $id);

            # Redireciona de volta para a página após dez segundos
            echo '<meta http-equiv="Refresh" content="4; url=' . HOME_URI . '/providers">';
            
            // Finaliza
            return;
        }
        
    } //--> End del_agendamento()
        
         
    /**
    *   @Acesso: public
    *   @Autor: Gomes - F.A.G.A <gomes.tisystem@gmail.com>
    *   @Versão: 0.1
    *   @Função: get_ultimo_id() 
    *   @Descrição: Pega o ultimo ID do agendamento.
    **/
    public function get_ultimo_id() {
        // Simplesmente seleciona os dados na base de dados
        $query = $this->db->query(' SELECT MAX(agenda_id) AS `agenda_id` FROM `agendas` ');
         
        $row = $query->fetch();
        $id = trim($row[0]);
        
        return $id;
        
     } // End get_ultimo_id()
     
     
    /**
    *   @Acesso: public
    *   @Autor: Gomes - F.A.G.A <gomes.tisystem@gmail.com>
    *   @Versão: 0.1
    *   @Função: get_listar() 
    *   @Descrição: Pega o ID passado na função e retorna os valores.
    **/ 
    public function get_listar( ) {
        
        #   Simplesmente seleciona os dados na base de dados
        $query = $this->db->query( 'SELECT * FROM `providers` ORDER BY provider_id' );

        // Verifica se a consulta está OK
        if ( ! $query ) {
                return array();
        }
        // Retorna os valores da consulta
        return $query->fetchAll();
    } // End get_listar()

    
    /**
    *   @Acesso: public
    *   @Autor: Gomes - F.A.G.A <gomes.tisystem@gmail.com>
    *   @Versão: 0.1
    *   @Função: jsonPagination() 
    *   @Descrição: Função que recebe os valores passado e executa a consulta SQL e imprime o retorno do json para a paginação.
    **/ 
    public function jsonPagination($param1 = NULL, $limit = NULL, $offset = NULL ) {
        
        // Cria os vetores necessarios
        $jsondata = [];
        $jsondataList = [];
        
        // Verifica se o parametro foi passado e executa a consulta
        if ($param1 == 'quantos') {
            
            // Realiza a consulta e retorna e armazena na variável
            $resultado = $this->db->query(' SELECT COUNT(*) total FROM `agendas` ');

            // Pega todos os valores retornado da base de dados e armazena no vetor
            $fila = $resultado->fetch();

            $jsondata['total'] = $fila['total'];
            
        // Verifica se o parametro existe e retorna a consulta.    
        } elseif ($param1 == 'dame') {
            
            $resultadoT = $this->db->query(" SELECT * FROM `agendas` LIMIT $limit OFFSET $offset ");


            while ($fila = $resultadoT->fetch()) {
                $jsondataperson = [];
                $jsondataperson['agenda_id'] = $fila['agenda_id'];
                $jsondataperson['agenda_pac'] = $fila['agenda_pac'];
                $jsondataperson['agenda_proc'] = $fila['agenda_proc'];
                $jsondataperson['agenda_start_normal'] = $fila['agenda_start_normal'];

                $jsondataList [] = $jsondataperson;
            }

            $jsondata['lista'] = array_values($jsondataList);
        }
        echo json_encode($jsondata);
    } // End jsonPagination()
    
    /**
    *   @Acesso: public
    *   @Autor: Gomes - F.A.G.A <gomes.tisystem@gmail.com>
    *   @Versão: 0.1
    *   @Função: _formatar() 
    *   @Descrição: Microtime formatar uma data do tipo 21/09/2016 12:00 para o formato tipo 1401517498985 aceito pelo calendario.
    **/ 
    public function _formatar($fecha) {
        return strtotime(substr($fecha, 6, 4) . "-" . substr($fecha, 3, 2) . "-" . substr($fecha, 0, 2) . " " . substr($fecha, 10, 6)) * 1000;
    }
}
