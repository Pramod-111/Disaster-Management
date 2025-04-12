<?php
$distribution_log = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $recipient_name = htmlspecialchars($_POST["Recipient_Name"]);
    $material_name = htmlspecialchars($_POST["Material_Name"]);
    $quantity = isset($_POST["Quantity"]) ? max(0, (int)$_POST["Quantity"]) : 0;
    $location = htmlspecialchars($_POST["Location"]);
    $timestamp = date("Y-m-d H:i:s");

    if ($quantity > 0 && !empty($recipient_name) && !empty($material_name) && !empty($location)) {
        $distribution_log .= "<tr><td class='border px-4 py-2'>$timestamp</td><td class='border px-4 py-2'>$recipient_name</td><td class='border px-4 py-2'>$material_name</td><td class='border px-4 py-2'>$quantity</td><td class='border px-4 py-2'>$location</td></tr>";
    } else {
        $distribution_log = "<p class='text-red-600 font-semibold'>Invalid input. Please fill all fields correctly.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Material Distribution Tracking</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class=" bg-[url(distribution.jpg)] lg:bg-cover opacity-80">
    <header class="bg-green-700 text-white py-4 px-6 flex justify-between sticky top-0 z-10">  
        <a href="home.html" class="hover:text-gray-300 font-bold md:text-base">
        Home
        </a>
        <div class="text-2xl font-bold w-[65%]">Material Distribution Tracking</div>
    </header>

    <main class="container mx-auto my-10 px-6">
        <h2 class="text-3xl font-semibold mb-6">Log Material Distribution</h2>
        <form method="POST" class="bg-white p-6 shadow-md rounded">
            <label class="block font-semibold mb-2">Distribution Details:</label>
            <div class="flex flex-col md:flex-row gap-3">
                <input type="text" name="Recipient_Name" placeholder="Recipient Name" class="border p-2 rounded w-full" required>
                <input type="text" name="Material_Name" placeholder="Material Name" class="border p-2 rounded w-full" required>
                <input type="number" name="Quantity" placeholder="Quantity" class="border p-2 rounded w-full" min="1" required>
                <input type="text" name="Location" placeholder="Location" class="border p-2 rounded w-full" required>
            </div>
            <button type="submit" class="mt-4 bg-blue-400 text-white px-4 py-2 rounded shadow">Log Distribution</button>
        </form>

        <h2 class="text-3xl font-semibold mt-10 mb-6">Distribution Log</h2>
        <table class="w-full bg-white shadow-md rounded border border-gray-200">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border px-4 py-2">Timestamp</th>
                    <th class="border px-4 py-2">Recipient Name</th>
                    <th class="border px-4 py-2">Material Name</th>
                    <th class="border px-4 py-2">Quantity</th>
                    <th class="border px-4 py-2">Location</th>
                </tr>
            </thead>
            <tbody>
                <?php echo $distribution_log; ?>
            </tbody>
        </table>
    </main>

    <footer class="bg-gray-800 text-white py-4 text-center mt-10">
        <p>&copy; 2025 Disaster Material Management</p>
    </footer>
</body>
</html>