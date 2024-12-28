<script>
    // Fungsi untuk memeriksa apakah pengguna sudah login
    function checkLoginStatus() {
        const token = localStorage.getItem('jwt'); // Ambil token dari localStorage

        if (!token) {
            // Jika token tidak ada, arahkan ke halaman sign-in
            window.location.href = '../signin_screen.php'; // Ubah sesuai dengan lokasi halaman sign-in
        } else {
            // Jika token ada, lakukan verifikasi lebih lanjut jika diperlukan
            const decoded = parseJwt(token); // Dekode JWT untuk verifikasi lebih lanjut
            if (!decoded || new Date(decoded.exp * 1000) < new Date()) {
                // Jika token kadaluarsa atau invalid, arahkan kembali ke login
                localStorage.removeItem('jwt'); // Hapus token yang tidak valid
                window.location.href = 'signin_screen.php'; // Arahkan ke halaman login
            }
        }
    }

    // Fungsi untuk mendekode JWT (seperti yang ada sebelumnya)
    function parseJwt(token) {
        try {
            const base64Url = token.split('.')[1];
            const base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
            const jsonPayload = decodeURIComponent(atob(base64).split('').map(function(c) {
                return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
            }).join(''));

            return JSON.parse(jsonPayload);
        } catch (error) {
            console.error("Error decoding token:", error);
            return null;
        }
    }

    // Panggil fungsi checkLoginStatus() di awal skrip
    checkLoginStatus();
</script>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create User (Batch)</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-cover bg-center h-screen font-['Inter']" style="background-image: url('../image/welcome_screen.jpg');">
  <div class="relative flex items-center justify-center h-full">
    <div class="absolute inset-0 bg-black opacity-50"></div>
    
    <div class="bg-white p-10 rounded-lg shadow-lg w-full max-w-lg relative z-10">
      <h2 class="text-2xl font-bold text-center mb-6">Create User</h2>
      <p class="text-sm text-gray-600 text-center">Silahkan upload spreadsheet sesuai dengan format yang sudah ditentukan</p>
      <div class="text-center">
        <a href="https://docs.google.com/spreadsheets/d/1UVAG-4QWw4ledvJbvQQCxflLIkc8nAUd/edit?usp=sharing&ouid=102890395760790999253&rtpof=true&sd=true" class="text-sm text-blue-600">Atau bisa cek di sini</a>
      </div>

      <form id="uploadFileForm">
        <div class="mb-4">
          <div>
            <label for="file">Upload File:</label>
            <input type="file" id="file" name="file" accept=".xlsx,.xls" required class="border rounded px-4 py-2 w-full">
          </div>
          <div class="justify-center mb-4 flex space-x-1.5">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-full sm:w-auto" type="submit">Upload</button>
            <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded w-full sm:w-auto" type="button" id="backButton">Back</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</body>
<script>
  // Menambahkan event listener ke tombol "Back"
  document.getElementById('backButton').addEventListener('click', () => {
    window.history.back();
  });

  // Handle file upload form submission
  document.getElementById('uploadFileForm').addEventListener('submit', async (event) => {
    event.preventDefault();

    const formData = new FormData(event.target);
    const token = localStorage.getItem('jwt');

    try {
        const response = await fetch('http://localhost/pbl/api-03/routes/bulk_users.php', {
            method: 'POST',
            headers: {
                'Authorization': `Bearer ${token}`,
            },
            body: formData,
        });
        
        const result = await response.json();

        // Debugging: Log the response status and body
        console.log('Response Status:', response.status);
        console.log('Response Body:', result);

        if (response.status === 200) {
            alert(`Users successfully created: ${result.message}`);
            document.getElementById('uploadFileModal');
            window.location.href = 'superadmin_accountlist_page.php';
        } else {
            // If the status is not 200, give detailed response
            alert(`Error uploading file: ${result.message || 'Unknown error'}`);
        }
    } catch (err) {
        // Add more detailed error logging here
        console.error('Error:', err);
        alert('An error occurred while uploading the file.');
    }
});
</script>
</html>
