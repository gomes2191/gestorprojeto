<?php

/**
 * Classe para registros de usuários
 *
 * @package OdontoControl
 * @since 0.1
 */
class UsersModel extends MainModel {

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
        #   Cria o vetor que vai receber os dados do post
        $this->form_data = [];
        
        #   Verifica se algo foi postado no formulário
        if ((filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_DEFAULT) === 'POST') && (!empty(filter_input_array(INPUT_POST, FILTER_DEFAULT)))) {
            
            if (empty(filter_input(INPUT_POST, 'user_email', FILTER_VALIDATE_EMAIL))) {
                #   Feedback para o usuário
                $this->form_msg = [0 => 'alert-warning', 1 => 'Opa! ', 2 => 'Email não válido verifique o email e tente novamente.'];
                #   Termina
                return;
            }

            #   Faz o loop dos dados do formulário inserindo os no vetor @form_data.
            foreach (filter_input_array(INPUT_POST, FILTER_DEFAULT) as $key => $value) {

                #   Configura os dados do post para a propriedade $form_data
                $this->form_data[$key] = $value;
            } #-->  Faz lop dos dados do post
            
            $this->process_data($this->form_data);
            
            var_dump($this->form_data['user_level_1']);die;
            
            #   Destroy variaveis não mais utilizadas
            unset($value, $key);
             
            #   Verifica se ambos os campos não estão vazio 
            if (empty($this->form_data['user_name'] AND $this->form_data['user_email'] AND $this->form_data['user_password'])) {
                
                #   Feedback para o usuário
                $this->form_msg = [0 => 'alert-warning', 1 => 'Opa! ', 2 => 'Os campos nome, email e senha são obrigatorios verfique esses campos e tente novamente.'];
                #   Termina
                return;
            }
        } else {

            #   Finaliza se nada foi enviado
            return;
            
        }   #---> End finaliza se nada foi enviado
         
        #    Chama o método de envio de imagem
        $imagem = $this->upload_imagem();

        #    Implementa a imagem no vetor inserindo a no mesmo
        $this->form_data['user_img_profile'] = $imagem;
        
        #   Destroy a variavel
        unset($imagem);
        
        if(empty($this->form_data['user_img_profile'])){
            echo "<script>alert('Não a imagem')</script>";
        }else{
            echo "<script>alert('Imagem foi carregada')</script>";
        }

        $db_check_email = $this->db->query(' SELECT count(*) FROM `users` WHERE `user_email` = ? ', [
            chk_array($this->form_data, 'user_email')
        ]);

        // Verifica se a consulta foi realizada com sucesso
        if (($db_check_email->fetchColumn()) >= 1) {

            #   Feedback para o usuário
            $this->form_msg = [0 => 'alert-info', 1 => 'Opa! ', 2 => 'Esse email já se encontra em nossa base de dados.'];
            unset($db_check_email);
            return;
        }

        # Destroy varivavel não mais utilizada
        unset($db_check_email, $imagem);

        /*  Converte a senha enviada através do formulário para o hash (Criptografa) com API PHP
            passando a hash para o vetor @form_data  */
        $this->form_data['user_password'] = password_hash($this->form_data['user_password'], PASSWORD_DEFAULT);
        
        
        #   Variáveis para inserção na base de dados
        $role_id = 1; // Onde 1 é adm e 2 user
        
        #   Executa a consulta na base de dados a procura do ID
        $db_check_id = $this->db->query(' SELECT count(*) FROM `users` WHERE `user_id` = ? ', [
            chk_array($this->form_data, 'user_id')
        ]);

        #   Verifica se o ID existe
        if (($db_check_id->fetchColumn()) >= 1) {
            $this->updateRegister(chk_array($this->form_data, 'user_id'));
            unset($db_check_id);
            return;
        } else {
            $this->insertRegister();
            unset($db_check_id);
            return;
        }
        
    }   #--> End validate_register_form()
    
    
    
    /**
     *   @Acesso: public
     *   @Autor: Gomes - F.A.G.A <gomes.tisystem@gmail.com>
     *   @Versão: 0.1
     *   @Função: get_listar() 
     *   @Descrição: Pega o ID passado na função e retorna os valores.
     * */
    public function process_data() {
        ($this->form_data['user_level_1']) ? $this->form_data['user_level_1'] = 'lv1'  : FALSE;
        ($this->form_data['user_level_2']) ? $this->form_data['user_level_2'] = 'lv2'  : FALSE;
        ($this->form_data['user_level_3']) ? $this->form_data['user_level_3'] = 'lv3'  : FALSE;
        ($this->form_data['user_level_4']) ? $this->form_data['user_level_4'] = 'lv4'  : FALSE;
        ($this->form_data['user_level_5']) ? $this->form_data['user_level_5'] = 'lv5'  : FALSE;
        ($this->form_data['user_level_6']) ? $this->form_data['user_level_6'] = 'lv6'  : FALSE;
        
    }   # End process_data()
    
    /**
     *   @Acesso: public
     *   @Autor: Gomes - F.A.G.A <gomes.tisystem@gmail.com>
     *   @Função: insertRegister()
     *   @Versão: 0.1 
     *   @Descrição: Insere o registro no BD.
     *   @Obs: Este método só funcionara se for chamado no método validate_register_form() ambos trabalham em conjunto.
     * */
    public function insertRegister() {

//        #   insere o nome da clinica (revisar)
//        $this->db->insert('clinics', [
//            'clinic_name' => chk_array($this->form_data, 'clinic_name'),
//        ]);
//
//        # Obtem ultimo id inserido
//        $user_clinic_id = $this->db->lastInsertId();

        //var_dump($this->form_data['user_mother_name']);die;
        # Se o ID do agendamento estiver vazio, insere os dados
        $query_ins = $this->db->insert('users', [
            'user_img_profile'      => chk_array($this->form_data, 'user_img_profile'),
            'user_name'             => chk_array($this->form_data, 'user_name'),
            'user_email'            => chk_array($this->form_data, 'user_email'),
            'user_password'         =>  chk_array($this->form_data, 'user_password'),
            'user_session_id'       => md5(time()),
            //'user_permissions' => $this->avaliar(chk_array($this->form_data, 'user_permissions')),
            'user_role_id'          => 1,
            'user_clinic_id'        => 79,
            'user_cpf'              => $this->only_filter_number(chk_array($this->form_data, 'user_cpf')),
            'user_rg'               => $this->only_filter_number(chk_array($this->form_data, 'user_rg')),
            'user_birth'            => $this->converteData('d/m/Y', 'Y-m-d', chk_array($this->form_data, 'user_birth')),
            'user_gen'              => chk_array($this->form_data, 'user_gen'),
            'user_civil_status'     => chk_array($this->form_data, 'user_civil_status'),
            'user_home_phone'       => $this->only_filter_number(chk_array($this->form_data, 'user_phone_home')),
            'user_cel_phone'        => $this->only_filter_number(chk_array($this->form_data, 'user_cel_phone')),
            'user_father_name'      => $this->form_data['user_father_name'],
            'user_mother_name'      => $this->form_data['user_mother_name'],
            'user_address'          => chk_array($this->form_data, 'user_address'),
            'user_city'             => chk_array($this->form_data, 'user_city'),
            'user_state'            => chk_array($this->form_data, 'user_state'),
            'user_cep'              => $this->only_filter_number(chk_array($this->form_data, 'user_cep')),
            'user_func_pri'         => chk_array($this->form_data, 'user_func_pri'),
            'user_func_sec'         => chk_array($this->form_data, 'user_func_sec'),
            'user_date_adm'         => $this->converteData('d/m/Y', 'Y-m-d', chk_array($this->form_data, 'user_date_adm')),
            'user_date_dem'         => $this->converteData('d/m/Y', 'Y-m-d', chk_array($this->form_data, 'user_date_dem')),
            'user_active'           => (int) $this->only_filter_number(chk_array($this->form_data, 'user_active')),
            'user_active'           => (int) $this->only_filter_number(chk_array($this->form_data, 'user_active'))
            
        ]);

        # Verifica se a consulta está OK se sim envia o Feedback para o usuário.
        if ($query_ins) {

            # Destroy variáveis não mais utilizadas.
            unset($query_ins);

            # Feedback para o usuário
            $this->form_msg = [0 => 'alert-info', 1 => 'Sucesso! ', 2 => 'O registro foi efetuado com sucesso!'];

            # Redireciona de volta para a página após dez segundos
            echo '<meta http-equiv="Refresh" content="5"; url='.HOME_URI.'/users/register-employee';

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
     * */
    public function updateRegister($registro_id = NULL) {

        # Se o ID não estiver vazio, atualiza os dados
        if ($registro_id) {

            # Atualiza os dados
            $query = $this->db->update('providers', 'provider_id', $registro_id, [
                'provider_nome' => $this->avaliar(chk_array($this->form_data, 'provider_nome')),
                'provider_cpf_cnpj' => $this->avaliar(chk_array($this->form_data, 'provider_cpf_cnpj')),
                'provider_rs' => $this->avaliar(chk_array($this->form_data, 'provider_rs')),
                'provider_at' => $this->avaliar(chk_array($this->form_data, 'provider_at')),
                'provider_end' => $this->avaliar(chk_array($this->form_data, 'provider_end')),
                'provider_bair' => $this->avaliar(chk_array($this->form_data, 'provider_bair')),
                'provider_cid' => $this->avaliar(chk_array($this->form_data, 'provider_cid')),
                'provider_uf' => $this->avaliar(chk_array($this->form_data, 'provider_uf')),
                'provider_pais' => $this->avaliar(chk_array($this->form_data, 'provider_pais')),
                'provider_cep' => $this->avaliar(chk_array($this->form_data, 'provider_cep')),
                'provider_cel' => $this->avaliar(chk_array($this->form_data, 'provider_cel')),
                'provider_tel_1' => $this->avaliar(chk_array($this->form_data, 'provider_tel_1')),
                'provider_tel_2' => $this->avaliar(chk_array($this->form_data, 'provider_tel_2')),
                'provider_insc_uf' => $this->avaliar(chk_array($this->form_data, 'provider_insc_uf')),
                'provider_web_url' => $this->avaliar(chk_array($this->form_data, 'provider_web_url')),
                'provider_email' => $this->avaliar(chk_array($this->form_data, 'provider_email')),
                'provider_rep_nome' => $this->avaliar(chk_array($this->form_data, 'provider_rep_nome')),
                'provider_rep_apelido' => $this->avaliar(chk_array($this->form_data, 'provider_rep_apelido')),
                'provider_rep_email' => $this->avaliar(chk_array($this->form_data, 'provider_rep_email')),
                'provider_rep_cel' => $this->avaliar(chk_array($this->form_data, 'provider_rep_cel')),
                'provider_rep_tel_1' => $this->avaliar(chk_array($this->form_data, 'provider_rep_tel_1')),
                'provider_rep_tel_2' => $this->avaliar(chk_array($this->form_data, 'provider_rep_tel_2')),
                'provider_banco_1' => $this->avaliar(chk_array($this->form_data, 'provider_banco_1')),
                'provider_agencia_1' => $this->avaliar(chk_array($this->form_data, 'provider_agencia_1')),
                'provider_conta_1' => $this->avaliar(chk_array($this->form_data, 'provider_conta_1')),
                'provider_titular_1' => $this->avaliar(chk_array($this->form_data, 'provider_titular_1')),
                'provider_banco_2' => $this->avaliar(chk_array($this->form_data, 'provider_banco_2')),
                'provider_agencia_2' => $this->avaliar(chk_array($this->form_data, 'provider_agencia_2')),
                'provider_conta_2' => $this->avaliar(chk_array($this->form_data, 'provider_conta_2')),
                'provider_titular_2' => $this->avaliar(chk_array($this->form_data, 'provider_titular_2')),
                'provider_obs' => $this->avaliar(chk_array($this->form_data, 'provider_obs'))
            ]);

            // Verifica se a consulta foi realizada com sucesso
            if ($query) {
                // Feedback para o usuário.
                $this->form_msg = [0 => 'alert-info', 1 => 'Sucesso!', 2 => 'Os dados foram atualizados com sucesso!'];

                // Destroy variáveis nao utilizadas
                unset($agenda_id, $query);

                // Finaliza execução.
                return;
            }
        }
    }

# End updateRegister()

    /**
     *   @Acesso: public
     *   @Autor: Gomes - F.A.G.A <gomes.tisystem@gmail.com>
     *   @Função: get_register_form()
     *   @Versão: 0.1 
     *   @Descrição: Obtém os dados de agendamentos cadastrados método usado para edição de agendamentos.
     * */
    public function get_register_form($parametros) {

        $id = intval($this->encode_decode(0, $parametros));

        // Verifica na base de dados
        $query = $this->db->query('SELECT * FROM `users` WHERE `user_id` = ?', [ $id]);

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
    }

// get_register_form

    /**
     *   @Acesso: public
     *   @Autor: Gomes - F.A.G.A <gomes.tisystem@gmail.com>
     *   @Função: del_agendamento()
     *   @Versão: 0.1 
     *   @Descrição: Recebe o id passado no método e executa a exclusão caso exista o id se não retorna um erro.
     * */
    public function delRegister($id) {

        # Recebe o ID do registro converte de string para inteiro.
        $parametro = intval($this->encode_decode(0, $id));
        //echo $ag_id; die();

        $search = $this->db->query("SELECT count(*) FROM `users` WHERE `user_id` = $parametro ");
        if ($search->fetchColumn() < 1) {

            // Feedback para o usuário
            $this->form_msg = [0 => 'alert-danger', 1 => 'Erro!', 2 => 'Erro interno do sistema. Contate o administrador.'];

            //Destroy variáveis não mais utilizadas
            unset($parametro, $search, $id);

            # Redireciona de volta para a página após dez segundos
            echo '<meta http-equiv="Refresh" content="4; url=' . HOME_URI . '/users">';

            // Finaliza
            return;
        } else {
            # Deleta o registro
            $query_del = $this->db->delete('users', 'user_id', $parametro);

            // Feedback para o usuário
            $this->form_msg = [0 => 'alert-info', 1 => 'Sucesso!', 2 => 'Registro removido com sucesso!'];

            // Destroy variáveis não mais utilizadas
            unset($parametro, $query_del, $search, $id);

            # Redireciona de volta para a página após dez segundos
            echo '<meta http-equiv="Refresh" content="4; url=' . HOME_URI . '/users">';

            // Finaliza
            return;
        }
    }   #--> End delRegister()

    /**
     *   @Acesso: public
     *   @Autor: Gomes - F.A.G.A <gomes.tisystem@gmail.com>
     *   @Versão: 0.1
     *   @Função: get_ultimo_id() 
     *   @Descrição: Pega o ultimo ID do agendamento.
     * */
    public function get_ultimo_id() {
        // Simplesmente seleciona os dados na base de dados
        $query = $this->db->query(' SELECT MAX(agenda_id) AS `agenda_id` FROM `agendas` ');

        $row = $query->fetch();
        $id = trim($row[0]);

        return $id;
        
    }   // End get_ultimo_id()
    
    
    /**
     *   @Acesso: public
     *   @Autor: Gomes - F.A.G.A <gomes.tisystem@gmail.com>
     *   @Versão: 0.1
     *   @Função: get_listar() 
     *   @Descrição: Pega o ID passado na função e retorna os valores.
     * */
    public function get_listar() {

        #   Simplesmente seleciona os dados na base de dados
        $query = $this->db->query('SELECT * FROM `users` ORDER BY user_id');

        // Verifica se a consulta está OK
        if (!$query) {
            return array();
        }
        // Retorna os valores da consulta
        return $query->fetchAll();
    }
    
    
    /**
     *   @Acesso: public
     *   @Autor: Gomes - F.A.G.A <gomes.tisystem@gmail.com>
     *   @Versão: 0.1
     *   @Função: get_col_data() 
     *   @Descrição: Recebe os valores passado na função, $campo, $tabela e $id, efetua a consulta e retorna o resultado. 
     * */
    public function get_col_data($campo, $table, $id) {

        #   Simplesmente seleciona os dados na base de dados
        $query = $this->db->query("SELECT  $campo FROM $table ORDER BY $id");

        // Verifica se a consulta está OK
        if (!$query) {
            return array();
        }
        
        // Retorna os valores da consulta
        return $query->fetchAll(PDO::FETCH_BOTH);
    }   // End get_listar()

    /**
     *   @Acesso: public
     *   @Autor: Gomes - F.A.G.A <gomes.tisystem@gmail.com>
     *   @Versão: 0.1
     *   @Função: get_listar() 
     *   @Descrição: Pega o ID passado na função e retorna os valores.
     * */
    public function get_registro($id = NULL) {
        #   Recebe o ID codficado e decodifica depois converte e inteiro
        $id_decode = intval($this->encode_decode(0, $id));

        // Simplesmente seleciona os dados na base de dados
        $query = $this->db->query(" SELECT * FROM  `users` WHERE `user_id`= $id_decode ");

        // Verifica se a consulta está OK
        if (!$query) {
            return array();
        }
        // Retorna os valores da consulta
        return $query->fetch(PDO::FETCH_ASSOC);
        
    }   // End get_registro()

    /**
     *   @Acesso: public
     *   @Autor: Gomes - F.A.G.A <gomes.tisystem@gmail.com>
     *   @Versão: 0.1
     *   @Função: jsonPagination() 
     *   @Descrição: Função que recebe os valores passado e executa a consulta SQL e imprime o retorno do json para a paginação.
     * */
    public function jsonPagination($param1 = NULL, $limit = NULL, $offset = NULL) {

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
    }   // End jsonPagination()

    /**
     *   @Acesso: public
     *   @Autor: Gomes - F.A.G.A <gomes.tisystem@gmail.com>
     *   @Versão: 0.1
     *   @Função: upload_imagem() 
     *   @Descrição: Simplesmente trata a imagem e a envia.
     * */
    public function upload_imagem() {
        /*
         * @var $imagem_atri recebe os valores referente a imagem.
         * @var $erro_imagem recebe o valor referente ao erro "0" não ouve erro maior que zero ouve erro.
         */
        $imagem_atri = $_FILES['user_img_profile'];
        $erro_imagem = $imagem_atri['error'];
        // Verifica se o arquivo da imagem existe
        if ($erro_imagem > 0) {
            // Destroi as variáveis não utilizadas
            unset($imagem_atri, $erro_imagem);
            return;
        } else {
            /*
             * @var $tipo_imagem variável que pega o formato da imagem recebida no upload.
             * @vet $formato vetor que recebe os formatos de imagem suportados pelo sistema.
             * Laço responsavel por verificar se o formato e suportado.
             */
            $tipo_imagem = $imagem_atri['type'];
            $formato = [
                'image/png',
                'image/gif',
                'image/jpeg',
                'image/pjpeg',
                'image/x-windows-bmp'
            ];
            if (in_array($tipo_imagem, $formato)) {
                /* Aqui pegamos alguns atributos da imagem
                 *
                 * @var $nome_imagem variável que recebe o nome da imagem.
                 * @var $ext_imagem variável que recebe a extensão da imagem.
                 *
                 */
                $temp_name = strtolower($imagem_atri['name']);
                $temp_ext = explode('.', $temp_name);
                $ext_imagem = \end($temp_ext);
                //$nome_imagem = preg_replace('/\s+/', '/[^-\.\w]+/', '', htmlentities($temp_name));
                //$nome_imagem .= mt_rand() . '.' . $ext_imagem;
                $nome_imagem = md5(uniqid(time())) . '.' . $ext_imagem;
                // Destroy as variáveis que não serão mais utilizadas
                unset($temp_name);
                unset($temp_ext);
                // Nome temporário, erro e tamanho
                $tmp_imagem = $imagem_atri['tmp_name'];
                //$erro_imagem = $imagem_atri['error'];
                //$tamanho_imagem = $imagem_atri['size'];
                /*
                 * Verifca o tipo da imagem e cria um novo stream de imagem GD
                 */
                switch ($tipo_imagem) {
                    case 'image/jpeg':
                        $image_format = imagecreatefromjpeg($tmp_imagem);
                        break;
                    case 'image/gif':
                        $image_format = imagecreatefromgif($tmp_imagem);
                        break;
                    case 'image/png':
                        $image_format = imagecreatefrompng($tmp_imagem);
                        break;
                    default:
                        break;
                }
                // Cria duas variáveis com a largura e altura da imagem
                list( $largura, $altura ) = getimagesize($tmp_imagem);
                // Nova largura e altura
                //$proporcao = 0.5;
                //$nova_largura = $largura * $proporcao;
                //$nova_altura = $altura * $proporcao;
                $nova_largura = 150;
                $nova_altura = 150;
                // Cria uma nova imagem em branco
                $image_new = imagecreatetruecolor($nova_largura, $nova_altura);
                // Copia a imagem para a nova imagem com o novo tamanho
                imagecopyresampled(
                        $image_new, // Nova imagem
                        $image_format, // Imagem original
                        0, // Coordenada X da nova imagem
                        0, // Coordenada Y da nova imagem
                        0, // Coordenada X da imagem
                        0, // Coordenada Y da imagem
                        $nova_largura, // Nova largura
                        $nova_altura, // Nova altura
                        $largura, // Largura original
                        $altura // Altura original
                );
                // Cria a imagem sobrescrevendo a anterior
                switch ($tipo_imagem) {
                    case 'image/jpeg':
                        imagejpeg($image_new, $tmp_imagem);
                        break;
                    case 'image/gif':
                        imagegif($image_new, $tmp_imagem);
                        break;
                    case 'image/png':
                        imagepng($image_new, $tmp_imagem);
                        break;
                    default:
                        break;
                }
                // Remove as imagens temporárias
                imagedestroy($image_format);
                imagedestroy($image_new);
                // Tenta mover o arquivo enviado
                if (!move_uploaded_file($tmp_imagem, UP_ABSPATH . '/img/perfil/' . $nome_imagem)) {
                    # Feedback para o usuário
                    $this->form_msg = [0 => 'alert-danger', 1 => 'Sucesso! ', 2 => 'Não foi possível mover imagem para o diretorio'];
                    return;
                }
                # Retorna o nome da imagem
                return $nome_imagem;
            } else {
                # Feedback para o usuário
                $this->form_msg = [0 => 'alert-danger', 1 => 'Sucesso! ', 2 => 'O tipo de imagem não é suportado tipos permitidos: (png,gif,jpeg,pjpeg,bmp)'];
                return;
            }
        }
    }   # End upload_imagem()
    
}   
