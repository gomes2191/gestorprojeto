<?php

/**
 *  @Autor: F.A.G.A <gomes.tisystem@gmail.com>
 *  @Class: AgendaModel
 *  @Descrição: Classe para registro de consultas
 *
 *  @Pacote: OdontoControl
 *  @Versão: 0.1
 */
class PatrimonyModel extends MainModel
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
        # Cria o vetor que vai receber os dados do post
        $this->form_data = [];

        # Verifica se algo foi postado no formulário
        if ( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST ) ) {
            
            # Faz o loop dos dados do formulário inserindo os no vetor @form_data.
            foreach ( $_POST as $key => $value ) {
                
                # Configura os dados do post para a propriedade $form_data
                $this->form_data[$key] = $value;
                
            } # Faz lop dos dados do post
            
            #   Não será permitido campos vazios
            if ( empty( $this->form_data['patrimony_cod'] ) OR empty( $this->form_data['patrimony_desc'])) {
                
                #   Feedback para o usuário
                $this->form_msg = [0 => 'alert-warning', 1=>'fa fa-info-circle', 2 => 'Opa! ', 3 => 'Campos obrigatório no formulario não foram preenchidos, campos com * são obrigatórios.'];
                
                # Termina
                return;

            } #--> End

        }else {
            
            # Finaliza se nada foi enviado
            return;
            
        } #--> End finaliza se nada foi enviado
        
        #   Verifica se o registro já existe.
        $db_check_ag = $this->db->query (' SELECT count(*) FROM `patrimony` WHERE `patrimony_id` = ? ',[
            chk_array($this->form_data, 'patrimony_id')
        ]);
        
        #   Verifica se a consulta foi realizada com sucesso
        if ( ($db_check_ag->fetchColumn()) >= 1 ) {
            $this->updateRegister(chk_array($this->form_data, 'patrimony_id'));
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
        $query_ins = $this->db->insert('patrimony',[
            'patrimony_cod'         =>  $this->avaliar(chk_array($this->form_data, 'patrimony_cod')),
            'patrimony_desc'        =>  $this->avaliar(chk_array($this->form_data, 'patrimony_desc')),
            'patrimony_data_aq'     =>  $this->converteData('d/m/Y', 'Y-m-d', chk_array($this->form_data, 'patrimony_data_aq')),
            'patrimony_cor'         =>  $this->avaliar(chk_array($this->form_data, 'patrimony_cor')),
            'patrimony_for'         =>  $this->avaliar(chk_array($this->form_data, 'patrimony_for')),
            'patrimony_dimen'       =>  $this->avaliar(chk_array($this->form_data, 'patrimony_dimen')),
            'patrimony_setor'       =>  $this->avaliar(chk_array($this->form_data, 'patrimony_setor')),
            'patrimony_valor'       =>  (int) $this->only_filter_number(chk_array($this->form_data, 'patrimony_valor')),
            'patrimony_garan'       =>  $this->avaliar(chk_array($this->form_data, 'patrimony_garan')),
            'patrimony_quant'       =>  $this->avaliar(chk_array($this->form_data, 'patrimony_quant')),
            'patrimony_nf'          =>  $this->avaliar(chk_array($this->form_data, 'patrimony_nf')),
            'patrimony_info'        =>  $this->avaliar(chk_array($this->form_data, 'patrimony_info'))
            
            
        ]);

        #   Verifica se a consulta está OK se sim envia o Feedback para o usuário.
        if ( $query_ins ) {
            
            # Feedback para o usuário
            $this->form_msg = [0 => 'alert-success', 1=>'fa fa-info-circle', 2 => 'Sucesso! ', 3 => 'Cadastro efetuado com sucesso.'];
                
            # Redireciona de volta para a página após dez segundos
            #   echo '<meta http-equiv="Refresh" content="3; url=' . HOME_URI . '/patrimony/cad">';
            
            # Destroy variável não mais utilizada
            unset($query_ins);
            
            # Finaliza execução.
            return;
        }else{
            # Destroy variáveis não mais utilizadas.
            unset($query_ins);

            # Feedback para o usuário
            $this->form_msg = [0 => 'alert-danger',1=> 'fa fa-exclamation-triangle fa-2', 2 => 'Erro! ', 3 => 'Erro interno do sistema se o problema persistir contate o administrador!'];

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
    public function updateRegister( $registro_id = NULL ){
        
        #   Se o ID não estiver vazio, atualiza os dados
        if ( $registro_id ) {
            
            # Atualiza os dados
            $query = $this->db->update('patrimony', 'patrimony_id', $registro_id,[
                'patrimony_cod'       =>  $this->avaliar(chk_array($this->form_data, 'patrimony_cod')),
                'patrimony_desc'      =>  $this->avaliar(chk_array($this->form_data, 'patrimony_desc')),
                'patrimony_data_aq'   =>  $this->converteData('d/m/Y', 'Y-m-d', chk_array($this->form_data, 'patrimony_data_aq')),
                'patrimony_cor'       =>  $this->avaliar(chk_array($this->form_data, 'patrimony_cor')),
                'patrimony_for'       =>  $this->avaliar(chk_array($this->form_data, 'patrimony_for')),
                'patrimony_dimen'     =>  $this->avaliar(chk_array($this->form_data, 'patrimony_dimen')),
                'patrimony_setor'     =>  $this->avaliar(chk_array($this->form_data, 'patrimony_setor')),
                'patrimony_valor'     =>  $this->avaliar(chk_array($this->form_data, 'patrimony_valor')),
                'patrimony_garan'     =>  $this->avaliar(chk_array($this->form_data, 'patrimony_garan')),
                'patrimony_quant'     =>  $this->avaliar(chk_array($this->form_data, 'patrimony_quant')),
                'patrimony_nf'        =>  $this->avaliar(chk_array($this->form_data, 'patrimony_nf')),
                'patrimony_info'      =>  $this->avaliar(chk_array($this->form_data, 'patrimony_info'))
            ]);

            // Verifica se a consulta foi realizada com sucesso
            if ( $query ) {
                
                # Feedback para o usuário.
                $this->form_msg = [0 => 'alert-success', 1=>'fa fa-info-circle', 2 => 'Sucesso! ', 3 => 'Os dados foram atualizados com sucesso!'];
                
                # Destroy variáveis nao utilizadas
                unset(  $query  );
                
                # Finaliza execução.
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
        
        # Verifica na base de dados
        $query = $this->db->query('SELECT * FROM `patrimony` WHERE `patrimony_id` = ?', [ $id ]  );

        # Verifica se a consulta foi realizada com sucesso!
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
     *   @Função: delRegister()
     *   @Versão: 0.2 
     *   @Descrição: Recebe o id passado no método e executa a exclusão caso exista o id se não retorna um erro.
     * */
    public function delRegister($id) {

        #   Recebe o ID do registro converte de string para inteiro.
        $parametro = intval($this->encode_decode(0, $id));
        //echo $ag_id; die();

        $search = $this->db->query("SELECT count(*) FROM `patrimony` WHERE `patrimony_id` = $parametro ");
        if ($search->fetchColumn() < 1) {

            #   Feedback para o usuário
            $this->form_msg = [0 => 'alert-danger', 1=>'fa fa-info-circle', 2 => 'Erro! ', 3 => 'Erro interno do sistema. Contate o administrador.'];
            
            #   Destroy variáveis não mais utilizadas
            unset($parametro, $search, $id);

            # Redireciona de volta para a página após dez segundos
            echo '<meta http-equiv="Refresh" content="4; url=' . HOME_URI . '/patrimony">';

            # Finaliza
            return;
        } else {
            # Deleta o registro
            $query_del = $this->db->delete('patrimony', 'patrimony_id', $parametro);

            #   Feedback para o usuário
            $this->form_msg = [0 => 'alert-success', 1=>'fa fa-info-circle', 2 => 'Sucesso! ', 3 => 'Registro removido com sucesso!'];

            #   Destroy variáveis não mais utilizadas
            unset($parametro, $query_del, $search, $id);

            # Redireciona de volta para a página após dez segundos
            echo '<meta http-equiv="Refresh" content="4; url=' . HOME_URI . '/patrimony">';

            #   Finaliza
            return;
        }
    }   #--> End delRegister()

        
         
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
        $query = $this->db->query( 'SELECT * FROM `patrimony` ORDER BY patrimony_id' );

        // Verifica se a consulta está OK
        if ( ! $query ) {
                return array();
        }
        // Retorna os valores da consulta
        return $query->fetchAll();
    } # End get_listar()
    
    /**
    *   @Acesso: public
    *   @Autor: Gomes - F.A.G.A <gomes.tisystem@gmail.com>
    *   @Versão: 0.1
    *   @Função: get_listar() 
    *   @Descrição: Pega o ID passado na função e retorna os valores.
    **/ 
    public function get_registro( $id = NULL ) {
        #   Recebe o ID codficado e decodifica depois converte e inteiro
        $id_decode = intval($this->encode_decode(0, $id));
        
        # Simplesmente seleciona os dados na base de dados
        $query = $this->db->query( " SELECT * FROM  `patrimony` WHERE `patrimony_id`= $id_decode " );

        # Verifica se a consulta está OK
        if ( ! $query ) {
                return array();
        }
        # Retorna os valores da consulta
        return $query->fetchAll(PDO::FETCH_ASSOC);
    } # End get_registro()

}
