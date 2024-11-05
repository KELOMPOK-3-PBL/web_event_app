<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Event</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <script type="text/javascript" src="../js/available_events.js"></script> <!-- Include the new JS file -->
</head>

<body>
    <!-- Sidebar -->
    <?php include '../component/sidebar_propose.php'; ?>

    <!-- Header -->
    <?php include '../component/header_propose.php'; ?>

    <!-- Main Content -->
    <div class="ml-64 p-8 mt-[120px]">
        <section>
            <h2 class="text-4xl font-semibold">All Available Events</h2>
            <div class="bg-white p-6 rounded-lg shadow-md mb-6">
                <table id="eventTable" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul Event</th>
                            <th>Kategori</th>
                            <th>Tempat</th>
                            <th>Waktu</th>
                            <th>Detail Informasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Rows will be populated here by JavaScript -->
                    </tbody>
                </table>
            </div>
        </section>
    </div>

    <!-- Footer -->
    <?php include '../component/footer.php'; ?>

    <!-- Initialize DataTables -->
    <script>
    document.addEventListener('DOMContentLoaded', async () => {
        const eventsUrl = 'http://localhost:80/pbl/api-03/routes/available_events.php'; // Your API URL
        const events = await fetchEvents(eventsUrl);
        populateEventTable(events);

        // Initialize DataTables after populating the table
        $('#eventTable').DataTable({
            "columnDefs": [
                { "orderable": false, "targets": 0 } // Disable sorting on the No column
            ],
            "order": [[ 0, 'asc' ]], // Default order by the event title
            "paging": true, // Enable pagination
            "lengthChange": true, // Enable changing number of entries per page
            "pageLength": 5, // Default entries per page
            "lengthMenu": [ [5, 15, 25, 50], [5, 15, 25, 50] ], // Options for entries per page
            "language": {
                "paginate": {
                    "previous": "Previous",
                    "next": "Next"
                }
            }
        });
    });
    </script>
</body>
</html>
