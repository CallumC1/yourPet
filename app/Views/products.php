<!-- A page title can be set here or leave blank for default. -->
<?php $pageTitle = "YourPet - Products";
require_once( __DIR__ . "../components/header.php");
require_once( __DIR__ . "../components/navbar.php");

?>

Products Page.

<a href="/products/type/:test">Test Products</a>

<?php

    foreach ($products as $product) {
        var_dump($product);
    }

?>


<?php 
require_once( __DIR__ . "../components/footer.php");
?>
