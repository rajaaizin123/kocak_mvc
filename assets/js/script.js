document.addEventListener("DOMContentLoaded", () => {
    const fakultasEl = document.getElementById('fakultas');
    const jurusanEl = document.getElementById('jurusan');
    const jurusan_session = "<?= $mhs['jurusan_id'] ?? '' ?>"; // dari PHP

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
                    if(j.id == jurusan_session) opt.selected = true; // set selected
                    jurusanEl.appendChild(opt);
                });
            })
            .catch(err => console.error("Error fetch jurusan:", err));
    });

    if(fakultasEl.value) {
        fakultasEl.dispatchEvent(new Event('change'));
    }
});