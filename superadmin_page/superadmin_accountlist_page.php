<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account List</title>
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
            <h2 class="text-4xl font-semibold">Account List</h2>
            <div class="bg-white p-6 rounded-lg shadow-md mb-6">
                <!-- Tabel Data Events -->
                <table id="eventTable" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th> <!-- Kolom Nomor -->
                            <th>Account</th>
                            <th>Roles</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center"></td> <!-- Nomor otomatis akan diisi oleh DataTables -->
                            <td>username1</td>
                            <td>Superadmin</td>
                            <td class="py-2 px-4 text-sm text-gray-700 flex items-center justify-center space-x-2 text-center">
                                <button class="px-3 py-1 bg-blue-500 text-white text-sm rounded hover:bg-blue-600">Edit role</button>
                                <button class="px-3 py-1 bg-red-500 text-white text-sm rounded hover:bg-red-600">Delete</button>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center"></td> <!-- Nomor otomatis akan diisi oleh DataTables -->
                            <td>username2</td>
                            <td>Admin</td>
                            <td class="py-2 px-4 text-sm text-gray-700 flex items-center justify-center space-x-2 text-center">
                                <button class="px-3 py-1 bg-blue-500 text-white text-sm rounded hover:bg-blue-600">Edit role</button>
                                <button class="px-3 py-1 bg-red-500 text-white text-sm rounded hover:bg-red-600">Delete</button>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center"></td> <!-- Nomor otomatis akan diisi oleh DataTables -->
                            <td>username3</td>
                            <td>Admin, Member</td>
                            <td class="py-2 px-4 text-sm text-gray-700 flex items-center justify-center space-x-2 text-center">
                                <button class="px-3 py-1 bg-blue-500 text-white text-sm rounded hover:bg-blue-600">Edit role</button>
                                <button class="px-3 py-1 bg-red-500 text-white text-sm rounded hover:bg-red-600">Delete</button>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center"></td> <!-- Nomor otomatis akan diisi oleh DataTables -->
                            <td>username4</td>
                            <td>Propose</td>
                            <td class="py-2 px-4 text-sm text-gray-700 flex items-center justify-center space-x-2 text-center">
                                <button class="px-3 py-1 bg-blue-500 text-white text-sm rounded hover:bg-blue-600">Edit role</button>
                                <button class="px-3 py-1 bg-red-500 text-white text-sm rounded hover:bg-red-600">Delete</button>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center"></td> <!-- Nomor otomatis akan diisi oleh DataTables -->
                            <td>username5</td>
                            <td>Member</td>
                            <td class="py-2 px-4 text-sm text-gray-700 flex items-center justify-center space-x-2 text-center">
                                <button class="px-3 py-1 bg-blue-500 text-white text-sm rounded hover:bg-blue-600">Edit role</button>
                                <button class="px-3 py-1 bg-red-500 text-white text-sm rounded hover:bg-red-600">Delete</button>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center"></td> <!-- Nomor otomatis akan diisi oleh DataTables -->
                            <td>username6</td>
                            <td>Admin, Propose</td>
                            <td class="py-2 px-4 text-sm text-gray-700 flex items-center justify-center space-x-2 text-center">
                                <button class="px-3 py-1 bg-blue-500 text-white text-sm rounded hover:bg-blue-600">Edit role</button>
                                <button class="px-3 py-1 bg-red-500 text-white text-sm rounded hover:bg-red-600">Delete</button>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center"></td> <!-- Nomor otomatis akan diisi oleh DataTables -->
                            <td>username7</td>
                            <td>Member</td>
                            <td class="py-2 px-4 text-sm text-gray-700 flex items-center justify-center space-x-2 text-center">
                                <button class="px-3 py-1 bg-blue-500 text-white text-sm rounded hover:bg-blue-600">Edit role</button>
                                <button class="px-3 py-1 bg-red-500 text-white text-sm rounded hover:bg-red-600">Delete</button>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center"></td> <!-- Nomor otomatis akan diisi oleh DataTables -->
                            <td>username8</td>
                            <td>Member</td>
                            <td class="py-2 px-4 text-sm text-gray-700 flex items-center justify-center space-x-2 text-center">
                                <button class="px-3 py-1 bg-blue-500 text-white text-sm rounded hover:bg-blue-600">Edit role</button>
                                <button class="px-3 py-1 bg-red-500 text-white text-sm rounded hover:bg-red-600">Delete</button>
                            </td>
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
        "order": [[ 1, 'asc' ]],
        "paging": true,
        "lengthChange": true,
        "pageLength": 5,
        "lengthMenu": [ [5, 15, 25, 50], [5, 15, 25, 50] ],
        "language": {
            "paginate": {
                "previous": "Previous",
                "next": "Next"
            }
        }
    }).on('order.dt search.dt', function () {
        let table = $('#eventTable').DataTable();
        table.column(0, { search: 'applied', order: 'applied' }).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1;
        });
        table.column(5).nodes().each(function(cell) {
            const status = cell.innerText.toLowerCase();
            cell.classList.add('px-2', 'py-1', 'rounded', 'text-center', 'font-bold'); // Tambahkan kelas dasar
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
    }).draw();
});

</script>

</body>

</html>
