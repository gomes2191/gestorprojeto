<?php

/**
 *  @Autor: F.A.G.A <gomes.tisystem@gmail.com>
 *  @Class: FeesModel
 *  @Descrição: Classe responsavel por toda intereção com a base de dados e validações
 *
 *  @Pacote: OdontoControl
 *  @Versão: 0.2
 */
class PayModel extends MainModel
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
        if ( (filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_DEFAULT) === 'GET') && (!empty(filter_input_array(INPUT_GET, FILTER_DEFAULT) ) ) ) {
            # Faz o loop dos dados do formulário inserindo os no vetor @form_data.
            foreach ( filter_input_array(INPUT_GET, FILTER_DEFAULT) as $key => $value ) {
                
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
        }else {
            
            # Finaliza se nada foi enviado
            return FALSE;
            
        } #--> End
        
        # Rotina que verifica se o registro já existe
        $db_check_ag = $this->db->query (' SELECT count(*) FROM `bills_to_pay` WHERE `pay_id` = ? ',[
            chk_array($this->form_data, 'pay_id')
        ]);        
        
        # Verefica qual tipo de ação a ser tomada se existe ID faz Update se não existir efetua o insert
        if ( ($db_check_ag->fetchColumn()) >= 1 ) {
            //var_dump($this->form_data);
            $this->updateRegister(chk_array($this->form_data, 'fees_id'));
            return;
        }else{
            //var_dump($this->form_data);die;
            $this->insertRegister();
            return;
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
    public function insertRegister(){
        //var_dump($this->form_data['covenant_tipo_unit']);die;
        //var_dump('==Insert=='.  $this->converteData('d/m/Y', 'Y-m-d', chk_array($this->form_data, 'covenant_data_aq')).'== novo==');die;
        # Se o ID do agendamento estiver vazio, insere os dados
        $query_ins = $this->db->insert('bills_to_pay',[
            'pay_venc'         =>  $this->avaliar(chk_array($this->form_data, 'pay_venc')),
            'pay_date_pay'     =>  $this->avaliar(chk_array($this->form_data, 'pay_date_pay')),
            'pay_desc'         =>  $this->avaliar(chk_array($this->form_data, 'pay_desc')),
            'pay_cat'          =>  $this->avaliar(chk_array($this->form_data, 'pay_cat')),
            'pay_val'          =>  $this->avaliar(chk_array($this->form_data, 'pay_val'))
        ]);

        # Verifica se a consulta está OK se sim envia o Feedback para o usuário.
        if ( $query_ins ) {
            $this->form_msg = ['result'=>'success', 'message'=>'query success'];
            return $this->form_msg;
        }else{
            # Feedback
            $this->form_msg = ['result'=>'error', 'message'=>'query error'];
            
            # Retorna o valor e finaliza execução
            return $this->form_msg;
            
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
    public function updateRegister( $registro_id = NULL ){
        
        //var_dump($this->form_data);die;
        
        #   Se o ID não estiver vazio, atualiza os dados
        if ( $registro_id ) {
            # Efetua o update do registro
            $query_up = $this->db->update('covenant_fees', 'fees_id', $registro_id,[
                'fees_cod'    =>  $this->avaliar(chk_array($this->form_data, 'fees_cod')),
                'fees_proc'   =>  $this->avaliar(chk_array($this->form_data, 'fees_proc')),
                'fees_cat'    =>  $this->avaliar(chk_array($this->form_data, 'fees_cat')),
                'fees_desc'   =>  $this->avaliar(chk_array($this->form_data, 'fees_desc')),
                'fees_part'   =>  $this->avaliar(chk_array($this->form_data, 'fees_part')),
                'fees_total'  =>  $this->avaliar(chk_array($this->form_data, 'fees_total'))
            ]);

            # Verifica se a consulta foi realizada com sucesso
            if ( $query_up ) {
                
                # Feedback para o usuário, retorna uma mensagem para usuário
                $this->form_msg = [0 => 'alert-success',1=> 'glyphicon glyphicon-info-sign', 2 => 'Informção! ', 3 => 'Os dados foram atualizados com sucesso!'];
                
                # Da um refresh na página apos um determinado tempo especifico
                echo '<meta http-equiv="Refresh" content="4">';
                
                # Destroy variáveis nao mais utilizadas
                unset( $registro_id, $query_up  );
                
                # Finaliza execução.
                return;
            }else{
                
                # Feedback para o usuário, retorna uma mensagem para usuário
                $this->form_msg = [0 => 'alert-danger',1=> 'fa fa-exclamation-triangle fa-2', 2 => 'Erro! ', 3 => 'Erro interno do sistema se o problema persistir contate o administrador. Erro: 800'];
                
                # Destroy variáveis nao mais utilizadas
                unset( $registro_id, $query_up  );
                
                # Finaliza   
                return;
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
    public function get_register_form ( $id_encode ) {
        
        $id_decode = intval($this->encode_decode(0, $id_encode));
        
        # Verifica na base de dados o registro
        $query_get = $this->db->query('SELECT * FROM `covenant` WHERE `covenant_id` = ?', [ $id_decode ]  );

        

        # Obtém os dados da consulta
        $fetch_userdata = $query_get->fetch(PDO::FETCH_ASSOC);
        
        # Faz um loop dos dados, guardando os no vetor $form_data
        foreach ( $fetch_userdata as $key => $value ) {
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
    public function delRegister( $encode_id ) {

        # Recebe o ID do registro converte de string para inteiro.
        $decode_id = intval($this->encode_decode(0, $encode_id));
        
        # Executa a consulta na base de dados
        $search = $this->db->query("SELECT count(*) FROM `bills_to_pay` WHERE `pay_id` = $decode_id ");
        if ($search->fetchColumn() < 1) {

            #   Feedback para o usuário
            $this->form_msg = [0 => 'alert-danger', 1=>'fa fa-info-circle', 2 => 'Erro! ', 3 => 'Erro interno do sistema. Contate o administrador. Cod: 800'];
            
            # Redireciona de volta para a página após 4 segundos
            echo '<meta http-equiv="Refresh" content="4; url=' . HOME_URI . '/finances-pay">';
            
            # Destroy variáveis não mais utilizadas
            unset($encode_id, $search, $decode_id);

            # Finaliza
            return;
        } else {
            # Deleta o registro
            $query_del = $this->db->delete('bills_to_pay', 'pay_id', $decode_id);

            #   Feedback para o usuário
            $this->form_msg = [0 => 'alert-success', 1=>'fa fa-info-circle', 2 => 'Sucesso! ', 3 => 'Registro removido com sucesso!'];
            
            # Tratamento de erro ajax retorno Feedback para o usuário
            //$this->form_msg = TRUE;

            #   Destroy variáveis não mais utilizadas
            unset($parametro, $query_del, $search, $id);

            # Redireciona de volta para a página após o tempo informado segundos
            echo '<meta http-equiv="Refresh" content="4; url=' . HOME_URI . '/finances-pay">';

            #   Finaliza
            return;
        }
    }   #--> End delRegister()

        
         
    /**
    *   @Acesso: public
    *   @Autor: Gomes - F.A.G.A <gomes.tisystem@gmail.com>
    *   @Versão: 0.1
    *   @Função: get_ultimo_id() 
    *   @Descrição: Pega o ultimo ID do registro.
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
     *   @Função: get_table_data() 
     *   @Descrição: Recebe os valores passado na função, $campo, $tabela e $id, efetua a consulta e retorna o resultado. 
     * */
    public function get_table_data( $tipo, $campo, $table, $id_campo, $get_id, $id, $sqlUpdate, $sqlSelect  ) {
        
        if ($tipo == 1){
             
            # Simplesmente seleciona os dados na base de dados
            $query = $this->db->query(" SELECT  $campo FROM $table  ORDER BY $id ");
             
            # Destroy todas as variaveis nao mais utilizadas
            unset($tipo, $campo, $table, $id_campo, $get_id, $id);
           
            # Retorna os valores da consulta
            return $query->fetchAll(PDO::FETCH_ASSOC);
            
        }elseif ($tipo == 2){
            
            # Simplesmente seleciona os dados na base de dados
            $query = $this->db->query(" SELECT  $campo FROM $table WHERE $id_campo = $get_id ORDER BY $id ");
            
            # Destroy todas as variaveis nao mais utilizadas
            unset($tipo, $campo, $table, $id_campo, $get_id, $id);
            
            # Retorna os valores da consulta
            return $query;
            
        }elseif ($tipo == 3){
            # Faz o update na tabela
            $query = $this->db->query($sqlUpdate);
             
            # Destroy todas as variaveis nao mais utilizadas
            //unset($tipo, $campo, $table, $id_campo, $get_id, $id);
           
            # Retorna os valores da consulta
            return $query;
        }elseif($tipo = 4) {
            # Simplesmente seleciona os dados na base de dados
            $queryGet = $this->db->query($sqlSelect);
           
            while ( $results = $queryGet->fetchAll(PDO::FETCH_ASSOC)) {
                $results_array[] = $results;
            }
            
            return $results_array;
        }
         
    }   # End get_table_data()
    
    public function getSelect_return($sql){
        # Simplesmente seleciona os dados na base de dados
        $queryGet = $this->db->query($sql);
        
        # Declara o array
        ;    
        # Retorna os valores da consulta
        while($results = $queryGet->fetchAll(PDO::FETCH_ASSOC)) {
            $result_array[0] = $results;
        }

        foreach ($result_array as $result) {
            # The output
            echo '<tr>';			
            echo '<td class="small">'.$result[0]['pay_id'].'</td>';
            echo '<td class="small">'.$result['pay_venc'].'</td>';
            echo '<td class="small">'.$result['pay_date_pay'].'</td>';
            echo '<td class="small">'.$result['pay_cat'].'</td>';
            echo '<td class="small">'.$result['pay_desc'].'</td>';
            echo '<td class="small">'.$result['pay_val'].'</td>';
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
  public function getJSON($table, $id) {

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
        foreach ($queryResult as $pay) {
            $mysql_data[] = [
                "pay_id"        => $pay['pay_id'],
                "pay_venc"      => $pay['pay_venc'],
                "pay_date_pay"  => $pay['pay_date_pay'],
                "pay_cat"       => '$ ' . $pay['pay_cat'],
                "pay_desc"      => $pay['pay_desc'],
                "pay_val"       => $pay['pay_val']
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
    public function get_registro( $encode_id = NULL ) {
        #   Recebe o ID codficado e decodifica depois converte e inteiro
        $decode_id = intval($this->encode_decode(0, $encode_id));
        
        # Simplesmente seleciona os dados na base de dados
        $query_get = $this->db->query( " SELECT * FROM  `bills_to_pay` WHERE `pay_id`= $decode_id " );

        # Verifica se a consulta está OK
        if ( !$query_get ) {
            
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
    $total_artigos = 0, $artigos_por_pagina = 10, $offset = 5
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
        for ($i = ( $pagina_atual - 1 ); $i < ( $pagina_atual - 1 ) + $offset; $i++) {

            // Eliminamos a primeira página (que seria a home do site)
            if ($i < $numero_de_paginas && $i > 0) {
                // A página atual
                $página = $i;

                // O estilo da página atual
                $estilo = null;

                // Verifica qual dos números é a página atual
                // E cria um estilo extremamente simples para diferenciar
                if ($i == @$parametros[1]) {
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

} #Fees_Model
