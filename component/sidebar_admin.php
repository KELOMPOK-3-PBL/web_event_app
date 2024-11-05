<!-- sidebar.php -->
<div id="sidebar" class="bg-blue-500 w-64 h-screen fixed left-0 top-0 flex flex-col justify-between p-4 text-white z-10">
    <div>

        <!-- Divider -->
        <div class="border-t border-white/50 my-8 mt-[105px]"></div>
         <!-- My Profile Section -->
         <div class="flex items-center mb-6">
            <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center text-blue-500 font-bold">
                <span>U</span>
            </div>
            <div class="ml-3">
                <a href="admin_profile.php" class="text-lg font-semibold">
                    <p>Username123</p>
                </a>
            </div>
        </div>
        <!-- Menu Items -->
        <ul>
            <li class="mb-4">
                <a href="admin_dashboard.php" class="flex items-center space-x-2 hover:bg-blue-600 p-2 rounded">
                    <img src="../image/logo_explore.png" alt="Explore" class="w-6 h-6">
                    <span>Explore</span>
                </a>
            </li>
            <li class="mb-4">
                <a href="admin_event_page.php" class="flex items-center space-x-2 hover:bg-blue-600 p-2 rounded">
                    <img src="../image/logo_calendar.png" alt="Event" class="w-6 h-6">
                    <span>Event</span>
                </a>
            </li>
            <li class="mb-4">
                <a href="admin_approval_page.php" class="flex items-center space-x-2 hover:bg-blue-600 p-2 rounded">
                    <img src="../image/logo_approval.png" alt="Approval" class="w-6 h-6">
                    <span>Approval</span>
                </a>
            </li>
        </ul>
    </div>

    <!-- Sidebar Footer -->
    <div>
        <a href="../signin_screen.php" class="flex items-center space-x-2 hover:bg-blue-600 p-2 rounded">
            <i class="fas fa-sign-out-alt"></i>
            <span>Log Out</span>
        </a>
    </div>
</div>
