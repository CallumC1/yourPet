
<!-- A page title can be set here or leave blank for default. -->
<?php 
$pageTitle = "YourPet - Home";
require_once( __DIR__ . "../components/header.php");
require_once( __DIR__ . "../components/navbar.php");

?>

<div class="relative w-full max-h-96">
    <img src="/assets/images/cow-hero.webp" alt="" class="w-full h-96 object-cover opacity-95">

    <div class="absolute z-10 w-80 sm:w-96 lg:w-[28rem] h-72 top-1/2 left-1/2 md:left-3/4 -translate-x-1/2 -translate-y-1/2  bg-white opacity-[96%] drop-shadow-md p-5 rounded-sm">
        <h1 class="text-4xl font-bold text-black mb-4">Welcome to <span class="text-emerald-600 underline">YourPet</span></h1>
        
        <p class="block md:hidden text-lg mb-4 ml-1">We provide medical services for pets and also sell pet products.</p>
        <p class="hidden md:block text-lg mb-4 ml-1">We provide medical services for pets and also sell pet products. We are dedicated to providing the best care for your pets.</p>
        
        <a href="/register" class="group flex justify-center w-60 px-10 py-5 ml-1 bg-emerald-600 text-black font-semibold text-base rounded-sm">
            Register Today 
            <img src="/assets/icons/arrow-right.svg" alt="" class="ml-3 transition-all group-hover:ml-4 size-6">
        </a>
    </div>
    
</div>

<div class="flex flex-col w-full px-6 max-w-screen-2xl mx-auto">
    
    <div class="flex flex-wrap justify-center gap-5 2xl:justify-between mt-8">

        <div class="flex flex-col justify-center items-center w-auto max-w-xs h-80 sm:h-auto sm:max-w-md px-4 pt-8 pb-10 bg-white rounded-md shadow-md">
            <div class="flex justify-center items-center bg-slate-100 rounded-full size-11">
                <img src="/assets/icons/HealthCross.svg" alt="" class="w-10 h-10">
            </div>
            <h2 class="text-2xl font-semibold mt-4">Medical Services</h2>
            <p class="text-lg text-center mt-4">We provide medical services for pets. We have a team of experienced vets and nurses who are dedicated to providing the best care for your pets.</p>
        </div>

        <div class="flex flex-col justify-center items-center w-auto max-w-xs h-80 sm:h-auto sm:max-w-md px-4 pt-8 pb-10 bg-white rounded-md shadow-md">
            <div class="flex justify-center items-center bg-slate-100 rounded-full size-11">
                <img src="/assets/icons/HealthCross.svg" alt="" class="w-10 h-10">
            </div>
            <h2 class="text-2xl font-semibold mt-4">Pet Food</h2>
            <p class="text-lg text-center mt-4">We sell a variety of pet food. We have food for all types of pets. We also have food for pets with special dietary needs.</p>
        </div>

        <div class="flex flex-col justify-center items-center w-auto max-w-xs h-80 sm:h-auto sm:max-w-md px-4 pt-8 pb-10 bg-white rounded-md shadow-md">
            <div class="flex justify-center items-center bg-slate-100 rounded-full size-11">
                <img src="/assets/icons/HealthCross.svg" alt="" class="w-10 h-10">
            </div>
            <h2 class="text-2xl font-semibold mt-4">Medicine</h2>
            <p class="text-lg text-center mt-4">We sell a variety of pet medicine. We have medicine for all types of pets. We also have medicine for pets with special medical needs.</p>
        </div>

    </div>
    
    
    <div class="mt-14 ">
        <h1 class="font-semibold text-4xl">Pet care</h1>
        <p>Get top 6 product cards to display here</p>
    </div>

</div>


<?php 
require_once( __DIR__ . "../components/footer.php");
?>
