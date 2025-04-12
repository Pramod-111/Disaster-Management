
 <?php
$message = "";
$receipt = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["place_order"])) {
    $user_email = filter_var($_POST["user_email"], FILTER_VALIDATE_EMAIL);
    $order_food = isset($_POST["Order_Food_Packages"]) ? max(0, (int)$_POST["Order_Food_Packages"]) : 0;
    $order_water = isset($_POST["Order_Drinking_Water"]) ? max(0, (int)$_POST["Order_Drinking_Water"]) : 0;
    $order_medical = isset($_POST["Order_Medical_Kits"]) ? max(0, (int)$_POST["Order_Medical_Kits"]) : 0;

    $total_items = $order_food + $order_water + $order_medical;

    if ($user_email && $total_items > 0) {
        $receipt .= "<h2 class='text-xl font-bold mb-3'>Order Receipt</h2>";
        $receipt .= "<p>Food Packages Ordered: <span class='font-semibold'>$order_food</span></p>";
        $receipt .= "<p>Drinking Water Ordered: <span class='font-semibold'>$order_water</span></p>";
        $receipt .= "<p>Medical Kits Ordered: <span class='font-semibold'>$order_medical</span></p>";
        $receipt .= "<p class='mt-4 font-bold'>Total Items Ordered: <span class='text-blue-600'>$total_items</span></p>";
        $receipt .= "<p class='font-medium text-green-700 mt-2'>Order Placed Successfully! A confirmation has been sent to your email.</p>";

        // Email content
        $subject = "Order Confirmation - Disaster Relief Material";
        $emailMessage = "Dear User,\n\nThank you for your order. Here are the details:\n\n";
        $emailMessage .= "Food Packages: $order_food\n";
        $emailMessage .= "Drinking Water: $order_water\n";
        $emailMessage .= "Medical Kits: $order_medical\n";
        $emailMessage .= "Total Items: $total_items\n\n";
        $emailMessage .= "We will process your request shortly.\n\nRegards,\nDisaster Material Team";

        $headers = $user_email;

        // Send email to user
        mail($user_email, $subject, $emailMessage, $headers);

        // (Optional) Send copy to admin
        $admin_email = $user_email;
        mail($admin_email, "New Order Placed", "User Email: $user_email\n\n$emailMessage", $headers);
    } else {
        $receipt = "<p class='text-red-600 font-semibold'>Invalid email or no items ordered.</p>";
    }
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
<body class="bg-[url(home/material.webp)] lg:bg-cover opacity-80">
    
    <header class="bg-green-700 text-white py-4 px-6 flex justify-between sticky top-0 z-10">  
        <a href="home.html" class="hover:text-gray-300 font-bold md:text-base">
            Home
        </a>
        <div class="text-2xl font-bold w-[65%]">Material Availability & Order</div>
    </header>

    <main class="container mx-auto my-10 px-6">
        <h2 class="text-3xl font-semibold mt-10 mb-6">Place Your Order</h2>

        <form method="POST" class="bg-white p-6 shadow-md rounded">
            <div class="mb-4">
                <label class="block font-semibold mb-2">Your Email Address:</label>
                <input type="email" name="user_email" placeholder="Enter your email" class="border p-2 rounded w-full" required>
            </div>

            <label class="block font-semibold mb-2">Enter Quantities to Order:</label>
            <div class="flex flex-col md:flex-row gap-3">
                <input type="number" name="Order_Food_Packages" placeholder="Food Packages" class="border p-2 rounded w-full" min="0" required>
                <input type="number" name="Order_Drinking_Water" placeholder="Drinking Water" class="border p-2 rounded w-full" min="0" required>
                <input type="number" name="Order_Medical_Kits" placeholder="Medical Kits" class="border p-2 rounded w-full" min="0" required>
            </div>

            <button type="submit" name="place_order" class="mt-4 bg-green-700 text-white px-4 py-2 rounded shadow hover:bg-green-600">Submit Order</button>
        </form>

        <?php if (!empty($receipt)): ?>
            <div class="mt-6 p-4 bg-white shadow-md rounded border border-gray-200">
                <?php echo $receipt; ?>
            </div>
        <?php endif; ?>
    </main>

    <footer class="bg-gray-800 text-white py-4 text-center mt-32">
        <p>&copy; 2025 Disaster Material Management</p>
    </footer>
</body>
</html>
