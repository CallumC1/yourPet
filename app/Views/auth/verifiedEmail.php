<?php
$pageTitle = "YourPet - Verify Email";
require_once(__DIR__ . "/../components/header.php");
$last_email = $_SESSION["last_verification_email"] ?? null;
?>


<!-- A page title can be set here or leave blank for default. -->
<?php
$pageTitle = "Email Verified | YourPet";
$pageBackground = "bg-white";
$bodyClasses = "min-h-screen h-full";
require_once(__DIR__ . "/components/header.php");

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

        <div class="flex flex-col justify-center max-w-lg w-full h-full ">      
            <h2 class="text-2xl mb-4">Your email has been verified!</h2>
            <p>Thank you...</p>

            <div class="flex flex-col ">
                <p class="text-sm">Thank you for confirming your email. You may now access your dashboard.</p>
                <div class="flex flex-col w-full py-3">
                    <button id="goToDash" class="w-80 p-4 bg-emerald-500">Go to Dashboard</button>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
require_once(__DIR__ . "/../components/footer.php");
?>

<script>

    let goToDash = document.getElementById("goToDash");
    goToDash.addEventListener("click", () => {
        window.location.href = "/dashboard";
    });

</script>