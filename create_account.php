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
    <div class="ml-64 p-8 main-content">
    <!-- Header -->
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

    <!-- Create New Account Form -->
    <div class="bg-white p-6 rounded-lg shadow-lg w-3/4 mx-auto mt-24">
        <div class="flex justify-between">
            <!-- Back Button -->
            <a href="account_page.php">
                <button class="bg-gray-200 p-2 rounded-full">
                    <i class="fas fa-arrow-left"></i> Back
                </button>
            </a>
            <!-- Title -->
            <h2 class="text-2xl font-bold">CREATE NEW ACCOUNT</h2>
        </div>
        <div class="flex mt-6">
            <!-- Profile Image -->
            <div class="w-1/3 flex justify-center items-center">
                <div class="border-2 border-gray-300 rounded-full p-16"> <!-- Increase padding to make it bigger -->
                    <i class="fas fa-user fa-10x"></i> <!-- Increase icon size to fa-10x -->
                </div>
            </div>
            <!-- Form Section -->
            <div class="w-2/3 ml-8">
                <form>
                    <!-- Username Field -->
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm mb-2">Username</label>
                        <div class="flex items-center border border-gray-300 rounded-md p-2">
                            <i class="fas fa-user text-gray-500"></i>
                            <input type="text" placeholder="Username" class="ml-2 w-full outline-none">
                        </div>
                    </div>
                    <!-- Email Address Field -->
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm mb-2">Email Address</label>
                        <div class="flex items-center border border-gray-300 rounded-md p-2">
                            <i class="fas fa-envelope text-gray-500"></i>
                            <input type="email" placeholder="Email Address" class="ml-2 w-full outline-none">
                        </div>
                    </div>
                    <!-- Password Field -->
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm mb-2">Password</label>
                        <div class="flex items-center border border-gray-300 rounded-md p-2">
                            <i class="fas fa-lock text-gray-500"></i>
                            <input type="password" placeholder="Password" class="ml-2 w-full outline-none">
                            <i class="fas fa-eye text-gray-500 cursor-pointer"></i> <!-- Password visibility toggle -->
                        </div>
                    </div>
                    <!-- Role Assigned Field -->
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm mb-2">Role Assigned</label>
                        <div class="flex items-center border border-gray-300 rounded-md p-2">
                            <i class="fas fa-key text-gray-500"></i>
                            <select class="ml-2 w-full outline-none">
                                <option value="">Select Role</option>
                                <option value="admin">Admin</option>
                                <option value="user">Member</option>
                                <option value="user">Proposed</option>
                            </select>
                        </div>
                    </div>
                    <!-- Submit Button -->
                    <div class="flex justify-end mt-6">
                    <a href="account_page.php" class="bg-gray-800 text-white px-4 py-2 rounded-md flex items-center">
                        Create <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
        <!-- Footer -->
        <footer class="bg-gray-800 text-white py-3 mt-10 flex justify-center items-center space-x-3">
                    <img src="../image/polines_logo.png" alt="Polines Logo" class="w-8 h-8">
                    <p>© 2024 Polines Event Dashboard. All rights reserved.</p>
                </footer>

        
</body>
</html>
