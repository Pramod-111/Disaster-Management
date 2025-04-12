<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $to = "nwdpramod12305901@gmail.com"; 
    $subject = "Contact Form Submission";
    
    $name = htmlspecialchars($_POST["name"]);
    $email = htmlspecialchars($_POST["email"]);
    $message = htmlspecialchars($_POST["message"]);
    
    $fullMessage = "Name: $name\nEmail: $email\n\nMessage:\n$message";
    $headers = "From: $email";

    if (mail($to, $subject, $fullMessage, $headers)) {
        $successMessage = "Message sent successfully!";
    } else {
        $errorMessage = "Failed to send Message.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[url(home/contact.jpg)] lg:bg-cover opacity-80">

    <header class="bg-green-700 text-white py-4 px-6 flex justify-between sticky top-0 z-10">  
        <a href="home.html" class="hover:text-gray-300 font-bold md:text-base">
            Home
        </a>
        <div class="text-2xl font-bold w-[55%]">Contact Us</div>
    </header>

    <main class="container mx-auto my-10 px-6">
        <h2 class="text-3xl font-semibold text-white mb-6">Get in Touch</h2>

        <?php if (isset($successMessage)) : ?>
            <p class="bg-green-200 text-green-700 p-3 rounded"><?php echo $successMessage; ?></p>
        <?php elseif (isset($errorMessage)) : ?>
            <p class="bg-red-200 text-red-700 p-3 rounded"><?php echo $errorMessage; ?></p>
        <?php endif; ?>

        <form class="bg-white shadow-md rounded p-6 opacity-80" action="" method="POST">
            <div class="mb-4">
                <label class="block font-bold">Name:</label>
                <input type="text" name="name" required class="w-full border border-gray-300 p-2 rounded">
            </div>
            <div class="mb-4">
                <label class="block font-bold">Email:</label>
                <input type="email" name="email" required class="w-full border border-gray-300 p-2 rounded">
            </div>
            <div class="mb-4">
                <label class="block font-bold">Message:</label>
                <textarea name="message" required class="w-full border border-gray-300 p-2 rounded"></textarea>
            </div>
            <button type="submit" class="bg-green-700 text-white py-2 px-4 rounded hover:bg-green-600">Submit</button>
        </form>
    </main>

    <footer class="bg-gray-600 text-white py-4 text-center mt-10">
        <p>&copy; 2025 Disaster Material Management</p>
    </footer>

</body>
</html>
