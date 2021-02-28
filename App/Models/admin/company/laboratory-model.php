<?php

/**
 *  @Autor: F.A.G.A <gomes.tisystem@gmail.com>
 *  @Class: FeesModel
 *  @Descrição: Classe responsavel por toda intereção com a base de dados e validações
 *
 *  @Pacote: OdontoControl
 *  @Versão: 0.2
 */
class LaboratoryModel extends MainModel
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

            # Verifica se existe o ID e decodifica se o mesmo existir.
            (!empty($this->form_data['laboratory_id']))
                ? $this->form_data['laboratory_id'] = $this->encodeDecode(0, $this->form_data['laboratory_id']) : '';
        } else {
            # Finaliza a execução.
            return 'err';
        } #--> End

        # Verifica se o registro já existe.
        $db_check_ag = $this->db->query(' SELECT count(*) FROM `laboratory` WHERE `laboratory_id` = ? ', [
            chkArray($this->form_data, 'laboratory_id')
        ]);

        # Verefica qual tipo de ação a ser tomada se existe ID faz Update se não existir efetua o insert
        if (($db_check_ag->fetchColumn()) >= 1) {
            $this->updateRegister($this->form_data['laboratory_id']);
        } else {
            //var_dump($this->form_data);die;
            $this->insertRegister();
        }
    } #--> End validate_register_form()

    /**
     *   @Acesso: public
     *   @Autor: Gomes - F.A.G.A <gomes.tisystem@gmail.com>
     *   @Função: insertRegister()
     *   @Versão: 0.2
     *   @Descrição: Insere o registro no BD.
     *   @Obs: Este método só funcionara se for chamado no método validate_register_form() ambos trabalham em conjunto.
     **/
    public function insertRegister()
    {
        //var_dump($this->convertDataHora('d/m/Y', 'Y-m-d',$this->avaliar(chkArray($this->form_data, 'laboratory_date_laboratory'))));die;
        # Se o ID do agendamento estiver vazio, insere os dados
        $query_ins = $this->db->insert('laboratory', [
            'laboratory_name'         =>  $this->avaliar(chkArray($this->form_data, 'laboratory_name')),
            'laboratory_cpf_cnpj'     =>  $this->avaliar(chkArray($this->form_data, 'laboratory_cpf_cnpj')),
            'laboratory_rs'           =>  $this->avaliar(chkArray($this->form_data, 'laboratory_rs')),
            'laboratory_at'           =>  $this->avaliar(chkArray($this->form_data, 'laboratory_at')),
            'laboratory_end'          =>  $this->avaliar(chkArray($this->form_data, 'laboratory_end')),
            'laboratory_district'     =>  $this->avaliar(chkArray($this->form_data, 'laboratory_district')),
            'laboratory_city'         =>  $this->avaliar(chkArray($this->form_data, 'laboratory_city')),
            'laboratory_uf'           =>  $this->avaliar(chkArray($this->form_data, 'laboratory_uf')),
            'laboratory_nation'       =>  $this->avaliar(chkArray($this->form_data, 'laboratory_nation')),
            'laboratory_cep'          =>  $this->avaliar(chkArray($this->form_data, 'laboratory_cep')),
            'laboratory_cel'          =>  $this->avaliar(chkArray($this->form_data, 'laboratory_cel')),
            'laboratory_tel_1'        =>  $this->avaliar(chkArray($this->form_data, 'laboratory_tel_1')),
            'laboratory_tel_2'        =>  $this->avaliar(chkArray($this->form_data, 'laboratory_tel_2')),
            'laboratory_insc_uf'      =>  $this->avaliar(chkArray($this->form_data, 'laboratory_insc_uf')),
            'laboratory_web_url'      =>  $this->avaliar(chkArray($this->form_data, 'laboratory_web_url')),
            'laboratory_sit'          =>  chkArray($this->form_data, 'laboratory_sit'),
            'laboratory_email'        =>  $this->avaliar(chkArray($this->form_data, 'laboratory_email')),
            'laboratory_rep_nome'     =>  $this->avaliar(chkArray($this->form_data, 'laboratory_rep_nome')),
            'laboratory_rep_apelido'  =>  $this->avaliar(chkArray($this->form_data, 'laboratory_rep_apelido')),
            'laboratory_rep_email'    =>  $this->avaliar(chkArray($this->form_data, 'laboratory_rep_email')),
            'laboratory_rep_cel'      =>  $this->avaliar(chkArray($this->form_data, 'laboratory_rep_cel')),
            'laboratory_rep_tel_1'    =>  $this->avaliar(chkArray($this->form_data, 'laboratory_rep_tel_1')),
            'laboratory_rep_tel_2'    =>  $this->avaliar(chkArray($this->form_data, 'laboratory_rep_tel_2')),
            'laboratory_banco_1'      =>  $this->avaliar(chkArray($this->form_data, 'laboratory_banco_1')),
            'laboratory_agencia_1'    =>  $this->avaliar(chkArray($this->form_data, 'laboratory_agencia_1')),
            'laboratory_conta_1'      =>  $this->avaliar(chkArray($this->form_data, 'laboratory_conta_1')),
            'laboratory_titular_1'    =>  $this->avaliar(chkArray($this->form_data, 'laboratory_titular_1')),
            'laboratory_banco_2'      =>  $this->avaliar(chkArray($this->form_data, 'laboratory_banco_2')),
            'laboratory_agencia_2'    =>  $this->avaliar(chkArray($this->form_data, 'laboratory_agencia_2')),
            'laboratory_conta_2'      =>  $this->avaliar(chkArray($this->form_data, 'laboratory_conta_2')),
            'laboratory_titular_2'    =>  $this->avaliar(chkArray($this->form_data, 'laboratory_titular_2')),
            'laboratory_obs'          =>  $this->avaliar(chkArray($this->form_data, 'laboratory_obs')),
            'laboratory_created'      =>  date('Y-m-d H:i:s', time())
        ]);

        # Verifica se a consulta está OK se sim envia o Feedback para o usuário.
        if ($query_ins) {
            //$this->form_msg = ['result'=>'success', 'message'=>'query success'];
            //return $this->form_msg;
            echo 'ok';
        } else {
            # Feedback
            //$this->form_msg = ['result'=>'error', 'message'=>'query error'];

            # Retorna o valor e finaliza execução
            //return $this->form_msg;
            echo 'err';
        }
    }

    /**
     *   @Acesso: public
     *   @Autor: Gomes - F.A.G.A <gomes.tisystem@gmail.com>
     *   @Função: updateRegister()
     *   @Versão: 0.2
     *   @Descrição: Atualiza um registro especifico no BD.
     *   @Obs: Este método só funcionara se for chamado no método validate_register_form() ambos trabalham em conjunto.
     **/
    public function updateRegister($registro_id = NULL)
    {
        # Verifica se existe ID
        if ($registro_id) {
            # Efetua o update do registro
            $query_up = $this->db->update('laboratory', 'laboratory_id', $registro_id, [
                'laboratory_name'         =>  $this->avaliar(chkArray($this->form_data, 'laboratory_name')),
                'laboratory_cpf_cnpj'     =>  $this->avaliar(chkArray($this->form_data, 'laboratory_cpf_cnpj')),
                'laboratory_rs'           =>  $this->avaliar(chkArray($this->form_data, 'laboratory_rs')),
                'laboratory_at'           =>  $this->avaliar(chkArray($this->form_data, 'laboratory_at')),
                'laboratory_end'          =>  $this->avaliar(chkArray($this->form_data, 'laboratory_end')),
                'laboratory_district'     =>  $this->avaliar(chkArray($this->form_data, 'laboratory_district')),
                'laboratory_city'         =>  $this->avaliar(chkArray($this->form_data, 'laboratory_city')),
                'laboratory_uf'           =>  $this->avaliar(chkArray($this->form_data, 'laboratory_uf')),
                'laboratory_nation'       =>  $this->avaliar(chkArray($this->form_data, 'laboratory_nation')),
                'laboratory_cep'          =>  $this->avaliar(chkArray($this->form_data, 'laboratory_cep')),
                'laboratory_cel'          =>  $this->avaliar(chkArray($this->form_data, 'laboratory_cel')),
                'laboratory_tel_1'        =>  $this->avaliar(chkArray($this->form_data, 'laboratory_tel_1')),
                'laboratory_tel_2'        =>  $this->avaliar(chkArray($this->form_data, 'laboratory_tel_2')),
                'laboratory_insc_uf'      =>  $this->avaliar(chkArray($this->form_data, 'laboratory_insc_uf')),
                'laboratory_web_url'      =>  $this->avaliar(chkArray($this->form_data, 'laboratory_web_url')),
                'laboratory_sit'          =>  chkArray($this->form_data, 'laboratory_sit'),
                'laboratory_email'        =>  $this->avaliar(chkArray($this->form_data, 'laboratory_email')),
                'laboratory_rep_nome'     =>  $this->avaliar(chkArray($this->form_data, 'laboratory_rep_nome')),
                'laboratory_rep_apelido'  =>  $this->avaliar(chkArray($this->form_data, 'laboratory_rep_apelido')),
                'laboratory_rep_email'    =>  $this->avaliar(chkArray($this->form_data, 'laboratory_rep_email')),
                'laboratory_rep_cel'      =>  $this->avaliar(chkArray($this->form_data, 'laboratory_rep_cel')),
                'laboratory_rep_tel_1'    =>  $this->avaliar(chkArray($this->form_data, 'laboratory_rep_tel_1')),
                'laboratory_rep_tel_2'    =>  $this->avaliar(chkArray($this->form_data, 'laboratory_rep_tel_2')),
                'laboratory_banco_1'      =>  $this->avaliar(chkArray($this->form_data, 'laboratory_banco_1')),
                'laboratory_agencia_1'    =>  $this->avaliar(chkArray($this->form_data, 'laboratory_agencia_1')),
                'laboratory_conta_1'      =>  $this->avaliar(chkArray($this->form_data, 'laboratory_conta_1')),
                'laboratory_titular_1'    =>  $this->avaliar(chkArray($this->form_data, 'laboratory_titular_1')),
                'laboratory_banco_2'      =>  $this->avaliar(chkArray($this->form_data, 'laboratory_banco_2')),
                'laboratory_agencia_2'    =>  $this->avaliar(chkArray($this->form_data, 'laboratory_agencia_2')),
                'laboratory_conta_2'      =>  $this->avaliar(chkArray($this->form_data, 'laboratory_conta_2')),
                'laboratory_titular_2'    =>  $this->avaliar(chkArray($this->form_data, 'laboratory_titular_2')),
                'laboratory_obs'          =>  $this->avaliar(chkArray($this->form_data, 'laboratory_obs')),
                'laboratory_modified'     =>  date('Y-m-d H:i:s', time())
            ]);

            # Verifica se a consulta foi realizada com sucesso
            if ($query_up) {
                # Destroy variáveis nao mais utilizadas.
                unset($registro_id, $query_up);

                # Retorna o valor e finaliza execução.
                echo 'ok';
                exit();
            } else {
                # Destroy variavel nao mais utilizadas.
                unset($registro_id, $query_up);

                # Retorna o valor e finaliza execução.
                echo 'err';
                exit();
            }
        }
    } #--> End updateRegister()

    /**
     *   @Acesso: public
     *   @Autor: Gomes - F.A.G.A <gomes.tisystem@gmail.com>
     *   @Função: get_register_form()
     *   @Versão: 0.2
     *   @Descrição: Obtém os dados do registro existente e retorna o valor para o usuario codificando e decodificando o mesmo na url.
     **/
    public function get_register_form($id_encode)
    {

        $id_decode = intval($this->encodeDecode(0, $id_encode));

        # Verifica na base de dados o registro
        $query_get = $this->db->query('SELECT * FROM `covenant` WHERE `covenant_id` = ?', [$id_decode]);



        # Obtém os dados da consulta
        $fetch_userdata = $query_get->fetch(PDO::FETCH_ASSOC);

        # Faz um loop dos dados, guardando os no vetor $form_data
        foreach ($fetch_userdata as $key => $value) {
            $this->form_data[$key] = $value;
        }

        # Tratamento da data para o modelo visao do fomulario
        #$this->form_data['covenant_data_aq'] = $this->converteData('Y-m-d', 'd/m/Y', $this->form_data['covenant_data_aq']);

        # Destroy variaveis não mais utilizadas
        unset($query_get, $fetch_userdata);

        return;
    } # End get_register_form()


    /**
     *   @Acesso: public
     *   @Autor: Gomes - F.A.G.A <gomes.tisystem@gmail.com>
     *   @Função: delRegister()
     *   @Versão: 0.2
     *   @Descrição: Recebe o id passado no método e executa a exclusão caso exista o id se não retorna um erro.
     * */
    public function delRegister($encode_id)
    {

        # Recebe o ID do registro converte de string para inteiro.
        $decode_id = intval($this->encodeDecode(0, $encode_id));

        # Executa a consulta na base de dados
        $search = $this->db->query("SELECT count(*) FROM `laboratory` WHERE `laboratory_id` = $decode_id ");
        if ($search->fetchColumn() < 1) {

            # Destroy variáveis não mais utilizadas
            unset($encode_id, $search, $decode_id);

            echo 'err';
            exit();
        } else {
            # Deleta o registro
            $query_del = $this->db->delete('laboratory', 'laboratory_id', $decode_id);

            #   Destroy variáveis não mais utilizadas
            unset($parametro, $query_del, $search, $id);

            echo 'ok';
            exit();
        }
    }   #--> End delRegister()



    /**
     *   @Acesso: public
     *   @Autor: Gomes - F.A.G.A <gomes.tisystem@gmail.com>
     *   @Versão: 0.1
     *   @Função: get_ultimo_id()
     *   @Descrição: Pega o ultimo ID do registro.
     **/
    public function get_ultimo_id()
    {
        // Simplesmente seleciona os dados na base de dados
        $query = $this->db->query(' SELECT MAX(agenda_id) AS `agenda_id` FROM `agendas` ');

        $row = $query->fetch();
        $id = trim($row[0]);

        return $id;
    } // End get_ultimo_id()



    public function getSelect_return($sql)
    {
        # Simplesmente seleciona os dados na base de dados
        $queryGet = $this->db->query($sql);

        # Declara o vetor
        $result_array = [];


        # Retorna os valores da consulta
        while ($results = $queryGet->fetchAll(PDO::FETCH_ASSOC)) {
            $result_array = $results;
        }

        foreach ($result_array as $result) {

            # The output
            echo '<tr>';
            echo '<td class="small">' . $result['laboratory_id'] . '</td>';
            echo '<td class="small">' . $result['laboratory_venc'] . '</td>';
            echo '<td class="small">' . $result['laboratory_date_laboratory'] . '</td>';
            echo '<td class="small">' . $result['laboratory_cat'] . '</td>';
            echo '<td class="small">' . $result['laboratory_desc'] . '</td>';
            echo '<td class="small">' . $result['laboratory_val'] . '</td>';
            echo '</tr>';
        }
    }

    /**
     *   @Acesso: public
     *   @Autor: Gomes - F.A.G.A <gomes.tisystem@gmail.com>
     *   @Versão: 0.1
     *   @Função: getJSON()
     *   @Descrição: Recebe a tabela e o id, e retorna um JSON dos dados.
     **/
    public function getJSON($table, $id)
    {

        # Simplesmente seleciona os dados na base de dados
        $query = $this->db->query("SELECT * FROM $table ORDER BY $id");

        # Verifica se a consulta está OK
        if (!$query) {

            # Finaliza execução
            return;
        }

        # Retorna os valores da consulta
        $queryResult = $query->fetchAll(PDO::FETCH_ASSOC);

        // Prepara a conversao para o formato desejado
        foreach ($queryResult as $laboratory) {
            $mysql_data[] = [
                "laboratory_id"        => $laboratory['laboratory_id'],
                "laboratory_venc"      => $laboratory['laboratory_venc'],
                "laboratory_date_laboratory"  => $laboratory['laboratory_date_laboratory'],
                "laboratory_cat"       => '$ ' . $laboratory['laboratory_cat'],
                "laboratory_desc"      => $laboratory['laboratory_desc'],
                "laboratory_val"       => $laboratory['laboratory_val']
            ];
        }

        # Cria o arquivo JSON
        $fp = fopen('arquivo.json', 'w');
        fwrite($fp, json_encode($mysql_data));
        fclose($fp);

        # Finaliza execução
        return;
    } # End getJSON()

    /**
     *   @Acesso: public
     *   @Autor: Gomes - F.A.G.A <gomes.tisystem@gmail.com>
     *   @Versão: 0.1
     *   @Função: get_registro()
     *   @Descrição: Pega o ID passado na função e retorna os valores do id solicitado.
     **/
    public function get_registro($encode_id = NULL)
    {
        #   Recebe o ID codficado e decodifica depois converte e inteiro
        $decode_id = intval($this->encodeDecode(0, $encode_id));

        # Simplesmente seleciona os dados na base de dados
        $query_get = $this->db->query(" SELECT * FROM  `laboratory` WHERE `laboratory_id`= $decode_id ");

        # Verifica se a consulta está OK
        if (!$query_get) {

            # Finaliza
            return;
        }

        # Destroy variaveis não mais utilizadas
        unset($decode_id, $encode_id);


        # Retorna os valores da consulta
        return $query_get->fetch(PDO::FETCH_ASSOC);
    } # End get_registro()

    /**
     * Paginação
     *
     * Cria uma paginação simples.
     *
     * @param int $total_artigos Número total de artigos da sua consulta
     * @param int $artigos_por_pagina Número de artigos a serem exibidos nas páginas
     * @param int $offset Número de páginas a serem exibidas para o usuário
     *
     * @return string A paginação montada
     */
    function paginacao(
        $total_artigos = 0,
        $artigos_por_pagina = 10,
        $offset = 5
    ) {
        // Obtém o número total de página
        $numero_de_paginas = floor($total_artigos / $artigos_por_pagina);

        // Obtém a página atual
        $pagina_atual = 1;

        // Atualiza a página atual se tiver o parâmetro pagina=n
        if (!empty($_GET['pagina'])) {
            $pagina_atual = (int) $_GET['pagina'];
        }

        // Vamos preencher essa variável com a paginação
        $paginas = null;

        // Primeira página
        $paginas .= " <a href='?pagina=0'>Home</a> ";

        // Faz o loop da paginação
        // $pagina_atual - 1 da a possibilidade do usuário voltar
        for ($i = ($pagina_atual - 1); $i < ($pagina_atual - 1) + $offset; $i++) {

            // Eliminamos a primeira página (que seria a home do site)
            if ($i < $numero_de_paginas && $i > 0) {
                // A página atual
                $página = $i;

                // O estilo da página atual
                $estilo = null;

                // Verifica qual dos números é a página atual
                // E cria um estilo extremamente simples para diferenciar
                if ($i == @$_parameters[1]) {
                    $estilo = ' style="color:red;" ';
                }

                // Inclui os links na variável $paginas
                $paginas .= " <a $estilo href='?pagina=$página'>$página</a> ";
            }
        } // for

        $paginas .= " <a href='?pagina=$numero_de_paginas'>Última</a> ";

        // Retorna o que foi criado
        return $paginas;
    }


    /*
     * Returns rows from the database based on the conditions
     * @param string name of the table
     * @param array select, where, search, order_by, limit and return_type conditions
     */
    public function getRows($table, $conditions = [])
    {
        $sql = 'SELECT ';
        $sql .= array_key_exists('select', $conditions) ? $conditions['select'] : '*';
        $sql .= ' FROM ' . $table;

        if (array_key_exists('where', $conditions)) {
            $sql .= ' WHERE ';
            $i = 0;
            foreach ($conditions['where'] as $key => $value) {
                $pre = ($i > 0) ? ' AND ' : '';
                $sql .= $pre . $key . " = '" . $value . "'";
                $i++;
            }
        }

        if (array_key_exists('where_limit', $conditions)) {
            $sql .= ' WHERE ' . $conditions['where_limit']['key_where'] . ' = ' . $conditions['where_limit']['value_where'];
            //$sql .=  $conditions['where_limit']['value_limit'];
            //var_dump($sql);die;

        }

        if (array_key_exists('search', $conditions)) {
            $sql .= (strpos($sql, 'WHERE') !== false) ? '' : ' WHERE ';
            $i = 0;
            foreach ($conditions['search'] as $key => $value) {
                $pre = ($i > 0) ? ' OR ' : '';
                $sql .= $pre . $key . " LIKE '%" . $value . "%'";
                $i++;
            }
        }



        if (array_key_exists("order_by", $conditions)) {
            $sql .= ' ORDER BY ' . $conditions['order_by'];
        }
        var_dump($sql);

        if (array_key_exists("start", $conditions) && array_key_exists("limit", $conditions)) {

            $sql .= ' LIMIT ' . $conditions['start'] . ',' . $conditions['limit'];
        } elseif (!array_key_exists("start", $conditions) && array_key_exists("limit", $conditions)) {
            $sql .= ' LIMIT ' . $conditions['limit'];
        }

        $result = $this->db->query($sql);

        if (array_key_exists("return_type", $conditions) && $conditions['return_type'] != 'all') {
            switch ($conditions['return_type']) {
                case 'count':
                    $data = count($result);
                    break;
                case 'single':
                    $data = $result->fetch(PDO::FETCH_ASSOC);
                    break;
                default:
                    $data = '';
            }
        } else {
            if (count($result) > 0) {
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    $data[] = $row;
                    //var_dump($data);
                }
            }
        }
        return !empty($data) ? $data : false;
    }
} #Fees_Model
