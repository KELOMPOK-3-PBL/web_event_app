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
    <script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
</head>

<body>
    <!-- Sidebar -->
    <?php include '../component/sidebar_superadmin.php'; ?>

    <!-- Header -->
    <?php include '../component/header_superadmin.php'; ?>

    <!-- Main Content -->
    <div class="ml-64 p-8 mt-[120px]">
        <section>
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-4xl font-semibold">Account List</h2>
                <!-- Tombol untuk membuka modal upload file -->
                <div class="flex justify-end space-x-4">
                    <button id="createUserButton"
                        class="px-4 py-2 bg-green-500 text-white font-semibold rounded-lg hover:bg-green-700">
                        Create User
                    </button>
                    <button id="uploadFileButton"
                        class="px-4 py-2 bg-yellow-500 text-white font-semibold rounded-lg hover:bg-yellow-700">
                        Upload Spreadsheet
                    </button>
                </div>
            </div>

            <!-- Modal to create new user -->
            <div id="createUserModal" class="modal">
                <div class="modal-content">
                    <span id="closeCreateUserModal" class="close">&times;</span>
                    <h2>Create New User</h2>
                    <form id="createUserForm">
                        <div>
                            <label for="username">Username:</label>
                            <input type="text" id="username" name="username" required
                                class="border rounded px-4 py-2 w-full">
                        </div>
                        <div>
                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" required
                                class="border rounded px-4 py-2 w-full">
                        </div>
                        <div>
                            <label for="password">Password:</label>
                            <input type="password" id="password" name="password" required
                                class="border rounded px-4 py-2 w-full">
                        </div>
                        <div>
                            <label for="roles">Roles (comma-separated):</label>
                            <input type="text" id="roles" name="roles" placeholder="e.g., 1,2,3" required
                                class="border rounded px-4 py-2 w-full">
                        </div>
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white font-semibold rounded-lg mt-4">
                            Create User
                        </button>
                    </form>
                </div>
            </div>

            <!-- Modal untuk upload file -->
            <div id="uploadFileModal" class="modal">
                <div class="modal-content">
                    <span id="closeUploadFileModal" class="close">&times;</span>
                    <h2>Upload Spreadsheet</h2>
                    <form id="uploadFileForm" enctype="multipart/form-data">
                        <div>
                            <label for="file">Upload File:</label>
                            <input type="file" id="file" name="file" accept=".xlsx,.xls" required
                                class="border rounded px-4 py-2 w-full">
                        </div>
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white font-semibold rounded-lg mt-4">
                            Upload
                        </button>
                    </form>
                </div>
            </div>

            <!-- Table to display account list -->
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
                <!-- Hidden field to store userId -->
                <input type="hidden" id="hiddenUserId" name="user_id">

                <label>Select Roles:</label>
                <div>
                    <label>
                        <input type="checkbox" name="role" value=1> Member
                    </label>
                </div>
                <div>
                    <label>
                        <input type="checkbox" name="role" value=2> Propose
                    </label>
                </div>
                <div>
                    <label>
                        <input type="checkbox" name="role" value=3> Admin
                    </label>
                </div>
                <br>
                <button type="submit" class="px-4 py-2 bg-green-500 text-white font-semibold rounded-lg">Update
                    Roles</button>
            </form>
        </div>
    </div>

    <!-- Add some basic CSS for the modal -->
    <style>
        .modal {
            display: none;
            /* Hidden by default */
            position: fixed;
            z-index: 1;
            /* Sit on top */
            left: 120px;
            top: 0;
            width: 100%;
            /* Full width */
            height: 100%;
            /* Full height */
            overflow: auto;
            /* Enable scroll if needed */
            background-color: rgb(0, 0, 0);
            /* Fallback color */
            background-color: rgba(0, 0, 0, 0.4);
            /* Black w/ opacity */
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
        // // Fungsi untuk memeriksa apakah pengguna sudah login
        // function checkLoginStatus() {
        //     const token = localStorage.getItem('access_token'); // Ambil token dari localStorage

        //     if (!token) {
        //         // Jika token tidak ada, arahkan ke halaman sign-in
        //         window.location.href = '../signin_screen.php'; // Ubah sesuai dengan lokasi halaman sign-in
        //     } else {
        //         // Jika token ada, lakukan verifikasi lebih lanjut jika diperlukan
        //         const decoded = parseJwt(token); // Dekode JWT untuk verifikasi lebih lanjut
        //         if (!decoded || new Date(decoded.exp * 1000) < new Date()) {
        //             // Jika token kadaluarsa atau invalid, arahkan kembali ke login
        //             localStorage.removeItem('access_token'); // Hapus token yang tidak valid
        //             window.location.href = 'signin_screen.php'; // Arahkan ke halaman login
        //         }
        //     }
        // }

        // Fungsi untuk mendekode JWT (seperti yang ada sebelumnya)
        function parseJwt(token) {
            try {
                const base64Url = token.split('.')[1];
                const base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
                const jsonPayload = decodeURIComponent(atob(base64).split('').map(function (c) {
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

        // Open modal
        document.getElementById('createUserButton').addEventListener('click', () => {
            document.getElementById('createUserModal').style.display = 'block';
        });

        // Close modal
        document.getElementById('closeCreateUserModal').addEventListener('click', () => {
            document.getElementById('createUserModal').style.display = 'none';
        });

        window.addEventListener('click', (event) => {
            if (event.target === document.getElementById('createUserModal')) {
                document.getElementById('createUserModal').style.display = 'none';
            }
        });

        // Handle form submission
        document.getElementById('createUserForm').addEventListener('submit', async (event) => {
            event.preventDefault();

            const formData = new FormData(event.target);
            const token = localStorage.getItem('access_token'); // Adjust if token is stored differently

            try {
                const response = await fetch('http://localhost/pbl/api-03/routes/users.php', {
                    method: 'POST',
                    headers: {
                        'Authorization': `Bearer ${token}`, // Add token for authentication
                    },
                    body: formData,
                });

                if (response.ok) {
                    const result = await response.json();
                    alert('User successfully created!');
                    document.getElementById('createUserModal').style.display = 'none';
                    location.reload(); // Reload page to see updated list
                } else {
                    const error = await response.json();
                    alert(`Error creating user: ${error.message}`);
                }
            } catch (err) {
                console.error('Error:', err);
                alert('An error occurred while creating the user.');
            }
        });

        // Open modal
        document.getElementById('uploadFileButton').addEventListener('click', () => {
            document.getElementById('uploadFileModal').style.display = 'block';
        });

        // Close modal
        document.getElementById('closeUploadFileModal').addEventListener('click', () => {
            document.getElementById('uploadFileModal').style.display = 'none';
        });

        window.addEventListener('click', (event) => {
            if (event.target === document.getElementById('uploadFileModal')) {
                document.getElementById('uploadFileModal').style.display = 'none';
            }
        });

        // Handle file upload form submission
        document.getElementById('uploadFileForm').addEventListener('submit', async (event) => {
            event.preventDefault();

            const formData = new FormData(event.target);
            const token = localStorage.getItem('access_token');

            try {
                const response = await fetch('http://localhost/pbl/api-03/routes/bulk_users.php', {
                    method: 'POST',
                    headers: {
                        'Authorization': `Bearer ${token}`,
                    },
                    body: formData,
                });
                // Read response body once and store it
                const result = await response.json();

                // Debugging: Log the response status and body
                console.log('Response Status:', response.status);
                console.log('Response Body:', result);



                if (response.status === 200) {
                    alert(`Users successfully created: ${result.message}`);
                    document.getElementById('uploadFileModal').style.display = 'none';
                    location.reload();
                } else {
                    alert(`Error uploading file: ${result.message}`);
                }
            } catch (err) {
                console.error('Error:', err);
                alert('An error occurred while uploading the file.');
            }
        });

        // Fungsi untuk mengambil data dari API
        async function fetchUsers(url) {
            const token = localStorage.getItem('access_token'); // Ambil token dari localStorage

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

                changeRoleButton.addEventListener("click", () => {
                    openChangeRoleModal(user.user_id, user.roles); // Call the function
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
            const token = localStorage.getItem('access_token'); // Ambil token dari localStorage
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

        // Modal element
        const modal = document.getElementById('changeRoleModal');
        const closeModalButton = document.getElementById('cancelChangeRole');

        // Function to open modal and set user data
        function openChangeRoleModal(userId, currentRoles) {
            modal.style.display = 'block';

            // Set user_id in a hidden field
            document.getElementById('hiddenUserId').value = userId;

            // Update the checkbox states
            const roleCheckboxes = document.querySelectorAll('input[name="role"]');
            roleCheckboxes.forEach((checkbox) => {
                checkbox.checked = currentRoles.includes(parseInt(checkbox.value, 10));
            });
        }

        // Close modal when clicking "X"
        closeModalButton.addEventListener('click', () => {
            modal.style.display = 'none';
        });

        // Close modal when clicking outside the modal
        window.addEventListener('click', (event) => {
            if (event.target === modal) {
                modal.style.display = 'none';
            }
        });

        // Close modal when pressing the "Esc" key
        window.addEventListener('keydown', (event) => {
            if (event.key === 'Escape') {
                modal.style.display = 'none';
            }
        });

        // Handle form submission in modal
        const form = document.getElementById('changeRoleForm');
        form.addEventListener('submit', async (event) => {
            event.preventDefault(); // Mencegah reload halaman

            // Ambil data dari modal
            const userId = document.getElementById('hiddenUserId').value; // Ambil user_id dari field tersembunyi
            const selectedRoles = Array.from(document.querySelectorAll('input[name="role"]:checked')).map(input => input.value).join(','); // Ambil ID roles

            // Buat FormData untuk pengiriman data
            const formData = new FormData();
            formData.append('roles', selectedRoles); // Kirim hanya roles

            // Ambil token dari localStorage
            const token = localStorage.getItem('access_token');

            try {
                // Kirim data ke endpoint
                const response = await fetch(`http://localhost:80/pbl/api-03/routes/users.php?user_id=${userId}`, {
                    method: 'POST',
                    headers: {
                        'Authorization': `Bearer ${token}`, // Tambahkan token
                    },
                    body: formData, // Kirim FormData
                });

                // Tangani respon dari server
                if (response.ok) {
                    const result = await response.json();
                    alert('Roles berhasil diperbarui!');
                    modal.style.display = 'none'; // Tutup modal setelah sukses
                    location.reload(); // Reload halaman untuk memperbarui data
                } else {
                    const error = await response.text();
                    alert(`Gagal memperbarui roles: ${error}`);
                }
            } catch (err) {
                console.error('Fetch Error:', err);
                alert('Terjadi kesalahan saat menghubungi server.');
            }
        });
    </script>
</body>

</html>