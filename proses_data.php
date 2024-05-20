<?php
// Include database connection
include "koneksi.php";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escape input untuk menghindari SQL Injection
    $judul = mysqli_real_escape_string($conn, $_POST['brand']);
    $tahun = mysqli_real_escape_string($conn, $_POST['price']);
    $pengarang = mysqli_real_escape_string($conn, $_POST['pengarang']);

    // Tentukan direktori target dan nama file target
    $target_dir = "gambar/";
    $target_file = $target_dir . basename($_FILES["file"]["name"]);
    $uploadOk = 1;

    // Periksa ukuran file
    if ($_FILES["file"]["size"] > 5000000) { // Ubah ukuran file sesuai kebutuhan Anda (dalam byte)
        echo "Maaf, file terlalu besar.";
        $uploadOk = 0;
    }

    // Periksa ekstensi file
    $allowed_extensions = array("jpg", "jpeg", "png", "gif");
    $file_extension = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    if (!in_array($file_extension, $allowed_extensions)) {
        echo "Maaf, hanya file JPG, JPEG, PNG, dan GIF yang diizinkan.";
        $uploadOk = 0;
    }

    // Cek apakah uploadOk masih bernilai 1 (tidak ada masalah)
    if ($uploadOk == 0) {
        echo "Maaf, file Anda tidak dapat diunggah.";
    } else {
        // Periksa apakah data sudah ada di database sebelum menyimpan
        $check_sql = "SELECT * FROM tbl_buku WHERE judul = '$judul' AND pengarang = '$pengarang' AND tahun_terbit = '$tahun'";
        $result = mysqli_query($conn, $check_sql);
        if (mysqli_num_rows($result) > 100) {
            echo "Maaf, data yang sama sudah ada dalam database.";
        } else {
            // Pindahkan file ke direktori target
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
                // Jika tidak ada data yang sama, masukkan data ke database
                $sql = "INSERT INTO tbl_buku (foto, judul, pengarang, tahun_terbit) VALUES ('$target_file', '$judul', '$pengarang', '$tahun')";
                if (mysqli_query($conn, $sql)) {
                    $pesan = "input";
                    header("Location: crud.php?pesan=" . $pesan);
                    exit();
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
            } else {
                echo "Maaf, terjadi kesalahan saat mengunggah file Anda.";
            }
        }
    }
}

// Handle record deletion
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    $sql = "DELETE FROM tbl_buku WHERE id = '$id'";

    if (mysqli_query($conn, $sql)) {
        header("Location: crud.php");
        exit();
    } else {
        echo "Error deleting record:" . mysqli_error($conn);
    }
} else {
    echo "ID parameter is missing";
}

// Close database connection
mysqli_close($conn);
?>
