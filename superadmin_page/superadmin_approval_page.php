<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Approval Event</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Tambahkan DataTables CSS dan JavaScript -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
</head>

<body>
    <!-- Sidebar -->
    <?php include '../component/sidebar_superadmin.php'; ?>

    <!-- Header -->
    <?php include '../component/header_superadmin.php'; ?>

    <!-- Main Content -->
    <div class="ml-64 p-8 mt-[120px]">
        <section>
            <h2 class="text-4xl font-semibold">Approval Events</h2>
            <div class="bg-white p-6 rounded-lg shadow-md mb-6">
                <!-- Tabel Data Events -->
                <table id="eventTable" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th> <!-- Kolom Nomor -->
                            <th>Judul Event</th>
                            <th>Kategori</th>
                            <th>Tempat</th>
                            <th>Waktu</th>
                            <th>Status</th>
                            <th>Detail Informasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- diisi oleh js -->
                    </tbody>
                </table>
            </div>
        </section>
    </div>

    <!-- Footer -->
    <?php include '../component/footer.php'; ?>

    <!-- Inisialisasi DataTables -->
    <script>
    $(document).ready(function () {
    // Konsumsi API
    const apiUrl = 'http://localhost:80/web_event_app/api-03/routes/events.php?admin_user_id=10';
    // id ne masih statis
    
    fetch(apiUrl)
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                const events = data.data;
                const table = $('#eventTable').DataTable({
                    columnDefs: [
                        { orderable: false, targets: 0 } // Nonaktifkan sorting pada kolom No
                    ],
                    order: [[1, 'asc']], // Urutkan berdasarkan kolom kedua (Judul Event)
                    paging: true,
                    lengthChange: true,
                    pageLength: 5,
                    lengthMenu: [[5, 10, 15], [5, 10, 15]],
                    language: {
                        paginate: {
                            previous: 'Previous',
                            next: 'Next',
                        },
                    },
                });

                // Tambahkan data ke tabel
                events.forEach((event, index) => {
                    table.row.add([
                        '', // Kolom No (akan diperbarui nanti)
                        event.title,
                        event.category,
                        `${event.location}, ${event.place}`,
                        `${event.date_start} - ${event.date_end}`,
                        event.status,
                        `<a href="detail_event.html?event_id=${event.event_id}" class="text-blue-500 underline">View Details</a>`
                    ]);
                });

                // Perbarui tabel dengan data
                table.draw();

                // Tambahkan warna pada status setelah data dimuat
                table.column(5).nodes().each(function (cell) {
                    const status = cell.innerText.toLowerCase();
                    cell.className = 'px-2 py-1 rounded text-center font-bold'; // Reset kelas sebelumnya
                    if (status === 'proposed') {
                        cell.classList.add('bg-blue-500', 'text-white');
                    } else if (status === 'pending') {
                        cell.classList.add('bg-yellow-500', 'text-white');
                    } else if (status === 'approved') {
                        cell.classList.add('bg-green-500', 'text-white');
                    } else if (status === 'rejected') {
                        cell.classList.add('bg-red-500', 'text-white');
                    }
                });

                // Perbarui nomor kolom No
                table.column(0, { search: 'applied', order: 'applied' })
                    .nodes()
                    .each(function (cell, i) {
                        cell.innerHTML = i + 1;
                    });
            } else {
                console.error('Failed to retrieve events:', data.message);
            }
        })
        .catch(error => console.error('Error fetching data:', error));
});


</script>
</body>
</html>