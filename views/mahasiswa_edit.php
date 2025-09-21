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
    </select><br>

    <button type="submit">Update</button>
</form>

<a href="index.php?controller=mahasiswa&action=index">Kembali</a>

<script>
    const fakultasEl = document.getElementById('fakultas');
    const jurusanEl = document.getElementById('jurusan');
    const jurusan_session = "<?= $mhs['jurusan_id'] ?? '' ?>";

    fakultasEl.addEventListener('change', function() {
        const fid = this.value;
        jurusanEl.innerHTML = '<option value="">-- Pilih Jurusan --</option>';
        if (!fid) return;

        fetch(`index.php?controller=mahasiswa&action=getJurusanAjax&fakultas_id=${fid}`)
            .then(res => res.json())
            .then(data => {
                data.forEach(j => {
                    const opt = document.createElement('option');
                    opt.value = j.id;
                    opt.textContent = j.nama;
                    if(j.id == jurusan_session) opt.selected = true;
                    jurusanEl.appendChild(opt);
                });
            })
            .catch(err => console.error("Error fetch jurusan:", err));
    });
    
    if(fakultasEl.value) {
        fakultasEl.dispatchEvent(new Event('change'));
    }
</script>

<?php include 'partials/footer.php'; ?>
