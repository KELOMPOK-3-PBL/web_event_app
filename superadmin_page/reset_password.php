<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reset Password</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-cover bg-center h-screen font-['Inter']" style="background-image: url('../image/welcome_screen.jpg');">
  <div class="relative flex items-center justify-center h-full">
    <div class="absolute inset-0 bg-black opacity-50"></div>
    
    <div class="bg-white p-10 rounded-lg shadow-lg w-full max-w-lg relative z-10">
      <h2 class="text-2xl font-bold text-center mb-6">Reset Password</h2>
      <p class="text-sm text-gray-600 text-center mb-6">Enter your email address to reset password.</p>

      <form id="forgotPasswordForm">
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="email">Email</label>
          <div class="flex items-center border rounded-md px-3 py-2">
            <svg class="w-5 h-5 text-gray-500 mr-2" fill="currentColor" viewBox="0 0 24 24">
              <path d="M21 8v10c0 1.1-.9 2-2 2H5c-1.1 0-2-.9-2-2V8c0-1.1.9-2 2-2h14c1.1 0 2 .9 2 2zM5 8l7 5 7-5H5zm0 10V9.12l7 4.88 7-4.88V18H5z" />
            </svg>
            <input class="appearance-none w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none" id="email" type="email" placeholder="Email" />
          </div>
        </div>

        <div class="justify-center mb-4 flex space-x-1.5">
          <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-full sm:w-auto" type="submit">Reset Password</button>
          <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded w-full sm:w-auto" type="button" id="backButton">Back</button>
        </div>
      </form>
    </div>
  </div>

  <script>
  // Menambahkan event listener ke tombol "Back"
  document.getElementById('backButton').addEventListener('click', () => {
    window.history.back();
  });

  document.getElementById('forgotPasswordForm').addEventListener('submit', async (event) => {
    event.preventDefault();
    const email = document.getElementById('email').value;
    const submitButton = event.submitter;

    submitButton.disabled = true; // Disable button to prevent multiple requests
    submitButton.textContent = 'Sending...';

    try {
      const response = await fetch('http://localhost/pbl/api-03/routes/auth.php?action=forgotPassword', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ email })
      });

      const data = await response.json();

      if (data.status === 'success') {
        alert('Reset password telah berhasil');
      } else {
        displayError(data.message || 'Failed to send reset link.');
      }
    } catch (error) {
      console.error('Error:', error);
      displayError('An error occurred. Please try again later.');
    } finally {
      submitButton.disabled = false;
      submitButton.textContent = 'RESET PASSWORD';
    }
  });

  function displayError(message) {
    const errorContainer = document.querySelector('#forgotPasswordForm .text-red-500');
    if (errorContainer) {
      errorContainer.textContent = message;
    } else {
      const newError = document.createElement('div');
      newError.className = 'text-red-500 text-sm mb-4';
      newError.textContent = message;
      const form = document.getElementById('forgotPasswordForm');
      form.insertBefore(newError, form.firstChild);
    }
  }
  </script>
</body>
</html>
