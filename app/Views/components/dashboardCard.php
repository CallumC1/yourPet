
<!-- My Pets Card -->
<div class="flex flex-col gap-y-3 bg-white w-full md:w-80 h-auto p-3 ring-emerald-500 duration-200 hover:ring-2 pointer-events-none drop-shadow-md rounded-md">

    <div class="flex gap-x-4 items-center">

        <!-- Might look better without icons -->
        <span class="w-14 h-14 bg-[#109DB9] rounded-md flex justify-center items-center ">
            <img src="/assets/icons/user.svg" alt="Profile" class="size-8" /> <!-- CUSTOM TO DO -->
        </span>

        <span class="flex flex-col ml-3">
            <h2><?= $title ?></h2> 
            <p><?= $description ?></p> 
        </span>

    </div>

    <!-- Button / Link -->
    <a href="<?= $link ?>"  class="group text-white font-semibold  bg-emerald-500 w-full px-2 py-3 mx-auto rounded-md pointer-events-auto hover:bg-emerald-600">
        <span class="flex">
            <?= $linkText ?>
            <img src="/assets/icons/arrow-right.svg" alt="Right Arrow" class="size-6 ml-2 group-hover:translate-x-1 transition-transform"> 
        </span>
    </a> 

</div>