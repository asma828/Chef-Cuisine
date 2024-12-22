<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up Form</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <main class="min-h-screen flex items-center justify-center py-12 px-4">
        <div class="max-w-md w-full space-y-8 bg-white p-10 rounded-xl shadow-lg">
            <!-- Logo -->
            <div class="flex justify-center">
                <img src="./image/logo.png" alt="Logo" class="h-20 w-auto">
            </div>

            <!-- Header -->
            <div class="text-center">
                <h2 class="mt-6 text-3xl font-extrabold text-gray-900">log in</h2>
                <p class="mt-2 text-sm text-gray-600">
                    dosen't have an account? 
                    <a href="./signup.php" class="font-medium text-orange-500 hover:text-orange-500">Sign up here</a>
                   <!--  catche the error i sent from loginPros.php and get the error message from the URL parameter-->
                    <?php if (isset($_GET['error'])): ?>
                        <div class="text-red-500 text-center mt-2">
                         <?php echo htmlspecialchars($_GET['error']); ?>
                    </div>
                        <?php endif; ?>
                </p>
            </div>

            <!-- Form -->
            <form action="./loginPros.php" id="loginForm" method="POST" class="mt-8 space-y-6">
                <div class="space-y-4">
                    <!-- Email -->
                    <div>
                        <label class="flex items-center text-sm font-medium text-gray-700 mb-1">
                            Email
                        </label>
                        <input type="text" id="email" name="email"  
                            class="appearance-none rounded-lg relative block w-full px-3 py-2 border border-orange-500 placeholder-orange-500 text-black focus:outline-none focus:ring-orange-500 focus:border-orange-500 focus:z-10 sm:text-sm">
                            <small class="text-red-500 hidden" id="emailError"></small>
                        </div>

                    <!-- Password -->
                    <div>
                        <label class="flex items-center text-sm font-medium text-gray-700 mb-1">
                            Password
                        </label>
                        <input type="password" id="password" name="password"  
                            class="appearance-none rounded-lg relative block w-full px-3 py-2 border border-gray-300 placeholder-orange-500 text-gray-900 focus:outline-none focus:ring-orange-500 focus:border-orange-500 focus:z-10 sm:text-sm">
                            <small class="text-red-500 hidden" id="passwordError"></small>

                        </div>
                </div>
                <div>
                    <button type="submit" 
                        class="w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-orange-500 hover:bg-orange-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200">
                        Log in
                    </button>
                </div>
            </form>
        </div>
    </main>

    <script>
        const loginForm = document.getElementById("loginForm")
        loginForm.onsubmit = function(){
            let isValid = true;
            const email = document.getElementById("email")
            const password = document.getElementById("password")
            const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
            

            if(email.value.trim() === ""){
                isValid = false;
                const emailError = document.getElementById("emailError");
                emailError.textContent = "email is required"
                emailError.classList.remove("hidden")
            }
            else if(!emailRegex.test(email.value.trim())){
                emailError.textContent = "Invalid email format."
                emailError.classList.remove("hidden")
            }
            else{
                emailError.classList.add("hidden")
            }
            if(password.value.trim() === ""){
                isValid = false
                const passwordError = document.getElementById("passwordError")
                passwordError.textContent = "password is required"
                passwordError.classList.remove("hidden")
            }
            else{
                passwordError.classList.add("hidden")
            }
            return isValid;
        }
    </script>
</body>
</html>