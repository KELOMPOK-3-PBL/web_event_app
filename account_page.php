<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Sidebar hover styles */
        #sidebar {
            transition: width 0.3s;
        }

        #sidebar:hover {
            width: 16rem; /* Width when hovered */
        }
        html, body {
            height: 100%; /* Pastikan tinggi 100% */
            margin: 0; /* Hapus margin default */
        }

        body {
            display: flex; /* Gunakan flexbox */
            flex-direction: column; /* Susun elemen secara vertikal */
        }
        .search-bar {
            max-width: 0;
            opacity: 0;
            transition: max-width 0.5s ease, opacity 0.5s ease;
            overflow: hidden;
            padding: 0 0;
        }

        .search-bar-visible {
            max-width: 300px;
            opacity: 1;
            padding: 0 10px;
        }

        #sidebar:not(:hover) {
            width: 5rem; /* Width when not hovered */
        }

        .sidebar-item {
            display: none;
        }

        #sidebar:hover .sidebar-item {
            display: block;
        }

        .divider {
            height: 1px;
            background-color: rgba(255, 255, 255, 0.5);
            margin: 2rem 0;
        }

        .scroll-container {
            display: flex;
            overflow-x: auto;
            padding: 1rem 0;
            scrollbar-width: none;
        }

        .scroll-container::-webkit-scrollbar {
            display: none;
        }

        .event-card {
            min-width: 250px;
            margin-right: 1rem;
        }
        .main-content {
            flex: 1; /* Buat konten utama mengambil sisa ruang */
        }

        footer {
            background-color: #2C3E50;
            color: white;
            padding: 1rem;
            text-align: center;
            width: 100%; /* Pastikan footer memenuhi lebar */
        }
    </style>
</head>

<body class="bg-gray-100">

    <!-- Sidebar -->
    <div id="sidebar" class="bg-blue-500 w-16 h-screen fixed left-0 top-0 flex flex-col justify-between p-4 text-white">
        <div>
            <div class="flex items-center mb-12">
                <img src="../image/polines_logo.png" alt="Polines Logo" class="w-12 h-12 object-contain cursor-pointer">
                <span class="ml-3 text-3xl font-bold sidebar-item">Polivent</span>
            </div>
            <div class="flex items-center mb-6">
                <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center text-blue-500 font-bold">
                    <span>U</span>
                </div>
                <div class="ml-3 sidebar-item">
                <a href="#" class="text-lg font-semibold">
                    <p>Username123</p>
                </a>

                </div>
            </div>
            <div class="divider"></div>
            <ul>
                <li class="mb-4">
                    <a href="#" class="flex items-center space-x-2 hover:bg-blue-600 p-2 rounded">
                        <img src="../image/logo_explore.png" alt="Explore" class="w-6 h-6">
                        <span class="sidebar-item">Explore</span>
                    </a>
                </li>
                <li class="mb-4">
                    <a href="#" class="flex items-center space-x-2 hover:bg-blue-600 p-2 rounded">
                        <img src="../image/logo_calendar.png" alt="Event" class="w-6 h-6">
                        <span class="sidebar-item">Event</span>
                    </a>
                </li>
                <li class="mb-4">
                    <a href="#" class="flex items-center space-x-2 hover:bg-blue-600 p-2 rounded">
                        <img src="../image/logo_approval.png" alt="Approval" class="w-6 h-6">
                        <span class="sidebar-item">Approval</span>
                    </a>
                </li>
                <li class="mb-4">
                    <a href="#" class="flex items-center space-x-2 hover:bg-blue-600 p-2 rounded">
                        <img src="../image/logo_account.png" alt="Accounts" class="w-6 h-6">
                        <span class="sidebar-item">Accounts</span>
                    </a>
                </li>
            </ul>
        </div>
        <div>
            <a href="#" class="flex items-center space-x-2 hover:bg-blue-600 p-2 rounded">
                <i class="fas fa-sign-out-alt"></i>
                <span class="sidebar-item">Log Out</span>
            </a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="ml-64 p-8 main-content">
        <header class="flex justify-between items-center mb-6 bg-[#ADC6FF] w-full p-4 rounded-lg shadow-md">
            <a href="superadmin_dashboard.php" class="text-blue-500 font-semibold">
                <button>Home</button>
             </a>
            <div class="flex items-center">
                <button id="toggleSearch" class="text-blue-500 hover:text-blue-700" onclick="toggleSearch()">
                <i class="fas fa-search"></i>
                </button>
                <div id="searchBar" class="search-bar flex items-center ml-2">
                    <input type="text" placeholder="Search..." class="border p-2 rounded">
                </div>
            </div>
        </header>

        <!-- Add New Account Button -->
        <!-- <div class="flex justify-end mb-4">
            <a href="create_account.php" class="flex items-center px-4 py-2 bg-green-500 text-white text-sm font-semibold rounded hover:bg-green-600">
            <i class="fas fa-plus mr-2"></i>
            Add New Account
            </a>
        </div> -->

        <h2 class="text-2xl font-bold mb-4">Account List</h2>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white rounded-lg shadow-md" id="accountTable">
                <thead>
                    <tr class="bg-gray-100 border-b">
                        <th class="py-2 px-4 text-left text-sm font-xl text-gray-600">Account</th>
                        <th class="py-2 px-4 text-left text-sm font-xl text-gray-600">Roles</th>
                        <th class="py-2 px-4 text-left text-sm font-xl text-gray-600">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Page 1 -->
                    <tr class="border-b">
                        <td class="py-2 px-4 text-sm text-gray-700">username1</td>
                        <td class="py-2 px-4 text-sm text-gray-700">superadmin</td>
                        <td class="py-2 px-4 text-sm text-gray-700 flex space-x-2">
                            <button class="px-3 py-1 bg-blue-500 text-white text-sm rounded hover:bg-blue-600">Edit role</button>
                            <button class="px-3 py-1 bg-red-500 text-white text-sm rounded hover:bg-red-600">Delete</button>
                        </td>
                    </tr>
                    <tr class="border-b">
                        <td class="py-2 px-4 text-sm text-gray-700">username2</td>
                        <td class="py-2 px-4 text-sm text-gray-700">admin</td>
                        <td class="py-2 px-4 text-sm text-gray-700 flex space-x-2">
                            <button class="px-3 py-1 bg-blue-500 text-white text-sm rounded hover:bg-blue-600">Edit role</button>
                            <button class="px-3 py-1 bg-red-500 text-white text-sm rounded hover:bg-red-600">Delete</button>
                        </td>
                    </tr>
                    <tr class="border-b">
                        <td class="py-2 px-4 text-sm text-gray-700">username3</td>
                        <td class="py-2 px-4 text-sm text-gray-700">admin</td>
                        <td class="py-2 px-4 text-sm text-gray-700 flex space-x-2">
                            <button class="px-3 py-1 bg-blue-500 text-white text-sm rounded hover:bg-blue-600">Edit role</button>
                            <button class="px-3 py-1 bg-red-500 text-white text-sm rounded hover:bg-red-600">Delete</button>
                        </td>
                    </tr>
                    <tr class="border-b">
                        <td class="py-2 px-4 text-sm text-gray-700">username4</td>
                        <td class="py-2 px-4 text-sm text-gray-700">propose</td>
                        <td class="py-2 px-4 text-sm text-gray-700 flex space-x-2">
                            <button class="px-3 py-1 bg-blue-500 text-white text-sm rounded hover:bg-blue-600">Edit role</button>
                            <button class="px-3 py-1 bg-red-500 text-white text-sm rounded hover:bg-red-600">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td class="py-2 px-4 text-sm text-gray-700">username5</td>
                        <td class="py-2 px-4 text-sm text-gray-700">propose</td>
                        <td class="py-2 px-4 text-sm text-gray-700 flex space-x-2">
                            <button class="px-3 py-1 bg-blue-500 text-white text-sm rounded hover:bg-blue-600">Edit role</button>
                            <button class="px-3 py-1 bg-red-500 text-white text-sm rounded hover:bg-red-600">Delete</button>
                        </td>
                    </tr>
                    <!-- Page 2 -->
                    <tr class="border-b">
                        <td class="py-2 px-4 text-sm text-gray-700">username6</td>
                        <td class="py-2 px-4 text-sm text-gray-700">member</td>
                        <td class="py-2 px-4 text-sm text-gray-700 flex space-x-2">
                            <button class="px-3 py-1 bg-blue-500 text-white text-sm rounded hover:bg-blue-600">Edit role</button>
                            <button class="px-3 py-1 bg-red-500 text-white text-sm rounded hover:bg-red-600">Delete</button>
                        </td>
                    </tr>
                    <tr class="border-b">
                        <td class="py-2 px-4 text-sm text-gray-700">username7</td>
                        <td class="py-2 px-4 text-sm text-gray-700">member</td>
                        <td class="py-2 px-4 text-sm text-gray-700 flex space-x-2">
                            <button class="px-3 py-1 bg-blue-500 text-white text-sm rounded hover:bg-blue-600">Edit role</button>
                            <button class="px-3 py-1 bg-red-500 text-white text-sm rounded hover:bg-red-600">Delete</button>
                        </td>
                    </tr>
                    <tr class="border-b">
                        <td class="py-2 px-4 text-sm text-gray-700">username8</td>
                        <td class="py-2 px-4 text-sm text-gray-700">propose</td>
                        <td class="py-2 px-4 text-sm text-gray-700 flex space-x-2">
                            <button class="px-3 py-1 bg-blue-500 text-white text-sm rounded hover:bg-blue-600">Edit role</button>
                            <button class="px-3 py-1 bg-red-500 text-white text-sm rounded hover:bg-red-600">Delete</button>
                        </td>
                    </tr>
                    <tr class="border-b">
                        <td class="py-2 px-4 text-sm text-gray-700">username9</td>
                        <td class="py-2 px-4 text-sm text-gray-700">propose</td>
                        <td class="py-2 px-4 text-sm text-gray-700 flex space-x-2">
                            <button class="px-3 py-1 bg-blue-500 text-white text-sm rounded hover:bg-blue-600">Edit role</button>
                            <button class="px-3 py-1 bg-red-500 text-white text-sm rounded hover:bg-red-600">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td class="py-2 px-4 text-sm text-gray-700">username10</td>
                        <td class="py-2 px-4 text-sm text-gray-700">admin</td>
                        <td class="py-2 px-4 text-sm text-gray-700 flex space-x-2">
                            <button class="px-3 py-1 bg-blue-500 text-white text-sm rounded hover:bg-blue-600">Edit role</button>
                            <button class="px-3 py-1 bg-red-500 text-white text-sm rounded hover:bg-red-600">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4 flex justify-center space-x-2" id="pagination">
            <button onclick="showPage(1)" class="px-3 py-1 bg-blue-500 text-white text-sm rounded hover:bg-blue-600">1</button>
            <button onclick="showPage(2)" class="px-3 py-1 bg-blue-500 text-white text-sm rounded hover:bg-blue-600">2</button>
            <button onclick="showPage(3)" class="px-3 py-1 bg-blue-500 text-white text-sm rounded hover:bg-blue-600">3</button>
        </div>
    </div>

    <!-- Footer -->
                <footer class="bg-gray-800 text-white py-3 mt-10 flex justify-center items-center space-x-3">
                    <img src="../image/polines_logo.png" alt="Polines Logo" class="w-8 h-8">
                    <p>© 2024 Polines Event Dashboard. All rights reserved.</p>
                </footer>

    <script>
        // Pagination logic
        function showPage(page) {
            const rows = document.querySelectorAll('#accountTable tbody tr');
            const rowsPerPage = 5;
            rows.forEach((row, index) => {
                row.style.display = (index >= (page - 1) * rowsPerPage && index < page * rowsPerPage) ? 'table-row' : 'none';
            });
        }
        // Show first page by default
        showPage(1);

        // Toggle search bar visibility
        function toggleSearch() {
            const searchBar = document.getElementById('searchBar');
            searchBar.classList.toggle('search-bar-visible');
        }
    </script>

</body>

</html>
