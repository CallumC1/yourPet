<!-- A page title can be set here or leave blank for default. -->
<?php 
$pageTitle = "Register | YourPet";
$pageBackground = "bg-white"; 
$bodyClasses = "min-h-screen h-full";
require_once( __DIR__ . "/../components/header.php");

?>


<div class="flex w-screen h-screen">
    <div class="grid grid-cols-1 lg:grid-cols-2 px-4 lg:px-0 mx-auto lg:mx-0 lg:gap-x-44 2xl:gap-x-72 ">
        <div class="relative hidden lg:block padding-2 overflow-hidden max-w-sm 2xl:max-w-lg"> 
            <a href="/" class="tracking-wide absolute m-4">
                <p class="text-2xl font-bold text-emerald-600" >YourPet</p>
                <p class="text-xs">medical experts</p>
            </a>
            <img src="/assets/images/dog-and-woman.jpg" alt="" class="h-full object-cover">
        </div>

        <div class="flex flex-col justify-center w-full h-full ">
            <a href="/" class="flex items-center gap-2 mb-2">
                <img src="/assets/icons/arrow-left-circle.svg" alt="" class="w-5 h-5">
                <p class="hover:underline underline-offset-2 text-blue-500 font-semibold">Go back</p>
            </a>
            
            <h2 class="text-2xl mb-4">Register your account</h2>
            <!-- FORM -->
            <form id="RegisterForm" action="/registerUser" method="POST" class="flex flex-col gap-6 w-full lg:w-96">

                <span class="flex flex-col ">
                    <label for="name" class="mb-1.5 ml-0.5">Name</label>
                    <input type="name" name="name" placeholder="Your name" autofocus class="py-2 pl-3 pr-1 border rounded-md border-gray-200">
                    <p id="name_error" class="text-red-500 hidden"></p>
                </span>

                <span class="flex flex-col ">
                    <label for="email" class="mb-1.5 ml-0.5">Email address</label>
                    <input type="email" name="email" placeholder="Your email address" class="py-2 pl-3 pr-1 border rounded-md border-gray-200">
                    <p id="email_error" class="text-red-500 hidden"></p>

                </span>
        
                <span class="flex flex-col ">
                    <label for="password" class="mb-1.5 ml-0.5">Password</label>
                    <input type="password" name="password" placeholder="Enter a password" class="py-2 pl-3 pr-1 rounded-md border border-gray-200 ">
                    <p id="password_error" class="text-red-500 hidden"></p>
                </span>

                <div>
                    <span class="flex items-center gap-3">
                        <input type="checkbox" name="terms" id="terms" class="h-5 w-5" required>
                        <label for="terms" class="text-sm">I agree to YourPet's  <a href="/terms" class="text-blue-600 underline">Terms of Serivce & Privacy Policy</a></label>
                    </span>
                    <p id="terms_error" class="text-red-500 hidden"></p>
                </div>
        
                <p id="general_error" class="text-red-500 hidden"></p>
                <input type="submit" value="Create Account" class="mt-8 p-4 font-semibold bg-emerald-500 hover:bg-emerald-600 rounded-md cursor-pointer transition-all duration-300">
            </form>
            <!-- END FORM -->

            <div class="flex mt-3 gap-2 text-sm">
                <p>Already registered?</p>
                <a href="/login" class="text-blue-600 underline">Login here</a>
            </div>

            </div>
        </div>
    </div>
</div>

<?php 
require_once( __DIR__ . "/../components/footer.php");
?>


<script>
    // Register form submission using fetch API
    // To be used in the future for AJAX form submissions and smoother user experience.

    const form = document.getElementById("RegisterForm");
    form.addEventListener("submit", async (e) => {
        e.preventDefault();
        const formData = new FormData(form);
        const response = await fetch("/registerUser", {
            method: "POST",
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.type == "success") {
                window.location.href = "/verifyEmail";
            } else if (data.type == "error") {
                if (data.redirect) {
                    window.location.href = data.redirect;
                } else {
                    generateErrors(data.errors);
                }
            }
        })
        
    });

    // Removes all error messages from the form fields.
    function cleanErrors() {
        let errors = document.querySelectorAll(".text-red-500");
        errors.forEach((error) => {
            if (!error.classList.contains("hidden")) {
                error.classList.add("hidden");
            }
        });
    }

    function generateErrors(errors) {
        cleanErrors();
        for (const [field, message] of Object.entries(errors)) {
            let errMsg = document.getElementById(field + "_error");
            if (errMsg.classList.contains("hidden")) {
                errMsg.classList.remove("hidden");
            }
            errMsg.textContent = message;
        }
    }

</script>