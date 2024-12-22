<?php
session_start();
if (!isset($_SESSION['user_id']) || (!($_SESSION['role'] == 'user' || $_SESSION['role'] == 'admin'))) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Marcellus&display=swap');
    </style>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'primary': ["Marcellus","serif"],
                    },
                }
            }
        }
    </script>
</head>

<body class="bg-[#F8F2F1]">
        <header>
            <nav class="flex justify-between items-center px-3 pt-2">
                <img src="./image/logo.png" class="w-auto h-10" alt="">
                <div class="hidden md:flex items-center space-x-10 mx-auto">
                    <a href="./Home.php" class="text-black">Home</a>
                    <a href="./Menu.php" class="text-black">Menu</a>
                    <a href="./Reservation.php" class="text-black">Reservation</a>
                    <a href="#" class="text-black">Contact</a>
                    <a href="./logout.php" class="text-black bg-orange-500 border border-white text-sm ho py-2 px-6 rounded-full ">logout</a>
                </div>
            </nav>
            <img id="menu" src="./image/icons8-menu-50.png" id="MenuBg" class="w-7 h-7 absolute right-4 top-4 md:hidden" alt="">
            <!-- Hero Section -->
    <section class="relative bg-cover bg-center h-screen" style="background-image: url('./image/a.jpg');">
        <div class="absolute inset-0 bg-black bg-opacity-60"></div>
        <div class="relative z-10 flex flex-col items-center justify-center h-full text-center text-white px-4">
            <h1 class="text-4xl md:text-6xl font-extrabold mb-4">Welcome to the Ultimate Culinary Experience</h1>
            <p class="text-lg md:text-xl max-w-2xl mb-6">Discover exquisite culinary masterpieces crafted by our world-renowned chef.</p>
            <a href="#menus" class="btn-animate px-6 py-3 bg-orange-500 hover:bg-orange-600 rounded-lg text-lg font-semibold transition duration-300">Explore Menus</a>
        </div>
    </section>

    <!-- About Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto text-center">
            <h2 class="text-3xl md:text-4xl font-bold mb-8">About the Chef</h2>
            <div class="flex flex-col md:flex-row md:justify-center md:space-x-8 space-y-8 md:space-y-0">
                <div class="flex-1">
                    <img src="./image/he.jpg" class="rounded-lg shadow-md h-80 mx-auto md:w-auto" alt="Chef Portrait">
                </div>
                <div class="flex-1 max-w-lg mx-auto">
                    <p class="text-lg leading-relaxed mb-6">Our chef is a culinary genius, known for creating unforgettable dining experiences. With a passion for gastronomy and a flair for innovation, our chef combines the finest ingredients with exceptional techniques to create dishes that tantalize the taste buds and delight the senses.</p>
                    <a href="#services" class="btn-animate px-6 py-3 bg-orange-500 hover:bg-orange-600 rounded-lg text-lg font-semibold transition duration-300">Learn More</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="py-16 bg-gray-100">
        <div class="container mx-auto text-center">
            <h2 class="text-3xl md:text-4xl font-bold mb-8">Our Services</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
              
                <div class="bg-white p-8 rounded-lg shadow-md hover:shadow-lg transition duration-300">
                    <img src="./image/chef.jpg" class="h-40 w-full object-cover rounded-md mb-4" alt="Service 1">
                    <h3 class="text-2xl font-semibold mb-2">Culinary Classes</h3>
                    <p>Join our interactive culinary classes and learn from the best.</p>
                </div>
               
                <div class="bg-white p-8 rounded-lg shadow-md hover:shadow-lg transition duration-300">
                    <img src="./image/chef.jpg" class="h-40 w-full object-cover rounded-md mb-4" alt="Service 2">
                    <h3 class="text-2xl font-semibold mb-2">Private Dining</h3>
                    <p>Experience an exclusive private dining with our chef.</p>
                </div>
              
                <div class="bg-white p-8 rounded-lg shadow-md hover:shadow-lg transition duration-300">
                    <img src="./image/chef.jpg" class="h-40 w-full object-cover rounded-md mb-4" alt="Service 3">
                    <h3 class="text-2xl font-semibold mb-2">Catering Services</h3>
                    <p>Let us cater your next event with our exquisite dishes.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white text-center py-6">
        <div class="container mx-auto">
            <p>&copy; 2024 Chef's Gastronomic Experience. All rights reserved.</p>
            <nav class="flex justify-center space-x-4 mt-4">
                <a href="#" class="hover:underline">Privacy Policy</a>
                <a href="#" class="hover:underline">Terms of Service</a>
                <a href="#" class="hover:underline">Contact Us</a>
            </nav>
        </div>
    </footer>

    
</body>
</html>