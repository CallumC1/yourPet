<?php

require_once( __DIR__ . "/components/header.php");

?>

<div class="flex flex-col h-screen w-screen mx-auto justify-center items-center">
    <div class="size-80">
        <?php

            $images = [
                "/assets/images/404.webp",
                "/assets/images/404-2.webp",
                "/assets/images/404-3.webp",
            ];

            $imag = $images[array_rand($images)];

        ?>
        <img src="<?= $imag ?>" alt="Cute Dog holding Page Not Found sign" class="w-80 h-80">
    </div>

    <h1>404 - Page not found.</h1>
    <p class="text-lg">Sorry, the page you are looking for does not exist.</p>
    <a href="/" class="text-xl text-blue-500 underline">Go back home</a>
</div>



</body>
</html>