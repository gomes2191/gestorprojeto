<?php


class MainModel
{
    public $form_data;

    public $form_msg;

    public $form_confirma;

    public $db;

    public $controller;

    public $_parameters;

    public $userdata;

    public function get_table_data($campo, $table, $id)
    {
        #Simplesmente seleciona os dados na base de dados
        $query = $this->db->query("SELECT $campo FROM $table ORDER BY $id");

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
     * @param: string $table [required]
     * @param: array $conditions [required] <code>$conditions['where'=>['colunm'=>value,...]] $conditions['search'=>['colunm'=>value,...]]
     * </code>
     * @return: array Retorna um array com os valores
     */

    /**
     * Método que retorna o resultado de uma consulta
     * a partir dos parâmetros passados.
     *
     * @param string $tabela nome da tabela no formato string.
     * @param array  $conditions parâmetros passado no formato array.
     *
     * @return array retorna o resultado da consulta.
     */
    public function searchTable($table, $tableJoin = [], $conditions = [])
    {

        (defined('Config::TB_PREFIX')) ? $table = Config::TB_PREFIX . $table : $table;

        $sql = 'SELECT ';
        $sql .= array_key_exists('select', $conditions) ? $conditions['select'] : '*';
        $sql .= ' FROM ' . $table;

        if (array_key_exists('innerJoin', $conditions)) {
            //$sql .= " INNER JOIN $table ON ";
            $i = 0;

            foreach ($conditions['innerJoin'] as $key => $value) {
                $pre = ($i >= 0) ? " INNER JOIN $tableJoin[$i] ON " : '';
                //echo $value;

                //var_dump($conditions['innerJoin']);

                if (in_array($value, $conditions['innerJoin'], TRUE)) {
                    //echo $i;
                    $sql .= $pre . $key . ' = ' . $value;
                    $i++;
                }
            }
        } elseif (array_key_exists('where', $conditions)) {
            $sql .= ' WHERE ';
            $i = 0;
            foreach ($conditions['where'] as $key => $value) {
                $pre = ($i > 0) ? ' AND ' : '';
                if (in_array($value, $conditions['where'], TRUE)) {
                    $sql .= $pre . $key . ' = ' . $value;
                    $i++;
                }
            }
        } elseif (array_key_exists('search', $conditions)) {
            $sql .= (strpos($sql, 'WHERE') !== FALSE) ? '' : ' WHERE (';
            $i = 0;
            foreach ($conditions['search'] as $key => $value) {
                $pre = ($i > 0) ? ' OR ' : '';
                $sql .= $pre . $key . " LIKE '%" . $value . "%'";
                $i++;
            }
            $sql .= ')';
        } elseif (array_key_exists('active', $conditions) or array_key_exists('inactive', $conditions)) {
            $sql .= ' WHERE ';
            $i = 0;
            (array_key_exists('active', $conditions)) ? $type = 'active' : $type = 'inactive';
            foreach ($conditions[$type] as $key => $value) {
                $pre = ($i > 0) ? ' AND ' : '';
                $sql .= $pre . $key . " = '" . $value . "'";
                $i++;
            }
        }
        if (array_key_exists('and', $conditions)) {
            $sql .= ' AND ( ' . $conditions['and'] . ' ) ';
        }
        if (array_key_exists('order_by', $conditions)) {
            $sql .= ' ORDER BY ' . $conditions['order_by'];
        }
        if (array_key_exists('start', $conditions) && array_key_exists("limit", $conditions)) {
            $sql .= ' LIMIT ' . $conditions['start'] . ',' . $conditions['limit'];
        }
        if (!array_key_exists('start', $conditions) && array_key_exists("limit", $conditions)) {
            $sql .= ' LIMIT ' . $conditions['limit'];
        }

        echo '<pre>';
        // print_r($sql);
        echo '</pre>';

        $result = $this->db->query($sql);

        //var_dump($result);

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
            while ($row = $result->fetch(PDO::FETCH_UNIQUE)) {
                $data[] = $row;
            }
        }

        // Limpa a memória...
        unset($table, $sql, $result, $row, $conditions, $type, $key, $value, $pre, $i);

        return !empty($data) ? $data : false;
    } // End searchTable()

} // End MainModel