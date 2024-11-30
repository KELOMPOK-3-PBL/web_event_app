<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign In</title>
  <!-- Link font Inter dari Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-cover bg-center h-screen font-['Inter']" style="background-image: url('image/welcome_screen.jpg');">
  <!-- Kontainer utama dengan posisi relatif untuk memastikan overlay ditempatkan dengan benar -->
  <div class="relative flex items-center justify-center h-full">
    
    <!-- Overlay hitam transparan untuk membuat background lebih gelap -->
    <div class="absolute inset-0 bg-black opacity-50"></div>
    
    <!-- Kotak form sign in dengan z-index lebih tinggi agar tampil di depan overlay -->
    <div class="bg-white p-10 rounded-lg shadow-lg w-full max-w-lg relative z-10">
      <h2 class="text-2xl font-bold text-center mb-6">SIGN IN</h2>
      
      <!-- Tambahkan ID "signinForm" di sini -->
      <form id="signinForm">
        <!-- Input untuk Email -->
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="email">Email</label>
          <div class="flex items-center border rounded-md px-3 py-2">
            <!-- Icon email -->
            <svg class="w-5 h-5 text-gray-500 mr-2" fill="currentColor" viewBox="0 0 24 24">
              <path d="M21 8v10c0 1.1-.9 2-2 2H5c-1.1 0-2-.9-2-2V8c0-1.1.9-2 2-2h14c1.1 0 2 .9 2 2zM5 8l7 5 7-5H5zm0 10V9.12l7 4.88 7-4.88V18H5z" />
            </svg>
            <input class="appearance-none w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none" id="email" type="email" placeholder="Email" />
          </div>
        </div>

        <!-- Input untuk Password -->
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="password">Password</label>
          <div class="flex items-center border rounded-md px-3 py-2">
            <!-- Icon password -->
            <svg class="w-5 h-5 text-gray-500 mr-2" fill="currentColor" viewBox="0 0 24 24">
              <path d="M12 2C9.79 2 8 3.79 8 6c0 1.85 1.28 3.41 3 3.86V10H7v10h10V10h-4V9.86c1.72-.45 3-2.01 3-3.86 0-2.21-1.79-4-4-4zm0 7c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2z" />
            </svg>
            <input class="appearance-none w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none" id="password" type="password" placeholder="Password" />
          </div>
        </div>

        <!-- Checkbox untuk "Remember me" -->
        <div class="flex items-center justify-between mb-4">
          <label class="flex items-center">
            <input class="mr-2 leading-tight" type="checkbox" />
            <span class="text-sm">Remember me</span>
          </label>
        </div>

        <!-- Tombol SIGN IN -->
        <div class="mb-4">
          <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-full" type="submit">SIGN IN</button>
        </div>
      </form>
    </div>
  </div>

  <!-- JavaScript for form submission -->
  <script>
    document.getElementById('signinForm').addEventListener('submit', async (event) => {
      event.preventDefault();
      const email = document.getElementById('email').value;
      const password = document.getElementById('password').value;
      const signInButton = event.submitter;

      signInButton.disabled = true; // Disable button to prevent multiple requests
      signInButton.textContent = 'Signing in...';

      try {
        const response = await fetch('http://localhost/web_event_app/api-03/routes/auth.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({ email, password })
        });

        const data = await response.json();

        if (data.status === 'success') {
          alert('Login successful!');
          window.location.href = 'http://localhost/web_event_app/web_event_app/superadmin_page/superadmin_dashboard.php';
        } else {
          displayError(data.message); // Inline error display
        }
      } catch (error) {
        console.error('Error:', error);
        displayError('Login failed. Please try again.');
      } finally {
        signInButton.disabled = false;
        signInButton.textContent = 'SIGN IN';
      }
    });

    function displayError(message) {
      const errorContainer = document.createElement('div');
      errorContainer.className = 'text-red-500 text-sm mb-4';
      errorContainer.textContent = message;
      const form = document.getElementById('signinForm');
      form.insertBefore(errorContainer, form.firstChild);
    }
  </script>
</body>
</html>
