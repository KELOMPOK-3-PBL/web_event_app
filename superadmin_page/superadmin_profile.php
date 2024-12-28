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
    <title>Profile</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <!-- Sidebar -->
    <?php include '../component/sidebar_superadmin.php'; ?>

    <!-- Header -->
    <?php include '../component/header_superadmin.php'; ?>

    <!-- Main Content -->
    <div class="ml-64 p-8 mt-[120px]">

        <!-- My Profile Section -->
        <div class="bg-white shadow-md rounded-lg p-8">
            <div class="flex justify-between items-center">
                <!-- Profile Image -->
                <div class="w-1/4 flex justify-center items-center">
                    <div class="border-2 border-gray-300 rounded-full p-8">
                        <i class="fas fa-user fa-10x"></i> <!-- Placeholder Icon for Profile -->
                    </div>
                </div>

                <!-- Profile Details -->
                <div class="w-3/4 px-6">
                    <!-- Username -->
                    <div class="flex justify-between items-center mb-4">
                        <h1 id="usernamee" class="text-3xl font-bold">Guest</h1> <!-- Username -->
                    </div>
                    <div>
                        <h3 id="role">Logged in as Role</h3> <!-- Role -->
                    </div>
                </div>
            </div>
        </div>


        <div class="bg-white shadow-md rounded-lg p-8">
            <h2 class="text-2xl font-semibold mb-6">Event Statistik</h2>
            <div class="flex space-x-4 mt-8" id="event-cards">
            <!-- Card event akan dinamis di sini -->
            </div>
        </div>
    </div>

    </div>
    <!-- Footer -->
    <?php include '../component/footer.php'; ?>
</body>
<script>
document.addEventListener("DOMContentLoaded", () => {
    // Endpoint API
    const apiURL = "http://localhost/pbl/api-03/routes/auth.php";
    const token = localStorage.getItem("jwt");

    // Pastikan token tersedia
    if (!token) {
        console.error("No token found in localStorage. Please login first.");
        // Redirect to login page or show error
        return;
    }

    // Ambil data dari API
    fetch(apiURL, {
        method: "GET",
        headers: {
            "Content-Type": "application/json",
            "Authorization": `Bearer ${token}`, // Kirim token jika tersedia
        },
    })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            if (data.status === "success") {
                // Isi data ke dalam elemen DOM
                document.getElementById("usernamee").textContent = data.data.username;
                document.getElementById("role").textContent = `Logged in as ${data.data.role_name}`;
            } else {
                console.error("API response status not success:", data.message);
                // Tampilkan error pada UI jika diperlukan
            }
        })
        .catch(error => {
            console.error("Fetch error:", error);
            // Tampilkan error pada UI jika diperlukan
        });
});
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
</script>
</html>