<?php

require "./config.php";

session_start();

if (!isset($_SESSION['user_id']) || (!($_SESSION['role'] == 'user' || $_SESSION['role'] == 'admin'))) {
    header("Location: login.php");
    exit();
}
$id = $_SESSION['user_id'];


$sql = "select menu.nom , Reservation.dateReservation , Reservation.heur , Reservation.nbrPerson , Reservation.status , Reservation.id from Reservation join menu on menu.id = Reservation.MenuId;";
$result = mysqli_query($conn,$sql);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Marcellus&display=swap');
    </style>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'primary': ["Marcellus", "serif"],
                    },
                }
            }
        }
    </script>
</head>
<body class=" bg-[#F8F2F1]">
 <?php if (isset ($_GET['failed'])):?>
    <script>
        document.addEventListener('DOMContentLoaded', function(){
            swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '<?= htmlspecialchars($_GET['failed']) ?>',
                confirmButtonText:'OK'

            });
        });
</script>
<?php endif; ?>
        

   
<!-- <section class=" relative bg-[url('./image/hero.png')] bg-cover bg-no-repeat my-3 mx-7 h-96"> -->
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
              <!-- Hero Section -->
    <section class="relative bg-cover bg-center h-screen" style="background-image: url('./image/a.jpg');">
        <div class="absolute inset-0 bg-black bg-opacity-60"></div>
        <div class="relative z-10 flex flex-col items-center justify-center h-full text-center text-white px-4">
            <h1 class="text-4xl md:text-6xl font-extrabold mb-4">Consulte your reservation history here</h1>
            <p class="text-lg md:text-xl max-w-2xl mb-6">Discover exquisite culinary masterpieces crafted by our world-renowned chef.</p>
            <a href="#menus" class="btn-animate px-6 py-3 bg-orange-500 hover:bg-orange-600 rounded-lg text-lg font-semibold transition duration-300">Explore Menus</a>
        </div>
    </section>
   

    </section>
    <div class="flex flex-wrap justify-center w-[80%] mx-auto gap-3 mt-20 mb-20">
        <?php while($data = mysqli_fetch_assoc($result)): ?>
        <div class="bg-gray-100 border border-[#222222] rounded-md shadow-sm w-64  ">
            <div class="flex justify-between p-2">
                <h3 class="text-[#222222] font-primary font-semibold"><?php echo $data['nom']; ?></h3>
                <p class="flex gap-1 items-center text-[#C0A677]"><img class="w-4 h-4" src="./image/agenda.png"/><?php echo $data['dateReservation'] ?></p>
            </div>
            <div class="flex justify-end pr-2 pb-2">
                <p class="flex gap-1 items-center"><img class="w-4 h-4" src="./image/horloge.png"/><?php echo $data['heur'] ?></p>
            </div>
            <div class="flex justify-between px-2 items-center">
                <p><?php echo $data['nbrPerson']?>: person</p>
                <p class="border border-black p-2 rounded-lg"><?php echo $data['status']?></p>
            </div>
            <div class="flex justify-center items-center gap-2 py-2">
            <button class="open-modal" data-modal="modal-<?php echo $data['id']; ?>">Edit</button>
                <a href="./SupprimerReservation.php?id=<?php echo $data['id']?>">supprimer</a>
            </div>
        </div>
        
    </div>
       <!-- Modal -->
       <div id="modal-<?php echo $data['id']; ?>" class="modal hidden fixed top-0 left-0 w-full h-full flex justify-center items-center bg-black bg-opacity-50">
    <div class="bg-white p-5 rounded-lg w-96">
        <h2 class="text-xl font-bold mb-4">Edit Reservation</h2>
        <form id="editForm" action="./UpdateReservation.php" method="POST">
            <input type="hidden" name="reservation_id" id="reservation_id" value="<?php echo $data['id']; ?>">
            <div class="mb-4">
                <label for="date" class="block mb-1">Date:</label>
                <input type="date" id="date" name="dateReservation" value="<?php echo $data['dateReservation']; ?>" class="border border-gray-300 p-2 w-full rounded-md">
            </div>
            <div class="mb-4">
                <label for="time" class="block mb-1">Time:</label>
                <input type="time" id="time" name="heur" value="<?php echo $data['heur']; ?>" class="border border-gray-300 p-2 w-full rounded-md">
            </div>
            <div class="mb-4">
                <label for="nbrPerson" class="block mb-1">Number of Persons:</label>
                <input type="number" id="nbrPerson" name="nbrPerson" value="<?php echo $data['nbrPerson']; ?>" class="border border-gray-300 p-2 w-full rounded-md">
            </div>
            <div class="flex justify-end gap-3">
                <button type="button" id="closeModal" class="bg-gray-500 text-white px-4 py-2 rounded-md">Cancel</button>
                <button type="submit" class="close-modal bg-blue-500 text-white px-4 py-2 rounded-md">Save</button>
            </div>
        </form>
    </div>
</div>
<?php endwhile; ?>


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
    <script>
    document.querySelectorAll('.open-modal').forEach(button => {
    button.addEventListener('click', () => {
        const modalId = button.getAttribute('data-modal');
        document.getElementById(modalId).classList.remove('hidden');
    });
});

document.querySelectorAll('.close-modal').forEach(button => {
    button.addEventListener('click', () => {
        button.closest('.modal').classList.add('hidden');
    });
});
</script>
</body>
</html>