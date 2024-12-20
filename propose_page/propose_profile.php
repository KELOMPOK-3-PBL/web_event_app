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
    <?php include '../component/sidebar_propose.php'; ?>

    <!-- Header -->
    <?php include '../component/header_propose.php'; ?>

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
                        <h1 id="usernamee" class="text-3xl font-bold">Guest</h1> <!-- Username -->
                    </div>
                    <div>
                        <h3 id="role">Logged in as Role</h3> <!-- Role -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Footer -->
    <?php include '../component/footer.php'; ?>
</body>
<script>
document.addEventListener("DOMContentLoaded", () => {
    // Endpoint API
    const apiURL = "http://localhost/pbl/api-03/routes/auth.php";
    const token = localStorage.getItem("jwt");

    // Pastikan token tersedia
    if (!token) {
        console.error("No token found in localStorage. Please login first.");
        // Redirect to login page or show error
        return;
    }

    // Ambil data dari API
    fetch(apiURL, {
        method: "GET",
        headers: {
            "Content-Type": "application/json",
            "Authorization": `Bearer ${token}`, // Kirim token jika tersedia
        },
    })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            if (data.status === "success") {
                // Isi data ke dalam elemen DOM
                document.getElementById("usernamee").textContent = data.data.username;
                document.getElementById("role").textContent = `Logged in as ${data.data.role_name}`;
            } else {
                console.error("API response status not success:", data.message);
                // Tampilkan error pada UI jika diperlukan
            }
        })
        .catch(error => {
            console.error("Fetch error:", error);
            // Tampilkan error pada UI jika diperlukan
        });
});
</script>
</html>