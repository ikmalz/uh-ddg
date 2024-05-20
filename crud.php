<?php
include "koneksi.php";



?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Document</title>
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

    body {
      font-family: 'Poppins', sans-serif;
      overflow: hidden;
      /* Menonaktifkan scrolling */
    }
  </style>
</head>

<body>
  <header class="bg-white dark:bg-gray-900 fixed w-full z-20 top-0 start-0 border-b border-gray-200 dark:border-gray-600">
    <div class="mx-auto max-w-screen-xl px-4 sm:px-6 lg:px-8">
      <div class="flex h-16 items-center justify-between">
        <div class="flex-1 md:flex md:items-center md:gap-12">
          <a class="block text-teal-600" href="#">
            <span class="sr-only">Home</span>
            <svg class="h-8" viewBox="0 0 28 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <!-- Masukkan kembali SVG Path untuk logo di sini -->
            </svg>
          </a>
          <span class="self-center text-2xl font-semibold whitespace-nowrap text-slate-300 cursor-pointer">Crid</i></span> <!-- Teks disamping logo -->
        </div>

        <div class="flex-1 md:flex md:items-center md:gap-12 justify-center">
          <nav aria-label="Global">
            <ul class="flex items-center gap-6 text-sm">
              <li>
                <a class="text-gray-500 transition hover:text-gray-500/75" href="index.php"> Home </a>
              </li>

              <li>
                <a class="text-gray-500 transition hover:text-gray-500/75" href="#"> Judul </a>
              </li>
            </ul>
          </nav>
        </div>

        <div class="flex-1 md:flex md:items-center md:gap-12 justify-end">
          <div class="flex items-center gap-4">
            <div class="sm:flex sm:gap-4">
              <a class="rounded-md bg-teal-600 px-5 py-2.5 text-sm font-medium text-white shadow dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" href="#">
                Login
              </a>

              <div class="hidden sm:flex">
                <a class="rounded-md bg-gray-100 px-5 py-2.5 text-sm font-medium text-teal-600" href="C:\xampp\htdocs\uh-ddg\signin.html">
                  Register
                </a>
              </div>
            </div>

            <div class="block md:hidden">
              <button class="rounded bg-gray-100 p-2 text-gray-600 transition hover:text-gray-600/75">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Table section -->
  <div class='flex min-h-screen items-center justify-center bg-gradient-to-br from-purple-200 via-purple-300 to-purple-500 pt-24'>
    <div class="flex flex-col items-center justify-center min-h-[450px] w-full max-w-7xl px-4 sm:px-6 lg:px-8 mt-[-420px]">

      <!-- Add icon above the table -->

      <?php
      if (isset($_GET['pesan'])) {
        $pesan = $_GET['pesan'];
        if ($pesan == "input") {
          echo "<p class='text-white mb-4'>Data berhasil di input.</p>";
        } else if ($pesan == "update") {
          echo "<p class='text-white mb-4'>Data berhasil di update.</p>";
        } else if ($pesan == "hapus") {
          echo "<p class='text-white mb-4'>Data berhasil di hapus.</p>";
        }
      }
      ?>

      <div class="flex justify-between w-full mb-4 items-center">
        <a href="tambah.php">
          <i class='bx bx-plus-circle text-4xl text-white cursor-pointer'></i>
        </a>
      </div>
      <div class="overflow-x-auto relative shadow-md sm:rounded-lg w-full">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 table-auto">
          <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
              <th class="py-3 px-6">No</th>
              <th scope="col" class="py-3 px-6 flex items-center">
                <i class='bx bx-plus-circle text-xl text-gray-700 cursor-pointer mr-2'></i>
                Foto
              </th>
              <th scope="col" class="py-3 px-6">Judul</th>
              <th scope="col" class="py-3 px-6">Pengarang</th>
              <th scope="col" class="py-3 px-6">Tahun</th>
              <th scope="col" class="py-3 px-6">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $sql = "SELECT * FROM tbl_buku ORDER BY id ASC";
            $result = mysqli_query($conn, $sql);

            if (!$result) {
              die("Query Error : " . mysqli_errno($conn) . " - " . mysqli_error($conn));
            }
            $no = 1;
            while ($row = mysqli_fetch_assoc($result)) {
            ?>
              <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <td class="py-4 px-6"><?php echo $no; ?></td>
                <td class="py-4 px-6"><img src="<?php echo $row['foto']; ?>" alt="" class="h-10"></td>
                <td class="py-4 px-6"><?php echo $row['judul']; ?> </td>
                <td class="py-4 px-6"><?php echo $row['pengarang']; ?> </td>
                <td class="py-4 px-6"><?php echo $row['tahun_terbit']; ?></td>
                <td class="py-4 px-6">
                <td class="py-4 px-6">
                <td class="py-4 px-6">
                  <a href="proses_data.php?id=<?php echo $row['id']; ?>" class="text-red-600 dark:text-red-400">
                    <i class='bx bx-trash' title="Hapus"></i>
                  </a>
                </td>

                </td>

                </td>
              </tr>
            <?php
              $no++;
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="text-sm text-white font-semibold py-10 text-center -mt-20">
    Selamat datang di <a href="#" class="text-white hover:text-gray-800" target="_blank"> Aplikasi</a> Pengeluaran <a href="#" class="text-blueGray-500 hover:text-blueGray-800" target="_blank">buku</a>.
  </div>
</body>

</html>