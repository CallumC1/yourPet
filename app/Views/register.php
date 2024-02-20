<!-- A page title can be set here or leave blank for default. -->
<?php $pageTitle = "Register for an account";
require_once( __DIR__ . "../components/header.php");
require_once( __DIR__ . "../components/navbar.php");

?>

Register Page.

<div>
    <form action="/registerSubmit" method="POST" class="flex flex-col gap-2 w-96 p-5">

        <span class="flex flex-col">
            <label for="full_name">Full Name</label>
            <input type="text" name="full_name" placeholder="John Doe" class="border-2 rounded-sm border-black pl-1">
        </span>

        
        <span class="flex flex-col">
            <label for="email">Email address</label>
            <input type="email" name="email" placeholder="your@email.com" class="border-2 rounded-sm border-black pl-1">
        </span>

        <span class="flex flex-col">
            <label for="password">Password</label>
            <input type="password" name="password" placeholder="Enter password" class="border-2 rounded-sm border-black pl-1">
        </span>

        <input type="submit" value="Register" class="bg-green-600">
    </form>
</div>

<?php 
require_once( __DIR__ . "../components/footer.php");
?>
