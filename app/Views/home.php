
<!-- A page title can be set here or leave blank for default. -->
<?php $pageTitle = "Home";
require_once( __DIR__ . "../components/header.php");
require_once( __DIR__ . "../components/navbar.php");

?>

<div class="relative w-full max-h-96">
    <img src="/assets/cow-hero.jpg" alt="" class="w-full h-96 object-cover">
    <div class="absolute top-12 right-20 z-10 bg-white opacity-[96%] drop-shadow-md w-[28rem] h-72 rounded-sm">
        <h1 class="text-4xl font-bold text-black p-5">Welcome to <span class="text-green-600 underline">YourPet</span></h1>
        <p class="text-lg px-5">YourPet is a medical service for pets. We provide medical services for pets and also sell pet products. We are dedicated to providing the best care for your pets.</p>
    </div>
</div>


<?php 
require_once( __DIR__ . "../components/footer.php");
?>
