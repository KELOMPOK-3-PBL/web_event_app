<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account List</title>
    
    <!-- Tailwind CSS and Font Awesome -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <!-- DataTables CSS and JS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
</head>

<body>
    <!-- Sidebar -->
    <?php include '../component/sidebar_superadmin.php'; ?>

    <!-- Header -->
    <?php include '../component/header_superadmin.php'; ?>

    <!-- Main Content -->
    <div class="ml-64 p-8 mt-[120px]">
        <section>
            <h2 class="text-4xl font-semibold">Account List</h2>
            <div class="bg-white p-6 rounded-lg shadow-md mb-6">
                <table id="accountTable" class="display w-full">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Account</th>
                            <th>Roles</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data will be loaded here by JavaScript -->
                    </tbody>
                </table>
            </div>
        </section>
    </div>

    <!-- Footer -->
    <?php include '../component/footer.php'; ?>

    <!-- Modal untuk mengubah role -->
<div id="roleModal" class="fixed inset-0 flex items-center justify-center bg-gray-600 bg-opacity-50 hidden">
    <div class="bg-white p-6 rounded-lg w-96">
        <h3 class="text-lg font-semibold mb-4">Change Roles</h3>
        <form id="roleForm">
            <div>
                <label class="block">
                    <input type="checkbox" id="role_member" class="mr-2"> Member
                </label>
                <label class="block">
                    <input type="checkbox" id="role_propose" class="mr-2"> Propose
                </label>
                <label class="block">
                    <input type="checkbox" id="role_admin" class="mr-2"> Admin
                </label>
                <label class="block">
                    <input type="checkbox" id="role_superadmin" class="mr-2"> Superadmin
                </label>
            </div>
            <div class="mt-4 flex justify-between">
                <button type="button" onclick="closeRoleModal()" class="bg-gray-500 text-white px-4 py-2 rounded">Cancel</button>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Save Changes</button>
            </div>
        </form>
    </div>
</div>


    <script>
document.addEventListener('DOMContentLoaded', async () => {
    const usersUrl = 'http://localhost:80/web_event_app/api-03/routes/users.php';

    // Fungsi untuk mengambil data pengguna
    async function fetchUsers(url) {
        try {
            const response = await fetch(url);
            if (!response.ok) throw new Error('Failed to fetch users');
            const result = await response.json();
            return result.data; // Hanya bagian data
        } catch (error) {
            console.error(error);
            return [];
        }
    }

    // Fungsi untuk mengisi tabel akun
    function populateAccountTable(users) {
        const table = $('#accountTable').DataTable();
        table.clear(); // Bersihkan tabel sebelum mengisi data baru

        users.forEach((user, index) => {
            const roles = user.roles.split(','); // Pecah string roles menjadi array
            table.row.add([
                index + 1, // Kolom No
                user.email, // Nama pengguna
                roles.join(', '), // Gabungkan roles kembali jika diperlukan
                `<div class="flex justify-center space-x-2">
                    <button class="px-3 py-1 bg-blue-500 text-white text-sm rounded hover:bg-blue-600" onclick="changeRole(${user.user_id})">Change Role</button>
                    <button class="px-3 py-1 bg-red-500 text-white text-sm rounded hover:bg-red-600" onclick="deleteAccount(${user.user_id})">Delete</button>
                </div>`
            ]);
        });

        table.draw(); // Render ulang tabel
    }

    // Fungsi untuk mengubah role pengguna dengan checkbox
window.changeRole = function(userId) {
    // Ambil elemen checkbox dari modal
    const roleModal = document.getElementById('roleModal');
    const roleForm = document.getElementById('roleForm');

    // Reset checkbox
    document.getElementById('role_member').checked = false;
    document.getElementById('role_propose').checked = false;
    document.getElementById('role_admin').checked = false;
    document.getElementById('role_superadmin').checked = false;

    // Tampilkan modal
    roleModal.classList.remove('hidden');
    
    // Kirim data userId melalui data modal
    roleForm.onsubmit = async function(event) {
        event.preventDefault(); // Mencegah form submit default

        const selectedRoles = [];
        
        // Cek role yang terpilih
        if (document.getElementById('role_member').checked) selectedRoles.push('member');
        if (document.getElementById('role_propose').checked) selectedRoles.push('propose');
        if (document.getElementById('role_admin').checked) selectedRoles.push('admin');
        if (document.getElementById('role_superadmin').checked) selectedRoles.push('superadmin');
        
        if (selectedRoles.length === 0) {
            alert('Please select at least one role.');
            return;
        }

        // Kirim permintaan update role ke server
        try {
            const response = await fetch(usersUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    user_id: userId,
                    roles: selectedRoles.join(','),
                }),
            });

            if (response.ok) {
                alert('Roles updated successfully.');
                loadUsers(); // Muat ulang data pengguna
                closeRoleModal(); // Tutup modal
            } else {
                throw new Error('Failed to update roles');
            }
        } catch (error) {
            alert(error.message);
        }
    };
};

// Fungsi untuk menutup modal
function closeRoleModal() {
    const roleModal = document.getElementById('roleModal');
    console.log('Closing modal:', roleModal.style.display);  // Cek status modal
    if (roleModal) {
        roleModal.style.display = 'none';  // Tutup modal
    } else {
        console.error('Modal element not found!');
    }
}

    // Fungsi untuk menghapus akun pengguna
window.deleteAccount = function(userId) {
    if (confirm('Are you sure you want to delete this account?')) {
        // Perbarui URL dengan user_id yang sesuai
        const deleteUrl = `http://localhost:80/pbl/api-03/routes/users.php?user_id=${userId}`;
        
        fetch(deleteUrl, {
            method: 'DELETE',  // Menggunakan metode DELETE
        })
        .then((response) => {
            if (response.ok) {
                alert('Account deleted successfully.');
                loadUsers(); // Muat ulang data pengguna
            } else {
                throw new Error('Failed to delete account');
            }
        })
        .catch((error) => {
            alert(error.message);
        });
    }
};

    // Fungsi untuk memuat data pengguna
    async function loadUsers() {
        const users = await fetchUsers(usersUrl);
        populateAccountTable(users);
    }

    // Inisialisasi DataTables
    $('#accountTable').DataTable({
        columnDefs: [
            { orderable: false, targets: 0 }, // Nonaktifkan sorting pada kolom No
            { orderable: false, targets: 3 }, // Nonaktifkan sorting pada kolom Action
        ],
        order: [[1, 'asc']],
        paging: true,
        lengthChange: true,
        pageLength: 5,
        lengthMenu: [[5, 10, 15], [5, 10, 15]],
        language: {
            paginate: {
                previous: 'Previous',
                next: 'Next',
            },
        },
    });

    // Muat data awal
    loadUsers();
});

</script>
</body>
</html>
