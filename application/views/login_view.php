<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <title><?php echo $title_web; ?></title>
  <link rel="stylesheet" href="<?php echo base_url('assets_style/assets/dist/css/login.css'); ?>">
</head>
<style>
  .SMPN2 {
    background: linear-gradient(to left, red, yellow,
        green, blue, indigo,
        orange, violet);
    color: transparent;
    background-clip: text;
    font-size: 2.5rem;
    font-weight: 700;
    animation: animated 7s linear infinite;
  }

  @keyframes animated {
    to {
      background-position-x: 1000px;
    }
  }

  .wrapper {
    background: linear-gradient(to left, #0f0c29, #302b63, #24243e);
    border-radius: 8px;
    box-shadow: 0 0 10px black;
    width: 90%;
    max-width: 400px;
  }
</style>

<body class="bg-cover bg-no-repeat"
  style="background-image: url('<?php echo base_url('assets_style/image/solear.jpg'); ?>');">
  <div class="flex justify-center items-center h-screen">
    <div class="wrapper rounded-lg shadow-lg p-10 w-full max-w-md">
      <h4 class="mb-5 text-center text-xl font-bold SMPN2">PERPUSTAKAAN SMP NEGERI 2 SOLEAR</h4>
      <div class="flex justify-center mb-6">
        <img src="<?php echo base_url('assets_style/image/SMPN2.png'); ?>" alt="logo" class="w-24"
          style="background-color: transparent;"> <!-- Ukuran logo diubah menjadi w-24 -->
      </div>
      <!-- <h3 class="mb-10 text-center text-4xl font-bold text-white">Login</h3> -->
      <form action="<?= base_url('login/auth'); ?>" method="POST">
        <div class="input-box mb-6">
          <input type="text" name="user" id="user" required autocomplete="off"
            class="w-full p-3 rounded border border-white bg-white text-black placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-300"
            placeholder="Username">
        </div>
        <div class="input-box mb-6">
          <input type="password" name="pass" id="pass" required autocomplete="off"
            class="w-full p-3 rounded border border-white bg-white text-black placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-300"
            placeholder="Password">
        </div>
        <button type="submit"
          class="w-full py-2 bg-white text-gray-800 font-bold rounded hover:bg-gray-200 transition duration-200">Sign
          In</button>
      </form>
      <footer class="mt-5 text-center text-white">
        <p>Copyright &copy; AdamStore - <?php echo date("Y"); ?></p>
      </footer>
    </div>
  </div>
</body>

</html>