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
    <div class="flex space-x-4 mt-8" id="event-cards">
    <!-- Card event akan dinamis di sini -->
    </div>
    
    <section class="mt-8">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-4xl font-semibold">New Proposed Event</h2>
            <a href="superadmin_approval_page.php" class="text-blue-500 hover:underline">See More</a>
        </div>
        <div id="new-proposed-events-container" class="scroll-container">
            <!-- Kartu event akan di-generate di sini -->
        </div>
    </section>

    <!-- Available Event Section -->
    <section class="mt-8">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-4xl font-semibold">Available Event</h2>
            <a href="superadmin_event_page.php" class="text-blue-500 hover:underline">See More</a>
        </div>
        <div id="available-events-container" class="scroll-container">
            <!-- Event Cards akan di-generate di sini -->
        </div>
    </section>

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

// Fetch jumlah event berdasarkan status
fetch('http://localhost/pbl/api-03/routes/events_count.php', {
})
.then(response => response.json())
.then(data => {
    if (data.status === 'success') {
        // Ambil data jumlah event
        const eventData = data.data;

        // Elemen container untuk menampung card
        const eventCardsContainer = document.getElementById('event-cards');
        
        // Data status event untuk di-loop dan ditampilkan
        const eventStatuses = [
            { name: 'Proposed', color: 'bg-blue-500' },
            { name: 'Review Admin', color: 'bg-yellow-500' },
            { name: 'Revision Propose', color: 'bg-[#D2B48C]' }, // Card for Reviewing with color #D2B48C
            { name: 'Approved', color: 'bg-green-500' },
            { name: 'Rejected', color: 'bg-red-500' },
            { name: 'Completed', color: 'bg-[#FFD700]' } // Card for Completed with color #FFD700
        ];

        // Loop untuk setiap status yang diperlukan
        eventStatuses.forEach(status => {
            const statusData = eventData.find(event => event.status_name === status.name);
            const eventCount = statusData ? statusData.event_count : 0; // Jika tidak ada data, set ke 0

            // Membuat card dinamis untuk setiap status
            const card = document.createElement('div');
            card.classList.add(status.color, 'text-white', 'p-6', 'rounded-lg', 'w-1/4');

            card.innerHTML = `
                <div class="flex items-center">
                    <span class="text-4xl font-bold">${eventCount}</span>
                    <span class="ml-2 text-lg">${status.name} Events</span>
                </div>
                <div class="mt-4 flex items-center justify-between">
                    <a href="superadmin_approval_page.php" class="text-white hover:underline">More info</a>
                    <i class="fas fa-info-circle"></i>
                </div>
            `;

            // Menambahkan card ke container
            eventCardsContainer.appendChild(card);
        });
    }
});

fetch('http://localhost/pbl/api-03/routes/events.php')
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success' && Array.isArray(data.data)) {
            // Filter berdasarkan status
            const approvedEvents = data.data.filter(event => event.status === 'Approved');
            const newProposedEvents = data.data.filter(event => event.status === 'Proposed' || event.status === 'Revision Propose');

            // Urutkan newProposedEvents berdasarkan status dan waktu
            const statusOrder = ['Proposed', 'Revision Propose'];
            newProposedEvents.sort((a, b) => {
                const statusComparison = statusOrder.indexOf(a.status) - statusOrder.indexOf(b.status);
                if (statusComparison !== 0) return statusComparison;

                // Jika status sama, urutkan berdasarkan waktu (terbaru lebih dulu)
                return new Date(b.date_add) - new Date(a.date_add);
            });

            // Tampilkan event sesuai kategori
            displayEvents(approvedEvents, 'available-events-container');
            displayEvents(newProposedEvents, 'new-proposed-events-container');
        } else {
            console.error('Failed to fetch events:', data.message);
        }
    })
    .catch(error => console.error('Error fetching events:', error));

// Fungsi untuk menampilkan daftar event
function displayEvents(events, containerId) {
    const container = document.getElementById(containerId);
    container.innerHTML = ''; // Kosongkan kontainer

    if (events.length === 0) {
        container.innerHTML = '<p class="text-gray-500">No events available.</p>';
        return;
    }

    events.forEach(event => {
        const eventCard = document.createElement('a');
        eventCard.className = 'bg-white rounded-lg shadow-lg p-4 event-card';
        eventCard.href = `superadmin_edit_event.php?event_id=${event.event_id}`;
        eventCard.innerHTML = `
            <img src="http://localhost${event.poster}" alt="${event.title}" class="w-80 h-80 rounded mb-4">
            <h3 class="text-lg font-semibold">${event.title}</h3>
            <p class="text-sm text-gray-600 mb-2"><strong>Category:</strong> ${event.category}</p>
            <div class="mt-4 bg-gray-100 p-4 rounded">
                <p><strong>Status:</strong> ${event.status}</p>
                <p><strong>Location:</strong> ${event.location} - ${event.place}</p>
                <p><strong>Date:</strong> ${formatDate(event.date_start)} - ${formatDate(event.date_end)}</p>
                <p><strong>Quota:</strong> ${event.quota}</p>
                <p><strong>Description:</strong> ${event.description}</p>
            </div>
        `;
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
