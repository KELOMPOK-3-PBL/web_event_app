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
// Mengambil token dari localStorage
const token = localStorage.getItem('jwt');

// Memanggil API tanpa pengecekan token terlebih dahulu
fetch('http://localhost/pbl/api-03/routes/auth.php', {
    method: 'GET',
    headers: {
        'Content-Type': 'application/json',
        'Authorization': `Bearer ${token}` // Meskipun token tidak dicek, tetap akan diteruskan
    }
})
.then(response => response.json())
.then(data => {
    if (data.status === 'success') {
        // Ambil username dari data yang diterima
        const username = data.data.username;

        // Menampilkan username di elemen dengan ID 'username'
        document.getElementById('username').textContent = username;

        // Menyimpan username ke localStorage jika diperlukan
        localStorage.setItem('username', username);
    } else {
        console.error('Error:', data.message);
        document.getElementById('username').textContent = 'Guest'; // Tampilkan 'Guest' jika error
    }
})
.catch(error => {
    console.error('Request failed:', error);
    document.getElementById('username').textContent = 'Guest'; // Tampilkan 'Guest' jika gagal
});

// Logout functionality
document.getElementById('logout-button').addEventListener('click', function (e) {
    e.preventDefault(); // Mencegah navigasi langsung

    // Kirim permintaan DELETE ke endpoint logout
    fetch('http://localhost/pbl/api-03/routes/auth.php', {
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
            sessionStorage.removeItem('jwt');
            localStorage.removeItem('jwt'); // Hapus token juga
            
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
