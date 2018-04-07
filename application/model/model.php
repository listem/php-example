<?php

class Model
{
    /**
     * @param object $db A PDO database connection
     */
    function __construct($db)
    {
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }
    }

    /**
     * Fetch all results of given select query.
     */
    public function fetchAll($query)
    {
        $query = $this->db->prepare($query);
        $query->execute();

        return $query->fetchAll();
    }
}
