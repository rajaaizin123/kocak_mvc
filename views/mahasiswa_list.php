<?php include 'partials/header.php'; ?>

<h2>Data Mahasiswa</h2>
<a href="index.php?controller=mahasiswa&action=create"><i class="fa-solid fa-user-plus"></i> Tambah Mahasiswa</a>
<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>NIM</th>
        <th>Email</th>
        <th>Fakultas</th>
        <th>Jurusan</th>
        <th>Aksi</th>
    </tr>
    <?php foreach ($data as $m): ?>
        <tr>
            <td><?= htmlspecialchars($m['id']) ?></td>
            <td><?= htmlspecialchars($m['nama']) ?></td>
            <td><?= htmlspecialchars($m['nim']) ?></td>
            <td><?= htmlspecialchars($m['email'] ?? '') ?></td>
            <td><?= htmlspecialchars($m['fakultas']) ?></td>
            <td><?= htmlspecialchars($m['jurusan'] ?? '') ?></td>
            <td>
                <a href="index.php?controller=mahasiswa&action=edit&id=<?= $m['id'] ?>"><i class="fa-solid fa-user-pen"></i> Edit</a> |
                <a href="index.php?controller=mahasiswa&action=delete&id=<?= $m['id'] ?>" onclick="return confirm('Hapus data?')"><i class="fa-solid fa-trash"></i>Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<?php include 'partials/footer.php'; ?>