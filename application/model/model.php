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
        $sql = "SELECT u.id, unit_name, unit_code, credits, unit_active, course_name, lecturer_name   
            FROM units u
            JOIN courses c ON u.course_id = c.id
            JOIN lecturers l ON u.lecturer_id = l.id";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }
}
