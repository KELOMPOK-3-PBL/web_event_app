<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile & Dashboard</title>
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

        html,
        body {
            height: 100%;
            margin: 0;
        }

        body {
            display: flex;
            flex-direction: column;
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
            min-width: 250px;
            margin-right: 1rem;
        }

        .main-content {
            flex: 1;
        }

        footer {
            background-color: #2C3E50;
            color: white;
            padding: 1rem;
            text-align: center;
            width: 100%;
        }
    </style>
</head>

<body class="bg-gray-100">

    <!-- Sidebar -->
    <div id="sidebar" class="bg-blue-500 w-16 h-screen fixed left-0 top-0 flex flex-col justify-between p-4 text-white">
        <div>
            <div class="flex items-center mb-12">
                <a href="superadmin_dashboard.php"><img src="image/polines_logo.png" alt="Polines Logo" class="w-12 h-12 object-contain cursor-pointer"></a>
                <a href="superadmin_dashboard.php"><span class="ml-3 text-3xl font-bold sidebar-item">Polivent</span></a>
            </div>
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
            <div class="divider"></div>
            <ul>
                <li class="mb-4">
                    <a href="superadmin_dashboard.php" class="flex items-center space-x-2 hover:bg-blue-600 p-2 rounded">
                        <img src="image/logo_explore.png" alt="Explore" class="w-6 h-6">
                        <span class="sidebar-item">Explore</span>
                    </a>
                </li>
                <li class="mb-4">
                    <a href="superadmin_event_page.php" class="flex items-center space-x-2 hover:bg-blue-600 p-2 rounded">
                        <img src="image/logo_calendar.png" alt="Event" class="w-6 h-6">
                        <span class="sidebar-item">Event</span>
                    </a>
                </li>
                <li class="mb-4">
                    <a href="#" class="flex items-center space-x-2 hover:bg-blue-600 p-2 rounded">
                        <img src="image/logo_approval.png" alt="Approval" class="w-6 h-6">
                        <span class="sidebar-item">Approval</span>
                    </a>
                </li>
                <li class="mb-4">
                    <a href="superadmin_accountlist_page.php" class="flex items-center space -x-2 hover:bg-blue-600 p-2 rounded">
                        <img src="image/logo_account.png" alt="Accounts" class="w-6 h-6">
                        <span class="sidebar-item">Accounts</span>
                    </a>
                </li>
            </ul>
        </div>
        <div>
            <a href="signin_screen.php" class="flex items-center space-x-2 hover:bg-blue-600 p-2 rounded">
                <i class="fas fa-sign-out-alt"></i>
                <span class="sidebar-item">Log Out</span>
            </a>
        </div>
    </div>

    <!-- Main Content -->
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

        <!-- My Profile Section -->
        <div class="bg-white shadow-md rounded-lg p-8">
            <div class="flex justify-between items-center">
                <!-- Profile Image -->
                <div class="w-1/4 flex justify-center items-center">
                    <div class="border-2 border-gray-300 rounded-full p-8">
                        <i class="fas fa-user fa-10x"></i> <!-- Placeholder Icon for Profile -->
                    </div>
                </div>

                <!-- Profile Details -->
                <div class="w-3/4 px-6">
                    <!-- Username -->
                <div class="flex justify-between items-center mb-4">
                    <h1 class="text-3xl font-bold">Username123</h1> <!-- Username -->
                    <i class="fas fa-cog text-blue-500 hover:text-blue-700 text-2xl"></i> <!-- Ikon Setting yang diperbesar -->
                </div>

                    <!-- About Me Section -->
                    <div>
                        <h2 class="text-xl font-semibold mb-2">About Me</h2>
                        <p>
                            I am a student with a strong interest in mobile app development, UI/UX design, and gaming. I also enjoy competing in the fields of technology and design, constantly striving to improve my skills.
                            <a href="#" class="text-blue-500 font-semibold">Read More</a>
                        </p>
                    </div>
                </div>
            </div>
    

        </div>

        <div class="bg-white shadow-md rounded-lg p-8">
    <h2 class="text-2xl font-semibold mb-6">System Statistics</h2>
    
    <!-- Stats Container -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Total Users -->
        <div class="bg-blue-500 text-white p-6 rounded-lg shadow-md flex items-center justify-between">
            <div>
                <h3 class="text-lg font-semibold">Total Users</h3>
                <p class="text-4xl font-bold mt-2">1,452</p>
            </div>
            <i class="fas fa-users fa-2x"></i>
        </div>
        
        <!-- Active Events -->
        <div class="bg-green-500 text-white p-6 rounded-lg shadow-md flex items-center justify-between">
            <div>
                <h3 class="text-lg font-semibold">Active Events</h3>
                <p class="text-4xl font-bold mt-2">34</p>
            </div>
            <i class="fas fa-calendar-check fa-2x"></i>
        </div>
        
        <!-- System Health -->
        <div class="bg-red-500 text-white p-6 rounded-lg shadow-md flex items-center justify-between">
            <div>
                <h3 class="text-lg font-semibold">System Health</h3>
                <p class="text-4xl font-bold mt-2">Good</p>
            </div>
            <i class="fas fa-heartbeat fa-2x"></i>
        </div>
    </div>

    <!-- Additional Stats -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-8">
        <!-- Server Uptime -->
        <div class="bg-yellow-500 text-white p-6 rounded-lg shadow-md flex items-center justify-between">
            <div>
                <h3 class="text-lg font-semibold">Server Uptime</h3>
                <p class="text-4xl font-bold mt-2">99.9%</p>
            </div>
            <i class="fas fa-server fa-2x"></i>
        </div>
        
        <!-- Database Queries -->
        <div class="bg-purple-500 text-white p-6 rounded-lg shadow-md flex items-center justify-between">
            <div>
                <h3 class="text-lg font-semibold">Database Queries</h3>
                <p class="text-4xl font-bold mt-2">1,234,567</p>
            </div>
            <i class="fas fa-database fa-2x"></i>
        </div>
    </div>
</div>

    </div>

    <script>
        function toggleSearch() {
            const searchBar = document.getElementById('searchBar');
            searchBar.classList.toggle('search-bar-visible');
        }
    </script>
</body>

</html>