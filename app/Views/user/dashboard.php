
<!-- A page title can be set here or leave blank for default. -->
<?php $pageTitle = "User Dashboard";
require_once( __DIR__ . "/../components/header.php");
require_once( __DIR__ . "/../components/navbar.php");
?>


<!-- Page Container -->
<div class="flex flex-col w-full px-4 mt-4 max-w-screen-2xl mx-auto">

    <div class="bg-[#109DB9] w-full h-auto p-4 rounded-sm text-white">
        <h1>User Dashboard</h1>
        <p>Welcome to your dashboard, <span class="font-semibold"><?php out($_SESSION["user_data"]["name"]) ?></span>! </p>
        <p>Here you can manage your added pets, scheduled appointments, orders and user profile.</p>
        <a href="/logout" class="text-xs">Sign out</a>
    </div>


    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 mx-auto gap-8 my-6 w-full h-full items-center place-items-center ">

        <?php
        // Dashboard Cards
        // Imported from components/dashboardCard.php
        $cards = [
            [
                'title' => 'My Pets',
                'description' => 'View and manage your pets',
                'link' => '/pets',
            ],
            [
                'title' => 'Appointments',
                'description' => 'Book and view Appointments',
                'link' => '#',
            ],
            [
                'title' => 'My Orders',
                'description' => 'View your orders',
                'link' => '#',
            ],
            [
                'title' => 'My Profile',
                'description' => 'View and edit your profile',
                'link' => '#',
            ]
        ];

        foreach ($cards as $card) {
            extract($card);
            include(__DIR__ . "/components/dashboardCard.php");
        };
        ?>

    </div>

</div>

<?php 
require_once( __DIR__ . "/../components/footer.php");
?>
