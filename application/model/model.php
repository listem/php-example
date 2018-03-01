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
     * Get all units with relationship from database
     */
    public function getAllUnits()
    {
        $sql = "SELECT u.name AS unit_name, u.code AS unit_code, u.credits, u.active AS unit_active, c.name AS course_name, l.name AS lecturer_name   
            FROM units u
            JOIN courses c ON u.course_id = c.id
            JOIN lecturers l ON u.lecturer_id = l.id";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }
}
