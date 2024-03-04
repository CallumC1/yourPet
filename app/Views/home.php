
<!-- A page title can be set here or leave blank for default. -->
<?php $pageTitle = "Home";
require_once( __DIR__ . "../components/header.php");
require_once( __DIR__ . "../components/navbar.php");

?>

<div class="relative w-full max-h-96">
    <img src="/assets/images/cow-hero.jpg" alt="" class="w-full h-96 object-cover">
    <div class="absolute top-12 right-20 z-10 bg-white opacity-[96%] drop-shadow-md w-[28rem] h-72 p-5 rounded-sm">
        <h1 class="text-4xl font-bold text-black mb-4">Welcome to <span class="text-green-600 underline">YourPet</span></h1>
        <p class="text-lg mb-4 ml-1">YourPet is a medical service for pets. We provide medical services for pets and also sell pet products. We are dedicated to providing the best care for your pets.</p>
        
        <a href="/register" class="group flex justify-center w-60 px-10 py-5 ml-1 bg-green-500 text-black font-semibold text-base">
            Register Today 
            <img src="/assets/icons/arrow-right.svg" alt="" class="ml-3 transition-all group-hover:ml-4">
        </a>
    </div>
</div>


<?php 
require_once( __DIR__ . "../components/footer.php");
?>
