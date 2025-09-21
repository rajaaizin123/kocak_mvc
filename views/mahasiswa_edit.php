<?php include 'partials/header.php'; ?>

<?php if (!empty($errors)): ?>
    <div style="color: red; margin-bottom: 10px;">
        <ul>
            <?php foreach ($errors as $err): ?>
                <li><?= htmlspecialchars($err) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<h2>Edit Mahasiswa</h2>
<form method="POST">
    Nama: <input type="text" name="nama" value="<?= htmlspecialchars($mhs['nama']) ?>"><br>
    NIM: <input type="text" name="nim" value="<?= htmlspecialchars($mhs['nim']) ?>"><br>
    Email: <input type="text" name="email" value="<?= htmlspecialchars($mhs['email']) ?>"><br>

    Fakultas:
    <select name="fakultas" id="fakultas" required class="styled-select">
        <option value="">-- Pilih Fakultas --</option>
        <?php foreach ($fakultas as $f): ?>
            <option value="<?= $f['id'] ?>" <?= ($f['id'] == $fakultas_aktif ? 'selected' : '') ?>>
                <?= htmlspecialchars($f['nama']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    Jurusan:
    <select name="jurusan_id" id="jurusan" required class="styled-select">
        <option value="">-- Pilih Jurusan --</option>
        <?php foreach ($jurusanList as $j) : ?>
            <option value="<?= $j['id']; ?>" <?= ($j['id'] == $jurusan_aktif ? 'selected' : ''); ?>>
                <?= htmlspecialchars($j['nama']); ?>
            </option>
        <?php endforeach; ?>
    </select>
    <br>

    <button type="submit">Update</button>
    <a href="index.php?controller=mahasiswa&action=index">Kembali</a>
</form>

<script src="<?= BASEURL ?>/assets/js/script.js"></script>
<script>

</script>
<?php include 'partials/footer.php'; ?>