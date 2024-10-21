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
            width: 16rem;
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
            width: 5rem;
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
            display: flex;
            background-color: white;
            margin-bottom: 10px;
            border-radius: 10px;
            padding: 15px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .event-banner {
            width: 150px;
            height: auto;
            border-radius: 8px;
            object-fit: cover;
            margin-right: 15px;
        }

        .event-details {
            flex-grow: 1;
        }

        footer {
            background-color: #2C3E50;
            color: white;
            padding: 1rem;
            text-align: center;
        }

        .see-detail-btn {
            background-color: #4CAF50;
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
        }

        .see-detail-btn:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body class="bg-gray-100">

    <!-- Sidebar (Fixed on Left Side) -->
    <div id="sidebar" class="bg-blue-500 w-16 h-screen fixed left-0 top-0 flex flex-col justify-between p-4 text-white">
        <div>
            <!-- Sidebar Header (Logo and Polivent) -->
            <div class="flex items-center mb-12">
                <img src="../image/polines_logo.png" alt="Polines Logo" class="w-12 h-12 object-contain cursor-pointer">
                <span class="ml-3 text-3xl font-bold sidebar-item">Polivent</span>
            </div>

            <!-- My Profile Section with spacing -->
            <div class="flex items-center mb-6">
                <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center text-blue-500 font-bold">
                    <span>U</span>
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
                    <a href="account_page.php" class="flex items-center space-x-2 hover:bg-blue-600 p-2 rounded">
                        <img src="../image/logo_account.png" alt="Accounts" class="w-6 h-6">
                        <span class="sidebar-item">Accounts</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- Sidebar Footer -->
        <div>
            <a href="#" class="flex items-center space-x-2 hover:bg-blue-600 p-2 rounded">
                <i class="fas fa-sign-out-alt"></i>
                <span class="sidebar-item">Log Out</span>
            </a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="ml-64 p-8">
        <!-- Header Section -->
        <header class="flex justify-between items-center mb-6 bg-[#ADC6FF] w-full p-4 rounded-lg shadow-md">
            <div class="flex items-center space-x-4">
                <button class="text-blue-500 font-semibold">Home</button>
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

        <!-- Event List Section -->
        <section>
            <div class="bg-white p-6 rounded-lg shadow-md mb-6">
                <h2 class="text-2xl font-semibold mb-4">All Events</h2>

                <!-- Event List -->
                <div id="eventList">
                    <!-- Example Event Item 1 -->
                    <div class="event-card">
                        <img src="../image/event_banner2.png" alt="Event 1" class="event-banner"> <!-- Banner Event 1 -->
                        <div class="event-details">
                            <h3 class="text-xl font-bold">Event 1</h3>
                            <p>Date: Nov 12, 2024</p>
                            <p>Location: New York</p>
                            <p>Description: This is the first event showcasing amazing new technology.</p>
                            <button class="see-detail-btn">See Detail</button>
                        </div>
                    </div>

                    <!-- Example Event Item 2 -->
                    <div class="event-card">
                        <img src="../image/videotron_semnas.png" alt="Event 2" class="event-banner"> <!-- Banner Event 2 -->
                        <div class="event-details">
                            <h3 class="text-xl font-bold">Event 2</h3>
                            <p>Date: Dec 5, 2024</p>
                            <p>Location: San Francisco</p>
                            <p>Description: Join us for an exciting seminar on national development.</p>
                            <button class="see-detail-btn">See Detail</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Footer Section -->
    <footer class="flex justify-between items-center mt-12 ml-64">
        <div class="flex items-center">
            <img src="../image/polines_logo.png" alt="Polines Logo" class="h-12 mr-2">
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
