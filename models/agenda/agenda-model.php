<?php
/**
 * Classe para registro de consultas
 *
 * @package OdontoVision
 * @since 0.1
 */

class AgendaModel
{

	/**
	 * $form_data
	 *
	 * Os dados do formulário de envio.
	 *
	 * @access public
	 */
	public $form_data;

	/**
	 * $form_msg
	 *
	 * As mensagens de feedback para o usuário.
	 *
	 * @access public
	 */
	public $form_msg;

	/**
	 * $db
	 *
	 * O objeto da nossa conexão PDO
	 *
	 * @access public
	 */
	public $db;

	/**
	 * Construtor
	 *
	 * Carrega  o DB.
	 *
	 * @since 0.1
	 * @access public
	 */
	public function __construct( $db = false ) {
		$this->db = $db;
	}

	/**
	 * Valida o formulário de envio
	 *
	 * Este método pode inserir ou atualizar dados dependendo do campo de
	 * usuário.
	 *
	 * @since 0.1
	 * @access public
	 */
	public function validate_register_form () {

		// Configura os dados do formulário
		$this->form_data = array();


		// Verifica se algo foi postado
		if ( 'POST' == $_SERVER['REQUEST_METHOD'] && ! empty ( $_POST ) ) {

			// Faz o loop dos dados do post
			foreach ( $_POST as $key => $value ) {

				// Configura os dados do post para a propriedade $form_data
				$this->form_data[$key] = $value;

				// Nós não permitiremos nenhum campos em branco
				if ( empty( $value ) ) {

					// Configura a mensagem
					$this->form_msg = '<p class="form_error">There are empty fields. Data has not been sent.</p>';
					// Termina
					return;
				} //Verifica campos em branco
			} //Faz lop dos dados do post

		} else {

			// Termina se nada foi enviado
			return;

		}// Finaliza se nada foi enviado

		// Verifica se a propriedade $form_data foi preenchida
		if( empty( $this->form_data ) ) {
			return;
		}

		/* // Verifica se o usuário existe
		$db_check_user = $this->db->query (
			'SELECT * FROM `users` WHERE `user` = ?',
			array(
				chk_array( $this->form_data, 'user')
			)
		);

		// Verifica se a consulta foi realizada com sucesso
		if ( ! $db_check_user ) {
			$this->form_msg = '<p class="form_error">Internal error.</p>';
			return;
		}

		// Obtém os dados da base de dados MySQL
		$fetch_user = $db_check_user->fetch();

		// Configura o ID do usuário
		$user_id = $fetch_user['user_id'];

		// Precisaremos de uma instância da classe Phpass
		// veja http://www.openwall.com/phpass/
		$password_hash = new PasswordHash(8, FALSE);

		// Cria o hash da senha
		$password = $password_hash->HashPassword( $this->form_data['user_password'] );

		// Verifica se as permissões tem algum valor inválido:
		// 0 a 9, A a Z e , . - _
		if ( preg_match( '/[^0-9A-Za-z\,\.\-\_\s ]/is', $this->form_data['user_permissions'] ) ) {
			$this->form_msg = '<p class="form_error">Use just letters, numbers and a comma for permissions.</p>';
			return;
		}

		// Faz um trim nas permissões
		$permissions = array_map('trim', explode(',', $this->form_data['user_permissions']));

		// Remove permissões duplicadas
		$permissions = array_unique( $permissions );

		// Remove valores em branco
		$permissions = array_filter( $permissions );

		// Serializa as permissões
		$permissions = serialize( $permissions );


		// Se o ID do usuário não estiver vazio, atualiza os dados
		if ( ! empty( $user_id ) ) {

			$query = $this->db->update('users', 'user_id', $user_id, array(
				'user_password' => $password,
				'user_name' => chk_array( $this->form_data, 'user_name'),
				'user_session_id' => md5(time()),
				'user_permissions' => $permissions,
			));

			// Verifica se a consulta está OK e configura a mensagem
			if ( ! $query ) {
				$this->form_msg = '<p class="form_error">Internal error. Data has not been sent.</p>';

				// Termina
				return;
			} else {
				$this->form_msg = '<p class="form_success">User successfully updated.</p>';

				// Termina
				return;
			}
		// Se o ID do usuário estiver vazio, insere os dados
		}*/

                
                
                        $agenda_start   = $this->_formatar($this->form_data['from']);
			 // e reformatar o funcion _formatar
			$agenda_end     = $this->_formatar($this->form_data['to']);
//			 // Recebemos a data de início e a data de término da forma
//			 $agenda_start_normal = ($this->form_data['from']);
//			 // e reformatar o funcion _formatar
//			 $agenda_end_normal  = ($this->form_data['to']);
			 // substituir caracteres ilegais
			 $agenda_class  = $this->avaliar($this->form_data['agenda_class']);
			 // Outros receber dados do form
                         
                          // e com function avaliar
                         $agenda_proc = $this->avaliar($this->form_data['agenda_proc']);
			 $agenda_pac = $this->avaliar($this->form_data['agenda_pac']);
			 $agenda_desc   = $this->avaliar($this->form_data['agenda_desc']);

//                         var_dump($this->form_data);die;
                        
                        
			// Executa a inserção na basse de dados.
			$query = $this->db->insert('agendas', 
                            ['agenda_start' => $agenda_start,
                            'agenda_end' => $agenda_end,
                            'agenda_start_normal'=> chk_array($this->form_data, 'from'),
                            'agenda_end_normal'=> chk_array($this->form_data, 'to'),
                            'agenda_class'=>$agenda_class,
                            'agenda_proc'=>$agenda_proc,
                            'agenda_pac'=>$agenda_pac,
                            'agenda_desc'=>$agenda_desc
                            ]);
                        
                        // Simplesmente seleciona os dados na base de dados
                        $exec_id = $this->db->query('SELECT MAX(agenda_id) AS `agenda_id` FROM `agendas`');
                        $row = $exec_id->fetch();
                        $id = trim($row[0]);
                        
                        // Gera o link do evento
                        //$link = HOME_URI."/_agenda/return_descricao.php?id=$id";
                        $link = HOME_URI.'/agenda?id='.$id;

                        // Atualizamos nosso $link
                        $this->db->query("UPDATE `agendas` SET `agenda_url` = '$link' WHERE `agenda_id` = $id");
                        
			// Verifica se a consulta está OK e configura a mensagem
			if ( ! $query ) {
				$this->form_msg = '<p class="form_error">Internal error. Data has not been sent.</p>';

				// Termina
				return;
			} else {
				$this->form_msg = '<p class="form_success">User successfully registered.</p>';

				// Termina
				return;
			}

	} // validate_register_form

	/**
	 * Obtém os dados do formulário
	 *
	 * Obtém os dados para usuários registrados
	 *
	 * @since 0.1
	 * @access public
	 */
	public function get_register_form ( $user_id = false ) {

		// O ID de usuário que vamos pesquisar
		$s_user_id = false;

		// Verifica se você enviou algum ID para o método
		if ( ! empty( $user_id ) ) {
			$s_user_id = (int)$user_id;
		}

		// Verifica se existe um ID de usuário
		if ( empty( $s_user_id ) ) {
			return;
		}

		// Verifica na base de dados
		$query = $this->db->query('SELECT * FROM `users` WHERE `user_id` = ?', array( $s_user_id ));

		// Verifica a consulta
		if ( ! $query ) {
			$this->form_msg = '<p class="form_error">Usuário não existe.</p>';
			return;
		}

		// Obtém os dados da consulta
		$fetch_userdata = $query->fetch();

		// Verifica se os dados da consulta estão vazios
		if ( empty( $fetch_userdata ) ) {
			$this->form_msg = '<p class="form_error">User do not exists.</p>';
			return;
		}

		// Configura os dados do formulário
		foreach ( $fetch_userdata as $key => $value ) {
			$this->form_data[$key] = $value;
		}

		// Por questões de segurança, a senha só poderá ser atualizada
		$this->form_data['user_password'] = null;

		// Remove a serialização das permissões
		$this->form_data['user_permissions'] = unserialize($this->form_data['user_permissions']);

		// Separa as permissões por vírgula
		$this->form_data['user_permissions'] = implode(',', $this->form_data['user_permissions']);
	} // get_register_form

	/*
	 * @param funtion del_evento() responsavel por eliminar eventos
	 *
	 * @since 0.1
	 * @access public
        */
	public function del_evento ($evento_id = NULL) {
            
		// Verifica se o ID não está vazio
		if ( !empty( $evento_id ) ) {

			// O ID precisa ser inteiro
			$evento_id = (int)$evento_id;

			// Deleta o usuário
			$this->db->delete('agendas', 'agenda_id', $evento_id);
                        
                        
                        
			// Redireciona para a página de registros
			echo '<meta http-equiv="Refresh" content="0; url=' . HOME_URI . '/agenda">';
			echo '<script type="text/javascript">window.location.href = "' . HOME_URI . '/user-register/";</script>';
			return;
                }else{
                    echo $evento_id;
                }
                
	} //---> fim del_evento() 
        
        
        /**
	 * Obtém as consultas 
	 *
	 * @return_json_evento
	 * @access public
	 */
        public function return_json_evento() {

        // Pega todos os dados da tabela agendas.
        $query = $this->db->query(' SELECT * FROM `agendas` ');

        // Verifica se a consulta foi realizada com sucesso.
        if (!$query) {
            return [];
        }
        
        foreach ($query as $row){
            $out[] = array(
                'id'        => $row['agenda_id'],
                'title'     => $row['agenda_pac'],
                'url'       => $row['agenda_url'],
                'body'      => $row['agenda_desc'],
                'class'     => $row['agenda_class'],
                'start'     => $row['agenda_start'],
                'end'       => $row['agenda_end']
            );
            
        }
        return json_encode($out);
        
    } // @get_agenda_consulta
    
     public function get_ultimo_id() {
        // Simplesmente seleciona os dados na base de dados
        $query = $this->db->query('SELECT MAX(agenda_id) AS `agenda_id` FROM `agendas`');
         
        $row = $query->fetch();
        $id = trim($row[0]);
        
        return $id;
        
     } // @get_ultimo_id

        /*
	 * Obtém a lista de usuários
	 *
	 * @since 0.1
	 * @access public
	 */
	public function get_evento_list($id = NULL) {
                
                
                
		// Simplesmente seleciona os dados na base de dados
		$query = $this->db->query("SELECT * FROM  `agendas` WHERE `agenda_id`=$id");

		// Verifica se a consulta está OK
		if ( ! $query ) {
			return array();
		}
		// Preenche a tabela com os dados do usuário
		return $query->fetchAll();
	} // get_agenda_list
        
        

      // Avaliar os dados inseridos pelo usuário e excluir caracteres indesejados.
    public function avaliar($valor_ini) {
        $nopermitido = array("'", '\\', '<', '>', "\"");
        $valor_1 = str_replace($nopermitido, "", $valor_ini);

        $valor = filter_var($valor_1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
        return $valor;
    }

    // Microtime formatar uma data para adicionar o evento, tipo 1401517498985.
    public function _formatar($fecha) {
        return strtotime(substr($fecha, 6, 4) . "-" . substr($fecha, 3, 2) . "-" . substr($fecha, 0, 2) . " " . substr($fecha, 10, 6)) * 1000;
    }

}
