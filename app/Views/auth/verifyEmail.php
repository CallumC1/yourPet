<?php
$pageTitle = "YourPet - Verify Email";
require_once(__DIR__ . "/../components/header.php");
$last_email = $_SESSION["last_verification_email"] ?? null;
?>


<!-- A page title can be set here or leave blank for default. -->
<?php
$pageTitle = "Verify Email | YourPet";
$pageBackground = "bg-white";
$bodyClasses = "min-h-screen h-full";
require_once(__DIR__ . "/components/header.php");

?>


<div class="flex w-screen h-screen">
    <div class="grid grid-cols-1 lg:grid-cols-2 px-4 lg:px-0 mx-auto lg:mx-0 lg:gap-x-44 2xl:gap-x-72 ">
        <div class="relative hidden lg:block padding-2 overflow-hidden max-w-sm 2xl:max-w-lg"> 
            <a href="/" class="tracking-wide absolute m-4">
                <p class="text-2xl font-bold text-emerald-600" >YourPet</p>
                <p class="text-xs">medical experts</p>
            </a>
            <img src="/assets/images/dog-and-woman.jpg" alt="" class="h-full object-cover">
        </div>

        <div class="flex flex-col justify-center max-w-lg w-full h-full ">
            <a href="/" class="flex items-center gap-2 mb-2">
                <img src="/assets/icons/arrow-left-circle.svg" alt="" class="w-5 h-5">
                <p class="hover:underline underline-offset-2 text-blue-500 font-semibold">Go back</p>
            </a>
            
            <h2 class="text-2xl mb-4">Verify your Email</h2>

            <div class="flex flex-col ">
                <p class="text-sm">We have sent an email to <span class="font-semibold"><?php echo $_SESSION["user_data"]["email"]; ?></span> with a verification link. Please click the link in the email to verify your email address.</p>
                <p class="text-sm">If you have not received the email, please check your spam folder or click the button below to resend the email.</p>
                <div class="flex flex-col w-full py-3">
                    <button id="resendEmail" class="w-80 p-4 bg-gray-200 cursor-default">Resend Email</button>
                    <p id="resendEmailTime" class="text-xs"></p>
                </div>
            </div>




        </div>
    </div>
</div>


<?php
require_once(__DIR__ . "/../components/footer.php");
?>

<script>
    // This is the dumbest thing I've ever done.
    let seconds = 5;
    let resendEmail = document.getElementById("resendEmail");
    let resendEmailTime = document.getElementById("resendEmailTime");

    function resendVerificationEmail() {
        resendEmail.addEventListener("click", () => {
            resendEmail.style.backgroundColor = "#e5e7eb";
            resendEmail.style.cursor = "default";
            fetch("/auth/email/resend")
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    console.log(data.type);
                    if (data.type == "success") {
                        resendEmail.innerHTML = "Email sent!";
                    }
                    seconds = 5;
                });
        });
    }

    setInterval(() => {
        seconds--;
        if (seconds < 0) {
            return;
        }
        if (seconds <= 0) {
            resendEmail.innerHTML = "Resend Email";
            resendEmail.style.backgroundColor = "#10b981";
            resendEmail.style.cursor = "pointer";
            resendVerificationEmail();
            resendEmailTime.innerHTML = "";
        } else {
            resendEmailTime.innerHTML = `Resend email in ${seconds} seconds`;
        }

    }, 1000);

</script>