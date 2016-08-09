<?php

/**
 * Classe para registros de usuários
 *
 * @package OdontoVision
 * @since 0.1
 */
class RegisterModel {

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
    public function __construct($db = false) {
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
     * */
    public function validate_register_form() {

        // Configura os dados do formulário
        $this->form_data = array();

        // Verifica se algo foi postado
        if ('POST' == $_SERVER['REQUEST_METHOD'] && !empty($_POST)) {

            // Faz o loop dos dados do post
            foreach ($_POST as $key => $value) {
                // Configura os dados do post para a propriedade $form_data
                // e remove todo e qualquer tipo de tags que venham a ser passsado nos campos
                $this->form_data[$key] = filter_var($value, FILTER_SANITIZE_STRING);

                // Nós não permitiremos nenhum campos em branco
                if (empty($value)) {

                    // Configura a mensagem
                    $this->form_msg = '
                    <div class="alert alert-warning alert-dismissible fade in">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <strong>Opa!</strong> Você deixou campos em brancos.
                    </div> ';

                    // Termina
                    return;
                }
            }
        } else {
            // Termina se nada foi enviado
            return;
        }

        // Verifica se a propriedade $form_data foi preenchida
        if (empty($this->form_data)) {
            return;
        }

        // Verifica se o usuário existe
        $db_check_user = $this->db->query(
                'SELECT * FROM `users` WHERE `user_email` = ?', array(
            chk_array($this->form_data, 'user_email')
                )
        );

        // Verifica se a consulta foi realizada com sucesso
        if (!$db_check_user) {
            $this->form_msg = '<p class="form_error">Internal error.</p>';
            return;
        }

        // Obtém os dados da base de dados MySQL
        $fetch_user = $db_check_user->fetch();

        // Configura o ID do usuário
        $user_id = $fetch_user['user_id'];

        // Converte a senha enviada através do formulário para o hash (Criptografa) com API PHP
        // passando a hash para a variável $password
        $password = password_hash($this->form_data['user_password'], PASSWORD_DEFAULT);

        // Pega o valor email do formulario e verifica se é um email se for email retorna
        // o valor do email para variável $user_email se não retorna o valor false para a variável
        $user_email = (filter_var($this->form_data['user_email'], FILTER_VALIDATE_EMAIL));

        if ($user_email == false) {
            $this->form_msg = '<div class="alert alert-warning alert-dismissible fade in">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                <strong>Opa!</strong> Este email não é válido.
                </div>';
            return;
        }


        //Variaveis para inserção na base de dados
        $role_id = 1; // Onde 1 é adm e 2 user
        $user_status = 1; // Onde 1 e usuario ativo e 2 não ativo;
        /*// Verifica se as permissões tem algum valor inválido:
        // 0 a 9, A a Z e , . - _
        if (preg_match('/[^0-9A-Za-z\,\.\-\_\s ]/is', $this->form_data['user_permissions'])) {
            $this->form_msg = '<p class="form_error">Use just letters, numbers and a comma for permissions.</p>';
            return;
        }

        // Faz um trim nas permissões
        $permissions = array_map('trim', explode(',', $this->form_data['user_permissions']));


        // Remove permissões duplicadas
        $permissions = array_unique($permissions);

        // Remove valores em branco
        $permissions = array_filter($permissions);

        // Serializa as permissões
        $permissions = serialize($permissions);*/

        /*
          // Se o ID do usuário não estiver vazio, atualiza os dados
          if (!empty($user_id) and chk_array($this->form_data, 'user_email') === $fetch_user['user_email'] ) {
          $query = $this->db->update('users', 'user_id', $user_id, array(
          'user_name' => chk_array($this->form_data, 'user_name'),
          'user_email' => $user_email,
          'user_password' => $password,
          'user_session_id' => md5(time()),
          'user_permissions' => $permissions,
          'user_role_id' => $role_id,
          'user_status' => $user_status,
          ));

          // Verifica se a consulta está OK e configura a mensagem
          if (!$query) {
          $this->form_msg = '<p class="form_error">Internal error. Data has not been sent.</p>';

          // Termina
          return;
          } else {
          $this->form_msg = '<p class="form_success">User successfully updated.</p>';

          // Termina
          return;
          }
          }

          // Se o ID do usuário estiver vazio, insere os dados
          else {
          //  --->
          // insere o nome da clinica (revisar)
          $this->db->insert('clinics', array(
          'clinic_name' => chk_array($this->form_data, 'clinic_name'),
          ));

          $user_clinic_id = $this->db->lastInsertId();
          // <----
          // Executa a consulta
          $query = $this->db->insert('users', array(
          //'user_user' => chk_array($this->form_data, 'user_user'),
          'user_name' => chk_array($this->form_data, 'user_name'),
          'user_email' => $user_email,
          'user_password' => $password,
          'user_session_id' => md5(time()),
          'user_permissions' => $permissions,
          'user_clinic_id' => $user_clinic_id,
          'user_role_id' => $role_id,
          'user_status' => $user_status,
          ));

          // Verifica se a consulta está OK e configura a mensagem
          if (!$query) {
          $this->form_msg = '<p class="form_error">Internal error. Data has not been sent.</p>';

          // Termina
          return;
          } else {
          $this->form_msg = '<p class="form_success">User successfully registered.</p>';

          // Termina
          return;
          }
          } */

        // Verifica se o email digitado já existe na base de dados
        if (!empty($user_id) and chk_array($this->form_data, 'user_email') === $fetch_user['user_email']) {

            $this->form_msg = '<div class="alert alert-warning alert-dismissible fade in">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                <strong>Opa!</strong> Email já se encontra na nossa base de dados.
                </div>';
        } else {
            // insere o nome da clinica (revisar)
            $this->db->insert('clinics', array(
                'clinic_name' => chk_array($this->form_data, 'clinic_name'),
            ));

            $user_clinic_id = $this->db->lastInsertId();
            
            // Executa a consulta
            $query = $this->db->insert('users', array(
                //'user_user' => chk_array($this->form_data, 'user_user'),
                'user_name' => chk_array($this->form_data, 'user_name'),
                'user_email' => $user_email,
                'user_password' => $password,
                'user_session_id' => md5(time()),                
                'user_clinic_id' => $user_clinic_id,
                'user_role_id' => $role_id,
                'user_status' => $user_status,
            ));

            // Verifica se a consulta está OK e configura a mensagem
            if (!$query) {
                $this->form_msg = '<p class="form_error">Internal error. Data has not been sent.</p>';

                // Termina
                return;
            } else {
                $this->form_msg = '<div class="alert alert-success alert-dismissible fade in">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                <strong>Sucesso!</strong> Usuário cadastrado com sucesso.
                </div>';

                // Termina
                return;
            }
        } // End insert
    }

// validate_register_form

    /**
     * Obtém os dados do formulário
     *
     * Obtém os dados para usuários registrados
     *
     * @since 0.1
     * @access public
     * */
    public function get_register_form($user_id = false) {

        // O ID de usuário que vamos pesquisar
        $s_user_id = false;

        // Verifica se você enviou algum ID para o método
        if (!empty($user_id)) {
            $s_user_id = (int) $user_id;
        }

        // Verifica se existe um ID de usuário
        if (empty($s_user_id)) {
            return;
        }

        // Verifica na base de dados
        $query = $this->db->query('SELECT * FROM `users` WHERE `user_id` = ?', array($s_user_id));

        // Verifica a consulta
        if (!$query) {
            $this->form_msg = '<p class="form_error">Usuário não existe.</p>';
            return;
        }

        // Obtém os dados da consulta
        $fetch_userdata = $query->fetch();

        // Verifica se os dados da consulta estão vazios
        if (empty($fetch_userdata)) {
            // Redireciona para a página de registros
            echo '<meta http-equiv="Refresh" content="0; url=' . HOME_URI . '/user-register/">';
            echo '<script type="text/javascript">window.location.href = "' . HOME_URI . '/user-register/";</script>';
            //$this->form_msg = '<p class="form_error">User do not exists.</p>';
            return;
        }

        // Configura os dados do formulário
        foreach ($fetch_userdata as $key => $value) {
            $this->form_data[$key] = $value;
        }

        // Por questões de segurança, a senha só poderá ser atualizada
        $this->form_data['user_password'] = null;

        /*// Remove a serialização das permissões
        $this->form_data['user_permissions'] = unserialize($this->form_data['user_permissions']);

        // Separa as permissões por vírgula
        $this->form_data['user_permissions'] = implode(',', $this->form_data['user_permissions']);*/
    }

// get_register_form

    /**
     * Apaga usuários
     *
     * @since 0.1
     * @access public
     */
    public function del_user($parametros = array()) {

        // O ID do usuário
        $user_id = null;

        // Verifica se existe o parâmetro "del" na URL
        if (chk_array($parametros, 0) == 'del') {
            
            //Era aqui
            
            // Verifica se o valor do parâmetro é um número
            if (
                    is_numeric(chk_array($parametros, 1)) && chk_array($parametros, 2) == 'confirma'
            ) {
                // Configura o ID do usuário a ser apagado
                $user_id = chk_array($parametros, 1);
            }
        }

        // Verifica se o ID não está vazio
        if (!empty($user_id)) {

            // O ID precisa ser inteiro
            $user_id = (int) $user_id;

            // Deleta o usuário
            $query = $this->db->delete('users', 'user_id', $user_id);

            // Redireciona para a página de registros
            echo '<meta http-equiv="Refresh" content="0; url=' . HOME_URI . '/user-register/">';
            echo '<script type="text/javascript">window.location.href = "' . HOME_URI . '/user-register/";</script>';
            return;
        }
    }// del_user



    /**
     * Obtém a lista de usuários
     *
     * @since 0.1
     * @access public
     */
    public function get_user_list() { 

        // Simplesmente seleciona os dados na base de dados
        $query = $this->db->query('SELECT * FROM `users` ORDER BY user_id');

        // Verifica se a consulta está OK
        if (!$query) {
            return array();
        }
        // Preenche a tabela com os dados do usuário
        return $query->fetchAll();
    } // End get_user_list
	
}
