<?php
/**
 *  @Autor: F.A.G.A <gomes.tisystem@gmail.com>
 *  @Class: MainModel - Modelo base
 *  @Descrição: Essa classe servirá para manter os métodos que poderão ser utilizados em todos os modelos, ou seja, ela o ajuda a manter a reutilização de código sempre ativa.
 * 
 *  @Pacote: SystemControl
 *  @Versão: 0.1
 * */
class MainModel{
    
    /**
     *  @Acesso: public
     *  @Autor: F.A.G.A <gomes.tisystem@gmail.com>
     *  @Descrição: Armazena os dados passado no formulário via post.
     * */
    public $form_data;

    /**
     *  @Acesso: public
     *  @Autor: F.A.G.A <gomes.tisystem@gmail.com>
     *  @Descrição: Responsavel por armazenar as mensagen de feedback ao usuário.
     */
    public $form_msg;

    /**
     *  @Acesso: public
     *  @Autor: F.A.G.A <gomes.tisystem@gmail.com>
     *  @Descrição: Armazena a mensagem de confirmação ao apagar algum registro
     * */
    public $form_confirma;

   /**
    *  @Acesso: public
    *  @Autor: F.A.G.A <gomes.tisystem@gmail.com>
    *  @Descrição: O objeto da nossa conexão PDO.
    **/
    public $db;

    /**
    *  @Acesso: public
    *  @Autor: F.A.G.A <gomes.tisystem@gmail.com>
    *  @Descrição: O controller que gerou esse modelo
    * */
    public $controller;

    /**
     *  @Acesso: public
     *  @Autor: F.A.G.A <gomes.tisystem@gmail.com>
     *  @Descrição: Parâmetros da URL
     * */
    public $parametros;

    /**
     *  @Acesso: public
     *  @Autor: F.A.G.A <gomes.tisystem@gmail.com>
     *  @Descrição: Dados do usuário
     * */
    public $userdata;
   
    
    /**
     *   @Acesso: public
     *   @Autor: Gomes - F.A.G.A <gomes.tisystem@gmail.com>
     *   @Versão: 0.1
     *   @Função: get_table_data() 
     *   @Descrição: Recebe os valores passado na função, $campo, $tabela e $id, efetua a consulta e retorna o resultado. 
     * */
    public function get_table_data($campo, $table, $id) {
        #Simplesmente seleciona os dados na base de dados
        $query = $this->db->query("SELECT  $campo FROM $table ORDER BY $id");

        // Verifica se a consulta está OK
        if (!$query) {
            
            #Finaliza
            return;
        }
        
        # Retorna os valores da consulta
        return $query->fetchAll(PDO::FETCH_BOTH);
    }   # End get_table_data()
    
    /**
     * @access: public
     * @author: Francisco Aparecido - F.A.G.A <gomes.tisystem@gmail.com>
     * @version: 0.2
     * @param: mixed variables
     * @param: string $table_name [required]
     * @param: array $conditions [required] <code>$conditions['where'=>['colunm'=>value,...]] $conditions['search'=>['colunm'=>value,...]]
     * </code>
     * @return: array Retorna um array com os valores
     */
    public function searchTable($table_name, $conditions = []) {
        $sql = 'SELECT ';
        $sql .= array_key_exists('select', $conditions) ? $conditions['select'] : '*';
        $sql .= ' FROM ' . $table_name;

        if(array_key_exists('where', $conditions)) {
            $sql .= ' WHERE ';
            $i = 0;
            foreach ($conditions['where'] as $key => $value) {
                $pre = ($i > 0) ? ' AND ' : '';
                if(in_array($value, $conditions['where'], TRUE)){
                    $sql .= $pre . $key . ' = ' . $value;
                    $i++;    
                }
            }
           
        }elseif (array_key_exists('search', $conditions)) {
            $sql .= (strpos($sql, 'WHERE') !== FALSE) ? '' : ' WHERE (';
            $i = 0;
            foreach ($conditions['search'] as $key => $value) {
                $pre = ($i > 0) ? ' OR ' : '';
                $sql .= $pre . $key . " LIKE '%" . $value . "%'";
                $i++;
            }
            $sql.=')';
        }elseif (array_key_exists('active', $conditions) OR array_key_exists('inactive', $conditions)) {
            $sql .= ' WHERE ';
            $i = 0;
            (array_key_exists('active', $conditions)) ? $type = 'active' : $type = 'inactive';
            foreach ($conditions[$type] as $key => $value) {
                $pre = ( $i > 0 ) ? ' AND ' : '';
                $sql .= $pre . $key . " = '" . $value . "'";
                $i++;
            }
        }if (array_key_exists('and', $conditions)){
            $sql.= ' AND ( ' . $conditions['and'].' ) ';
        }if (array_key_exists('order_by', $conditions)) {
            $sql .= ' ORDER BY ' . $conditions['order_by'];
        }if (array_key_exists('start', $conditions) && array_key_exists("limit", $conditions)) {
            $sql .= ' LIMIT ' . $conditions['start'] . ',' . $conditions['limit'];
        }if (!array_key_exists('start', $conditions) && array_key_exists("limit", $conditions)) {
            $sql .= ' LIMIT ' . $conditions['limit'];
        }
        //var_dump($sql);
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
            //var_dump($result);
           /*if ( (empty($result)) ? count($result) > 0 : 1 ) {
                echo 'Eu';
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    $data[] = $row;
                }
            }*/
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $data[] = $row;
            }
            
         }
         return !empty($data) ? $data : false;
    }   # End searchTable()

}   # End MainModel