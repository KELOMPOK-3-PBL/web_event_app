<?php
// Tangkap event_id dari URL
if (isset($_GET['event_id'])) {
    $event_id = $_GET['event_id'];
} else {
    // Jika event_id tidak ditemukan, arahkan ke halaman lain atau tampilkan pesan error
    die("Event ID tidak ditemukan.");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Event</title>
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
            <h2 class="text-2xl font-bold mb-6">Detail Event</h2>
            
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
                
                <!-- Date and time -->
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2" for="date_start">Date and Time</label>
                    <input type="datetime-local" id="date_start" class="w-full border rounded px-4 py-2" required>
                </div>

                <!-- Date End
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2" for="date_end">Date End</label>
                    <input type="datetime-local" id="date_end" class="w-full border rounded px-4 py-2" required>
                </div> -->
                
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

                <!-- Poster download Section -->
                <div class="mb-6">
                    <label class="block text-gray-700 font-semibold mb-2" for="qrCodeDownload">Download Poster</label>
                    <!-- Tombol download poster -->
                    <a id="posterDownloadLink" href="#" download="qr-code.png" class="px-4 py-2 bg-blue-500 text-white font-semibold rounded-lg inline-block">
                        Download Poster
                    </a>
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
                <!-- Exit Button -->
                <div class="flex justify-left">
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
// Tangkap event_id dari URL menggunakan JavaScript
const urlParams = new URLSearchParams(window.location.search);
const eventId = urlParams.get('event_id');

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
            let description = event.description || '';
            let note = event.note || '';

            // Populate form fields with event data
            document.getElementById('title').value = title;
            document.getElementById('category_id').value = category; // Use category_id for dropdown
            document.getElementById('location').value = location;
            document.getElementById('place').value = place;
            document.getElementById('quota').value = quota;
            document.getElementById('date_start').value = date_start;
            document.getElementById('description').value = description;

            // Poster logic
            const poster = event.poster || ''; // Assign poster variable
            const posterDownloadLink = document.getElementById('posterDownloadLink');
            const posterPreview = document.getElementById('posterPreview');
            if (posterPreview && poster) {
                posterPreview.src = `http://localhost${poster}`;
                posterPreview.alt = "Event Poster";
            }
            if (posterDownloadLink && poster) {
                // Make sure the path is complete, by adding the hostname (localhost)
                const fullPosterUrl = `http://localhost${poster}`;
                
                // Update the download link with the correct URL
                posterDownloadLink.href = fullPosterUrl;
                posterDownloadLink.download = fullPosterUrl.split('/').pop(); // Automatically get the file name from the URL
            }

            // If you have a poster file input, you can set it here
            const posterInput = document.getElementById('poster');
            if (posterInput) {
                // Set poster if it's available, if the input is meant to be updated.
                posterInput.value = '';  // Clear the input if you are allowing new file upload.
            }

            // Set the selected category in the dropdown
            const categorySelect = document.getElementById('category_id');
            if (categorySelect && event.category) {
                Array.from(categorySelect.options).forEach(option => {
                    if (option.text === event.category) { // Match based on the text value
                        option.selected = true;
                    }
                });
            }

            // Update QR code link (assuming you have a qrCode element)
            const qr_id = eventId; // Original data
            const encodedqr_id = btoa(qr_id.toString()); // Base64 encoding

            QRCode.toCanvas(document.getElementById('qrcode'), encodedqr_id, function (error) {
                if (error) console.error(error);
            });
        } else {
            console.error('Failed to fetch event details:', data.message);
        }
    } catch (error) {
        console.error('Error fetching event details:', error);
    }
}

// Panggil fungsi loadEventDetails dengan eventId
if (eventId) {
    loadEventDetails(eventId);
} else {
    alert('Event ID tidak ditemukan.');
}

// Handle poster file input to update the poster path
document.getElementById('poster').addEventListener('change', function (event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            // If you want to preview the file before uploading
            const preview = document.getElementById('posterPreview');
            preview.src = e.target.result;  // Display the selected image
        };
        reader.readAsDataURL(file);
    }
});

function formatDateTime(inputDate) {
    // Pisahkan tanggal dan waktu
    const [date, time] = inputDate.split(' ');
    // Pisahkan bagian waktu (jam:menit:detik)
    const [hour, minute] = time.split(':');

    // Gabungkan menjadi format yang sesuai untuk input datetime-local
    return `${date}T${hour}:${minute}`;
}
</script>
</html>
