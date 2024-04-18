
<!-- A page title can be set here or leave blank for default. -->
<?php $pageTitle = "My Pets";
require_once( __DIR__ . "../components/header.php");
require_once( __DIR__ . "../components/navbar.php");
?>


<!-- Page Container -->
<div class="flex flex-col w-full px-4 mt-6 max-w-screen-2xl mx-auto">

    <div class="flex justify-between items-center bg-[#109DB9] w-full h-auto p-4 rounded-sm text-white">

        <span>
            <h1>My Pets</h1>
            <p>View and manage your pets </p>
        </span>

        <span>
            <a href="/dashboard" class="font-semibold p-4 underline">Back to Dashboard</a>
        </span>
    </div>

    <div class="flex gap-8 mt-8">

        <!-- Card -->
        <div class="bg-white p-2 w-96">
            <div class="flex gap-3">
    
                <div class="flex flex-shrink-0 overflow-hidden rounded-sm w-32 h-auto ">
                    <img src="/assets/images/isla.jpg" alt="" class="object-cover">
                </div>
    
                <div class="flex flex-col w-full">
                    <h2>Isla</h2>
    
                    <span class="flex justify-between text-sm">
                        <p>Age:</p>
                        <p>3</p>
                    </span>
    
                    <span class="flex justify-between text-sm">
                        <p>Sex:</p>
                        <p>Female</p>
                    </span>
    
                    <span class="flex justify-between text-sm">
                        <p>Breed:</p>
                        <p>Cockapoo</p>
                    </span>
    
                    <a href="#" class="bg-emerald-500 text-white w-ful p-2 mt-3 rounded-sm">
                        View Details
                    </a>
    
                </div>
    
            </div>
        </div>
        <!-- End Card -->
    
    
        <!-- Add pet card -->
    
        <a href="#" class="flex items-center gap-6 bg-white px-5 py-2 h-fit my-auto">
            <div class="bg-emerald-500 size-16 rounded-full">
                <img src="" alt="">
            </div>
            <p class="font-semibold">Add pet</p>
        </a>
    
    
    </div>
</div>



<?php 
require_once( __DIR__ . "../components/footer.php");
?>
