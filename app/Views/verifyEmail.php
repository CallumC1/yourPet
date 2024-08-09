<?php 
$pageTitle = "YourPet - Verify Email";
require_once( __DIR__ . "/components/header.php");
$last_email = $_SESSION["last_verification_email"] ?? null;
?>

<div class="w-screen h-screen ">
    <div class="flex flex-col w-96 h-full mx-auto justify-center items-center gap-5">
        <div class="bg-white drop-shadow-md w-full px-10 py-5 text-center">
            <a href="/" class="tracking-wide">
                <p class="text-2xl font-bold text-emerald-600" >YourPet</p>
                <p class="text-xs">medical experts</p>
            </a>
            <h1 class="">Verification link sent!</h1>
            <p class="">Please check your emails shortly.</p>
        </div>
        <div class="w-full px-10 py-5 bg-white drop-shadow-md">
            <p class="text-xs">Emails may take a few minutes to reach your inbox, If the email has not arrived click below to resend the email.</p>
            <p class="text-xs text-gray-500 line-through pt-2" id="resend">Resend Email</p> 
        </div>
    </div>
</div>

<script>
    let seconds = 5;
    let resend = document.getElementById("resend");

    function resendEmail() {
        resend.innerHTML = "Resend email";
            resend.style.cursor = "pointer";
            resend.style.color = "#0000EE";
            resend.addEventListener("click", () => {
                fetch("/auth/email/resend")
                    .then(response => response.json())
                    .then(data => {
                        console.log(data);
                        console.log(data.status);
                        if (data.status == "success") {
                            resend.innerHTML = "Email sent!";
                            resend.style.cursor = "not-allowed";
                            seconds = 5;
                        }
                    });
            });
    }

    setInterval(() => {
        seconds--;
        if (seconds < 0) {
            return;
        }
        if (seconds <= 0) {
            resendEmail();
        } else {
            resend.innerHTML = `<s>Resend Email</s>: ${seconds}`;
        }
    }, 1000);
    
</script>

<?php 
require_once( __DIR__ . "/components/footer.php");
?>