<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Keuangan</title>

    <!-- Memanggil Icon Font Awesome -->
    <script src="https://kit.fontawesome.com/62c979b04d.js" crossorigin="anonymous"></script>

    <!-- Memanggil file CSS Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <!-- Memanggil file CSS DataTables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.11.3/datatables.min.css" />
</head>

<body>
    <?php
    // Koneksi ke database
    include "connection.php";

    $act = (isset($_REQUEST['act'])) ? $_REQUEST['act'] : '';
    $id = (isset($_REQUEST['id'])) ? $_REQUEST['id'] : '';
    $alert = (isset($_SESSION['notif'])) ? $_SESSION['notif'] : '';

    if ($act == 'delete') {
        $delete = mysqli_query($koneksi, "DELETE FROM crud WHERE id='$id'");

        if ($delete) {
            $_SESSION['notif'] = 'success';
            $_SESSION['pesan'] = 'Berhasil Hapus Data Pembayaran';
            header("location: report.php");
            exit();
        } else {
            print_r("Error");
        }
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
                    <li class="nav-item ">
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
        <h3>Report Pembayaran</h3>
        <!-- Membuat tabel untuk menampilkan data Pembayaran -->
        <table id="table_id" class="table table-bordered table-striped table-responsive text-nowrap" width="100%">
            <thead>
                <tr>
                    <th style="width:30px !important">No</th>
                    <th style="width:100px !important">NIM</th>
                    <th>Nama Mahasiswa</th>
                    <th>No Handphone</th>
                    <th>Jenis Keuangan</th>
                    <th>Jumlah</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Loop untuk menampilkan data Pembayaran pada tabel
                $no = 1;
                while ($row = mysqli_fetch_array($result)) {
                ?>
                    <tr>
                        <td><?= $no ?></td>
                        <td><?= $row['nim'] ?></td>
                        <td><?= $row['nama_mahasiswa'] ?></td>
                        <td><?= $row['nohp'] ?></td>
                        <td><?= $row['jenis_keuangan'] ?></td>
                        <td><?= $row['jumlah'] ?></td>
                        <td><?= $row['keterangan'] ?></td>
                        <td align="center">
                            <a href="index.php?act=edit&id=<?= $row['id'] ?>" style="text-decoration:none">
                                <button class="btn btn-warning btn-sm" type="button"><i class="fa-solid fa-pen-to-square"></i> Edit</button>
                            </a>
                            <a href="report.php?act=delete&id=<?= $row['id'] ?>" onclick="return confirm('Yakin Hapus Data?')">
                                <button class="btn btn-danger btn-sm" type="button"><i class="fa-solid fa-trash-can"></i> Hapus</button>
                            </a>
                        </td>
                    </tr>
                <?php
                    $no++;
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Memanggil file JavaScript Bootstrap 5 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

    <!-- Memanggil file JavaScript jQuery -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Memanggil file JavaScript DataTables -->
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.3/datatables.min.js"></script>
</body>
<!-- Script untuk inisialisasi DataTables -->
<script type="text/javascript">
    $(document).ready(function() {
        $("#table_id").DataTable({
            "scrollX": true,
        });
    });
</script>

<?php
// Menutup koneksi database
mysqli_close($koneksi);
?>

</html>