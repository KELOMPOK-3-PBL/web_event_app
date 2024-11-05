<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account List</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
                <table id="eventTable" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Account</th>
                            <th>Roles</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data will be loaded here by JavaScript -->
                    </tbody>
                </table>
            </div>
        </section>
    </div>

    <!-- Footer -->
    <?php include '../component/footer.php'; ?>

    <!-- Initialize DataTables -->
    <script>
    $(document).ready(function() {
        // Initialize DataTable
        var table = $('#eventTable').DataTable({
            "columnDefs": [
                { "orderable": false, "targets": 0 } // Disable sorting on column No
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
        });

        // Function to load user data
        function loadUserData() {
            $.ajax({
                url: '../api/users.php', // URL of your user API
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    // Clear the table body
                    table.clear();
                    // Add data to the table
                    $.each(data, function(index, user) {
                        table.row.add([
                            '', // Placeholder for No column
                            user.username,
                            user.roles.join(', '), // Assuming roles is an array
                            `<div class="flex justify-center space-x-2">
                                <button class="px-3 py-1 bg-blue-500 text-white text-sm rounded hover:bg-blue-600" onclick="editUser(${user.id})">Edit role</button>
                                <button class="px-3 py-1 bg-red-500 text-white text-sm rounded hover:bg-red-600" onclick="deleteUser(${user.id})">Delete</button>
                            </div>`
                        ]).draw();
                    });
                },
                error: function() {
                    console.error('Failed to load user data.');
                }
            });
        }

        // Call loadUserData to fetch and display users
        loadUserData();

        // Edit user function
        window.editUser = function(userId) {
            // Logic to handle editing user roles (e.g., show a modal)
            alert('Edit user with ID: ' + userId);
            // Implement actual edit logic here
        };

        // Delete user function
        window.deleteUser = function(userId) {
            if (confirm('Are you sure you want to delete this user?')) {
                $.ajax({
                    url: '../api/users.php?user_id=' + userId,
                    method: 'DELETE',
                    success: function(response) {
                        alert('User deleted successfully.');
                        loadUserData(); // Refresh the user list
                    },
                    error: function() {
                        alert('Failed to delete user.');
                    }
                });
            }
        };
    });
    </script>

</body>

</html>
