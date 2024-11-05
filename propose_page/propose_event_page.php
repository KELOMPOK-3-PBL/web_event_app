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
    <?php include '../component/sidebar_propose.php'; ?>

    <!-- Header -->
    <?php include '../component/header_propose.php'; ?>

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
                        <tr>
                            <td></td> <!-- Nomor otomatis akan diisi oleh DataTables -->
                            <td>Techomfest</td>
                            <td>Seminar</td>
                            <td>GKT Lt. 2</td>
                            <td>12 Desember 2024</td>
                            <td class="text-center"><a href="#">Cek Event</a></td>
                        </tr>
                        <tr>
                            <td></td> <!-- Nomor otomatis akan diisi oleh DataTables -->
                            <td>Techomfest</td>
                            <td>Seminar</td>
                            <td>GKT Lt. 2</td>
                            <td>12 Desember 2024</td>
                            <td class="text-center"><a href="#">Cek Event</a></td>
                        </tr>
                        <tr>
                            <td></td> <!-- Nomor otomatis akan diisi oleh DataTables -->
                            <td>Techomfest</td>
                            <td>Seminar</td>
                            <td>GKT Lt. 2</td>
                            <td>12 Desember 2024</td>
                            <td class="text-center"><a href="#">Cek Event</a></td>
                        </tr>
                        <tr>
                            <td></td> <!-- Nomor otomatis akan diisi oleh DataTables -->
                            <td>Techomfest</td>
                            <td>Seminar</td>
                            <td>GKT Lt. 2</td>
                            <td>12 Desember 2024</td>
                            <td class="text-center"><a href="#">Cek Event</a></td>
                        </tr>
                        <tr>
                            <td></td> <!-- Nomor otomatis akan diisi oleh DataTables -->
                            <td>Techomfest</td>
                            <td>Seminar</td>
                            <td>GKT Lt. 2</td>
                            <td>12 Desember 2024</td>
                            <td class="text-center"><a href="#">Cek Event</a></td>
                        </tr>
                        <tr>
                            <td></td> <!-- Nomor otomatis akan diisi oleh DataTables -->
                            <td>Techomfest</td>
                            <td>Seminar</td>
                            <td>GKT Lt. 2</td>
                            <td>12 Desember 2024</td>
                            <td class="text-center"><a href="#">Cek Event</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
    </div>

    <!-- Footer -->
    <?php include '../component/footer.php'; ?>

    <!-- Inisialisasi DataTables -->
    <script>
    $(document).ready(function() {
        $('#eventTable').DataTable({
            "columnDefs": [
                { "orderable": false, "targets": 0 } // Nonaktifkan sorting pada kolom No
            ],
            "order": [[ 1, 'asc' ]], // Urutkan berdasarkan kolom Name secara default
            "paging": true, // Aktifkan pagination
            "lengthChange": true, // Aktifkan pilihan jumlah data per halaman
            "pageLength": 5, // Set jumlah data per halaman awalnya
            "lengthMenu": [ [5, 15, 25, 50], [5, 15, 25, 50] ], // Pilihan entries menjadi 5, 15, 25, 50
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
</script>
</body>
</html>