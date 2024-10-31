<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Event</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <!-- Sidebar -->
    <?php include 'component/sidebar.php'; ?>

    <!-- Header -->
    <?php include 'component/header.php'; ?>

    <!-- Main Content -->
    <div class="ml-64 p-8 mt-[80px]">

        <!-- Event List Section -->
        <section>
            <div class="bg-white p-6 rounded-lg shadow-md mb-6">
                <h2 class="text-2xl font-semibold mb-4">All Events</h2>

                <!-- Event List -->
                <div id="eventList">
                    <!-- Example Event Item 1 -->
                    <div class="event-card">
                        <img src="image/event_banner2.png" alt="Event 1" class="event-banner"> <!-- Banner Event 1 -->
                        <div class="event-details">
                            <h3 class="text-xl font-bold">Event 1</h3>
                            <p>Date: Nov 12, 2024</p>
                            <p>Location: New York</p>
                            <p>Description: This is the first event showcasing amazing new technology.</p>
                            <a href="superadmin_detail_event.php"><button class="see-detail-btn">See Detail</button></a>
                        </div>
                    </div>

                    <!-- Example Event Item 2 -->
                    <div class="event-card">
                        <img src="image/videotron_semnas.png" alt="Event 2" class="event-banner"> <!-- Banner Event 2 -->
                        <div class="event-details">
                            <h3 class="text-xl font-bold">Event 2</h3>
                            <p>Date: Dec 5, 2024</p>
                            <p>Location: San Francisco</p>
                            <p>Description: Join us for an exciting seminar on national development.</p>
                            <a href="superadmin_detail_event.php"><button class="see-detail-btn">See Detail</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Footer -->
    <?php include 'component/footer.php'; ?>
</body>
</html>