<h2>Edit Mahasiswa</h2>
<form method="POST">
    Nama: <input type="text" name="nama" value="<?= $mhs['nama'] ?>"><br>
    NIM: <input type="text" name="nim" value="<?= $mhs['nim'] ?>"><br>
    Jurusan: <input type="text" name="jurusan" value="<?= $mhs['jurusan'] ?>"><br>
    <button type="submit">Update</button>
</form>
<a href="index.php?controller=mahasiswa&action=index">Kembali</a>


