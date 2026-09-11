<?php

require_once __DIR__ . "/../../core/Model.php";

class AbsensiModel extends Model
{

    /**
     * Cari Header Absensi
     */
    public function getHeader($kelas_id,$guru_id,$mapel_id,$tanggal)
    {

        $kelas_id = (int)$kelas_id;
        $guru_id  = (int)$guru_id;
        $mapel_id = (int)$mapel_id;

        $tanggal = $this->escape($tanggal);

        $sql = "SELECT *
                FROM absensi_header
                WHERE
                    kelas_id='$kelas_id'
                AND guru_id='$guru_id'
                AND mapel_id='$mapel_id'
                AND tanggal='$tanggal'";

        $result = $this->query($sql);

        return $this->fetch($result);

    }

    /**
     * Membuat Header Baru
     */
    public function createHeader($kelas_id,$guru_id,$mapel_id,$tanggal)
    {

        $kelas_id = (int)$kelas_id;
        $guru_id  = (int)$guru_id;
        $mapel_id = (int)$mapel_id;

        $tanggal = $this->escape($tanggal);

        $sql = "INSERT INTO absensi_header
                (
                    kelas_id,
                    guru_id,
                    mapel_id,
                    tanggal
                )
                VALUES
                (
                    '$kelas_id',
                    '$guru_id',
                    '$mapel_id',
                    '$tanggal'
                )";

        $this->execute($sql);

        return $this->lastInsertId();

    }

    /**
     * Ambil Header ID
     * Kalau belum ada otomatis dibuat
     */
    public function getHeaderId($kelas_id,$guru_id,$mapel_id,$tanggal)
    {

        $header = $this->getHeader(
            $kelas_id,
            $guru_id,
            $mapel_id,
            $tanggal
        );

        if($header){

            return $header['id'];

        }

        return $this->createHeader(
            $kelas_id,
            $guru_id,
            $mapel_id,
            $tanggal
        );

    }

    /**
     * Simpan / Update Absensi
     */
    public function save($header_id,$murid_id,$status)
    {

        $header_id = (int)$header_id;
        $murid_id  = (int)$murid_id;

        $status = $this->escape($status);

        $cek = $this->query("
            SELECT id
            FROM absensi_detail
            WHERE
                header_id='$header_id'
            AND murid_id='$murid_id'
        ");

        if($this->rowCount($cek)>0){

            $sql = "
                UPDATE absensi_detail
                SET status='$status'
                WHERE
                    header_id='$header_id'
                AND murid_id='$murid_id'
            ";

        }else{

            $sql = "
                INSERT INTO absensi_detail
                (
                    header_id,
                    murid_id,
                    status
                )
                VALUES
                (
                    '$header_id',
                    '$murid_id',
                    '$status'
                )
            ";

        }

        return $this->execute($sql);

    }

    /**
     * Ambil Status Murid
     */
    public function getStatus($header_id,$murid_id)
    {

        $header_id = (int)$header_id;
        $murid_id  = (int)$murid_id;

        $sql = "
            SELECT status
            FROM absensi_detail
            WHERE
                header_id='$header_id'
            AND murid_id='$murid_id'
        ";

        $result = $this->query($sql);

        if($this->rowCount($result)>0){

            $row = $this->fetch($result);

            return $row['status'];

        }

        return "Hadir";

    }

}