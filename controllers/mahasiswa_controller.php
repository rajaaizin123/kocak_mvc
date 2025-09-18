<?php
require_once('models/mahasiswa_model.php');

class mahasiswaController {
    private $model;

    public function __construct($conn) {
        $this->model = new Mahasiswa($conn);
    }

    public function index() {
        $data = $this->model->all();
        require('views/mahasiswa_list.php');
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->create($_POST);
            header("Location: index.php?controller=mahasiswa&action=index");
            exit;
        }
        require('views/mahasiswa_create.php');
    }

    public function edit($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->update($id, $_POST);
            header("Location: index.php?controller=mahasiswa&action=index");
            exit;
        }
        $mhs = $this->model->find($id);
        require('views/mahasiswa_edit.php');
    }

    public function delete($id) {
        $this->model->delete($id);
        header("Location: index.php?controller=mahasiswa&action=index");
        exit;
    }
}
