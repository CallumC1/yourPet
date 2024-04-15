
<!-- A page title can be set here or leave blank for default. -->
<?php $pageTitle = "User Dashboard";
require_once( __DIR__ . "../components/header.php");
?>


<!-- Page Container -->
<div class="flex">
    <!-- Sidebar -->
    <div class="bg-slate-200 flex flex-col w-72 px-2 h-screen">

        <span class="flex justify-between">
            <h2>YourPet</h2>
            <p>Menu</p>
        </span>

        <span>
            <!-- Icon Here -->
            <a href="/profile">Profile</a>
        </span>

        <span>
            <!-- Icon Here -->
            <a href="/logout">Logout</a>
        </span>
    </div>

    <div class="px-3">
        <h1>User Dashboard</h1>
        <p>Welcome to your dashboard</p>
        <p>Welcome, <?php out($_SESSION["user_data"]["name"]) ?> </p>
    </div>

</div>

<?php 
require_once( __DIR__ . "../components/footer.php");
?>
