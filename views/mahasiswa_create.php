<?php include 'partials/header.php'; ?>

<h2>Tambah Mahasiswa</h2>

<?php if (!empty($errors)): ?>
    <div style="color:red; margin-bottom:10px;">
        <ul>
            <?php foreach ($errors as $err): ?>
                <li><?= htmlspecialchars($err) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form method="POST">
    Nama: <input type="text" name="nama" value="<?= htmlspecialchars($_POST['nama'] ?? '') ?>"><br>
    NIM: <input type="text" name="nim" value="<?= htmlspecialchars($_POST['nim'] ?? '') ?>"><br>
    Email: <input type="text" name="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"><br>

    Fakultas:
    <select name="fakultas" id="fakultas" required class="styled-select">
        <option value="">--- Pilih Fakultas ---</option>
        <?php foreach ($data_fakultas as $fid => $fname): ?>
            <option value="<?= $fid ?>" <?= (($_POST['fakultas'] ?? '') == $fid ? 'selected' : '') ?>>
                <?= htmlspecialchars($fname) ?>
            </option>
        <?php endforeach; ?>
    </select><br>

    Jurusan:
    <select name="jurusan_id" id="jurusan" required class="styled-select">
        <option value="">-- Pilih Jurusan --</option>
    </select><br>

    <button type="submit">Simpan</button>
</form>

<a href="index.php?controller=mahasiswa&action=index">Kembali</a>

<script src="../assets/js/script.js"></script>

<?php include 'partials/footer.php'; ?>
