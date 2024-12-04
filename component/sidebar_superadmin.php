<div id="sidebar" class="bg-blue-500 w-64 h-screen fixed left-0 top-0 flex flex-col justify-between p-4 text-white z-10">
    <div>

        <!-- Divider -->
        <div class="border-t border-white/50 my-8 mt-[105px]"></div>

        <!-- My Profile Section -->
        <div class="flex items-center mb-6">
            <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center text-blue-500 font-bold">
                <span>U</span>
            </div>
            <div class="ml-3">
                <a href="superadmin_profile.php" class="text-lg font-semibold">
                    <p id="username">Loading ...</p> <!-- Username yang akan diubah -->
                </a>
            </div>
        </div>

        <!-- Menu Items -->
        <ul>
            <li class="mb-4">
                <a href="superadmin_dashboard.php" class="flex items-center space-x-2 hover:bg-blue-600 p-2 rounded">
                    <img src="../image/logo_explore.png" alt="Explore" class="w-6 h-6">
                    <span>Explore</span>
                </a>
            </li>
            <li class="mb-4">
                <a href="superadmin_event_page.php" class="flex items-center space-x-2 hover:bg-blue-600 p-2 rounded">
                    <img src="../image/logo_calendar.png" alt="Event" class="w-6 h-6">
                    <span>Event</span>
                </a>
            </li>
            <li class="mb-4">
                <a href="superadmin_approval_page.php" class="flex items-center space-x-2 hover:bg-blue-600 p-2 rounded">
                    <img src="../image/logo_approval.png" alt="Approval" class="w-6 h-6">
                    <span>Approval</span>
                </a>
            </li>
            <li class="mb-4">
                <a href="superadmin_accountlist_page.php" class="flex items-center space-x-2 hover:bg-blue-600 p-2 rounded">
                    <img src="../image/logo_account.png" alt="Accounts" class="w-6 h-6">
                    <span>Accounts</span>
                </a>
            </li>
        </ul>
    </div>

    <!-- Sidebar Footer -->
    <div>
        <a href="#" id="logout-button" class="flex items-center space-x-2 hover:bg-blue-600 p-2 rounded">
            <i class="fas fa-sign-out-alt"></i>
            <span>Log Out</span>
        </a>
    </div>
</div>

<script>
// Ambil token dari localStorage
const token = localStorage.getItem('token');

// Mengecek apakah token ada
if (token) {
    // Dekode token untuk mendapatkan user_id
    const decodedToken = parseJwt(token);
    
    if (decodedToken && decodedToken.user_id) {
        const userId = decodedToken.user_id;  // Mendapatkan user_id dari token

        // Membuat permintaan ke endpoint menggunakan Bearer token dan user_id yang dinamis
        fetch(`http://localhost/web_event_app/api-03/routes/users.php?user_id=${userId}`, {
    method: 'GET',
    headers: {
        'Content-Type': 'application/json',
        'Authorization': `Bearer ${token}`
    }
})
.then(response => response.json())
.then(data => {
    console.log('API Response:', data); // Log respons API untuk debugging
    if (data.status === 'success') {
        // Ambil username dari data yang diterima
        const username = data.data.username;

        // Menampilkan username di elemen dengan ID 'username'
        document.getElementById('username').textContent = username;
    } else {
        console.error('Error:', data.message);
        document.getElementById('username').textContent = 'Guest'; // Tampilkan 'Guest' jika error
    }
})
.catch(error => {
    console.error('Request failed:', error);
    document.getElementById('username').textContent = 'Guest'; // Tampilkan 'Guest' jika gagal
});
    } else {
        console.error('User ID not found in token.');
        document.getElementById('username').textContent = 'Guest'; // Tampilkan sebagai 'Guest' jika token tidak valid
    }
} else {
    console.error('Token is missing.');
    document.getElementById('username').textContent = 'Guest'; // Tampilkan sebagai 'Guest' jika tidak ada token
}

// Fungsi untuk mendekode JWT
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

// Logout functionality
document.getElementById('logout-button').addEventListener('click', function (e) {
    e.preventDefault(); // Mencegah navigasi langsung

    // Kirim permintaan DELETE ke endpoint logout
    fetch('http://localhost/web_event_app/api-03/routes/auth.php', {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            action: 'logout' // Menambahkan parameter action untuk logout
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            // Menghapus username dan token dari localStorage
            localStorage.removeItem('username');
            // localStorage.removeItem('token'); // Hapus token juga
            
            // Jika logout berhasil, redirect ke halaman login
            alert(data.message); // Menampilkan pesan logout sukses
            window.location.href = '../signin_screen.php'; // Arahkan ke halaman login
        } else {
            alert('Logout failed: ' + data.message); // Jika ada error saat logout
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred during logout.'); // Menangani kesalahan lainnya
    });
});
</script>