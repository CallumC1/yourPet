
<!-- A page title can be set here or leave blank for default. -->
<?php $pageTitle = "User Dashboard";
require_once( __DIR__ . "../../components/header.php");
require_once( __DIR__ . "../../components/navbar.php");
?>


<!-- Page Container -->
<div class="flex flex-col w-full px-4 mt-4 max-w-screen-2xl mx-auto">

    <div class="bg-[#b97510] w-full h-auto p-4 rounded-sm text-white">
        <h1>Admin Dashboard</h1>
        <p>Welcome to your dashboard, <span class="font-semibold"><?php out($_SESSION["user_data"]["name"]) ?></span>! </p>
        <a href="/logout" class="text-xs">Sign out</a>
    </div>



</div>

<?php 
require_once( __DIR__ . "../../components/footer.php");
?>
