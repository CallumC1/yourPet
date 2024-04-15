
<!-- A page title can be set here or leave blank for default. -->
<?php $pageTitle = "User Dashboard";
require_once( __DIR__ . "../components/header.php");
require_once( __DIR__ . "../components/navbar.php");
?>


<!-- Page Container -->
<div class="flex flex-col w-full px-3 mt-8 max-w-screen-2xl mx-auto">

    <div class="bg-[#109DB9] w-full h-60 mx-3 p-4 rounded-sm text-white">
        <h1>User Dashboard</h1>
        <p>Welcome to your dashboard, <?php out($_SESSION["user_data"]["name"]) ?> </p>
    </div>


    <div class="flex flex-col md:flex-row gap-8 p-3 w-full h-full ">



        <!-- Card -->
        <div class="flex flex-col gap-y-3 bg-white w-80 h-36 rounded-md p-3 ring-emerald-500 duration-200 hover:ring-2 pointer-events-none drop-shadow-md">

            <div class="flex gap-x-4 items-center">

                <span class="size-14 bg-[#109DB9] rounded-md flex justify-center items-center ">
                    <img src="/assets/icons/user.svg" alt="Profile" class="size-8" />
                </span>
        
                <span class="flex flex-col ml-3">
                    <h2>My Pets</h2>
                    <p>View and manage your pets</p>
                </span>

            </div>

            <a href="#" class="bg-emerald-500 w-full  mx-auto px-2 py-3 rounded-md text-white font-semibold text-center pointer-events-auto">Pets</a>

        </div>

        <!-- Card -->
        <div class="flex flex-col gap-y-3 bg-white w-80 h-36 rounded-md p-3 ring-emerald-500 duration-200 hover:ring-2 pointer-events-none drop-shadow-md">

            <div class="flex gap-x-4 items-center">

                <span class="size-14 bg-[#109DB9] rounded-md flex justify-center items-center ">
                    <img src="/assets/icons/user.svg" alt="Profile" class="size-8" />
                </span>
        
                <span class="flex flex-col ml-3">
                    <h2>Appointments</h2>
                    <p>Book and view Appointments</p>
                </span>

            </div>

            <a href="#" class="bg-emerald-500 w-full  mx-auto px-2 py-3 rounded-md text-white font-semibold text-center pointer-events-auto">Appointments</a>

        </div>

        <!-- Card -->
        <div class="flex flex-col gap-y-3 bg-white w-80 h-36 rounded-md p-3 ring-emerald-500 duration-200 hover:ring-2 pointer-events-none drop-shadow-md">

            <div class="flex gap-x-4 items-center">

                <span class="size-14 bg-[#109DB9] rounded-md flex justify-center items-center ">
                    <img src="/assets/icons/user.svg" alt="Profile" class="size-8" />
                </span>

                <span class="flex flex-col ml-3">
                    <h2>My Profile</h2>
                    <p>View and edit your profile</p>
                </span>

            </div>

            <a href="#" class="bg-emerald-500 w-full  mx-auto px-2 py-3 rounded-md text-white font-semibold text-center pointer-events-auto">Manage Profile</a>

        </div>


    </div>

</div>

<?php 
require_once( __DIR__ . "../components/footer.php");
?>
