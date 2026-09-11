<?php

require_once __DIR__ . "/../../core/Model.php";

class MuridModel extends Model
{

    /**
     * Ambil semua murid
     */
    public function getAll()
    {
        $sql = "SELECT
                    murid.*,
                    kelas.nama_kelas
                FROM murid
                INNER JOIN kelas
                    ON murid.kelas_id = kelas.id
                ORDER BY
                    kelas.nama_kelas ASC,
                    murid.nama_murid ASC";

        $result = $this->query($sql);

        return $this->fetchAll($result);
    }

    /**
     * Ambil murid berdasarkan kelas
     */
    public function getByKelas($kelas_id)
    {
        $kelas_id = (int)$kelas_id;

        $sql = "SELECT *
                FROM murid
                WHERE kelas_id = '$kelas_id'
                ORDER BY nama_murid ASC";

        $result = $this->query($sql);

        return $this->fetchAll($result);
    }

    /**
     * Ambil satu murid
     */
    public function getById($id)
    {
        $id = (int)$id;

        $sql = "SELECT *
                FROM murid
                WHERE id='$id'";

        $result = $this->query($sql);

        return $this->fetch($result);
    }

}