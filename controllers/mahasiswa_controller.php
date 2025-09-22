<?php
require_once('models/mahasiswa_model.php');

class mahasiswaController {
    private $model;

    public function __construct($conn) 
    {
        $this->model = new Mahasiswa($conn);
    }

    public function index() 
    {
        $data = $this->model->all();

        $title = "Data mahasiswa";
        require('views/mahasiswa_list.php');
    }

    public function create() 
    {
        $title = "Tambah Mahasiswa";
        $errors = [];

        $fakultas = $this->model->getFakultas();
        $data_fakultas = array_column($fakultas, 'nama', 'id'); // [id => nama]

       // var_dump($data_fakultas);
        //var_dump($_POST);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $errors = $this->model->validate($_POST);
            if (!empty($errors)){
                require('views/mahasiswa_create.php');
                return;
            }
            
            $this->model->create($_POST);
            header("Location: index.php?controller=mahasiswa&action=index");
            exit;

        }
        require('views/mahasiswa_create.php');
    }

    public function edit($id) 
    {
        $title = "Edit Mahasiswa";
        $mhs = $this->model->find($id);
        if (!$mhs){
            echo "mahasiswa dengan ID $id tidak ada.";
            echo '<br><a href="index.php?controller=mahasiswa&action=index">Kembali</a>';
            return;
        }

        $errors = [];
        $fakultas = $this->model->getFakultas();
        $fakultas_aktif = $_POST['fakultas'] ?? $mhs['fakultas_id'] ?? 0;
        $jurusanList = $this->model->getJurusanByFakultas($fakultas_aktif);
        $jurusan_aktif = $this->model->getJurusanById($mhs['jurusan_id']);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $errors = $this->model->validate($_POST);
            if (!empty($errors)){
                require('views/mahasiswa_edit.php');
                return;
            }

            $this->model->update($id, $_POST);
            header("Location: index.php?controller=mahasiswa&action=index");
            exit;
        }

        require('views/mahasiswa_edit.php');
    }

    public function delete($id) 
    {
        $this->model->delete($id);
        header("Location: index.php?controller=mahasiswa&action=index");
        exit;
    }

    public function getJurusanAjax() 
    {
        $fakultas_id = $_GET['fakultas_id'] ?? 0;
        $jurusan = $this->model->getJurusanByFakultas($fakultas_id);
        header('Content-Type: application/json');
        echo json_encode($jurusan);
        exit;
    }

}
