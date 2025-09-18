-- Database: mvc_crud
CREATE DATABASE IF NOT EXISTS kampus;
USE kampus;

-- Tabel: mahasiswa
CREATE TABLE IF NOT EXISTS mahasiswa (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    nim VARCHAR(20) NOT NULL UNIQUE,
    jurusan VARCHAR(100) NOT NULL
);

-- Data contoh
INSERT INTO mahasiswa (nama, nim, jurusan) VALUES
('Andi Saputra', '210101001', 'Informatika'),
('Budi Santoso', '210101002', 'Sistem Informasi'),
('Citra Dewi',   '210101003', 'Teknik Elektro'),
('Dian Prasetyo','210101004', 'Manajemen');
