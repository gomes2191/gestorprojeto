<?php
/**
 * @Descrição: Classe para registro de consultas
 *
 * @Pacote: OdontoControl
 * @Versão: 0.1
 */

class AgendaModel extends MainModel
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
    * @Acesso: public
    * @Autor: Gomes - F.A.G.A <gomes.tisystem@gmail.com>
    * @Função: validate_register_form()
    * @Versão: 0.1 
    * @Descrição: Método que trata o fromulário, verifica o tipo de dados passado e executa as validações necessarias.
    * @Obs: Este método pode inserir ou atualizar dados dependendo do tipo de requisição solicitada pelo usuário.
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

                # Não será permitido campos vazios
                if ( empty( $value ) ) {
                    // Feedback para o usuário
                    $this->form_msg = [0 => 'alert-danger', 1 =>'Erro! ',  2 => 'Você não preencheu todos os campos.'];
                    // Termina
                    return;
                } //--> End

            } //Faz lop dos dados do post

        }else {
            // Finaliza se nada foi enviado
            return;
        } //--> End finaliza se nada foi enviado

        // Verifica se a propriedade $form_data foi preenchida
        if( empty( $this->form_data ) ) {
            // Finaliza a execução.
            return;
        }
        
        # Pega a data de inicio da consulta e data final da consulta e verifica se ambas estão no padrão aceito Ex: 'd/m/Y H:i' 
        if(! (($this->validaDataHora($this->form_data['from'], 'd/m/Y H:i')) && ($this->validaDataHora($this->form_data['to'], 'd/m/Y H:i'))) ){
            $this->form_msg = [0 => 'alert-danger', 1 =>'Erro!',  2 => 'Campo início da consulta e términio da consulta não atendem o formato exigido.'];
            // Finaliza a execução.
            return;
        }// End valida

        // Verifica se o agendamento já existe.
        $db_check_ag = $this->db->query (' SELECT count(*) FROM `agendas` WHERE `agenda_id` = ? ',[
            chk_array($this->form_data, 'agenda_id')
        ]);
        
        // Verifica se a consulta foi realizada com sucesso
        if ( ($db_check_ag->fetchColumn()) >= 1 ) {
            $this->updateRegister(chk_array($this->form_data, 'agenda_id'));
            return;
        }else{
             $this->insertRegister();
             return;
        }
        
    } #--> End validate_register_form()
    
    /**
    * @Acesso: public
    * @Autor: Gomes - F.A.G.A <gomes.tisystem@gmail.com>
    * @Função: insertRegister()
    * @Versão: 0.1 
    * @Descrição: Insere o registro no BD.
    * @Obs: Este método só funcionara se for chamado no método validate_register_form() ambos trabalham em conjunto.
    **/ 
    public function insertRegister(){
        
        # Se o ID do agendamento estiver vazio, insere os dados
        $query_ins = $this->db->insert('agendas',[
            'agenda_start'          =>  $this->_formatar (chk_array($this->form_data, 'from')),
            'agenda_end'            =>  $this->_formatar(chk_array($this->form_data, 'to')),
            'agenda_start_normal'   =>  chk_array($this->form_data, 'from'),
            'agenda_end_normal'     =>  chk_array($this->form_data, 'to'),
            'agenda_class'          =>  $this->avaliar(chk_array($this->form_data, 'agenda_class')),
            'agenda_proc'           =>  $this->avaliar(chk_array($this->form_data, 'agenda_proc')),
            'agenda_pac'            =>  $this->avaliar(chk_array($this->form_data, 'agenda_pac')),
            'agenda_desc'           =>  $this->avaliar(chk_array($this->form_data, 'agenda_desc'))
        ]);

        # Simplesmente seleciona os dados na base de dados
        $exec_id = $this->db->query(' SELECT MAX(agenda_id) AS `agenda_id` FROM `agendas` ');
        $row = $exec_id->fetch();
        $id = trim($row[0]);

        # Gera o link do agendamento
        $link = HOME_URI.'/agenda/box-visao?ag='.$id;

        # Atualizamos nosso $link
        $query_up = $this->db->update('agendas', 'agenda_id', $id,['agenda_url' => $link]);

        # Verifica se a consulta está OK se sim envia o Feedback para o usuário.
        if ( $query_up && $query_ins ) {

            # Destroy variáveis não mais utilizadas.
            unset($query_ins, $query_up, $exec_id, $row,  $id, $link);
            
            # Feedback para o usuário
            $this->form_msg = [0 => 'alert-success', 1 =>'Sucesso! ',  2 => 'A consulta foi isnerida com successo!'];

            # Finaliza execução.
            return;
        }
        
    }
    
    /**
    * @Acesso: public
    * @Autor: Gomes - F.A.G.A <gomes.tisystem@gmail.com>
    * @Função: updateRegister()
    * @Versão: 0.1 
    * @Descrição: Atualiza um registro especifico no BD.
    * @Obs: Este método só funcionara se for chamado no método validate_register_form() ambos trabalham em conjunto.
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
                $this->form_msg = [0 => 'alert-success', 1 =>'Sucesso!',  2 => 'Os dados foram atualizados com sucesso!'];
                
                // Destroy variáveis nao utilizadas
                unset($agenda_id, $query);
                
                echo '<meta http-equiv="Refresh" content="2; url=' . HOME_URI . '/agenda">';
                
                // Finaliza
                return;
            }
        }
    } # End updateRegister()
    
    /**
    * @Acesso: public
    * @Autor: Gomes - F.A.G.A <gomes.tisystem@gmail.com>
    * @Função: get_register_form()
    * @Versão: 0.1 
    * @Descrição: Obtém os dados de agendamentos cadastrados método usado para edição de agendamentos.
    **/ 
    public function get_register_form ( $agenda_id = FALSE ) {

        // O ID de usuário que vamos pesquisar
        $s_agenda_id = false;

        // Verifica se foi passado um valor em $agenda_id e passa o valor do tipo int para $s_agenda_id
        if ( ! empty( $agenda_id ) ) {
            $s_agenda_id = (int)$agenda_id;
            
            // Destroy Variável não mais utilizada
            unset($agenda_id);
        }

        // Verifica se existe um ID
        if ( empty( $s_agenda_id ) ) {
            return;
        }

        // Verifica na base de dados
        $query = $this->db->query('SELECT * FROM `agendas` WHERE `agenda_id` = ?', [ $s_agenda_id ]  );

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
        unset($s_agenda_id, $query, $fetch_userdata);
    } // get_register_form
        
        
    /**
    * @Acesso: public
    * @Autor: Gomes - F.A.G.A <gomes.tisystem@gmail.com>
    * @Função: del_agendamento()
    * @Versão: 0.1 
    * @Descrição: Recebe os parametros passado no método e executa a exclusão.
    **/ 
    public function delRegister ( $id ) {

        // O ID do evento
        $ag_id = $this->avaliar($id);
        
        $search = $this->db->query("SELECT * FROM `agendas` WHERE agenda_id = $ag_id ");
        if($search->fetch(PDO::FETCH_NUM) < 1){

            // Feedback para o usuário
            $this->form_msg = [0 => 'alert-danger', 1 =>'Erro!',  2 => 'Erro interno do sistema. Contate o administrador.'];

            //Destroy variáveis não mais utilizadas
            unset($ag_id, $search, $id);

            // Redireciona de volta para a página após dez segundos
            echo '<meta http-equiv="Refresh" content="2; url=' . HOME_URI . '/agenda">';

            // Finaliza
            return;
        } else {
            // Deleta o evento
            $query_del = $this->db->delete('agendas', 'agenda_id', $ag_id);
            
            // Feedback para o usuário
            $this->form_msg = [0 => 'alert-success', 1 =>'Sucesso!',  2 => 'Seu agendamento foi deletado com sucesso!'];
            
            // Destroy variáveis não mais utilizadas
            unset($ag_id, $query_del, $search, $id);

            // Redireciona de volta para a página após dez segundos
            echo '<meta http-equiv="Refresh" content="2; url=' . HOME_URI . '/agenda">';
            
            // Finaliza
            return;
        }
        
    } //--> End del_agendamento()
        
        
    /**
    * @Acesso: public
    * @Autor: Gomes - F.A.G.A <gomes.tisystem@gmail.com>
    * @Função: return_json_evento() 
    * @Descrição: Pega os dados referente as consultas na base de dados e retorna um Json no padrão aceito pela calendario do Sistema.
    **/
    public function return_json_evento() {

    // Pega todos os dados da tabela agendas.
    $query = $this->db->query(' SELECT * FROM `agendas` ');

    // Verifica se a consulta foi realizada com sucesso.
    if (!$query) {
        return [];
    }
    
    
    /**
    * Faz um loop com os dados da query inserindo no vetor $row
    * e pega os valores especifico e insere no vetor $out. 
    **/ 
    foreach ($query as $row){
        $out[] = [
            'id'       => $row['agenda_id'],
            'title'    => $row['agenda_pac'],
            'url'      => $row['agenda_url'],
            'body'     => $row['agenda_desc'],
            'class'    => $row['agenda_class'],
            'start'    => $row['agenda_start'],
            'end'      => $row['agenda_end']
        ];

    }
        // Converte em um json o valor do vetor e imprime
        echo json_encode(array('success' => 1, 'result' => $out));
        exit;
        
    } // End return_json_evento()
    
    
    /**
    * @Acesso: public
    * @Autor: Gomes - F.A.G.A <gomes.tisystem@gmail.com>
    * @Função: get_ultimo_id() 
    * @Descrição: Pega o ultimo ID do agendamento.
    **/
    public function get_ultimo_id() {
        // Simplesmente seleciona os dados na base de dados
        $query = $this->db->query(' SELECT MAX(agenda_id) AS `agenda_id` FROM `agendas` ');
         
        $row = $query->fetch();
        $id = trim($row[0]);
        
        return $id;
        
     } // End get_ultimo_id()
     
     
    /**
    * @Acesso: public
    * @Autor: Gomes - F.A.G.A <gomes.tisystem@gmail.com>
    * @Função: get_listar() 
    * @Descrição: Pega o ID passado na função e retorna os valores.
    **/ 
    public function get_listar($agenda_id = NULL) {
        
        // Simplesmente seleciona os dados na base de dados
        $query = $this->db->query( " SELECT * FROM  `agendas` WHERE `agenda_id`= $agenda_id " );

        // Verifica se a consulta está OK
        if ( ! $query ) {
                return array();
        }
        // Retorna os valores da consulta
        return $query->fetch(PDO::FETCH_ASSOC);
    } // End get_listar()

    
    /**
    * @Acesso: public
    * @Autor: Gomes - F.A.G.A <gomes.tisystem@gmail.com>
    * @Função: jsonPagination() 
    * @Descrição: Função que recebe os valores passado e executa a consulta SQL e imprime o retorno do json para a paginação.
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
    * @Acesso: public
    * @Autor: Gomes - F.A.G.A <gomes.tisystem@gmail.com>
    * @Função: _formatar() 
    * @Descrição: Microtime formatar uma data do tipo 21/09/2016 12:00 para o formato tipo 1401517498985 aceito pelo calendario.
    **/ 
    public function _formatar($fecha) {
        return strtotime(substr($fecha, 6, 4) . "-" . substr($fecha, 3, 2) . "-" . substr($fecha, 0, 2) . " " . substr($fecha, 10, 6)) * 1000;
    }
}
