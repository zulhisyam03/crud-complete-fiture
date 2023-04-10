<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keuangan Kampus</title>
    <!-- Memanggil file CSS Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>

    <?php
    include "connection.php";

    $act = (isset($_REQUEST['act'])) ? $_REQUEST['act'] : '';
    $id = (isset($_REQUEST['id'])) ? $_REQUEST['id'] : '';
    $alert = (isset($_SESSION['notif'])) ? $_SESSION['notif'] : '';

    switch ($act) {
        case 'edit':
            // Kode Form Edit
            # code...
            $q = mysqli_query($koneksi, "SELECT * FROM crud WHERE id='$id'");
            $d = mysqli_fetch_assoc($q);
            // End Kode Form Edit
            break;
        case 'save':
            // Kode Tambah Data
            # code...

            $nim = $_POST['nim'];
            $nama = $_POST['nama'];
            $nohp = $_POST['nohp'];
            $jenis_keuangan = $_POST['jenis_keuangan'];
            $jumlah = $_POST['jumlah'];
            $keterangan = $_POST['keterangan'];

            $insert = mysqli_query($koneksi, "INSERT INTO crud (nim, nama_mahasiswa, nohp, jenis_keuangan, jumlah, keterangan) VALUES
            ('$nim', '$nama', '$nohp', '$jenis_keuangan', '$jumlah', '$keterangan')");

            if ($insert) {
                $_SESSION['notif'] = 'success';
                $_SESSION['pesan'] = 'Berhasil Tambah Data Pembayaran';
                header("location: index.php");
                exit();
            } else {
                print_r("Error");
            }
            // End Kode Tambah Data
            break;
        case 'saveEdit':
            // Kode Edit Save
            $nim = $_POST['nim'];
            $nama = $_POST['nama'];
            $nohp = $_POST['nohp'];
            $jenis_keuangan = $_POST['jenis_keuangan'];
            $jumlah = $_POST['jumlah'];
            $keterangan = $_POST['keterangan'];

            $update = mysqli_query($koneksi, "UPDATE crud SET nim='$nim', nama_mahasiswa='$nama', nohp='$nohp', jenis_keuangan='$jenis_keuangan', nohp='$nohp', jumlah='$jumlah', keterangan='$keterangan' WHERE id='$id'");
            if ($update) {
                $_SESSION['notif'] = 'success';
                $_SESSION['pesan'] = 'Berhasil Ubah Data Pembayaran';
                header("location: index.php");
                exit();
            } else {
                print_r("Error");
            }
            // End Kode Edit Save
            break;

        default:
            # code...
            break;
    }

    ?>

    <!-- Membuat Navbar -->
    <nav class="navbar navbar-expand-lg navbar-primary bg-primary">
        <div class="container-fluid">
            <!-- Menambahkan Judul Navbar -->
            <a class="navbar-brand text-light" href="#">Sistem Keuangan Kampus</a>
            <!-- Menambahkan Tombol Toggle Navbar -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <!-- Menambahkan Menu Home -->
                    <li class="nav-item">
                        <a class="nav-link text-light" href="index.php">Home</a>
                    </li>
                    <!-- Menambahkan Menu Report -->
                    <li class="nav-item">
                        <a class="nav-link text-light" href="report.php">Report</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-3">
        <?php
        if ($alert == 'success') {
        ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Sukses!</strong> <?= $_SESSION['pesan'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php
            unset($_SESSION['notif']);
            unset($_SESSION['pesan']);
        }
        ?>
        <h3><?= ($act == 'edit') ? 'Edit' : 'Input' ?> Data Keuangan</h3>
        <form action="index.php?<?= ($act == 'edit') ? 'act=saveEdit&id=' . $id . '' : 'act=save' ?>" method="POST">
            <!-- Input Skema -->
            <div class="form-group mb-3">
                <label for="input-nim">NIM</label>
                <input type="text" class="form-control" name='nim' id="input-nim" placeholder="Masukkan NIM" value="<?= @$d['nim'] ?>" required>
            </div>
            <div class="form-group mb-3">
                <label for="input-nama">Nama Mahasiswa</label>
                <input type="text" class="form-control" name='nama' id="input-nama" placeholder="Masukkan Nama" value="<?= @$d['nama_mahasiswa'] ?>" required>
            </div>
            <div class="form-group mb-3">
                <label for="input-jenis">Jenis Keuangan</label>
                <select class="form-select" name='jenis_keuangan' id="input-jenis" required>
                    <option selected disabled>Pilih jenis keuangan</option>
                    <option value="Pembayaran SPP" <?= (@$d['jenis_keuangan'] == 'Pembayaran SPP') ? 'selected' : '' ?>>Pembayaran SPP</option>
                    <option value="Pembayaran Kuliah" <?= (@$d['jenis_keuangan'] == 'Pembayaran Kuliah') ? 'selected' : '' ?>>Pembayaran Kuliah</option>
                    <option value="Pembayaran Lainnya" <?= (@$d['jenis_keuangan'] == 'Pembayaran Lainnya') ? 'selected' : '' ?>>Pembayaran Lainnya</option>
                </select>
            </div>
            <div class="form-group mb-3">
                <label for="input-nama">No. Handphone</label>
                <input type="text" class="form-control" name='nohp' id="nohp" placeholder="Masukkan No Handphone" value="<?= @$d['nohp'] ?>" required>
            </div>
            <div class="form-group mb-3">
                <label for="input-jumlah">Jumlah</label>
                <input type="text" class="form-control" name="jumlah" id="input-jumlah" placeholder="Masukkan Jumlah" min="0" step="1" value="<?= @$d['jumlah'] ?>" required>
            </div>
            <div class=" form-group mb-3">
                <label for="input-keterangan">Keterangan</label>
                <textarea class="form-control" name="keterangan" id="input-keterangan" rows="3" placeholder="Masukkan Keterangan"><?= @$d['keterangan'] ?></textarea>
            </div>
            <!-- Tombol Submit -->
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <!-- Memanggil file JavaScript Bootstrap 5 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

    <!-- JS untuk format nominal numeric -->
    <script>
        const inputJumlah = document.getElementById('input-jumlah');

        inputJumlah.addEventListener('input', function(e) {
            // Hapus semua karakter selain angka
            let nominal = this.value.replace(/\D/g, '');
            if (nominal) {
                // Tambahkan separator ribuan
                nominal = parseInt(nominal, 10).toLocaleString('id-ID');

                // Update nilai input Jumlah
                this.value = nominal;
            } else {
                this.value = '';
            }

        });
    </script>
</body>

</html>