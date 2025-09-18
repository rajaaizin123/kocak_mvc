<?php
class Mahasiswa {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function all() {
        $result = $this->conn->query("SELECT * FROM mahasiswa");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function find($id) {
        $stmt = $this->conn->prepare("SELECT * FROM mahasiswa WHERE id=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function create($data) {
        $stmt = $this->conn->prepare("INSERT INTO mahasiswa (nama, nim, jurusan) VALUES (?,?,?)");
        $stmt->bind_param("sss", $data['nama'], $data['nim'], $data['jurusan']);
        return $stmt->execute();
    }

    public function update($id, $data) {
        $stmt = $this->conn->prepare("UPDATE mahasiswa SET nama=?, nim=?, jurusan=? WHERE id=?");
        $stmt->bind_param("sssi", $data['nama'], $data['nim'], $data['jurusan'], $id);
        return $stmt->execute();
    }

    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM mahasiswa WHERE id=?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
