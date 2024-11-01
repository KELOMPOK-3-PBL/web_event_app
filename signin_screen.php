<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign In</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-cover bg-center h-screen font-['Inter']" style="background-image: url('image/welcome_screen.jpg');">
  <div class="relative flex items-center justify-center h-full">
    <div class="absolute inset-0 bg-black opacity-50"></div>
    <div class="bg-white p-10 rounded-lg shadow-lg w-full max-w-lg relative z-10">
      <h2 class="text-2xl font-bold text-center mb-6">SIGN IN</h2>

      <!-- Sign-in form with ID -->
      <form id="signinForm">
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="email">Email</label>
          <div class="flex items-center border rounded-md px-3 py-2">
            <input class="appearance-none w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none" id="email" type="email" placeholder="Email" required />
          </div>
        </div>

        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="password">Password</label>
          <div class="flex items-center border rounded-md px-3 py-2">
            <input class="appearance-none w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none" id="password" type="password" placeholder="Password" required />
          </div>
        </div>

        <div class="mb-4">
          <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-full">SIGN IN</button>
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
  const signInButton = event.submitter; // Button to disable during loading

  signInButton.disabled = true; // Disable button to prevent multiple requests
  signInButton.textContent = 'Signing in...';

  try {
    const response = await fetch('auth.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ email, password })
    });

    const data = await response.json();

    if (data.status === 'success') {
      alert('Login successful!');
      window.location.href = '/superadmin_dashboard.php';
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
;
  </script>
</body>
</html>
