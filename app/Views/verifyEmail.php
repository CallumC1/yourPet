<?php 
$pageTitle = "YourPet - Verify Email";
require_once( __DIR__ . "/components/header.php");
?>

<div class="w-screen h-screen ">
    <div class="flex flex-col w-96 h-full mx-auto justify-center items-center gap-5">
        <h1 class="px-10 py-5 bg-white drop-shadow-md">Verification email sent!</h1>
        <p class="px-10 py-5 bg-white drop-shadow-md">Please open your email app and click the button which will redirect your to verify your email automatically.</p>
        <p id="resend">Resend email in: </p>
    </div>
</div>

<script>
    let seconds = 90;
    let resend = document.getElementById("resend");

    function resendEmail() {
        resend.innerHTML = "Resend email";
            resend.style.cursor = "pointer";
            resend.addEventListener("click", () => {
                fetch("/auth/email/resend")
                    .then(response => response.json())
                    .then(data => {
                        console.log(data);
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
            resend.innerHTML = `Resend email in: ${seconds} seconds`;
        }
    }, 1000);
    
</script>

<?php 
require_once( __DIR__ . "/components/footer.php");
?>