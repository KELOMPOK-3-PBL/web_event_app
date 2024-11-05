<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <!-- Sidebar -->
    <?php include '../component/sidebar_superadmin.php'; ?>

    <!-- Header -->
    <?php include '../component/header_superadmin.php'; ?>

    <!-- Main Content -->
    <div class="ml-64 p-8 mt-[120px]">

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
                </div>
                <div>
                    <h3>Logged in as Superadmin</h3>
                </div>
                </div>
            </div>
    

        </div>

        <div class="bg-white shadow-md rounded-lg p-8">
            <h2 class="text-2xl font-semibold mb-6">Event Statistik</h2>
            <div class="flex space-x-4 mt-8">
                <!-- Proposed Event Card -->
                <div class="bg-blue-500 text-white p-6 rounded-lg w-1/4">
                    <div class="flex items-center">
                        <span class="text-4xl font-bold">150</span>
                        <span class="ml-2 text-lg">Proposed Events</span>
                    </div>
                    <div class="mt-4 flex items-center justify-between">
                        <a href="superadmin_approval_page.php" class="text-white hover:underline">More info</a>
                        <i class="fas fa-info-circle"></i>
                    </div>
                </div>

                <!-- Pending Event Card -->
                <div class="bg-yellow-500 text-white p-6 rounded-lg w-1/4">
                    <div class="flex items-center">
                        <span class="text-4xl font-bold">53</span>
                        <span class="ml-2 text-lg">Pending Events</span>
                    </div>
                    <div class="mt-4 flex items-center justify-between">
                        <a href="superadmin_approval_page.php" class="text-white hover:underline">More info</a>
                        <i class="fas fa-info-circle"></i>
                    </div>
                </div>

                <!-- Approved Event Card -->
                <div class="bg-green-500 text-white p-6 rounded-lg w-1/4">
                    <div class="flex items-center">
                        <span class="text-4xl font-bold">44</span>
                        <span class="ml-2 text-lg">Approved Events</span>
                    </div>
                    <div class="mt-4 flex items-center justify-between">
                        <a href="superadmin_approval_page.php" class="text-white hover:underline">More info</a>
                        <i class="fas fa-info-circle"></i>
                    </div>
                </div>

                <!-- Rejected Event Card -->
                <div class="bg-red-500 text-white p-6 rounded-lg w-1/4">
                    <div class="flex items-center">
                        <span class="text-4xl font-bold">65</span>
                        <span class="ml-2 text-lg">Rejected Events</span>
                    </div>
                    <div class="mt-4 flex items-center justify-between">
                        <a href="superadmin_approval_page.php" class="text-white hover:underline">More info</a>
                        <i class="fas fa-info-circle"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>
    <!-- Footer -->
    <?php include '../component/footer.php'; ?>
</body>

</html>