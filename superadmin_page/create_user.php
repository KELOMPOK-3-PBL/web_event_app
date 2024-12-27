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
        <a href="" class="text-sm text-blue-600">Atau bisa cek di sini</a>
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

<script>
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
          // Read response body once and store it
          const result = await response.json();

          // Debugging: Log the response status and body
          console.log('Response Status:', response.status);
          console.log('Response Body:', result);



          if (response.status === 200) {
              alert(`Users successfully created: ${result.message}`);
              document.getElementById('uploadFileModal').style.display = 'none';
              location.reload();
          } else {
              alert(`Error uploading file: ${result.message}`);
          }
      } catch (err) {
          console.error('Error:', err);
          alert('An error occurred while uploading the file.');
      }
  });
</script>
</body>
</html>
