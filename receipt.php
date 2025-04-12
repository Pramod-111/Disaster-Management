<?php
$message = "";
$receipt = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["check_availability"])) {
    $food_packages = isset($_POST["Food_Packages"]) ? max(0, (int)$_POST["Food_Packages"]) : 0;
    $drinking_water = isset($_POST["Drinking_Water"]) ? max(0, (int)$_POST["Drinking_Water"]) : 0;
    $medical_kits = isset($_POST["Medical_Kits"]) ? max(0, (int)$_POST["Medical_Kits"]) : 0;

    $message .= "<p class='text-lg font-bold'>Availability Status:</p>";
    $message .= "<p>Food Packages: " . ($food_packages <= 50 ? "<span class='text-green-600 font-semibold'>Available</span>" : ($food_packages < 0 ? "<span class='text-yellow-600 font-semibold'>Low Stock</span>" : "<span class='text-red-600 font-semibold'>Out of Stock</span>")) . "</p>";
    $message .= "<p>Drinking Water: " . ($drinking_water <= 50 ? "<span class='text-green-600 font-semibold'>Available</span>" : ($drinking_water < 0 ? "<span class='text-yellow-600 font-semibold'>Low Stock</span>" : "<span class='text-red-600 font-semibold'>Out of Stock</span>")) . "</p>";
    $message .= "<p>Medical Kits: " . ($medical_kits <= 50 ? "<span class='text-green-600 font-semibold'>Available</span>" : ($medical_kits < 0 ? "<span class='text-yellow-600 font-semibold'>Low Stock</span>" : "<span class='text-red-600 font-semibold'>Out of Stock</span>")) . "</p>";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Material Availability & Order</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <header class="bg-green-700 text-white py-4">
    <a href="home.html" class="bg-white text-green-800 px-4 py-2 rounded shadow-md text-sm md:text-base">
            &#8592; Back
        </a>
        <h1 class="text-2xl font-bold text-center">Material Availability & Order</h1>
    </header>

    <main class="container mx-auto my-10 px-6">
        <h2 class="text-3xl font-semibold text-gray-800 mb-6">Check Material Availability</h2>
        <form method="POST" class="bg-white p-6 shadow-md rounded">
            <label class="block text-gray-700 font-semibold mb-2">Enter Quantities:</label>
            <div class="flex flex-col md:flex-row gap-3">
                <input type="number" name="Food_Packages" placeholder="Food Packages" class="border p-2 rounded w-full" min="0" required>
                <input type="number" name="Drinking_Water" placeholder="Drinking Water" class="border p-2 rounded w-full" min="0" required>
                <input type="number" name="Medical_Kits" placeholder="Medical Kits" class="border p-2 rounded w-full" min="0" required>
            </div>
            <button type="submit" name="check_availability" class="mt-4 bg-green-700 text-white px-4 py-2 rounded shadow">Check Availability</button>
        </form>
        
        <?php if (!empty($message)): ?>
            <div class="mt-6 p-4 bg-white shadow-md rounded border border-gray-200">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>

    <footer class="bg-gray-800 text-white py-4 text-center mt-10">
        <p>&copy; 2025 Disaster Material Management</p>
    </footer>
</body>
</html>