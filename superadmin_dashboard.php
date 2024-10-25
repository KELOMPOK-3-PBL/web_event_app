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
                <a href="superadmin_dashboard.php"><img src="image/polines_logo.png" alt="Polines Logo" class="w-12 h-12 object-contain cursor-pointer"></a> <!-- Perbaiki ukuran logo -->
                <a href="superadmin_dashboard.php"><span class="ml-3 text-3xl font-bold sidebar-item">Polivent</span></a>
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
                    <a href="superadmin_accountlist_page.php" class="flex items-center space-x-2 hover:bg-blue-600 p-2 rounded">
                        <img src="image/logo_account.png" alt="Accounts" class="w-6 h-6"> <!-- Updated Logo for Accounts -->
                        <span class="sidebar-item">Accounts</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- Sidebar Footer -->
        <div>
            <a href="signin_screen.php" class="flex items-center space-x-2 hover:bg-blue-600 p-2 rounded">
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

        <!-- New Proposed Event Section -->
        <section class="mt-8">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-4xl font-semibold">New Proposed Event</h2>
                <a href="proposed_event.php" class="text-blue-500 hover:underline">See More</a>
            </div>
            <div class="scroll-container">
                <!-- Event Card -->
                <a href="link-to-seminar-techfest.html" class="bg-white rounded-lg shadow-lg p-4 event-card">
                    <img src="image/videotron_semnas.png" alt="Event" class="rounded mb-4">
                    <h3 class="text-lg font-semibold">Seminar Techfest</h3>
                    <div class="mt-4 bg-gray-100 p-4 rounded">
                        <p><strong>Status:</strong> Proposed</p>
                        <p><strong>Location:</strong> Auditorium</p>
                        <p><strong>Date:</strong> 20 Oct 2023</p>
                        <p><strong>Time:</strong> 08:00 - 16:00</p>
                    </div>
                </a>
                <!-- Duplikasi Event Card -->
                <a href="link-to-another-proposed-event.html" class="bg-white rounded-lg shadow-lg p-4 event-card">
                    <img src="image/videotron_semnas.png" alt="Event" class="rounded mb-4">
                    <h3 class="text-lg font-semibold">Another Proposed Event</h3>
                    <div class="mt-4 bg-gray-100 p-4 rounded">
                        <p><strong>Status:</strong> Proposed</p>
                        <p><strong>Location:</strong> Auditorium B</p>
                        <p><strong>Date:</strong> 21 Oct 2023</p>
                        <p><strong>Time:</strong> 10:00 - 12:00</p>
                    </div>
                </a>
                <!-- Tambahkan lebih banyak event card sesuai kebutuhan -->
                <a href="link-to-yet-another-proposed-event.html" class="bg-white rounded-lg shadow-lg p-4 event-card">
                    <img src="image/videotron_semnas.png" alt="Event" class="rounded mb-4">
                    <h3 class="text-lg font-semibold">Yet Another Proposed Event</h3>
                    <div class="mt-4 bg-gray-100 p-4 rounded">
                        <p><strong>Status:</strong> Proposed</p>
                        <p><strong>Location:</strong> Auditorium C</p>
                        <p><strong>Date:</strong> 22 Oct 2023</p>
                        <p><strong>Time:</strong> 11:00 - 13:00</p>
                    </div>
                </a>
                <!-- Tambahan 4 Kartu Baru -->
                <a href="link-to-fourth-proposed-event.html" class="bg-white rounded-lg shadow-lg p-4 event-card">
                    <img src="image/videotron_semnas.png" alt="Event" class="rounded mb-4">
                    <h3 class="text-lg font-semibold">Fourth Proposed Event</h3>
                    <div class="mt-4 bg-gray-100 p-4 rounded">
                        <p><strong>Status:</strong> Proposed</p>
                        <p><strong>Location:</strong> Room 101</p>
                        <p><strong>Date:</strong> 25 Oct 2023</p>
                        <p><strong>Time:</strong> 09:00 - 11:00</p>
                    </div>
                </a>
                <a href="link-to-fifth-proposed-event.html" class="bg-white rounded-lg shadow-lg p-4 event-card">
                    <img src="image/videotron_semnas.png" alt="Event" class="rounded mb-4">
                    <h3 class="text-lg font-semibold">Fifth Proposed Event</h3>
                    <div class="mt-4 bg-gray-100 p-4 rounded">
                        <p><strong>Status:</strong> Proposed</p>
                        <p><strong>Location:</strong> Room 102</p>
                        <p><strong>Date:</strong> 26 Oct 2023</p>
                        <p><strong>Time:</strong> 14:00 - 16:00</p>
                    </div>
                </a>
                <a href="link-to-sixth-proposed-event.html" class="bg-white rounded-lg shadow-lg p-4 event-card">
                    <img src="image/videotron_semnas.png" alt="Event" class="rounded mb-4">
                    <h3 class="text-lg font-semibold">Sixth Proposed Event</h3>
                    <div class="mt-4 bg-gray-100 p-4 rounded">
                        <p><strong>Status:</strong> Proposed</p>
                        <p><strong>Location:</strong> Room 103</p>
                        <p><strong>Date:</strong> 27 Oct 2023</p>
                        <p><strong>Time:</strong> 10:00 - 12:00</p>
                    </div>
                </a>
                <a href="link-to-seventh-proposed-event.html" class="bg-white rounded-lg shadow-lg p-4 event-card">
                    <img src="image/videotron_semnas.png" alt="Event" class="rounded mb-4">
                    <h3 class="text-lg font-semibold">Seventh Proposed Event</h3>
                    <div class="mt-4 bg-gray-100 p-4 rounded">
                        <p><strong>Status:</strong> Proposed</p>
                        <p><strong>Location:</strong> Room 104</p>
                        <p><strong>Date:</strong> 28 Oct 2023</p>
                        <p><strong>Time:</strong> 08:00 - 10:00</p>
                    </div>
                </a>
            </div>
        </section>

        <!-- Available Event Section -->
        <section class="mt-8">
            <div class="flex justify-between items-center mb-4">
            <h2 class="text-4xl font-semibold">Available Event</h2>
                <a href="link-to-more-proposed-events.html" class="text-blue-500 hover:underline">See More</a>
            </div>
            <div class="scroll-container">
                <!-- Event Card -->
                <a href="link-to-business-plan-competition.html" class="bg-white rounded-lg shadow-lg p-4 event-card">
                    <img src="image/videotron_semnas.png" alt="Event" class="rounded mb-4">
                    <h3 class="text-lg font-semibold">Competition: Business Plan</h3>
                    <div class="mt-4 bg-gray-100 p-4 rounded">
                        <p><strong>Status:</strong> Available</p>
                        <p><strong>Location:</strong> GKT VII/05</p>
                        <p><strong>Date:</strong> 23-25 July 2023</p>
                        <p><strong>Time:</strong> 09:00 - 10:00</p>
                    </div>
                </a>
                <!-- Duplikasi Event Card -->
                <a href="link-to-another-available-event.html" class="bg-white rounded-lg shadow-lg p-4 event-card">
                    <img src="image/videotron_semnas.png" alt="Event" class="rounded mb-4">
                    <h3 class="text-lg font-semibold">Another Available Event</h3>
                    <div class="mt-4 bg-gray-100 p-4 rounded">
                        <p><strong>Status:</strong> Available</p>
                        <p><strong>Location:</strong> GKT II/01</p>
                        <p><strong>Date:</strong> 30 Oct 2023</p>
                        <p><strong>Time:</strong> 10:00 - 11:00</p>
                    </div>
                </a>
                <!-- Tambahan Kartu Baru -->
                <a href="link-to-third-available-event.html" class="bg-white rounded-lg shadow-lg p-4 event-card">
                    <img src="image/videotron_semnas.png" alt="Event" class="rounded mb-4">
                    <h3 class="text-lg font-semibold">Third Available Event</h3>
                    <div class="mt-4 bg-gray-100 p-4 rounded">
                        <p><strong>Status:</strong> Available</p>
                        <p><strong>Location:</strong> GKT III/01</p>
                        <p><strong>Date:</strong> 31 Oct 2023</p>
                        <p><strong>Time:</strong> 15:00 - 16:00</p>
                    </div>
                </a>
                <a href="link-to-fourth-available-event.html" class="bg-white rounded-lg shadow-lg p-4 event-card">
                    <img src="image/videotron_semnas.png" alt="Event" class="rounded mb-4">
                    <h3 class="text-lg font-semibold">Fourth Available Event</h3>
                    <div class="mt-4 bg-gray-100 p-4 rounded">
                        <p><strong>Status:</strong> Available</p>
                        <p><strong>Location:</strong> GKT IV/01</p>
                        <p><strong>Date:</strong> 1 Nov 2023</p>
                        <p><strong>Time:</strong> 12:00 - 13:00</p>
                    </div>
                </a>
                <a href="link-to-fifth-available-event.html" class="bg-white rounded-lg shadow-lg p-4 event-card">
                    <img src="image/videotron_semnas.png" alt="Event" class="rounded mb-4">
                    <h3 class="text-lg font-semibold">Fifth Available Event</h3>
                    <div class="mt-4 bg-gray-100 p-4 rounded">
                        <p><strong>Status:</strong> Available</p>
                        <p><strong>Location:</strong> GKT V/01</p>
                        <p><strong>Date:</strong> 2 Nov 2023</p>
                        <p><strong>Time:</strong> 10:00 - 11:00</p>
                    </div>
                </a>
                <a href="link-to-sixth-available-event.html" class="bg-white rounded-lg shadow-lg p-4 event-card">
                    <img src="image/videotron_semnas.png" alt="Event" class="rounded mb-4">
                    <h3 class="text-lg font-semibold">Sixth Available Event</h3>
                    <div class="mt-4 bg-gray-100 p-4 rounded">
                        <p><strong>Status:</strong> Available</p>
                        <p><strong>Location:</strong> GKT VI/01</p>
                        <p><strong>Date:</strong> 3 Nov 2023</p>
                        <p><strong>Time:</strong> 11:00 - 12:00</p>
                    </div>
                </a>
                <a href="link-to-seventh-available-event.html" class="bg-white rounded-lg shadow-lg p-4 event-card">
                    <img src="image/videotron_semnas.png" alt="Event" class="rounded mb-4">
                    <h3 class="text-lg font-semibold">Seventh Available Event</h3>
                    <div class="mt-4 bg-gray-100 p-4 rounded">
                        <p><strong>Status:</strong> Available</p>
                        <p><strong>Location:</strong> GKT VII/01</p>
                        <p><strong>Date:</strong> 4 Nov 2023</p>
                        <p><strong>Time:</strong> 09:00 - 10:00</p>
                    </div>
                </a>
            </div>
        </section>
    </div>

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
