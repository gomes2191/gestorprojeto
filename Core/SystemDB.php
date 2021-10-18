<?php

class SystemDB extends Config
{
    private $_dbHost = "localhost",
        $_dbDriver = "mysql",
        $_dbName,
        $_tbPrefix,
        $_dbPassword,
        $_dbUser,
        $_dbCharset,
        $_pdo,
        $_error,
        $_showErrors = true;

    function __construct()
    {

        $this->_dbHost      = defined('Config::DB_HOST') ? Config::DB_HOST : $this->_dbHost;
        $this->_dbDriver    = defined('Config::DB_DRIVER') ? Config::DB_DRIVER['driver'] : $this->_dbDriver;
        $this->_dbName      = defined('Config::DB_NAME') ? Config::DB_NAME : $this->_dbName;
        $this->_tbPrefix    = defined('Config::TB_PREFIX') ? Config::TB_PREFIX : $this->_tbPrefix;
        $this->_dbPassword  = defined('Config::DB_PASSWORD') ? Config::DB_PASSWORD : $this->_dbPassword;
        $this->_dbUser      = defined('Config::DB_USER') ? Config::DB_USER : $this->_dbCharset;
        $this->_dbCharset   = defined('Config::DB_CHARSET') ? Config::DB_CHARSET : $this->_dbCharset;

        $this->connectDb();
    }

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

    public function insert($table)
    {
        $cols = [];

        $place_holders = '(';

        $values = [];

        $j = 1;

        $data = func_get_args();

        if (!isset($data[1]) || !is_array($data[1])) {
            return false;
        }

        for ($i = 1; $i < count($data); $i++) {
            foreach ($data[$i] as $col => $val) {

                if ($i === 1) {
                    $cols[] = "`$col`";
                }

                if ($j <> $i) {
                    $place_holders .= '), (';
                }

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

        }

        return false;
    }

    public function update($table, $where_single = false, $where_field = false, $where_field_value = false, $values)
    {
        $stmt = " UPDATE `$table` SET ";

        // Configura o array de valores
        $set = [];

        // Configura a declaração do WHERE campo=valor
        if ($where_single <> false) {
            $where = " WHERE $where_single";
        }else{
            $where = " WHERE `$where_field` = ?";
        }

        if (!is_array($values)) {
            return false;
        }

        foreach ($values as $column => $value) {
            $set[] = " `$column` = ?";
        }

        $set = implode(', ', $set);

        $stmt .= $set . $where;

        if ($where_single == false) {

            $values[] = $where_field_value;

            $values = array_values($values);

            $update = $this->query($stmt, $values);
        } else {

            $values = array_values($values);

            $update = $this->query($stmt, $values);
        }

        if ($update) {
            return $update;
        }

        return false;
    }

    public function delete($table, $where_field, $where_field_value)
    {
        if (empty($table) || empty($where_field) || empty($where_field_value)) {
            return;
        }

        $stmt = " DELETE FROM `$table` ";

        $where = " WHERE `$where_field` = ? ";

        $stmt .= $where;

        $values = array($where_field_value);

        $delete = $this->query($stmt, $values);

        if ($delete) {
            return $delete;
        }
        return;
    }

    public function lastInsertId()
    {
        return $this->_pdo->lastInsertId();
    }

    public function select($table, $column, $condition = null)
    {
        (defined('Config::TB_PREFIX')) ? $table = Config::TB_PREFIX . $table : $table;

        if ($result = $this->query("SELECT {$column} FROM {$table} {$condition}")) {

            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $data[]  = $row;
            }
        }
        return !empty($data) ? $data : false;
    }
}