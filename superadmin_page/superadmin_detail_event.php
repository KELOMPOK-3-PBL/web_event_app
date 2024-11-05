<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> <!-- Font Awesome -->
    <style>
        /* Sidebar hover styles */
        #sidebar {
            transition: width 0.3s;
        }

        #sidebar:hover {
            width: 16rem; /* Width when hovered */
        }

        .search-bar {
            max-width: 0;
            opacity: 0;
            transition: max-width 0.5s ease, opacity 0.5s ease;
            overflow: hidden;
            padding: 0 0; /* Start with no padding */
        }

        .search-bar-visible {
            max-width: 300px; /* Ubah ini untuk mengatur panjang search bar */
            opacity: 1;
            padding: 0 10px; /* Tambahkan padding saat terlihat */
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

        /* Add this for the divider */
        .divider {
            height: 1px;
            background-color: rgba(255, 255, 255, 0.5); /* White color with some transparency */
            margin: 2rem 0; /* Add some margin */
        }

        /* Scroll container */
        .scroll-container {
            display: flex;
            overflow-x: auto;
            padding: 1rem 0;
            scrollbar-width: none; /* For Firefox */
        }

        .scroll-container::-webkit-scrollbar {
            display: none; /* For Chrome, Safari, and Opera */
        }

        /* Event card styling */
        .event-card {
            min-width: 250px; /* Set minimum width for cards */
            margin-right: 1rem; /* Spacing between cards */
        }

        /* Footer styling */
        footer {
            background-color: #2C3E50; /* Darker background for footer */
            color: white;
            padding: 1rem;
            text-align: center;
        }
    </style>
</head>

<body class="bg-gray-100">

    <!-- Sidebar (Fixed on Left Side) -->
    <div id="sidebar" class="bg-blue-500 w-16 h-screen fixed left-0 top-0 flex flex-col justify-between p-4 text-white">
        <div>
            <!-- Sidebar Header (Logo and Polivent) -->
            <div class="flex items-center mb-12">
                <img src="image/polines_logo.png" alt="Polines Logo" class="w-12 h-12 object-contain cursor-pointer"> <!-- Perbaiki ukuran logo -->
                <span class="ml-3 text-3xl font-bold sidebar-item">Polivent</span>
            </div>

            <!-- My Profile Section with spacing -->
            <div class="flex items-center mb-6">
                <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center text-blue-500 font-bold">
                    <span>U</span> <!-- Initial letter of Username -->
                </div>
                <div class="ml-3 sidebar-item">
                <a href="myProfile.php" class="text-lg font-semibold">
                    <p>Username123</p>
                </a>
                </div>
            </div>

            <!-- Divider -->
            <div class="divider"></div>

            <!-- Menu Items with spacing -->
            <ul>
                <li class="mb-4">
                    <a href="superadmin_dashboard.php" class="flex items-center space-x-2 hover:bg-blue-600 p-2 rounded">
                        <img src="image/logo_explore.png" alt="Explore" class="w-6 h-6"> <!-- Updated Logo for Explore -->
                        <span class="sidebar-item">Explore</span>
                    </a>
                </li>
                <li class="mb-4">
                    <a href="superadmin_event_page.php" class="flex items-center space-x-2 hover:bg-blue-600 p-2 rounded">
                        <img src="image/logo_calendar.png" alt="Event" class="w-6 h-6"> <!-- Updated Logo for Event -->
                        <span class="sidebar-item">Event</span>
                    </a>
                </li>
                <li class="mb-4">
                    <a href="#" class="flex items-center space-x-2 hover:bg-blue-600 p-2 rounded">
                        <img src="image/logo_approval.png" alt="Approval" class="w-6 h-6"> <!-- Updated Logo for Approval -->
                        <span class="sidebar-item">Approval</span>
                    </a>
                </li>
                <li class="mb-4">
                    <a href="account_page.php" class="flex items-center space-x-2 hover:bg-blue-600 p-2 rounded">
                        <img src="image/logo_account.png" alt="Accounts" class="w-6 h-6"> <!-- Updated Logo for Accounts -->
                        <span class="sidebar-item">Accounts</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- Sidebar Footer -->
        <div>
            <a href="#" class="flex items-center space-x-2 hover:bg-blue-600 p-2 rounded">
                <i class="fas fa-sign-out-alt"></i> <!-- Font Awesome Log Out Icon -->
                <span class="sidebar-item">Log Out</span>
            </a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="ml-64 p-8">
        <!-- Header Section -->
        <header class="flex justify-between items-center mb-6 bg-[#ADC6FF] w-full p-4 rounded-lg shadow-md">
            <div class="flex items-center space-x-4">
                <a href="superadmin_dashboard.php" class="text-blue-500 font-semibold">
                    <button">Home</button>
                </a>
            </div>
            <div class="flex items-center">
                <button id="toggleSearch" class="text-blue-500 hover:text-blue-700">
                <i class="fas fa-search"></i>
                </button>
                <div id="searchBar" class="search-bar flex items-center ml-2">
                    <input type="text" placeholder="Search..." class="border p-2 rounded">
                </div>
            </div>
        </header>

    <!-- Footer Section -->
    <footer class="flex justify-between items-center mt-12 ml-64"> <!-- Tambahkan ml-64 untuk memberikan margin-left -->
    <div class="flex items-center">
        <img src="image/polines_logo.png" alt="Polines Logo" class="h-12 mr-2"> <!-- Logo Polines -->
        <span class="font-semibold text-lg">Polivent</span>
    </div>
    <div class="text-right">
        <p>Jl. Prof. Soedarto, Tembalang,</p>
        <p>Kec. Tembalang, Kota Semarang,</p>
        <p>Jawa Tengah 50275</p>
        <p>Telp (024) 7473417</p>
        <p>Email: polines@ac.id</p>
    </div>
</footer>



    <script>
        // Toggle search bar visibility
        document.getElementById("toggleSearch").addEventListener("click", function () {
            const searchBar = document.getElementById("searchBar");
            searchBar.classList.toggle("search-bar-visible");
        });
    </script>
</body>

</html>
