<?php $pageTitle = "YourPet - Verify Your Email Address";
require_once( __DIR__ . "/components/header.php");

?>

<div class="w-screen h-screen ">
    <div class="flex flex-col w-96 h-full mx-auto justify-center items-center gap-5">
        <h1 class="px-10 py-5 bg-white drop-shadow-md">Verification email sent!</h1>
        <p class="px-10 py-5 bg-white drop-shadow-md">Please open your email app and click the button which will redirect your to verify your email automatically.</p>
    </div>
</div>

<?php 
require_once( __DIR__ . "/components/footer.php");
?>