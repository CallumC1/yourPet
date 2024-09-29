
<!-- A page title can be set here or leave blank for default. -->
<?php $pageTitle = "My Pets";
require_once( __DIR__ . "/../components/header.php");
require_once( __DIR__ . "/../components/navbar.php");
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




    <div class="flex flex-wrap gap-8 mt-8">

        
        <!-- Pet cards -->
        <?php
        include(__DIR__ . "/../components/petCard.php");
        ?>
    
    
        <!-- Add pet card -->
    
        <a href="#" class="flex flex-col items-center justify-center gap-2 bg-white px-5 py-2 size-40">
            <p class="font-semibold">Add Pet</p>
            <div class="bg-emerald-500 size-16 rounded-full flex justify-center items-center">
                <img src="/assets/icons/plus.svg" alt="" class="size-10">
            </div>
        </a>
    
    
    </div>
</div>



<?php 
require_once( __DIR__ . "/../components/footer.php");
?>
