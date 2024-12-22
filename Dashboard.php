<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.tailwindcss.com"></script>
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

<body>
    
 <?php if (isset($_GET['success'])):?>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: '<?= htmlspecialchars($_GET['success']) ?>',
                    confirmButtonText: 'OK'
                });
            });
        </script>
    <?php endif; ?>

     <?php if (isset($_GET['anuller'])):?>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: '<?= htmlspecialchars($_GET['anuller']) ?>',
                    confirmButtonText: 'OK'
                });
            });
        </script>
    <?php endif; ?>
    <section class="flex">
        <aside class="hidden lg:w-1/5 lg:flex flex-col bg-orange-100 min-h-screen px-3">
            <img src="./image/logo.png" class="w-20 h-10" alt="">
            <a href="./Dashboard.php" class="text-black pt-10">Dashboard</a>
            <a href="./MenuDash.php" class="text-black pt-10">Menu</a>
        </aside>
        <main class="w-full">
            <!-- statistique -->
            <div class="flex justify-between items-center gap-2 md:justify-end  bg-orange-100 text-white p-3 ">
                <p class="font-bold text-black">Welcome Asma</p>
                <img src="./image/icons8-menu-50.png" id="MenuBg" class="w-7 h-7 md:hidden" alt="">
                <a href="./logout.php"><img src="./image/OOF.png" class="w-5 h-5" alt=""></a>
            </div>
            <div id="menu" class="hidden absolute bg-[#161615] rounded-lg p-2 ">
                <a href="./Dashboard.php" class="text-[#C0A677] pt-10">Dashboard</a>
                <a href="./MenuDash.php" class="text-[#C0A677] pt-10">Menu</a>
            </div>
            <div class="flex flex-wrap gap-2 m-2">
                <?php
                require "./config.php";
                $sql = "SELECT count(*) as total from Reservation where status = 'Attent';";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);

                $sql1 = "SELECT count(*) as result from Reservation where status = 'Confirme';";
                $result1 = mysqli_query($conn, $sql1);
                $row1 = mysqli_fetch_assoc($result1);

                $sql2 = "SELECT (count(*) - 1) as total from client;";
                $result2 = mysqli_query($conn, $sql2);
                $row2 = mysqli_fetch_assoc($result2);

                $sql3 = "SELECT count(*) as total FROM Reservation WHERE status = 'Confirme' AND DATE(dateReservation) = CURDATE() + INTERVAL 1 DAY;";
                $result3 = mysqli_query($conn, $sql3);
                $row3 = mysqli_fetch_assoc($result3);
                ?>
                <div class="bg-gray-100 rounded-lg p-1 md:px-2 md:py-2 flex flex-col w-32  shadow-lg md:w-40">
                    <p class="text-[#C0A677] font-semibold text-[40px]"><?php echo $row['total'] ?></p>
                    <p class="text-black text-sm font-primary md:text-lg ">Demand en attent</p>
                </div>
                <div class="bg-gray-100 rounded-lg p-1 md:px-2 md:py-2 flex flex-col w-32 shadow-md  md:w-40">
                    <p class="text-[#C0A677] font-semibold text-[40px]"><?php echo  $row1['result'] ?></p>
                    <p class="text-black text-sm font-primary md:text-lg ">Demand approver</p>
                </div>
                <div class="bg-gray-100 rounded-lg p-1 w-32 md:px-2 md:py-2 flex flex-col  shadow-md  md:w-48">
                    <p class="text-[#C0A677] font-semibold text-[40px]"><?php echo $row3['total'] ?></p>
                    <p class="text-black text-sm font-primary md:text-lg ">Demand a demain </p>
                </div>
                <div class="bg-gray-50 rounded-lg p-1 md:px-2 md:py-2 flex flex-col w-32 shadow-md  md:w-40">
                    <p class="text-[#C0A677] font-semibold text-[40px]"><?php echo $row2['total'] ?></p>
                    <p class="text-black text-sm  font-primary md:text-lg ">Users</p>
                </div>
            </div>
            <?php
            require "./config.php";
            $sql = "select client.nom as ClientNom , Reservation.id , menu.nom as MenuNom , Reservation.dateReservation , Reservation.heur , Reservation.nbrPerson , Reservation.status , Reservation.clientId , Reservation.MenuId from Reservation 
            join client on client.id = Reservation.clientId 
            join menu on Reservation.MenuId = menu.id
            ORDER BY Reservation.id ASC;
            ;";
            $result = mysqli_query($conn, $sql);
            ?>
            <div class="overflow-x-auto">
                <table class="w-full text-left overflow-x-auto">
                    <thead>
                        <tr>
                            <th class="px-2 md:px-6 py-3">reservation</th>
                            <th class="px-2 md:px-6 py-3">clientName</th>
                            <th class="px-2 md:px-6 py-3">Menu</th>
                            <th class="px-2 md:px-6 py-3">dateReservation</th>
                            <th class="px-2 md:px-6 py-3">heur</th>
                            <th class="px-2 md:px-6 py-3">nbrPerson</th>
                            <th class="px-2 md:px-6 py-3">status</th>
                            <th class="px-2 md:px-6 py-3">action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($reservations = mysqli_fetch_assoc($result)): ?>
                            <tr class="border-b">
                                <td class="px-2 md:px-6 py-3"><?php echo $reservations['id'] ?></td>
                                <td class="px-2 md:px-6 py-3"><?php echo $reservations['ClientNom'] ?></td>
                                <td class="px-2 md:px-6 py-3"><?php echo $reservations['MenuNom'] ?></td>
                                <td class="px-2 md:px-6 py-3"><?php echo $reservations['dateReservation'] ?></td>
                                <td class="px-2 md:px-6 py-3"><?php echo $reservations['heur'] ?></td>
                                <td class="px-2 md:px-6 py-3"><?php echo $reservations['nbrPerson'] ?></td>
                                <td class="px-2 md:px-6 py-3"><?php echo $reservations['status'] ?></td>
                                <td class="px-2 md:px-6 py-3 flex space-x-2">
                                    <a class="" href="./aproveReservation.php?id=<?php echo $reservations['id'] ?>"><img src="./image/approuve.png" class="w-10" alt=""></a>
                                    <a class="" href="./denyReservation.php?id=<?php echo $reservations['id'] ?>"><img src="./image/interdit.png" class="w-10" alt=""></a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </section>
    <script>
        const bgMenu = document.getElementById("MenuBg");
        const menu = document.getElementById("menu")
        bgMenu.addEventListener("click", () => {
            menu.classList.toggle("hidden");
        })
    </script>
</body>

</html>