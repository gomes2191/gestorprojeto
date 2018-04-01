<?php

/**
 *  @Autor: F.A.G.A <gomes.tisystem@gmail.com>
 *  @Class: FeesModel
 *  @Descrição: Classe responsavel por toda intereção com a base de dados e validações
 *
 *  @Pacote: OdontoControl
 *  @Versão: 0.2
 */
class ReceiveModel extends MainModel implements Model
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
        //$this->form_data = [];
        
        # Verifica se não é vazio o $_POST
        if ( (filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_DEFAULT) === 'POST') && (!empty(filter_input_array(INPUT_POST, FILTER_DEFAULT) ) ) ) {
            
            # Faz o loop dos dados do formulário inserindo os no vetor $form_data.
            foreach ( filter_input_array(INPUT_POST, FILTER_DEFAULT) as $key => $value ) {
                # Configura os dados do post para a propriedade $form_data
                $this->form_data[$key] = $value;
            } # End foreach
            
            # Verifica se existe o ID e decodifica se o mesmo existir.
            ( !empty($this->form_data['pay_id']) ) 
            ? $this->form_data['pay_id'] = $this->encode_decode(0, $this->form_data['pay_id']) : '';
        }else {
            # Finaliza a execução.
            return 'err';
        } #--> End
        
        # Verifica se o registro já existe.
        $db_check_ag = $this->db->query (' SELECT count(*) FROM `bills_to_pay` WHERE `pay_id` = ? ',[
            chk_array($this->form_data, 'pay_id')
        ]);
        
        # Verefica qual tipo de ação a ser tomada se existe ID faz Update se não existir efetua o insert
        if ( ($db_check_ag->fetchColumn()) >= 1 ) {           
            $this->updateRegister( $this->form_data['pay_id'] );
        }else{
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
    public function insertRegister(){
        //var_dump($this->convertDataHora('d/m/Y', 'Y-m-d',$this->avaliar(chk_array($this->form_data, 'patrimony_date_patrimony'))));die;
        # Se o ID do agendamento estiver vazio, insere os dados
        $query_ins = $this->db->insert('bills_to_receive',[
            'receive_cod'           =>  $this->avaliar(chk_array($this->form_data, 'receive_cod')),
            'receive_desc'          =>  $this->avaliar(chk_array($this->form_data, 'receive_desc')),
            'receive_cat'           =>  $this->avaliar(chk_array($this->form_data, 'receive_cat')),
            'receive_date_venc'     =>  $this->convertDataHora('d/m/Y', 'Y-m-d',$this->avaliar(chk_array($this->form_data, 'receive_date_venc'))),
            'receive_date_pay'      =>  $this->convertDataHora('d/m/Y', 'Y-m-d',$this->avaliar(chk_array($this->form_data, 'receive_date_pay'))),
            'receive_value_real'    =>  $this->moneyFloat(chk_array($this->form_data, 'receive_value_real')),
            'receive_perce'         =>  (int) $this->only_filter_number(chk_array($this->form_data, 'receive_perce')),
            'receive_value_final'   =>  $this->moneyFloat(chk_array($this->form_data, 'receive_value_final')),
            'receive_sit'           =>  $this->avaliar(chk_array($this->form_data, 'receive_sit')),
            'receive_obs'           =>  $this->avaliar(chk_array($this->form_data, 'receive_obs')),
            'receive_created'       =>  date('Y-m-d H:i:s', time())
        ]);

        # Verifica se a consulta está OK se sim envia o Feedback para o usuário.
        if ( $query_ins ) {
            //$this->form_msg = ['result'=>'success', 'message'=>'query success'];
            //return $this->form_msg;
            echo 'ok';
        }else{
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
    public function updateRegister( $registro_id = NULL ){
        # Verifica se existe ID
        if ( $registro_id ) {
            
            # Efetua o update do registro
            $query_up = $this->db->update('bills_to_receive', 'receive_id', $registro_id,[
                'receive_cod'           =>  parent::avaliar(chk_array($this->form_data, 'receive_cod')),
                'receive_desc'          =>  parent::avaliar(chk_array($this->form_data, 'receive_desc')),
                'receive_cat'           =>  parent::avaliar(chk_array($this->form_data, 'receive_cat')),
                'receive_date_venc'     =>  parent::convertDataHora('d/m/Y', 'Y-m-d',parent::avaliar(chk_array($this->form_data, 'receive_date_venc'))),
                'receive_date_pay'      =>  parent::convertDataHora('d/m/Y', 'Y-m-d',parent::avaliar(chk_array($this->form_data, 'receive_date_pay'))),
                'receive_value_real'    =>  parent::moneyFloat(chk_array($this->form_data, 'receive_value_real')),
                'receive_perce'         =>  (int) parent::only_filter_number(chk_array($this->form_data, 'receive_perce')),
                'receive_value_final'   =>  parent::moneyFloat(chk_array($this->form_data, 'receive_value_final')),
                'receive_sit'           =>  parent::avaliar(chk_array($this->form_data, 'receive_sit')),
                'receive_obs'           =>  parent::savaliar(chk_array($this->form_data, 'receive_obs')),
                'receive_modified'      =>  date('Y-m-d H:i:s', time())
            ]);

            # Verifica se a consulta foi realizada com sucesso
            if ( $query_up ) {
                # Destroy variáveis nao mais utilizadas.
                unset( $registro_id, $query_up  );
                
                # Retorna o valor e finaliza execução.
                echo 'ok';exit();
            }else{
                # Destroy variavel nao mais utilizadas.
                unset( $registro_id, $query_up  );
                
                # Retorna o valor e finaliza execução.   
                echo 'err';exit();
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
        
        # Remove cryptográfia
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
        
        # Decodifica decodifica id
        $decode_id = parent::encode_decode(0, $encode_id);
        
        # Executa a consulta na base de dados
        if ($this->db->query("SELECT count(*) FROM `bills_to_receive` WHERE `receive_id` =  $decode_id ")->fetchColumn() < 1) {

            # Dstroy variável não mas usada
            unset($encode_id, $decode_id);
            
            # Feedback usuário (erro)
            $feedback = 'err';
            
        } else {
            # Deleta o registro
            $this->db->delete('bills_to_receive', 'receive_id', $decode_id);
            
            # Dstroy variável não mas usada
            unset($encode_id, $decode_id);
            
            # Feedback usuário (successo)
             $feedback = 'ok';
        }
        echo $feedback;unset($feedback);return;
    } #--> End delRegister()
   
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
        foreach ($queryResult as $patrimony) {
            $mysql_data[] = [
                "patrimony_id"        => $patrimony['patrimony_id'],
                "patrimony_venc"      => $patrimony['patrimony_venc'],
                "patrimony_date_patrimony"  => $patrimony['patrimony_date_patrimony'],
                "patrimony_cat"       => '$ ' . $patrimony['patrimony_cat'],
                "patrimony_desc"      => $patrimony['patrimony_desc'],
                "patrimony_val"       => $patrimony['patrimony_val']
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
        $query_get = $this->db->query( " SELECT * FROM  `patrimony` WHERE `patrimony_id`= $decode_id " );

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
    

} #Fees_Model
