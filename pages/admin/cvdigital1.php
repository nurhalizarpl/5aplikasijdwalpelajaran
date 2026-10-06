<?php

$file = "data/datapeserta.json";

if (file_exists($file)) {
    $json = file_get_contents($file);
    $data = json_decode($json, true);

    if (!is_array($data)) {
        $data = [];
    }
} else {
    $data = [];
}

// Urutkan data berdasarkan tanggal terbaru
usort($data, function ($a, $b) {
    return strtotime($b['tanggal_buat'] ?? 0)
        - strtotime($a['tanggal_buat'] ?? 0);
});

?>

<div class="card card-outline card-primary shadow">

    <div class="card-header">

        <h3 class="card-title">
            <i class="fas fa-id-card mr-2"></i>
            Data CV Digital Peserta (<?= count($data) ?>)
        </h3>

        <div class="card-tools">

            <a href="index.php?halaman=tambahcv"
               class="btn btn-primary btn-sm">

                <i class="fas fa-plus"></i>
                Tambah CV

            </a>

        </div>

    </div>

    <div class="card-body table-responsive p-0">

        <table class="table table-hover text-nowrap">

            <thead>

                <tr>
                    <th>#</th>
                    <th>Foto</th>
                    <th>Nama Lengkap</th>
                    <th>Sekolah</th>
                    <th>Skill</th>
                    <th>Cita-cita</th>
                    <th>Tanggal Buat</th>
                    <th>Aksi</th>
                </tr>

            </thead>

            <tbody>

                <?php if (empty($data)): ?>

                    <tr>

                        <td colspan="8"
                            class="text-center p-4 text-muted">

                            Belum ada CV.

                            <a href="index.php?halaman=registrasipeserta">
                                Buat dari form peserta
                            </a>

                        </td>

                    </tr>

                <?php else: ?>

                    <?php $no = 1; ?>

                    <?php foreach ($data as $row): ?>

                        <?php

                        $foto = $row['foto'] ?? 'default.png';

                        $path = "assets/image/peserta/" . $foto;

                        if (!file_exists($path)) {
                            $path = "assets/dist/img/avatar.png";
                        }

                        ?>

                        <tr>

                            <td>
                                <?= $no++ ?>
                            </td>

                            <td>

                                <img
                                    src="<?= htmlspecialchars($path) ?>"
                                    class="img-circle"
                                    style="width:38px;height:38px;object-fit:cover;"
                                >

                            </td>

                            <td>

                                <b>
                                    <?= htmlspecialchars($row['nama_lengkap'] ?? '') ?>
                                </b>

                                <br>

                                <small class="text-muted">

                                    <?= htmlspecialchars($row['email'] ?? '') ?>

                                    |

                                    <?= htmlspecialchars($row['no_hp'] ?? '') ?>

                                </small>

                            </td>

                            <td>

                                <?= htmlspecialchars($row['sekolah'] ?? '') ?>

                                <br>

                                <small>
                                    <?= htmlspecialchars($row['jurusan'] ?? '') ?>
                                </small>

                            </td>

                            <td>

                                <?php

                                $skills = $row['skills'] ?? [];

                                if (!is_array($skills)) {
                                    $skills = [$skills];
                                }

                                foreach (array_slice($skills, 0, 3) as $skill):

                                ?>

                                    <span class="badge badge-info">

                                        <?= htmlspecialchars($skill) ?>

                                    </span>

                                <?php endforeach; ?>

                            </td>

                            <td>

                                <?= htmlspecialchars($row['cita_cita'] ?? '') ?>

                            </td>

                            <td>

                                <small>

                                    <?= date(
                                        'd/m/Y H:i',
                                        strtotime($row['tanggal_buat'] ?? 'now')
                                    ) ?>

                                </small>

                            </td>

                            <td>

                                <a
                                    href="index.php?halaman=lihatcv&id=<?= urlencode($row['id'] ?? 0) ?>"
                                    class="btn btn-xs btn-primary"
                                    title="Lihat"
                                >

                                    <i class="fas fa-eye"></i>

                                </a>


                                <a
                                    href="index.php?halaman=editcv&id=<?= urlencode($row['id'] ?? 0) ?>"
                                    class="btn btn-xs btn-warning"
                                    title="Edit"
                                >

                                    <i class="fas fa-edit"></i>

                                </a>


                                <a
                                    href="proses/prosescvdigital.php?aksi=hapus&id=<?= urlencode($row['id'] ?? 0) ?>"
                                    onclick="return confirm('Hapus CV ini? Foto juga akan terhapus!')"
                                    class="btn btn-xs btn-danger"
                                    title="Hapus"
                                >

                                    <i class="fas fa-trash"></i>

                                </a>

                            </td>

                        </tr>

                    <?php endforeach; ?>

                <?php endif; ?>

            </tbody>

        </table>

    </div>

</div>