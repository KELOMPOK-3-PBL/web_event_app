<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign Up</title>
  <!-- Link font Inter dari Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-cover bg-center h-screen font-['Inter']" style="background-image: url('../image/welcome_screen.jpg');">
  <!-- Kontainer utama dengan posisi relatif -->
  <div class="relative flex items-center justify-center h-full">
    
    <!-- Overlay hitam transparan -->
    <div class="absolute inset-0 bg-black opacity-50"></div>
    
    <!-- Kotak form sign up dengan z-index lebih tinggi -->
    <div class="bg-white p-10 rounded-lg shadow-lg w-full max-w-lg relative z-10">
      <h2 class="text-2xl font-bold text-center mb-6">SIGN UP</h2>
      
      <form>
        <!-- Input untuk Username -->
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="username">Username</label>
          <input class="appearance-none w-full py-2 px-3 text-gray-700 leading-tight border rounded-md focus:outline-none" id="username" type="text" placeholder="Username" />
        </div>

        <!-- Input untuk Email -->
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="email">Email</label>
          <input class="appearance-none w-full py-2 px-3 text-gray-700 leading-tight border rounded-md focus:outline-none" id="email" type="email" placeholder="Email" />
        </div>

        <!-- Input untuk Password -->
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="password">Password</label>
          <input class="appearance-none w-full py-2 px-3 text-gray-700 leading-tight border rounded-md focus:outline-none" id="password" type="password" placeholder="Password" />
        </div>

        <!-- Input untuk Confirm Password -->
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="confirm-password">Confirm Password</label>
          <input class="appearance-none w-full py-2 px-3 text-gray-700 leading-tight border rounded-md focus:outline-none" id="confirm-password" type="password" placeholder="Password" />
        </div>

        <!-- Tombol SIGN UP -->
        <div class="mb-4">
          <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-full">SIGN UP</button>
        </div>

        <!-- Link untuk sign in -->
      </form>
    </div>
  </div>
</body>
</html>
