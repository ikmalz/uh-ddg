<?php
include "koneksi.php";

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $judul = $_POST['judul'];
    $pengarang = $_POST['pengarang'];
    $tahun_terbit = $_POST['tahun_terbit'];

    // Proses upload file jika ada file yang diupload
    if ($_FILES['foto']['name'] != "") {
        $foto = $_FILES['foto']['name'];
        $tmp = $_FILES['foto']['tmp_name'];
        $path = "images/" . $foto;

        // Upload file dan cek keberhasilan upload
        if (move_uploaded_file($tmp, $path)) {
            // Ambil data lama untuk menghapus file yang lama jika ada file baru diupload
            $query = "SELECT * FROM tbl_buku WHERE id='$id'";
            $result = mysqli_query($conn, $query);
            $data = mysqli_fetch_assoc($result);

            // Hapus file lama jika ada
            if (is_file("images/" . $data['foto'])) {
                unlink("images/" . $data['foto']);
            }

            // Update data buku dengan file foto baru
            $query = "UPDATE tbl_buku SET judul='$judul', pengarang='$pengarang', tahun_terbit='$tahun_terbit', foto='$foto' WHERE id='$id'";
        }
    } else {
        // Update data buku tanpa mengubah file foto
        $query = "UPDATE tbl_buku SET judul='$judul', pengarang='$pengarang', tahun_terbit='$tahun_terbit' WHERE id='$id'";
    }

    // Eksekusi query update
    $result = mysqli_query($conn, $query);

    // Cek keberhasilan update
    if (!$result) {
        die("Query Error: " . mysqli_errno($conn) . " - " . mysqli_error($conn));
    } else {
        echo "<script>alert('Data berhasil diupdate.');window.location='crud.php';</script>";
    }
} else {
    echo "<script>alert('ID tidak ditemukan.');window.location='crud.php';</script>";
}
?>
