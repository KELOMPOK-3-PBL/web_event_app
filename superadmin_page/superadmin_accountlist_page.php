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
                            <th>Username</th>
                            <th>Email</th>
                            <th>Roles</th>
                            <th>Change Role</th>
                            <th>Delete</th>
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

    <!-- Modal untuk memilih role -->
    <div id="changeRoleModal" class="modal">
        <div class="modal-content">
            <span id="cancelChangeRole" class="close">&times;</span>
            <h2>Change User Role</h2>
            <form id="changeRoleForm">
                <label for="roleSelect">Select Role:</label>
                <select id="roleSelect" name="roleSelect">
                    <option value="Member">Member</option>
                    <option value="Propose">Propose</option>
                    <option value="Superadmin">Superadmin</option>
                </select>
                <br>
                <button type="submit">Update Role</button>
            </form>
        </div>
    </div>

    <!-- Add some basic CSS for the modal -->
    <style>
    .modal {
        display: none;  /* Hidden by default */
        position: fixed;
        z-index: 1; /* Sit on top */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0, 0, 0); /* Fallback color */
        background-color: rgba(0, 0, 0, 0.4); /* Black w/ opacity */
    }

    .modal-content {
        background-color: #fefefe;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
    }

    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }
    </style>
<script>
// Fungsi untuk mengambil data dari API
async function fetchUsers(url) {
    const token = localStorage.getItem('jwt'); // Ambil token dari localStorage

    try {
        const response = await fetch(url, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': `Bearer ${token}`,
            },
        });

        const data = await response.json();

        if (data.status === "success") {
            return data.data; // Mengembalikan array pengguna
        } else {
            console.error("Error fetching data:", data.message);
            return []; // Mengembalikan array kosong jika gagal
        }
    } catch (error) {
        console.error("Error fetching API:", error);
        return []; // Mengembalikan array kosong jika ada error
    }
}

// Fungsi untuk mengisi data ke tabel
function populateAccountTable(users) {
    const tbody = document.querySelector("#accountTable tbody");
    users.forEach((user, index) => {
        const row = document.createElement("tr");

        // Nomor urut
        const cellNo = document.createElement("td");
        cellNo.textContent = index + 1;

        // Username
        const cellUsername = document.createElement("td");
        cellUsername.textContent = user.username;

        // Email
        const cellEmail = document.createElement("td");
        cellEmail.textContent = user.email;

        // Roles
        const cellRoles = document.createElement("td");
        cellRoles.textContent = user.roles;

        // Change Role Button
        const cellChangeRole = document.createElement("td");
        const changeRoleButton = document.createElement("button");
        changeRoleButton.textContent = "Change Role";
        changeRoleButton.classList.add("bg-blue-500", "text-white", "px-4", "py-2", "rounded", "hover:bg-blue-700");
        
        // Show modal and set the current user in the form when "Change Role" is clicked
        changeRoleButton.addEventListener("click", () => {
            openChangeRoleModal(user.user_id, user.roles); // Pass the user_id and roles to the modal
        });

        cellChangeRole.appendChild(changeRoleButton);

        // Delete Button
        const cellDelete = document.createElement("td");
        const deleteButton = document.createElement("button");
        deleteButton.textContent = "Delete";
        deleteButton.classList.add("bg-red-500", "text-white", "px-4", "py-2", "rounded", "hover:bg-red-700");

        deleteButton.addEventListener("click", async () => {
            const confirmed = confirm(`Are you sure you want to delete ${user.username}?`);
            if (confirmed) {
                const success = await deleteUser(user.user_id);
                if (success) {
                    row.remove();
                }
            }
        });

        cellDelete.appendChild(deleteButton);

        // Menambahkan cell ke row
        row.appendChild(cellNo);
        row.appendChild(cellUsername);
        row.appendChild(cellEmail);
        row.appendChild(cellRoles);
        row.appendChild(cellChangeRole);
        row.appendChild(cellDelete);

        // Menambahkan row ke tabel body
        tbody.appendChild(row);
    });
}

// Fungsi utama untuk memuat dan menampilkan data pengguna
async function loadUsers() {
    const usersUrl = 'http://localhost/pbl/api-03/routes/users.php';
    const users = await fetchUsers(usersUrl);  // Mengambil data dengan token
    populateAccountTable(users);

    // Inisialisasi DataTables setelah data diisi
    $('#accountTable').DataTable({
        columnDefs: [
            { orderable: false, targets: 0 }, // Kolom No tidak bisa diurutkan
            { orderable: false, targets: 4 }, // Kolom Change Role tidak bisa diurutkan
            { orderable: false, targets: 5 }, // Kolom Delete tidak bisa diurutkan
        ],
        order: [[1, 'asc']], // Urutkan berdasarkan kolom Username
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
}

// Memanggil loadUsers untuk memuat data awal
loadUsers();

// Fungsi untuk menghapus user berdasarkan user_id
async function deleteUser(user_id) {
    const token = localStorage.getItem('jwt'); // Ambil token dari localStorage
    const url = `http://localhost:80/pbl/api-03/routes/users.php?user_id=${user_id}`;

    try {
        const response = await fetch(url, {
            method: 'DELETE', // Menggunakan metode DELETE
            headers: {
                'Content-Type': 'application/json',
                'Authorization': `Bearer ${token}`, // Kirim token di header
            },
        });

        const data = await response.json();

        if (data.status === "success") {
            console.log("User deleted successfully");
            alert('User berhasil dihapus!');
            window.location.href = 'superadmin_accountlist_page.php';
            return true; // Return true jika berhasil
        } else {
            console.error("Error deleting user:", data.message);
            return false; // Return false jika gagal
        }
    } catch (error) {
        console.error("Error deleting user:", error);
        return false;
    }
}
function openChangeRoleModal(userId, currentRoles) {
    // Set userId in the modal so we know who we are updating
    document.querySelector("#changeRoleForm").dataset.userId = userId;

    // Set current roles in the select dropdown
    const roleSelect = document.querySelector("#roleSelect");
    roleSelect.value = currentRoles;

    // Show the modal
    const modal = document.getElementById("changeRoleModal");
    modal.style.display = "block";
}

document.getElementById("cancelChangeRole").addEventListener("click", () => {
    // Close the modal
    document.getElementById("changeRoleModal").style.display = "none";
});

document.getElementById("changeRoleForm").addEventListener("submit", async (event) => {
    event.preventDefault();

    const userId = event.target.dataset.userId;
    const newRole = document.getElementById("roleSelect").value;

    // Update user role via API
    const success = await updateRole(userId, newRole);

    if (success) {
        alert("User role updated successfully!");
        location.reload(); // Reload the page to see the updated roles
    } else {
        alert("Failed to update user role.");
    }

    // Close the modal
    document.getElementById("changeRoleModal").style.display = "none";
});

// Update user role function (API call)
async function updateRole(userId, role) {
    const token = localStorage.getItem('jwt');

    try {
        const response = await fetch(`http://localhost/pbl/api-03/routes/users.php?user_id=${userId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': `Bearer ${token}`,
            },
            body: JSON.stringify({ roleSelect: role }), // Send the new role
        });

        const data = await response.json();

        if (data.status === "success") {
            return true;
        } else {
            console.error("Error updating role:", data.message);
            return false;
        }
    } catch (error) {
        console.error("Error updating role:", error);
        return false;
    }
}
</script>
</body>
</html>
