<!-- A page title can be set here or leave blank for default. -->
<?php 
$pageTitle = "Register for an account";
$pageBackground = "bg-slate-100"; 
$bodyClasses = "h-screen overflow-hidden";
require_once( __DIR__ . "../components/header.php");
require_once( __DIR__ . "../components/navbar.php");

?>


<div class="flex h-screen -mt-16">
    <div class="grid grid-cols-2 mx-auto my-auto gap-5 p-10 justify-center max-w-screen-lg h-96 bg-white rounded-md">

        <div class="padding-2 rounded-sm overflow-hidden">
            <img src="/assets/images/dog-and-woman.jpg" alt="" class="w-full h-full object-cover">
        </div>

        <div class="flex flex-col justify-center w-full h-full" >
            <h2 class="text-2xl font-semibold mb-8">Register</h2>
    
            <form action="/registerSubmit" method="POST" class="flex flex-col gap-2 w-96">
     
                <span class="flex flex-col mt-2">
                    <label for="email">Email address</label>
                    <input type="email" name="email" placeholder="Your email address" class="py-1 pl-2 pr-1 border rounded-sm  border-gray-200 focus:ring-1 focus:ring-green-600">
                </span>
        
                <span class="flex flex-col mt-2">
                    <label for="password">Password</label>
                    <input type="password" name="password" placeholder="Enter a password" class="py-1 pl-2 pr-1 rounded-sm  border border-gray-200 ">
                </span>
        
                <input type="submit" value="Register" class="cursor-pointer bg-green-500 hover:bg-green-600 mt-4 p-3 rounded-sm">
            </form>
        </div>

 

    </div>
</div>

<?php 
require_once( __DIR__ . "../components/footer.php");
?>
