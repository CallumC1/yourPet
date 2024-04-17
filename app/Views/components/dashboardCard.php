
<!-- My Pets Card -->
<a href="<?= $link ?>" class="group flex flex-col gap-y-3 bg-white w-full md:w-80 h-auto px-3 py-6 ring-emerald-500 duration-200 hover:ring-2 drop-shadow-md rounded-md cursor-pointer">

    <div class="flex gap-x-4 items-center size-full">

        <div class="flex flex-col w-full">
            <span class="flex items-center justify-between">
                <h2><?= $title ?></h2> 
                <img src="/assets/icons/arrow-right-black.svg" alt="Right Arrow" class="size-6 mr-1 group-hover:translate-x-1 transition-transform"> 
            </span>
            
            <p><?= $description ?></p> 
        </div>

    </div>

</a>