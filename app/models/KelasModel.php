<?php

require_once __DIR__ . "/../../core/Model.php";

class KelasModel extends Model
{

    /**
     * Ambil semua kelas
     */
    public function getAll()
    {
        $sql = "SELECT *
                FROM kelas
                ORDER BY nama_kelas ASC";

        $result = $this->query($sql);

        return $this->fetchAll($result);
    }

    /**
     * Ambil kelas berdasarkan ID
     */
    public function getById($id)
    {
        $id = (int)$id;

        $sql = "SELECT *
                FROM kelas
                WHERE id='$id'";

        $result = $this->query($sql);

        return $this->fetch($result);
    }

}