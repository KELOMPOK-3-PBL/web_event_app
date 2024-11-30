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

    // Fungsi untuk mengubah role pengguna
    window.changeRole = function(userId) {
        const newRole = prompt('Enter new role for this user (e.g., Member,Admin):');
        if (newRole) {
            fetch(usersUrl, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    user_id: userId,
                    roles: newRole,
                }),
            })
                .then((response) => {
                    if (response.ok) {
                        alert('Role updated successfully.');
                        loadUsers(); // Muat ulang data
                    } else {
                        throw new Error('Failed to update role');
                    }
                })
                .catch((error) => {
                    alert(error.message);
                });
        }
    };

    // Fungsi untuk menghapus akun pengguna
    window.deleteAccount = function(userId) {
        if (confirm('Are you sure you want to delete this account?')) {
            fetch(`${usersUrl}?user_id=${userId}`, {
                method: 'DELETE',
            })
                .then((response) => {
                    if (response.ok) {
                        alert('Account deleted successfully.');
                        loadUsers(); // Muat ulang data
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
