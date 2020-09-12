<?php

/**
 *  @Autor: F.A.G.A <gomes.tisystem@gmail.com>
 *  @Class: AgendaModel
 *  @Descrição: Classe para registro de consultas
 *
 *  @Pacote: OdontoControl
 *  @Versão: 0.1
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
    public $pag_type = 'calendar';

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
    public function __construct($db = FALSE)
    {
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
    public function validate_register_form()
    {
        # Cria o vetor que vai receber os dados do post
        $this->form_data = [];

        # Verifica se não é vazio o $_POST
        if ((filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_DEFAULT) === 'POST') && (!empty(filter_input_array(INPUT_POST, FILTER_DEFAULT)))) {

            # Faz o loop dos dados do formulário inserindo os no vetor $form_data.
            foreach (filter_input_array(INPUT_POST, FILTER_DEFAULT) as $key => $value) {

                # Configura os dados do post para a propriedade $form_data
                $this->form_data[$key] = $value;
            } # End foreach

            //var_dump($this->form_data);die;

            //            #   Não será permitido campos vazios
            //            if ( empty( $this->form_data['fees_cod'] )) {
            //                
            //                #   Feedback para o usuário
            //                $this->form_msg = [0 => 'alert-warning', 1=>'glyphicon glyphicon-info-sign', 2 => 'Opa! ', 3 => 'Campos marcados com <strong>*</strong> são obrigatórios .'];
            //                
            //                # Termina
            //                return;
            //            }
        } else {
            # Finaliza a execução.
            return 'err';
        } #--> End

        # Verifica se o registro já existe.
        $db_check_ag = $this->db->query(' SELECT count(*) FROM `calendar` WHERE `calendar_id` = ? ', [
            chkArray($this->form_data, 'calendar_id')
        ]);

        # Verefica qual tipo de ação a ser tomada se existe ID faz Update se não existir efetua o insert
        if (($db_check_ag->fetchColumn()) >= 1) {
            $this->updateRegister(chkArray($this->form_data, 'calendar_id'));
        } else {
            //var_dump($this->form_data);die;
            $this->insertRegister();
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
    public function insertRegister()
    {
        # Se o ID do agendamento estiver vazio, insere os dados
        $query_ins = $this->db->insert('calendar', [
            'calendar_start'          =>  $this->_formatar(chkArray($this->form_data, 'from')),
            'calendar_end'            =>  $this->_formatar(chkArray($this->form_data, 'to')),
            'calendar_start_normal'   =>  chkArray($this->form_data, 'from'),
            'calendar_end_normal'     =>  chkArray($this->form_data, 'to'),
            'calendar_class'          =>  $this->avaliar(chkArray($this->form_data, 'calendar_class')),
            'calendar_proc'           =>  $this->avaliar(chkArray($this->form_data, 'calendar_proc')),
            'calendar_pat'            =>  $this->avaliar(chkArray($this->form_data, 'calendar_pat')),
            'calendar_desc'           =>  $this->avaliar(chkArray($this->form_data, 'calendar_desc'))
        ]);

        # Simplesmente seleciona os dados na base de dados
        $exec_id = $this->db->query(' SELECT MAX(calendar_id) AS `calendar_id` FROM `calendar` ');
        $row = $exec_id->fetch();
        $id = trim($row[0]);

        # Gera o link do agendamento
        //$link = HOME_URI.'/agenda/box-visao?ag='.$this->encodeDecode($id);

        # Atualizamos nosso $link
        //$query_up = $this->db->update('calendar', 'calendar_id', $id,['calendar_url' => $link]);

        # Verifica se a consulta está OK se sim envia o Feedback para o usuário.
        if ($query_ins) {

            # Destroy variáveis não mais utilizadas.
            unset($query_ins, $query_up, $exec_id, $row,  $id);

            # Feedback para o usuário
            $this->form_msg = [0 => 'alert-success', 1 => 'glyphicon glyphicon-info-sign', 2 => 'Sucesso! ', 3 => 'Registro inserido com sucesso!'];

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
    public function updateRegister($calendar_id = NULL)
    {
        # Se o ID não estiver vazio, atualiza os dados
        if ($calendar_id) {
            # Atualiza os dados
            $query = $this->db->update('calendar', 'calendar_id', $calendar_id, [
                'calendar_start'          =>  $this->_formatar(chkArray($this->form_data, 'from')),
                'calendar_end'            =>  $this->_formatar(chkArray($this->form_data, 'to')),
                'calendar_start_normal'   =>  chkArray($this->form_data, 'from'),
                'calendar_end_normal'     =>  chkArray($this->form_data, 'to'),
                'calendar_class'          =>  $this->avaliar(chkArray($this->form_data, 'calendar_class')),
                'calendar_proc'           =>  $this->avaliar(chkArray($this->form_data, 'calendar_proc')),
                'calendar_pat'            =>  $this->avaliar(chkArray($this->form_data, 'calendar_pat')),
                'calendar_desc'           =>  $this->avaliar(chkArray($this->form_data, 'calendar_desc'))
            ]);

            // Verifica se a consulta foi realizada com sucesso
            if ($query) {
                // Feedback para o usuário.
                $this->form_msg = [0 => 'alert-info', 1 => 'Sucesso!',  2 => 'Os dados foram atualizados com sucesso!'];

                // Destroy variáveis nao utilizadas
                unset($calendar_id, $query);

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
    public function get_register_form($agenda_id = FALSE)
    {

        $id = intval($this->encodeDecode(0, $agenda_id));

        // Verifica na base de dados
        $query = $this->db->query('SELECT * FROM `calendar` WHERE `calendar_id` = ?', [$id]);

        // Verifica se a consulta foi realizada com sucesso!
        if (!$query) {
            $this->form_msg = '<p class="form_error">Agendamento não existe.</p>';
            return;
        }

        // Obtém os dados da consulta
        $fetch_userdata = $query->fetch();

        // Verifica se os dados da consulta estão vazios
        if (empty($fetch_userdata)) {
            $this->form_msg = '<p class="form_error">Agendamento não existe.</p>';
            return;
        }

        // Faz um loop dos dados do formulário, guardando os no vetor $form_data
        foreach ($fetch_userdata as $key => $value) {
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
    public function delRegister($id)
    {

        # Recebe o ID do registro converte de string para inteiro.
        $ag_id = intval($this->encodeDecode(0, $id));
        //echo $ag_id; die();

        $search = $this->db->query("SELECT count(*) FROM `agendas` WHERE `agenda_id` = $ag_id ");
        if ($search->fetchColumn() < 1) {

            // Feedback para o usuário
            $this->form_msg = [0 => 'alert-danger', 1 => 'Erro!',  2 => 'Erro interno do sistema. Contate o administrador.'];

            //Destroy variáveis não mais utilizadas
            unset($ag_id, $search, $id);

            // Redireciona de volta para a página após 2 segundos
            // echo '<meta http-equiv="Refresh" content="2; url=' . HOME_URI . '/agenda">';

            // Finaliza
            return;
        } else {
            # Deleta o registro
            $query_del = $this->db->delete('agendas', 'agenda_id', $ag_id);

            // Feedback para o usuário
            $this->form_msg = [0 => 'alert-info', 1 => 'Sucesso!',  2 => 'Seu agendamento foi deletado com sucesso!'];

            // Destroy variáveis não mais utilizadas
            unset($ag_id, $query_del, $search, $id);

            // Redireciona de volta para a página após dez segundos
            //echo '<meta http-equiv="Refresh" content="2; url=' . HOME_URI . '/agenda">';

            // Finaliza
            return;
        }
    } //--> End del_agendamento()


    /**
     *   @Acesso: public
     *   @Autor: Gomes - F.A.G.A <gomes.tisystem@gmail.com>
     *   @Versão: 0.1
     *   @Função: return_json_evento() 
     *   @Descrição: Pega os dados referente as consultas na base de dados e retorna um Json no padrão aceito pela calendario do Sistema.
     **/
    public function return_json_evento()
    {
        // Pega todos os dados da tabela agendas.
        $query = $this->db->query(' SELECT * FROM `calendar` ');
        // Verifica se a consulta foi realizada com sucesso.
        if (!$query) {
            return [];
        }

        /**
         * Faz um loop com os dados da query inserindo no vetor $row
         * e pega os valores especifico e insere no vetor $out. 
         * */
        foreach ($query as $row) {
            $out[] = [
                'id'    => $this->encodeDecode($row['calendar_id']),
                'title' => $row['calendar_pat'],
                //'url' => $row['calendar_url'],
                'desc'  => $row['calendar_desc'],
                'class' => $row['calendar_class'],
                'start_normal' => $row['calendar_start_normal'],
                'end_normal'   => $row['calendar_end_normal'],
                'start' => $row['calendar_start'],
                'end'   => $row['calendar_end']
            ];
        }
        // Converte em um json o valor do vetor e imprime
        echo json_encode(['success' => 1, 'result' => $out]);
    } # End return_json_evento()

    /**
     *   @Acesso: public
     *   @Autor: Gomes - F.A.G.A <gomes.tisystem@gmail.com>
     *   @Versão: 0.1
     *   @Função: get_ultimo_id() 
     *   @Descrição: Pega o ultimo ID do agendamento.
     **/
    public function get_ultimo_id()
    {
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
    public function get_listar($agenda_id = NULL)
    {
        #   Recebe o ID codficado e decodifica depois converte e inteiro
        $id_decode = intval($this->encodeDecode(0, $agenda_id));
        //echo $id_decode;die();

        // Simplesmente seleciona os dados na base de dados
        $query = $this->db->query(" SELECT * FROM  `agendas` WHERE `agenda_id`= $id_decode ");

        // Verifica se a consulta está OK
        if (!$query) {
            return array();
        }
        // Retorna os valores da consulta
        return $query->fetch(PDO::FETCH_ASSOC);
    } // End get_listar()


    /**
     *   @Acesso: public
     *   @Autor: Gomes - F.A.G.A <gomes.tisystem@gmail.com>
     *   @Versão: 0.1
     *   @Função: jsonPagination() 
     *   @Descrição: Função que recebe os valores passado e executa a consulta SQL e imprime o retorno do json para a paginação.
     **/
    public function jsonPagination($param1 = NULL, $limit = NULL, $offset = NULL)
    {

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

                $jsondataList[] = $jsondataperson;
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
    public function _formatar($fecha)
    {
        return strtotime(substr($fecha, 6, 4) . "-" . substr($fecha, 3, 2) . "-" . substr($fecha, 0, 2) . " " . substr($fecha, 10, 6)) * 1000;
    }
}
