<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Propose Event</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <!-- Sidebar -->
    <?php include '../component/sidebar_propose.php'; ?>

    <!-- Header -->
    <?php include '../component/header_propose.php'; ?>

    <!-- Main Content Wrapper -->
    <div class="ml-64 mt-[120px] p-8">
        <div class="w-full max-w-3xl bg-white p-8 rounded-lg shadow-lg">
            <h2 class="text-2xl font-bold mb-6">Propose Event</h2>
            
            <!-- Form Section -->
            <form id="eventForm">
                <!-- Title -->
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2" for="title">Title</label>
                    <input type="text" id="title" class="w-full border rounded px-4 py-2" placeholder="Title" required>
                </div>

                <!-- Category Dropdown -->
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2" for="category_id">Category</label>
                    <select id="category_id" class="w-full border rounded px-4 py-2" required>
                        <option value="" disabled selected>Pilih Category</option>
                        <option value="1">Seminar</option>
                        <option value="2">Lomba</option>
                        <option value="3">Technology</option>
                        <option value="4">Sports</option>
                    </select>
                </div>

                 <!-- Location -->
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2" for="location">Location</label>
                    <input type="text" id="location" class="w-full border rounded px-4 py-2" placeholder="Location" required>
                </div>

                <!-- Place -->
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2" for="place">Place</label>
                    <input type="text" id="place" class="w-full border rounded px-4 py-2" placeholder="Place" required>
                </div>

                <!-- Quota -->
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2" for="quota">Quota</label>
                    <input type="number" id="quota" class="w-full border rounded px-4 py-2" placeholder="Quota" required>
                </div>

                 <!-- Date Start -->
                 <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2" for="date_start">Date Start</label>
                    <input type="datetime-local" id="date_start" class="w-full border rounded px-4 py-2" required>
                </div>

                <!-- Date End -->
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2" for="date_end">Date End</label>
                    <input type="datetime-local" id="date_end" class="w-full border rounded px-4 py-2" required>
                </div>

                <!-- Description -->
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2" for="description">Description</label>
                    <textarea id="description" class="w-full border rounded px-4 py-2" rows="4" placeholder="Description..." required></textarea>
                </div>

                <!-- Invited Users
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2" for="invited_users">Invited Users</label>
                    <input type="text" id="invited_users" class="w-full border rounded px-4 py-2" placeholder="Invited Users" required>
                </div> -->

                <!-- Poster -->
                <div class="mb-6">
                    <label class="block text-gray-700 font-semibold mb-2" for="poster">Upload Poster</label>
                    <input type="file" id="poster" class="w-full border rounded px-4 py-2 bg-gray-100" required>
                </div>

                <!-- Buttons -->
                <div class="flex justify-between">
                    <button type="submit" class="px-4 py-2 bg-green-500 text-white font-semibold rounded-lg">Upload</button>
                    <button type="button" onclick="window.history.back();" class="px-4 py-2 bg-red-500 text-white font-semibold rounded-lg">Exit</button>
                </div>
            </form>
        </div>
    </div>
    
    <!-- Footer -->
    <?php include '../component/footer.php'; ?>
</body>
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

    document.getElementById('eventForm').addEventListener('submit', async function(event) {
        event.preventDefault(); // Mencegah reload halaman

        // Ambil data dari form
        const title = document.getElementById('title').value;
        const description = document.getElementById('description').value;
        const location = document.getElementById('location').value;
        const place = document.getElementById('place').value;
        const quota = document.getElementById('quota').value;
        const date_start = document.getElementById('date_start').value;
        const date_end = document.getElementById('date_end').value;
        const category_id = document.getElementById('category_id').value;
        const poster = document.getElementById('poster').files[0]; // File poster

        // Buat objek FormData untuk mengirimkan data form
        roles = localStorage.getItem('roles');
        const formData = new FormData();
        formData.append('propose_user_id', roles);
        formData.append('title', title);
        formData.append('description', description);
        formData.append('location', location);
        formData.append('place', place);
        formData.append('quota', quota);
        formData.append('date_start', date_start);
        formData.append('date_end', date_end);
        formData.append('category_id', category_id);
        formData.append('poster', poster);
        // formData.append('invited_users', null); // Kirim null untuk invited_users

        try {
            const token = localStorage.getItem('jwt');
            if (!token) {
                alert('Token tidak ditemukan. Anda harus login terlebih dahulu.');
                return;
            }
            const response = await fetch('http://localhost/pbl/api-03/routes/events.php', {
                method: 'POST',
                headers: {
                    'Authorization': `Bearer ${token}`, // Menambahkan token dalam header
                },
                body: formData
            });

            if (!response.ok) {
                const errorText = await response.text();
                alert(`Gagal menyimpan event. Status: ${response.status}, Respons: ${errorText}`);
                return;
            }

            const contentType = response.headers.get('content-type');

            if (contentType && contentType.includes('application/json')) {
                let result;
                try {
                    result = await response.json();

                    if (result.code === 201 && result.status === 'success') {
                        alert('Event berhasil dibuat!!');
                        window.history.back();
                        window.location.href = 'propose_dashboard.php';
                    } else {
                        alert('Gagal menyimpan event. Pesan dari server: ' + result.message);
                    }
                } catch (jsonError) {
                    alert('Gagal memproses respons JSON dari server.');
                }
            } else {
                const responseBody = await response.text();
                alert('Respons server bukan JSON. Tidak dapat memproses.');
            }
        } catch (err) {
            alert('Terjadi kesalahan saat menghubungi server.');
        }

    });
</script>
</html>
