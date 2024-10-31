<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
    .scroll-container {
        display: flex;
        overflow-x: auto; /* Aktifkan scroll horizontal */
        gap: 1rem; /* Spasi antar-kartu */
        padding-bottom: 1rem; /* Tambahkan padding di bawah untuk scroll */
    }
    .event-card {
        flex: 0 0 300px; /* Lebar tetap untuk setiap kartu event */
    }
</style>
</head>

<body>
    <!-- Sidebar -->
    <?php include 'component/sidebar.php'; ?>

    <!-- Header -->
    <?php include 'component/header.php'; ?>

    <div class="ml-64 p-8 mt-[80px]">
    <!-- New Proposed Event Section -->
    <section class="mt-8">
    <div class="flex justify-between items-center mb-4">
            <h2 class="text-4xl font-semibold">New Proposed Event</h2>
            <a href="link-to-more-available-events.html" class="text-blue-500 hover:underline">See More</a>
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
        </div>
    </section>

    <!-- Available Event Section -->
    <section class="mt-8">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-4xl font-semibold">Available Event</h2>
            <a href="superadmin_event_page.php" class="text-blue-500 hover:underline">See More</a>
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
        </div>
    </section>
    </div>

    <!-- Footer -->
    <?php include 'component/footer.php'; ?>
</body>

</html>
