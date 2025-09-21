const fakultasEl = document.getElementById('fakultas');
const jurusanEl = document.getElementById('jurusan');
const jurusan_aktif = jurusanEl.dataset.selected;

// Event change fakultas
fakultasEl.onchange = function() {
    const fid = this.value;
    jurusanEl.innerHTML = '<option value="">-- Pilih Jurusan --</option>';
    if (!fid) return;

    // AJAX fetch
    fetch(`index.php?controller=mahasiswa&action=getJurusanAjax&fakultas_id=${fid}`)
        .then(res => res.json())
        .then(data => {
            data.forEach(j => {
                const opt = document.createElement('option');
                opt.value = j.id;
                opt.textContent = j.nama;
                if (j.id == jurusan_aktif) opt.selected = true;
                jurusanEl.appendChild(opt);
            });
        })
        .catch(err => console.error('Error fetch jurusan:', err));
};

if (fakultasEl.value) fakultasEl.onchange();