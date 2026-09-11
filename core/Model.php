<?php

require_once __DIR__ . '/../config/Database.php';

class Model
{
    protected $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    /**
     * SELECT
     */
    protected function query($sql)
    {
        return $this->db->query($sql);
    }

    /**
     * INSERT / UPDATE / DELETE
     */
    protected function execute($sql)
    {
        return $this->db->query($sql);
    }

    /**
     * Ambil 1 data
     */
    protected function fetch($result)
    {
        return $result->fetch_assoc();
    }

    /**
     * Ambil semua data
     */
    protected function fetchAll($result)
    {
        $data = [];

        if (!$result) {
            return $data;
        }

        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        return $data;
    }

    /**
     * Escape string
     */
    protected function escape($value)
    {
        return $this->db->real_escape_string(trim($value));
    }

    /**
     * ID terakhir
     */
    protected function lastInsertId()
    {
        return $this->db->insert_id;
    }

    /**
     * Jumlah row
     */
    protected function rowCount($result)
    {
        return $result->num_rows;
    }
}