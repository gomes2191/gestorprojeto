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
     * @Descrição: Armazena os dados enviado no formulário.
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
    * @Descrição: Método que trata o fromulário, verifica o tipo de formulário passado e executa as validações necessarias.
    * @Obs: Este método pode inserir ou atualizar dados dependendo do tipo de requisição solicitada pelo usuário.
    **/ 
    public function validate_register_form () {

        /* 
        * Prepara a propriede convertendo a em um
        * array para receber os dados do formulario.
        */
        $this->form_data = [];


        // Verifica se algo foi postado no formulário
        if ( 'POST' == $_SERVER['REQUEST_METHOD'] && ! empty ( $_POST ) ) {


            /* Faz o loop dos dados do formulário *
             * inserindo os no vetor @form_data. */
            foreach ( $_POST as $key => $value ) {

                // Configura os dados do post para a propriedade $form_data
                $this->form_data[$key] = $value;

                // Não será permitido campos vazios
                if ( empty( $value ) ) {

                    // Mensagem de erro caso exista campos vazios
                    $this->form_msg = '<p class="form_error">There are empty fields. Data has not been sent.</p>';

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
            return;
        }

        // Pega o valor do post, data de início e formata para o valor aceito no agenda
        $agenda_start   = $this->_formatar($this->form_data['from']);

        // Pega o valor do post, data de fim e formata para o valor aceito no agenda
        $agenda_end     = $this->_formatar($this->form_data['to']);

        // Pega o valor do post @agenda_class e retira todos os caracteres nao aceitos
        $agenda_class  = $this->avaliar($this->form_data['agenda_class']);

        // Pega o valor do post @agenda_proc e retira todos os caracteres nao aceitos
        $agenda_proc = $this->avaliar($this->form_data['agenda_proc']);

        // Pega o valor do post @agenda_pac e retira todos os caracteres nao aceitos
        $agenda_pac = $this->avaliar($this->form_data['agenda_pac']);

        // Pega o valor do post @agenda_desc e retira todos os caracteres nao aceitos
        $agenda_desc   = $this->avaliar($this->form_data['agenda_desc']);

        // Verifica se o agendamento já existe.
        $db_check_ag = $this->db->query (' SELECT * FROM `agendas` WHERE `agenda_id` = ? ', 
                [chk_array($this->form_data, 'agenda_id')]);

        // Verifica se a consulta foi realizada com sucesso
        if ( ! $db_check_ag ) {
            $this->form_msg = '<p git status="form_error">Erro interno.</p>';
            return;
        }

        // Obtém os dados da base de dados MySQL
        $fetch_ag = $db_check_ag->fetch();

        // Configura o ID do agendamento
        $agenda_id = $fetch_ag['agenda_id'];

        // Destroy vetores não mais utilizado.
        unset($db_check_ag, $fetch_ag);

        // Se o ID do agendamento não estiver vazio, atualiza os dados
        if ( ! empty( $agenda_id ) ) {

            // Atualiza os dados
            $query = $this->db->update('agendas', 'agenda_id', $agenda_id, 
                    ['agenda_start' => $agenda_start,
                    'agenda_end' => $agenda_end,
                    'agenda_start_normal'=> chk_array($this->form_data, 'from'),
                    'agenda_end_normal'=> chk_array($this->form_data, 'to'),
                    'agenda_class'=>$agenda_class,
                    'agenda_proc'=>$agenda_proc,
                    'agenda_pac'=>$agenda_pac,
                    'agenda_desc'=>$agenda_desc]);

            // Verifica se a consulta está OK e configura a mensagem
            if ( ! $query ) {
                $this->form_msg = '<p class="form_error">Erro interno. dados não atualizado.</p>';
                // Termina
                return;
            }else{
                
                $this->form_msg [] = [1 => 'alert-success', 2 => 'Sua edição foi realizada com sucesso!'];
                // Termina
                return;
            }
            
           
            // Destroy variáveis nao utilizadas
            unset($agenda_id, $query, $agenda_start, $agenda_end, $agenda_class,$agenda_proc, $agenda_pac, $agenda_desc);

        } //--> End atualiza os dados.


        // Se o ID do agendamento estiver vazio, insere os dados
        $query_ins = $this->db->insert('agendas', 
            ['agenda_start' => $agenda_start,
            'agenda_end' => $agenda_end,
            'agenda_start_normal'=> chk_array($this->form_data, 'from'),
            'agenda_end_normal'=> chk_array($this->form_data, 'to'),
            'agenda_class'=> $agenda_class,
            'agenda_proc'=> $agenda_proc,
            'agenda_pac'=> $agenda_pac,
            'agenda_desc'=> $agenda_desc]);

        // Destroy variáveis não mais utilizadas
        unset($agenda_start, $agenda_end, $agenda_class,$agenda_proc, $agenda_pac, $agenda_desc);

        // Simplesmente seleciona os dados na base de dados
        $exec_id = $this->db->query(' SELECT MAX(agenda_id) AS `agenda_id` FROM `agendas` ');
        $row = $exec_id->fetch();
        $id = trim($row[0]);

        // Gera o link do evento
        //$link = HOME_URI."/_agenda/return_descricao.php?id=$id";
        $link = HOME_URI."/agenda/box-visao?ag=$id";

        // Atualizamos nosso $link
        $query_up = $this->db->query(" UPDATE `agendas` SET `agenda_url` = '$link' WHERE `agenda_id` = $id ");

        // Verifica se a consulta está OK e configura a mensagem
        if ( ! $query_up && $query_ins ) {

            // Destroy variáveis não mais utilizadas
            unset($query_ins, $query_up, $exec_id, $row,  $id, $link);

            $this->form_msg = '<p class="form_error">Internal error. Data has not been sent.</p>';

            // Termina
            return;
        }else {

            // Destroy variáveis não mais utilizadas
            unset($query_ins, $query_up, $exec_id, $row,  $id, $link);

            $this->form_msg = '<p class="form_success">User successfully registered.</p>';
            echo '<meta http-equiv="Refresh" content="0; url=' . HOME_URI . '/agenda">';

            // Termina
            return;
        }

    } //--> End validate_register_form
    
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
    * @Função: _formatar()
    * @Versão: 0.1 
    * @Descrição: Recebe os parametros passado no método e executa a exclusão.
    **/ 
    public function del_evento ( $parametros = [] ) {

        // O ID do evento
        $evento_id = NULL;

        // Verifica se existe o parâmetro "del" na URL
        if ( chk_array( $parametros, 0 ) == 'del' ) {

            $evento_id = chk_array( $parametros, 1 );
        }

        // Verifica se o ID não está vazio
        if ( !empty( $evento_id ) ) {

            // O ID precisa ser inteiro
            $evento_id = (int) $evento_id;

            // Deleta o evento
            $query_del = $this->db->delete('agendas', 'agenda_id', $evento_id);
            
            if($query_del){
              echo '<script type="text/javascript">alert("Exclusao realizada com sucesso.")</script>';  
                
            }
            
            //Destroy variáveis não mais utilizadas
            unset($evento_id, $parametros);
           
            // Redireciona de volta para a página
            echo '<meta http-equiv="Refresh" content="0; url=' . HOME_URI . '/agenda">';
            echo '<script type="text/javascript">window.location.href = "' . HOME_URI . '/agenda";</script>';

            return;
        }
    } //--> End del_evento()
        
        
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
    }
    
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
