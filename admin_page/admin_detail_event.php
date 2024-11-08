<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Event</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <!-- Sidebar -->
    <?php include '../component/sidebar_admin.php'; ?>

    <!-- Header -->
    <?php include '../component/header_admin.php'; ?>

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
                
                <!-- Event Category -->
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2" for="category">Category Event</label>
                    <input type="text" id="category" class="w-full border rounded px-4 py-2" placeholder="Category Event">
                </div>
                
                <!-- Location -->
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2" for="location">Location</label>
                    <input type="text" id="location" class="w-full border rounded px-4 py-2" placeholder="GKT Lt. 2">
                </div>
                
                <!-- Audience Count -->
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2" for="audience">Audience</label>
                    <input type="text" id="audience" class="w-full border rounded px-4 py-2" placeholder="200 People">
                </div>
                
                <!-- Date and Time -->
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2" for="datetime">Date & Time</label>
                    <input type="datetime-local" id="datetime" class="w-full border rounded px-4 py-2">
                </div>
                
                <!-- Description -->
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2" for="description">Description</label>
                    <textarea id="description" class="w-full border rounded px-4 py-2" rows="4" placeholder="Event description..."></textarea>
                </div>

                <!-- poster download Section -->
                <div class="mb-6">
                    <label class="block text-gray-700 font-semibold mb-2" for="qrCodeDownload">Download Poster</label>
                    <!-- Tombol download poster -->
                    <a href="path/to/qr-code.png" download="qr-code.png" class="px-4 py-2 bg-blue-500 text-white font-semibold rounded-lg inline-block">
                        Download Poster
                    </a>
                </div>

                <!-- QR Code Download Section -->
                <div class="mb-6">
                    <label class="block text-gray-700 font-semibold mb-2" for="qrCodeDownload">Download QR Code</label>
                    <!-- Tombol download QR Code -->
                    <a href="path/to/qr-code.png" download="qr-code.png" class="px-4 py-2 bg-blue-500 text-white font-semibold rounded-lg inline-block">
                        Download QR Code
                    </a>
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

</html>