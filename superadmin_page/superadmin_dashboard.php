<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explore Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
    .scroll-container {
        display: flex;
        overflow-x: auto; /* Aktifkan scroll horizontal */
        gap: 1rem; /* Spasi antar-kartu */
        padding-bottom: 1rem; /* Tambahkan padding di bawah untuk scroll */
    }
    .event-card {
        flex: 0 0 300px; /* Lebar tetap untuk setiap kartu event */
    }
</style>
</head>

<body>
    <!-- Sidebar -->
    <?php include '../component/sidebar_superadmin.php'; ?>

    <!-- Header -->
    <?php include '../component/header_superadmin.php'; ?>

    <div class="ml-64 p-8 mt-[120px]">
    <div class="flex justify-between items-center mb-4">
            <h2 class="text-4xl font-semibold">Dashboard</h2>
    </div>
    <div class="flex space-x-4 mt-8">
    <!-- Proposed Event Card -->
    <div class="bg-blue-500 text-white p-6 rounded-lg w-1/4">
        <div class="flex items-center">
            <span class="text-4xl font-bold">150</span>
            <span class="ml-2 text-lg">Proposed Events</span>
        </div>
        <div class="mt-4 flex items-center justify-between">
            <a href="superadmin_approval_page.php" class="text-white hover:underline">More info</a>
            <i class="fas fa-info-circle"></i>
        </div>
    </div>

    <!-- Pending Event Card -->
    <div class="bg-yellow-500 text-white p-6 rounded-lg w-1/4">
        <div class="flex items-center">
            <span class="text-4xl font-bold">53</span>
            <span class="ml-2 text-lg">Pending Events</span>
        </div>
        <div class="mt-4 flex items-center justify-between">
            <a href="superadmin_approval_page.php" class="text-white hover:underline">More info</a>
            <i class="fas fa-info-circle"></i>
        </div>
    </div>

    <!-- Approved Event Card -->
    <div class="bg-green-500 text-white p-6 rounded-lg w-1/4">
        <div class="flex items-center">
            <span class="text-4xl font-bold">44</span>
            <span class="ml-2 text-lg">Approved Events</span>
        </div>
        <div class="mt-4 flex items-center justify-between">
            <a href="superadmin_approval_page.php" class="text-white hover:underline">More info</a>
            <i class="fas fa-info-circle"></i>
        </div>
    </div>

    <!-- Rejected Event Card -->
    <div class="bg-red-500 text-white p-6 rounded-lg w-1/4">
        <div class="flex items-center">
            <span class="text-4xl font-bold">65</span>
            <span class="ml-2 text-lg">Rejected Events</span>
        </div>
        <div class="mt-4 flex items-center justify-between">
            <a href="superadmin_approval_page.php" class="text-white hover:underline">More info</a>
            <i class="fas fa-info-circle"></i>
        </div>
    </div>
    </div>
    <!-- New Proposed Event Section -->
    <section class="mt-8">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-4xl font-semibold">New Proposed Event</h2>
            <a href="superadmin_approval_page.php" class="text-blue-500 hover:underline">See More</a>
        </div>
        <div class="scroll-container">
            <!-- Event Card -->
            <a href="link-to-business-plan-competition.html" class="bg-white rounded-lg shadow-lg p-4 event-card">
                <img src="../image/videotron_semnas.png" alt="Event" class="rounded mb-4">
                <h3 class="text-lg font-semibold">Competition: Business Plan</h3>
                <div class="mt-4 bg-gray-100 p-4 rounded">
                    <p><strong>Status:</strong> Available</p>
                    <p><strong>Location:</strong> GKT VII/05</p>
                    <p><strong>Date:</strong> 23-25 July 2023</p>
                    <p><strong>Time:</strong> 09:00 - 10:00</p>
                </div>
            </a>
            <a href="link-to-business-plan-competition.html" class="bg-white rounded-lg shadow-lg p-4 event-card">
                <img src="../image/videotron_semnas.png" alt="Event" class="rounded mb-4">
                <h3 class="text-lg font-semibold">Competition: Business Plan</h3>
                <div class="mt-4 bg-gray-100 p-4 rounded">
                    <p><strong>Status:</strong> Available</p>
                    <p><strong>Location:</strong> GKT VII/05</p>
                    <p><strong>Date:</strong> 23-25 July 2023</p>
                    <p><strong>Time:</strong> 09:00 - 10:00</p>
                </div>
            </a>
            <a href="link-to-business-plan-competition.html" class="bg-white rounded-lg shadow-lg p-4 event-card">
                <img src="../image/videotron_semnas.png" alt="Event" class="rounded mb-4">
                <h3 class="text-lg font-semibold">Competition: Business Plan</h3>
                <div class="mt-4 bg-gray-100 p-4 rounded">
                    <p><strong>Status:</strong> Available</p>
                    <p><strong>Location:</strong> GKT VII/05</p>
                    <p><strong>Date:</strong> 23-25 July 2023</p>
                    <p><strong>Time:</strong> 09:00 - 10:00</p>
                </div>
            </a>
            <a href="link-to-business-plan-competition.html" class="bg-white rounded-lg shadow-lg p-4 event-card">
                <img src="../image/videotron_semnas.png" alt="Event" class="rounded mb-4">
                <h3 class="text-lg font-semibold">Competition: Business Plan</h3>
                <div class="mt-4 bg-gray-100 p-4 rounded">
                    <p><strong>Status:</strong> Available</p>
                    <p><strong>Location:</strong> GKT VII/05</p>
                    <p><strong>Date:</strong> 23-25 July 2023</p>
                    <p><strong>Time:</strong> 09:00 - 10:00</p>
                </div>
            </a>
            <a href="link-to-business-plan-competition.html" class="bg-white rounded-lg shadow-lg p-4 event-card">
                <img src="../image/videotron_semnas.png" alt="Event" class="rounded mb-4">
                <h3 class="text-lg font-semibold">Competition: Business Plan</h3>
                <div class="mt-4 bg-gray-100 p-4 rounded">
                    <p><strong>Status:</strong> Available</p>
                    <p><strong>Location:</strong> GKT VII/05</p>
                    <p><strong>Date:</strong> 23-25 July 2023</p>
                    <p><strong>Time:</strong> 09:00 - 10:00</p>
                </div>
            </a>
        </div>
    </section>

    <!-- Available Event Section -->
    <section class="mt-8">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-4xl font-semibold">Available Event</h2>
            <a href="superadmin_event_page.php" class="text-blue-500 hover:underline">See More</a>
        </div>
        <div id="events-container" class="scroll-container">
            <!-- Event Cards akan di-generate di sini -->
        </div>
    </section>

    </div>

    <!-- Footer -->
    <?php include '../component/footer.php'; ?>
</body>
<script>
    // Fetch data dari API
    fetch('http://localhost:80/web_event_app/api-03/routes/available_events.php')
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                displayEvents(data.data);
            } else {
                console.error('Failed to fetch events:', data.message);
            }
        })
        .catch(error => console.error('Error:', error));

    // Fungsi untuk menampilkan daftar event
    function displayEvents(events) {
        const container = document.getElementById('events-container');
        container.innerHTML = ''; // Kosongkan kontainer

        events.forEach(event => {
            // Buat elemen HTML untuk kartu event
            const eventCard = document.createElement('a');
            eventCard.className = 'bg-white rounded-lg shadow-lg p-4 event-card';
            eventCard.href = `superadmin_detail_event.php?event_id=${event.event_id}`; // Tautkan ke halaman detail (opsional)
            eventCard.innerHTML = `
                <img src="${event.poster}" alt="${event.title}" class="w-80 h-80 rounded mb-4">
                <h3 class="text-lg font-semibold">${event.title}</h3>
                <div class="mt-4 bg-gray-100 p-4 rounded">
                    <p><strong>Status:</strong> ${event.status}</p>
                    <p><strong>Location:</strong> ${event.location} - ${event.place}</p>
                    <p><strong>Date:</strong> ${formatDate(event.date_start)} - ${formatDate(event.date_end)}</p>
                    <p><strong>Quota:</strong> ${event.quota}</p>
                </div>
            `;
            // Tambahkan kartu ke dalam kontainer
            container.appendChild(eventCard);
        });
    }

    // Fungsi untuk memformat tanggal
    function formatDate(dateString) {
        const options = { year: 'numeric', month: 'long', day: 'numeric' };
        const date = new Date(dateString);
        return date.toLocaleDateString(undefined, options);
    }
</script>
</html>
