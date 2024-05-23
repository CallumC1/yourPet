<!-- A page title can be set here or leave blank for default. -->
<?php 
$pageTitle = "Login | YourPet";
$pageBackground = "bg-white"; 
$bodyClasses = "min-h-screen h-full";
require_once( __DIR__ . "/components/header.php");

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
            <h2 class="text-2xl mb-4">Login to your account</h2>

    
            <!-- FORM -->
            <form action="/loginSubmit" method="POST" class="flex flex-col gap-6 w-full lg:w-96">

                <span class="flex flex-col ">
                    <label for="email" class="mb-1.5 ml-0.5">Email address</label>
                    <input type="email" name="email" placeholder="Your email address" autofocus class="py-2 pl-3 pr-1 border rounded-md border-gray-200">
                    <p class="text-red-500"><?= $error_no_user ?></p>
                </span>
        
                <span class="flex flex-col ">
                    <label for="password" class="mb-1.5 ml-0.5">Password</label>
                    <input type="password" name="password" placeholder="Enter a password" class="py-2 pl-3 pr-1 rounded-md border border-gray-200 ">
                </span>
        
                <input type="submit" value="Login" class="mt-8 p-4 font-semibold bg-emerald-500 hover:bg-emerald-600 rounded-md cursor-pointer transition-all duration-300">
            </form>
            <!-- END FORM -->

            <div class="flex mt-3 gap-2 text-sm">
                <p>Dont have an account?</p>
                <a href="/register" class="text-blue-600 underline">Register here</a>
            </div>

            </div>

            

        </div>

    </div>

</div>

<?php 
require_once( __DIR__ . "/components/footer.php");
?>
