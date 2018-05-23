<?php

class IndexModel
{
    /**
     * Every model needs a database connection, passed to the model
     * @param object $db A PDO database connection
     */
    function __construct($db) {
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }
    }

    public function testMethod()
    {
        // $sql = "SELECT * FROM tableName";
        // $query = $this->db->prepare($sql);
        // $query->execute();
        // return $query->fetchAll();

        $result = array('id' => 1, 'name' => 'Dimitar Deskov');
        return $result;
    }
}
