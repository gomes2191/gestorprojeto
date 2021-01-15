<?php

/**
 * SystemDB - Classe para gerenciamento da Base de dados.
 *
 * @category Class
 * @package  SystemDB
 * @author   Francisco <gomes.tisystem@gmail.com>
 * @license  gclinic.com Private
 * @link     www.gclinic.com
 * @since    0.2
 */
class SystemDB extends Config
{

    // Propriedades referente a conexão com a base de dados.
    private $_dbHost = "localhost", // Host da base de dados
        $_dbDriver = "mysql",
        $_dbName, // Nome do banco de dados
        $_tbPrefix,
        $_dbPassword, // Senha do usuário da base de dados
        $_dbUser, // Usuário da base de dados
        $_dbCharset, // Charset da base de dados
        $_pdo, // Nossa conexão com o BD
        $_error, // Configura o erro
        $_showErrors = true; // Mostra todos os erros

    /**
     * Construtor da classe
     *
     * @since 0.1
     * @access public
     * @param string $db_host
     * @param string $db_driver
     * @param string $db_name
     * @param string $tb_prefix
     * @param string $password
     * @param string $user
     * @param string $charset
     * @param string $debug
     */
    function __construct()
    {

        $this->_dbHost      = defined('Config::DB_HOST') ? Config::DB_HOST : $this->_dbHost;
        $this->_dbDriver    = defined('Config::DB_DRIVER') ? Config::DB_DRIVER['driver'] : $this->_dbDriver;
        $this->_dbName      = defined('Config::DB_NAME') ? Config::DB_NAME : $this->_dbName;
        $this->_tbPrefix    = defined('Config::TB_PREFIX') ? Config::TB_PREFIX : $this->_tbPrefix;
        $this->_dbPassword  = defined('Config::DB_PASSWORD') ? Config::DB_PASSWORD : $this->_dbPassword;
        $this->_dbUser      = defined('Config::DB_USER') ? Config::DB_USER : $this->_dbCharset;
        $this->_dbCharset   = defined('Config::DB_CHARSET') ? Config::DB_CHARSET : $this->_dbCharset;
        //$this->_showErrors  = defined('Config::SHOW_ERRORS') ? Config::SHOW_ERRORS : $this->_showErrors;

        // Efetua a conexão
        $this->connectDb();
    } // End:) __construct


    /**
     * Junta os _parameters e tenta efetuar a conexão com o BD.
     *
     * @return array
     */
    final protected function connectDb()
    {
        /* Os detalhes da nossa conexão PDO */
        $pdoDetails  = "{$this->_dbDriver}:host={$this->_dbHost};";
        $pdoDetails .= "dbname={$this->_dbName};";
        //$pdo_details .= "charset={$this->db_charset};";
        $pdoDetails .= "options='--client_encoding={$this->_dbCharset}'";


        // Tenta conectar
        try {

            $this->_pdo = new PDO($pdoDetails, $this->_dbUser, $this->_dbPassword);

            //var_dump($this->_pdo);

            // Verifica se devemos debugar
            if ($this->_showErrors === true) {

                // Configura o PDO ERROR MODE
                $this->_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
            }

            // Descarta propriedades, não mais usadas.
            unset($this->_dbHost);
            unset($this->_dbName);
            unset($this->_password);
            unset($this->_user);
            unset($this->_charset);
        } catch (PDOException $e) {

            // Verifica se devemos debugar
            if ($this->_showErrors === true) {

                // Mostra a mensagem de erro
                echo '<pre>';
                var_dump("Erro: " . $e->getMessage());
                echo '<pre>';
            }
        } // catch
    } // connect

    /**
     * query - Consulta PDO
     *
     * @since 0.1
     * @access public
     * @return object|bool Retorna a consulta ou falso
     */
    public function query($stmt, $data_array = null)
    {
        // Prepara e executa
        $query = $this->_pdo->prepare($stmt);
        $check_exec = $query->execute($data_array);

        # Verifica se a consulta aconteceu
        if ($check_exec) {

            # Retorna a consulta
            return $query;
        } else {

            // Configura o erro
            $error = $query->errorInfo();
            $this->error = $error[2];

            // Retorna falso
            return false;
        }
    }

    /**
     * insert - Insere valores
     *
     * Insere os valores e tenta retornar o último id enviado
     *
     * @since 0.1
     * @access public
     * @param string $table O nome da tabela
     * @param array ... Ilimitado número de arrays com chaves e valores
     * @return object|bool Retorna a consulta ou falso
     */
    public function insert($table)
    {
        // Configura o array de colunas
        $cols = [];

        // Configura o valor inicial do modelo
        $place_holders = '(';

        // Configura o array de valores
        $values = [];

        // O $j will assegura que colunas serão configuradas apenas uma vez
        $j = 1;

        // Obtém os argumentos enviados
        $data = func_get_args();

        // É preciso enviar pelo menos um array de chaves e valores
        if (!isset($data[1]) || !is_array($data[1])) {
            return;
        }

        // Faz um laço nos argumentos
        for ($i = 1; $i < count($data); $i++) {

            // Obtém as chaves como colunas e valores como valores
            foreach ($data[$i] as $col => $val) {

                // A primeira volta do laço configura as colunas
                if ($i === 1) {
                    $cols[] = "`$col`";
                }

                if ($j <> $i) {
                    // Configura os divisores
                    $place_holders .= '), (';
                }

                // Configura os place holders do PDO
                $place_holders .= '?, ';

                // Configura os valores que vamos enviar
                $values[] = $val;

                $j = $i;
            }

            // Remove os caracteres extra dos place holders
            $place_holders = substr($place_holders, 0, strlen($place_holders) - 2);
        }

        // Separa as colunas por vírgula
        $cols = implode(', ', $cols);

        // Cria a declaração para enviar ao PDO
        $stmt = "INSERT INTO `$table` ( $cols ) VALUES $place_holders) ";

        // Insere os valores
        $insert = $this->query($stmt, $values);

        // Verifica se a consulta foi realizada com sucesso
        if ($insert) {

            // Destrói as varáveis não mais usadas.
            unset($insert, $stmt, $cols, $place_holders, $data, $values, $place_holders);

            // Verifica se temos o último ID enviado
            if (method_exists($this->_pdo, 'lastInsertId') && $this->_pdo->lastInsertId()) {
                // Configura o último ID
                return $this->_pdo->lastInsertId();
            }

            // Retorna a consulta

        }

        // The end :)
        return;
    }

    // insert

    /**
     * Update simples
     *
     * Atualiza uma linha da tabela baseada em um campo
     *
     * @since 0.1
     * @access protected
     * @param string $table Nome da tabela
     * @param string $where_field WHERE $where_field = $where_field_value
     * @param string $where_field_value WHERE $where_field = $where_field_value
     * @param array $values Um array com os novos valores
     * @return object|bool Retorna a consulta ou falso
     */
    public function update($table, $where_field, $where_field_value, $values)
    {
        // Você tem que enviar todos os parâmetros
        if (empty($table) || empty($where_field) || empty($where_field_value)) {
            return;
        }

        // Começa a declaração
        $stmt = " UPDATE `$table` SET ";

        // Configura o array de valores
        $set = [];

        // Configura a declaração do WHERE campo=valor
        $where = " WHERE `$where_field` = ? ";

        // Você precisa enviar um array com valores
        if (!is_array($values)) {
            return;
        }

        // Configura as colunas a atualizar
        foreach ($values as $column => $value) {
            $set[] = " `$column` = ?";
        }

        // Separa as colunas por vírgula
        $set = implode(', ', $set);

        // Concatena a declaração
        $stmt .= $set . $where;

        // Configura o valor do campo que vamos buscar
        $values[] = $where_field_value;

        // Garante apenas números nas chaves do array
        $values = array_values($values);

        // Atualiza
        $update = $this->query($stmt, $values);

        // Verifica se a consulta está OK
        if ($update) {
            // Retorna a consulta
            return $update;
        }

        // The end :)
        return;
    } // update

    /**
     * Delete
     *
     * Deleta uma linha da tabela
     *
     * @since 0.1
     * @access protected
     * @param string $table Nome da tabela
     * @param string $where_field WHERE $where_field = $where_field_value
     * @param string $where_field_value WHERE $where_field = $where_field_value
     * @return object|bool Retorna a consulta ou falso
     */
    public function delete($table, $where_field, $where_field_value)
    {
        // Você precisa enviar todos os parâmetros
        if (empty($table) || empty($where_field) || empty($where_field_value)) {
            return;
        }

        // Inicia a declaração
        $stmt = " DELETE FROM `$table` ";

        // Configura a declaração WHERE campo=valor
        $where = " WHERE `$where_field` = ? ";

        // Concatena tudo
        $stmt .= $where;

        // O valor que vamos buscar para apagar
        $values = array($where_field_value);

        // Apaga
        $delete = $this->query($stmt, $values);

        // Verifica se a consulta está OK
        if ($delete) {
            // Retorna a consulta
            return $delete;
        }

        // The end :)
        return;
    } // delete

    // Metodo para pegar o id da ultima inserção na tabela
    public function lastInsertId()
    {
        return $this->_pdo->lastInsertId();
    }


    //Método para a consulta na tabela
    /**
     * [listar]
     * @param  [type] $tabela   string
     * @param  [type] $coluna   string
     * @param  [type] $condicao string
     * @return [type]           array
     */
    public function select($table, $column, $condition = null)
    {
        (defined('Config::TB_PREFIX')) ? $table = Config::TB_PREFIX . $table : $table;

        if ($result =  $this->query("SELECT {$column} FROM {$table} {$condition}")) {
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $data[]  = $row;
            }
        }
        return !empty($data) ? $data : false;
    }
}// Class SystemDB