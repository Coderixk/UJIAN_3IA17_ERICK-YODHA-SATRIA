<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
        integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <style>
        body {
            background: url('https://media.suara.com/pictures/970x544/2021/09/17/60549-universitas-gunadarma.jpg') no-repeat center center fixed;
            background-size: cover;
            color: #212529;
        }

        h4 {
            color: #008bff;
        }

        table {
            background-color: #ffffff;
        }

        .table-primary th,
        .table-primary td {
            background-color: #007bff;
            color: #ffffff;
        }

        
    </style>
    
</head>

<body>
    <nav class="navbar navbar-dark bg-dark">
        <span class="navbar-brand mb-0 h1">UJIAN PWEB ERICK</span>
    </nav>
    <div class="container">
        <br>
        <h4><center>DAFTAR PERTUKARAN MAHASISWA</center></h4>
        <?php
        include "koneksi.php";

        if (isset($_GET['id_mahasiswa'])) {
            $id_mahasiswa = htmlspecialchars($_GET["id_mahasiswa"]);

            $sql = "delete from mahasiswa where id_mahasiswa='$id_mahasiswa' ";
            $hasil = mysqli_query($kon, $sql);

            if ($hasil) {
                header("Location:index.php");
            } else {
                echo "<div class='alert alert-danger'> Data Gagal dihapus.</div>";
            }
        }
        ?>

        <table class="my-3 table table-bordered">
            <thead>
                <tr class="table-primary">
                    <th>No</th>
                    <th>Nama</th>
                    <th>Universitas</th>
                    <th>Jurusan</th>
                    <th>No Hp</th>
                    <th>Email</th>
                    <th colspan='2'>Tindakan</th>
                </tr>
            </thead>

            <?php
            $sql = "select * from mahasiswa order by id_mahasiswa desc";
            $hasil = mysqli_query($kon, $sql);
            $no = 0;
            while ($data = mysqli_fetch_array($hasil)) {
                $no++;
            ?>
                <tbody>
                    <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $data["nama"]; ?></td>
                        <td><?php echo $data["universitas"];   ?></td>
                        <td><?php echo $data["jurusan"];   ?></td>
                        <td><?php echo $data["no_hp"];   ?></td>
                        <td><?php echo $data["email"];   ?></td>
                        <td>
                            <a href="update.php?id_mahasiswa=<?php echo htmlspecialchars($data['id_mahasiswa']); ?>"
                                class="btn btn-warning" role="button">Update</a>
                            <a href="index.php?id_mahasiswa=<?php echo $data['id_mahasiswa']; ?>"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');"
                                class="btn btn-danger" role="button">Delete</a>
                        </td>
                    </tr>
                </tbody>
            <?php
            }
            ?>
        </table>
        <a href="create.php" class="btn btn-success" role="button">Tambah Data</a>
    </div>
</body>

</html>
