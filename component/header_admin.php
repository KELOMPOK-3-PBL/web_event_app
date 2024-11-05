<!-- header.php -->
<header class="w-full h-[120px] mb-6 bg-blue-500 p-4 fixed top-0 left-0 z-20 flex items-center justify-between">
    <div class="flex items-center space-x-4">
        <!-- Logo and Polivent Text -->
        <a href="admin_dashboard.php" class="flex items-center">
            <img src="../image/polines_logo.png" alt="Polines Logo" class="w-20 h-20 object-contain">
            <span class="ml-3 text-4xl font-bold text-white">Polivent</span>
        </a>
        <!-- Home Button
        <a href="superadmin_dashboard.php" class="text-blue-500 font-semibold">
            <button>Home</button>
        </a> -->
    </div>
    
    <!-- Search Bar -->
    <div class="flex items-center">
        <button id="toggleSearch" class="text-white">
            <i class="fas fa-search"></i>
        </button>
        <div id="searchBar" class="flex items-center ml-2">
            <input type="text" placeholder="Search..." class="border p-2 rounded">
        </div>
    </div>
</header>

<script>
    // Toggle search bar visibility
    document.getElementById("toggleSearch").addEventListener("click", function () {
        const searchBar = document.getElementById("searchBar");
        searchBar.classList.toggle("flex"); // Toggle visibility using `flex`
    });
</script>
