<?php
include "koneksi.php";

if (isset($_GET['id'])) {
  $id = $_GET['id'];

  $query = "SELECT * FROM tbl_buku WHERE id='$id'";
  $result = mysqli_query($conn, $query);

  if (!$result) {
    die("Query Error: " . mysqli_errno($conn) . " - " . mysqli_error($conn));
  }

  $data = mysqli_fetch_assoc($result);

  if (!count($data)) {
    echo "<script>alert('Data tidak ditemukan pada database');window.location='index.php';</script>";
  }
} else {
  echo "<script>alert('Masukkan ID.');window.location='index.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Edit Buku</title>
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

    body {
      font-family: 'Poppins', sans-serif;
    }
  </style>
</head>
<body>
  <div class="flex min-h-screen items-center justify-center bg-gradient-to-br from-purple-200 via-purple-300 to-purple-500 pt-24">
    <div class="bg-purple-200 text-black p-8 rounded-lg shadow-md w-full max-w-lg">
        <button>
            <a href="crud.php">
      <h2 class="text-2xl font-bold mb-6 text-3xl"><i class='bx bxs-chevron-left-circle' ></i> Edit Buku</h2>
      </a>
      </button>
      <form action="proses_edit.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $data['id']; ?>">

        <div class="mb-4 ">
          <label for="judul" class="block text-sm font-medium text-gray-700">Judul</label>
          <input type="text" name="judul" id="judul" value="<?php echo $data['judul']; ?>" class="mt-1 p-2 w-full border rounded-md">
        </div>

        <div class="mb-4">
          <label for="pengarang" class="block text-sm font-medium text-gray-700">Pengarang</label>
          <input type="text" name="pengarang" id="pengarang" value="<?php echo $data['pengarang']; ?>" class="mt-1 p-2 w-full border rounded-md">
        </div>

        <div class="mb-4">
          <label for="tahun_terbit" class="block text-sm font-medium text-gray-700">Tahun Terbit</label>
          <input type="text" name="tahun_terbit" id="tahun_terbit" value="<?php echo $data['tahun_terbit']; ?>" class="mt-1 p-2 w-full border rounded-md">
        </div>

        <div class="mb-4">
          <label for="foto" class="block text-sm font-medium text-gray-700">Foto</label>
          <input type="file" name="foto" id="foto" class="mt-1 p-2 w-full border rounded-md">
          <img src="<?php echo $data['foto']; ?>" alt="Current Photo" class="h-20 mt-2">
        </div>

        <div class="flex justify-end">
          <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md">Update</button>
        </div>
      </form>
    </div>
  </div>
</body>
</html>
