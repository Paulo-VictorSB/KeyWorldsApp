<?php

namespace DATABASE;

use PDO;
use PDOException;
use stdClass;

class Database
{
    // Prop
    private $_host;
    private $_database;
    private $_username;
    private $_password;
    private $_return_type;

    public function __construct($cfg_options, $_return_type = 'object')
    {
        // Set conection configurations
        $this->_host = $cfg_options['host'];
        $this->_database = $cfg_options['database'];
        $this->_username = $cfg_options['username'];
        $this->_password = $cfg_options['password'];

        // Sets the return type
        if(!empty($return_type) && $_return_type == 'object'){
            $this->_return_type = PDO::FETCH_OBJ;
        } else {
            $this->_return_type = PDO::FETCH_ASSOC;
        }
    }

    public function execute_query($sql, $parameters = null)
    {
        // Executes a query with results

        // Conection 
        $connection = new PDO(
            'mysql:host=' . $this->_host . ';dbname=' . $this->_database . ';charset=utf8',
            $this->_username,
            $this->_password,
            array(PDO::ATTR_PERSISTENT => true)
        );

        $results = null;

        try {

            $db = $connection->prepare($sql);
            if(!empty($parameters)){
                $db->execute($parameters);
            } else{
                $db->execute();
            }
            $results = $db->fetchAll($this->_return_type);

        } catch (PDOException $err) {
            
            // Close connection
            $connection = null;

            return $this->_result('ERROR: ', $err->getMessage(), $sql, null, 0, null);

        }

        // Close connection
        $connection = null;

        return $this->_result('sucess', 'sucess', $sql, $results, $db->rowCount(), null);
    }

    public function _result($status, $mensage, $sql, $results, $affected_rows, $last_id)
    {
        $tmp = new stdClass();
        $tmp->status = $status;
        $tmp->mensage = $mensage;
        $tmp->query = $sql;
        $tmp->results = $results;
        $tmp->affected_rows = $affected_rows;
        $tmp->last_id = $last_id;
        return $tmp;
    }

    public function execute_non_query($sql, $parameters = null)
    {
        // Executes a query without results

        // Conection 
        $connection = new PDO(
            'mysql:host=' . $this->_host . ';dbname=' . $this->_database . ';charset=utf8',
            $this->_username,
            $this->_password,
            array(PDO::ATTR_PERSISTENT => true)
        );

        // Init transation
        $connection->beginTransaction();

        // Perapre and execute a query
        try {

            $db = $connection->prepare($sql);
            if(!empty($parameters)){
                $db->execute($parameters);
            } else{
                $db->execute();
            }

            // Last inserted id
            $last_inserted_id = $connection->lastInsertId();

            // Finsh transaction

            $connection->commit();

        } catch (PDOException $err) {
            
            // undo all sql operations on error
            $connection->rollBack();

            // Close connection
            $connection = null;

            return $this->_result('ERROR: ', $err->getMessage(), $sql, null, 0, null);

        }

        $connection = null;

        return $this->_result('sucess', 'sucess', $sql, null, $db->rowCount(), $last_inserted_id);
    }
}
