<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Event</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Tambahkan DataTables CSS dan JavaScript -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
</head>

<body>
    <!-- Sidebar -->
    <?php include '../component/sidebar_admin.php'; ?>

    <!-- Header -->
    <?php include '../component/header_admin.php'; ?>

    <!-- Main Content -->
    <div class="ml-64 p-8 mt-[120px]">
        <section>
            <h2 class="text-4xl font-semibold">All Available Events</h2>
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

    <!-- Inisialisasi DataTables -->
    <script>
document.addEventListener('DOMContentLoaded', async () => {
    const eventsUrl = 'http://localhost:80/web_event_app/api-03/routes/available_events.php'; // URL API
    const events = await fetchEvents(eventsUrl); // Ambil data acara
    populateEventTable(events); // Tampilkan data ke tabel

    // Inisialisasi DataTables setelah mengisi tabel
    $('#eventTable').DataTable({
        "columnDefs": [
            { "orderable": false, "targets": 0 } // Nonaktifkan sorting pada kolom No
        ],
        "order": [[ 1, 'asc' ]], // Urutkan berdasarkan kolom Judul Event secara default
        "paging": true, // Aktifkan pagination
        "lengthChange": true, // Aktifkan pilihan jumlah data per halaman
        "pageLength": 5, // Set jumlah data per halaman awalnya
        "lengthMenu": [ [5, 10, 15], [5, 10, 15] ], // Pilihan entries menjadi 5, 10, 15
        "language": {
            "paginate": {
                "previous": "Previous",
                "next": "Next"
            }
        }
    }).on('order.dt search.dt', function () {
        // Tambahkan nomor urut pada kolom No secara dinamis
        let table = $('#eventTable').DataTable();
        table.column(0, { search: 'applied', order: 'applied' }).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1;
        });
    }).draw();
});

// Fungsi untuk mengambil data acara dari API
async function fetchEvents(url) {
    try {
        const response = await fetch(url);
        const data = await response.json();
        if (data.status === 'success') {
            return data.data; // Return data acara jika status 'success'
        } else {
            console.error('Failed to fetch events:', data.message);
            return [];
        }
    } catch (error) {
        console.error('Error fetching events:', error);
        return [];
    }
}

// Fungsi untuk memasukkan data acara ke dalam tabel
function populateEventTable(events) {
    const tableBody = document.querySelector('#eventTable tbody');
    tableBody.innerHTML = ''; // Kosongkan tabel sebelumnya

    events.forEach(event => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td></td>
            <td>${event.title}</td>
            <td>${event.category}</td>
            <td>${event.place}</td>
            <td>${new Date(event.date_start).toLocaleString()}</td>
            <td class="text-center">
                <a href="admin_detail_event.php?event_id=${event.event_id}" class="text-blue-600 hover:text-blue-800">Cek Event</a>
            </td>
        `;
        tableBody.appendChild(row);
    });
}
</script>
</body>
</html>