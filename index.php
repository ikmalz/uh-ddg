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
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

    body {
      font-family: 'Poppins', sans-serif;
    }
  </style>
</head>

<body>

  <nav class="bg-white dark:bg-gray-900 fixed w-full z-20 top-0 start-0 border-b border-gray-200 dark:border-gray-600">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
      <a href="https://flowbite.com/" class="flex items-center space-x-3 rtl:space-x-reverse">
        <!-- Ganti "#" dengan link ke halaman utama jika diperlukan -->
        <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Pengelolaan Buku</span>
      </a>
      <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
        <button data-collapse-toggle="navbar-sticky" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-sticky" aria-expanded="false">
          <span class="sr-only">Open main menu</span>
          <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15" />
          </svg>
        </button>
      </div>
      <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
        <ul class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
          <li>
            <!-- Ganti "#" dengan link ke halaman utama jika diperlukan -->
            <a href="#" class="block py-2 px-3 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 md:dark:text-blue-500" aria-current="page">Home</a>
          </li>
          <li>
            <!-- Ganti "#" dengan link ke halaman "Crud.php" jika diperlukan -->
            <a href="crud.php" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Crud</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- Buku -->
  <div class="flex justify-start mt-40 ml-10 max-w-md">
    <?php
    $sql = "SELECT * FROM tbl_buku ORDER BY id ASC";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
      die("Query Error : " . mysqli_errno($conn) . " - " . mysqli_error($conn));
    }

    while ($row = mysqli_fetch_assoc($result)) {
    ?>
      <div class="max-w-md mx-4 mb-8 w-full">
    <div class="relative">
        <div class="h-72 mb-4">
            <img src="<?php echo $row['foto']; ?>" alt="" class="absolute inset-0 w-full h-full object-cover opacity-100" />
        </div>
        <div class="absolute bottom-0 left-0 right-0 bg-white p-4">
            <p class="text-sm text-gray-600"><?php echo $row['tanggal_update']; ?></p>
        </div>
    </div>
  </div>
  </div>



<?php
    }
?>
</div>


<!-- end buku -->

</body>

</html>