<?php
// Tangkap event_id dari URL
if (isset($_GET['event_id'])) {
    $event_id = $_GET['event_id'];
} else {
    // Jika event_id tidak ditemukan, tampilkan pesan dan arahkan setelah delay
    echo "Event ID tidak ditemukan.";

    sleep(1);  // Menunggu selama 3 detik sebelum mengarahkan
    header('Location: ../signin_screen.php');  // Mengarahkan ke halaman signin
    exit;  // Pastikan script berhenti setelah pengalihan
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Reviewed Event</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/qrcode/build/qrcode.min.js"></script>
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
            <h2 class="text-2xl font-bold mb-6">Edit Reviewed Event</h2>
            
            <!-- Form Section -->
            <form>
                <!-- Event Title -->
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2" for="title">Judul Event</label>
                    <input type="text" id="title" class="w-full border rounded px-4 py-2" placeholder="Judul event">
                </div>
                
                <!-- Event Category
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2" for="category">Category Event</label>
                    <input type="text" id="category" class="w-full border rounded px-4 py-2" placeholder="Category Event">
                </div> -->

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
                    <input type="text" id="location" class="w-full border rounded px-4 py-2" placeholder="GKT Lt. 2">
                </div>

                <!-- Place -->
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2" for="place">Place</label>
                    <input type="text" id="place" class="w-full border rounded px-4 py-2" placeholder="Place" required>
                </div>
                
                <!-- Quota Count -->
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2" for="quota">Quota</label>
                    <input type="text" id="quota" class="w-full border rounded px-4 py-2" placeholder="200 People">
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
                    <textarea id="description" class="w-full border rounded px-4 py-2" rows="4" placeholder="Event description..."></textarea>
                </div>

                <!-- preview poster -->
                <div class="mb-6">
                    <label class="block text-gray-700 font-semibold mb-2">Poster Preview</label>
                    <img id="posterPreview" class="w-full max-h-[720px] object-contain border rounded" alt="Poster not available" />
                </div>
                
                <!-- poster upload Section -->
                <div class="mb-6">
                    <label class="block text-gray-700 font-semibold mb-2">Upload Poster (If theres any revision)</label>
                    <input type="file" id="posterFile" name="poster" class="w-full" />
                </div>


                <!-- QR Code Download Section -->
                <div class="mb-6">
                    <label class="block text-gray-700 font-semibold mb-2" for="qrCodeDownload">QR Code</label>
                    <canvas id="qrcode"></canvas>
                    <!-- <label class="block text-gray-700 font-semibold mb-2" for="qrCodeDownload">Download QR Code</label> -->
                    <!-- Tombol download QR Code -->
                    <!-- <a href="path/to/qr-code.png" download="qr-code.png" class="px-4 py-2 bg-blue-500 text-white font-semibold rounded-lg inline-block">
                        Download QR Code
                    </a> -->
                </div>

                <!-- Note Section tidak pake not karena ini detail event
                <div class="mb-6">
                    <label class="block text-gray-700 font-semibold mb-2" for="note">Note :</label>
                    <textarea id="note" class="w-full border rounded px-4 py-2 bg-gray-100" rows="4" placeholder="Additional notes..."></textarea>
                </div> -->

                <!-- Buttons -->
                <!-- Note Section -->
                <div class="mb-6">
                    <label class="block text-gray-700 font-semibold mb-2" for="note">Note :</label>
                    <textarea id="note" class="w-full border rounded px-4 py-2 bg-gray-100" rows="4" placeholder="Additional notes..." readonly></textarea>
                </div>

                <!-- Save and Submit Button -->
                <div class="flex justify-between">
                    <button type="submit" class="px-4 py-2 bg-green-500 text-white font-semibold rounded-lg">Save and Submit</button>
                    <button type="button" onclick="window.history.back();" class="px-4 py-2 bg-red-500 text-white font-semibold rounded-lg">
                        Exit
                    </button>
                </div>
            </form>
        </div>
    </div>
    
    <!-- Footer -->
    <?php include '../component/footer.php'; ?>
</body>
<script>
document.addEventListener("DOMContentLoaded", () => {
    // Tangkap event_id dari URL menggunakan JavaScript
    const urlParams = new URLSearchParams(window.location.search);
    const eventId = urlParams.get('event_id');

    if (!eventId) {
        alert('Event ID tidak ditemukan.');
        return;
    }

    let poster = '';  // Declare poster variable globally

    // Fungsi untuk memuat data event
    async function loadEventDetails(eventId) {
        const apiEndpoint = `http://localhost/pbl/api-03/routes/events.php?event_id=${eventId}`;
        try {
            const response = await fetch(apiEndpoint);
            const data = await response.json();

            if (response.ok && data.status === 'success' && data.data) {
                const event = data.data;

                // Declare variables to store event data
                let title = event.title || '';
                let category = event.category || '';
                let location = event.location || '';
                let place = event.place || '';
                let quota = event.quota || '';
                let date_start = event.date_start ? event.date_start.replace(' ', 'T') : '';
                let date_end = event.date_end ? event.date_end.replace(' ', 'T') : '';
                let description = event.description || '';
                let note = event.note || '';

                // Populate form fields with event data
                document.getElementById('title').value = title;
                document.getElementById('category_id').value = category;
                document.getElementById('location').value = location;
                document.getElementById('place').value = place;
                document.getElementById('quota').value = quota;
                document.getElementById('date_start').value = date_start;
                document.getElementById('date_end').value = date_end;
                document.getElementById('description').value = description;
                document.getElementById('note').value = note;

                poster = event.poster || ''; // Assign poster variable

                // Set the selected category in the dropdown
                const categorySelect = document.getElementById('category_id');
                if (categorySelect) {
                    Array.from(categorySelect.options).forEach(option => {
                        if (option.text === event.category) {
                            option.selected = true;
                        }
                    });
                }

                // Update QR code link
                const qr_id = eventId; // Original data
                const encodedqr_id = btoa(qr_id.toString()); // Base64 encoding

                QRCode.toCanvas(document.getElementById('qrcode'), encodedqr_id, function (error) {
                    if (error) console.error(error);
                });

                // Display the event poster if available
                const posterPreview = document.getElementById('posterPreview');
                if (posterPreview && event.poster) {
                    posterPreview.src = `http://localhost${event.poster}`;
                    posterPreview.alt = "Event Poster";
                }
            } else {
                console.error('Failed to fetch event details:', data.message);
            }
        } catch (error) {
            console.error('Error fetching event details:', error);
        }
    }

    // Fungsi untuk memformat tanggal dan waktu ke input datetime-local
    function formatDateTime(datetimeString) {
        const date = new Date(datetimeString);
        const year = date.getFullYear();
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const day = String(date.getDate()).padStart(2, '0');
        const hours = String(date.getHours()).padStart(2, '0');
        const minutes = String(date.getMinutes()).padStart(2, '0');
        return `${year}-${month}-${day}T${hours}:${minutes}`;
    }

    // Panggil fungsi loadEventDetails dengan eventId
    loadEventDetails(eventId);

    // Handle form submission
    document.querySelector('form').addEventListener('submit', async (e) => {
        e.preventDefault(); // Mencegah reload halaman

        // Menangani roles dengan benar
        let roles;
        try {
            // Memeriksa apakah data roles berupa JSON
            roles = JSON.parse(localStorage.getItem('roles'));
        } catch (e) {
            roles = localStorage.getItem('roles'); // Ambil sebagai string jika tidak valid JSON
        }

        // Pastikan bahwa token ada di localStorage
        const token = localStorage.getItem('jwt');
        if (!token) {
            alert('Token tidak ditemukan. Anda harus login terlebih dahulu.');
            return;
        }

        // Ambil nilai input
        let title = document.getElementById('title').value;
        let description = document.getElementById('description').value;
        let location = document.getElementById('location').value;
        let place = document.getElementById('place').value;
        let quota = document.getElementById('quota').value;
        let date_start = document.getElementById('date_start').value;
        let date_end = document.getElementById('date_end').value;

        // Jika ingin mendapatkan kategori yang dipilih
        let category_id = document.getElementById('category_id').value;

        // Ambil file poster yang diupload
        const posterFileInput = document.getElementById('posterFile');
        const posterFile = posterFileInput ? posterFileInput.files[0] : null;

        // Membuat FormData untuk pengiriman data
        const formData = new FormData();
        formData.append('title', title);
        formData.append('description', description);
        formData.append('location', location);
        formData.append('place', place);
        formData.append('quota', quota);
        formData.append('date_start', date_start);
        formData.append('date_end', date_end);
        formData.append('category_id', category_id);

        // Jika ada file poster, tambahkan ke formData
        if (posterFile) {
            formData.append('poster', posterFile); // Gantikan dengan file yang diupload
        } else if (poster) {
            // Jika tidak ada file baru, kirimkan poster lama
            formData.append('poster', poster);
        }

        // Filter data yang kosong
        for (const [key, value] of formData.entries()) {
            if (value === "" || value === null || value === undefined) {
                formData.delete(key);
            }
        }

        try {
            const response = await fetch(`http://localhost/pbl/api-03/routes/events.php?event_id=${eventId}`, {
                method: 'POST',
                headers: {
                    'Authorization': `Bearer ${token}`, // Menambahkan token dalam header
                },
                body: formData, // Mengirim FormData
            });

            if (response.ok) {
                const result = await response.json();
                alert('Event berhasil diedit!!');
                window.location.href = 'propose_proposed_page.php';
            } else {
                const error = await response.text();
                alert('Gagal menyimpan event. Silakan coba lagi.');
            }
        } catch (err) {
            alert('Terjadi kesalahan saat menghubungi server.');
        }
    });
});
</script>
</html>
