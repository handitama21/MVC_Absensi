<?php

require_once __DIR__ . "/../../core/Model.php";

class GuruModel extends Model
{

    /**
     * Ambil semua guru
     */
    public function getAll()
    {
        $sql = "SELECT *
                FROM guru
                ORDER BY nama_guru ASC";

        $result = $this->query($sql);

        return $this->fetchAll($result);
    }

    /**
     * Ambil guru berdasarkan id
     */
    public function getById($id)
    {
        $id = (int)$id;

        $sql = "SELECT *
                FROM guru
                WHERE id='$id'";

        $result = $this->query($sql);

        return $this->fetch($result);
    }

    /**
     * Ambil mapel yang diajar guru
     */
    public function getMapel($guru_id)
    {
        $guru_id = (int)$guru_id;

        $sql = "SELECT
                    mapel.id,
                    mapel.nama_mapel
                FROM guru_mapel
                INNER JOIN mapel
                    ON guru_mapel.mapel_id = mapel.id
                WHERE guru_mapel.guru_id='$guru_id'
                LIMIT 1";

        $result = $this->query($sql);

        return $this->fetch($result);
    }

}