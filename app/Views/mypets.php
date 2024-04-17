
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
            <a href="/dashboard" class="p-4">Back to Dash</a>
        </span>
    </div>


    test
</div>

<?php 
require_once( __DIR__ . "../components/footer.php");
?>
