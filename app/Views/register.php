<!-- A page title can be set here or leave blank for default. -->
<?php 
$pageTitle = "Register for an account";
$pageBackground = "bg-slate-100"; 
$bodyClasses = "h-screen overflow-hidden";
require_once( __DIR__ . "../components/header.php");
// require_once( __DIR__ . "../components/navbar.php");

?>


<div class="flex w-screen h-screen bg-white">
    <div class="grid grid-cols-1 px-4 mx-auto lg:mx-0 lg:px-0 lg:grid-cols-2 lg:gap-x-44 ">

        <div class="hidden lg:block padding-2 overflow-hidden max-w-sm">
            <img src="/assets/images/dog-and-woman.jpg" alt="" class="h-full object-cover">
        </div>

        <div class="flex flex-col justify-center w-full h-full ">

            <span class="flex items-center gap-2 mb-2">
                <img src="/assets/icons/arrow-left-circle.svg" alt="" class="w-5 h-5">
                <a href="/" class="hover:underline underline-offset-2 text-blue-500 font-semibold">Go back</a>
            </span>
            <h2 class="text-2xl mb-4">Register your account</h2>

    
            <!-- FORM -->
            <form action="/registerSubmit" method="POST" class="flex flex-col gap-6 w-full lg:w-96">

                <!-- first  name -->
                <span class="flex flex-col ">
                    <label for="name" class="mb-1.5 ml-0.5">Name</label>
                    <input type="name" name="name" placeholder="Your name" class="py-2 pl-3 pr-1 border rounded-md border-gray-200">
                </span>

                <span class="flex flex-col ">
                    <label for="email" class="mb-1.5 ml-0.5">Email address</label>
                    <input type="email" name="email" placeholder="Your email address" class="py-2 pl-3 pr-1 border rounded-md border-gray-200">
                </span>
        
                <span class="flex flex-col ">
                    <label for="password" class="mb-1.5 ml-0.5">Password</label>
                    <input type="password" name="password" placeholder="Enter a password" class="py-2 pl-3 pr-1 rounded-md border border-gray-200 ">
                </span>

                <span class="flex items-center gap-3">
                    <input type="checkbox" name="terms" id="terms" class="h-5 w-5" required>
                    <label for="terms" class="text-sm">I agree to YourPet's  <a href="/terms" class="text-blue-600 underline">Terms of Serivce & Privacy Policy</a></label>
                </span>
        
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
require_once( __DIR__ . "../components/footer.php");
?>
