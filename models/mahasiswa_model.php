<?php
class Mahasiswa {
    private $conn;

    public function __construct($conn) 
    {
        $this->conn = $conn;
    }

    public function all() {
       $sql = "
            SELECT 
                m.id, m.nama, m.nim, m.email,
                j.id AS jurusan_id, j.nama AS jurusan,
                f.id AS fakultas_id, f.nama AS fakultas
            FROM mahasiswa m
            LEFT JOIN jurusan j ON j.id = m.jurusan_id
            LEFT JOIN fakultas f ON f.id = j.fakultas_id
            ORDER BY m.id
        ";
        $result = $this->conn->query($sql);

        $rows = [];
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }

    public function find($id) {
        $stmt = $this->conn->prepare("
            SELECT 
                m.id, m.nama, m.nim, m.email,
                j.id AS jurusan_id, j.nama AS jurusan,
                f.id AS fakultas_id, f.nama AS fakultas
            FROM mahasiswa m
            LEFT JOIN jurusan j ON j.id = m.jurusan_id
            LEFT JOIN fakultas f ON f.id = j.fakultas_id
            WHERE m.id = ?
        ");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function create($data) 
    {
        $stmt = $this->conn->prepare("INSERT INTO mahasiswa (nama, nim, email, jurusan_id) VALUES (?,?,?,?)");
        $stmt->bind_param("sssi", $data['nama'], $data['nim'], $data['email'], $data['jurusan_id']);
        return $stmt->execute();
    }


    public function update($id, $data) 
    {
        $stmt = $this->conn->prepare(
            "UPDATE mahasiswa SET nama=?, nim=?, email=?, jurusan_id=? WHERE id=?"
        );
        $stmt->bind_param(
            "sssii", 
            $data['nama'], 
            $data['nim'], 
            $data['email'], 
            $data['jurusan_id'], 
            $id
        );
        if (!$stmt->execute()) {
            throw new Exception("Error saat update mahasiswa: " . $stmt->error);
        }
        return $stmt->affected_rows;
    }


    public function delete($id) 
    {
        $stmt = $this->conn->prepare("DELETE FROM mahasiswa WHERE id=?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public function validate($data) {
        $errors = [];

        $nama = trim($data['nama'] ?? '');
        $nim = trim($data['nim'] ?? '');
        $jurusan = trim($data['jurusan_id'] ?? '');
        $email = trim($data['email'] ?? '');
        $fakultas = trim($data['fakultas'] ?? '');

        if ($nama === '') $errors[] = "Nama wajib diisi.";

        if ($nim === '') $errors[] = "NIM wajib diisi.";
        elseif (!preg_match('/^\d+$/', $nim)) $errors[] = "NIM harus berupa angka.";

        if ($jurusan === '') $errors[] = "Jurusan wajib diisi.";

        if ($email === '') $errors[] = "Email wajib diisi";
        else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Email tak valid";

        if ($fakultas === '') $errors[] = "Fakultas wajib diisi";

        return $errors;
    }

    public function getFakultas() 
    {
        $result = $this->conn->query("SELECT * FROM fakultas");
        $rows = [];
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }

    public function getJurusanByFakultas($faculty_id) 
    {
        $stmt = $this->conn->prepare("SELECT * FROM jurusan WHERE fakultas_id=?");
        $stmt->bind_param("i", $faculty_id);
        $stmt->execute();
        $res = $stmt->get_result();
        $rows = [];
        while ($row = $res->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }

}
