<?php

require_once __DIR__ . "/../../core/Controller.php";

class AbsensiController extends Controller
{

    private $guruModel;
    private $kelasModel;
    private $muridModel;
    private $absensiModel;

    public function __construct()
    {
        $this->guruModel    = $this->model("GuruModel");
        $this->kelasModel   = $this->model("KelasModel");
        $this->muridModel   = $this->model("MuridModel");
        $this->absensiModel = $this->model("AbsensiModel");
    }

    public function index()
    {

        $guru_id  = isset($_GET['guru']) ? (int)$_GET['guru'] : 1;
        $kelas_id = isset($_GET['kelas']) ? (int)$_GET['kelas'] : 1;
        $tanggal  = isset($_GET['tanggal'])
                        ? $_GET['tanggal']
                        : date('Y-m-d');


        $mapel = $this->guruModel->getMapel($guru_id);

        $mapel_id = $mapel['id'];

        $header_id = $this->absensiModel->getHeaderId(
            $kelas_id,
            $guru_id,
            $mapel_id,
            $tanggal
        );

        $murid = $this->muridModel->getByKelas($kelas_id);


        foreach($murid as &$m){

            $m['status']=$this
                        ->absensiModel
                        ->getStatus(
                            $header_id,
                            $m['id']
                        );

        }

        $data=[
            "guru"=>$this->guruModel->getAll(),
            "kelas"=>$this->kelasModel->getAll(),
            "guru_id"=>$guru_id,
            "kelas_id"=>$kelas_id,
            "tanggal"=>$tanggal,
            "mapel"=>$mapel,
            "header_id"=>$header_id,
            "murid"=>$murid
        ];

        $this->view(
            "absensi/index",
            $data
        );

    }

    public function simpan()
    {

        if(!$this->isPost()){

            return;

        }

        $header_id = $_POST['header_id'];
        $murid_id = $_POST['murid_id'];
        $status = $_POST['status'];
        $this->absensiModel->save(
            $header_id,
            $murid_id,
            $status
            
        );

        echo json_encode([

            "success"=>true

        ]);

    }

}