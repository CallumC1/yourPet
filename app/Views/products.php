<!-- A page title can be set here or leave blank for default. -->
<?php $pageTitle = "YourPet - Products";
require_once( __DIR__ . "../components/header.php");
require_once( __DIR__ . "../components/navbar.php");

?>

Products Page.
<div class="flex justify-center">
    <div class="grid grid-cols-4 gap-3">
    
        <?php
        foreach ($products as $product): 
            $product_type = $product['product_type'];
            $product_name = $product['product_name'];
            $product_stock = $product['product_stock'];
        ?>
    
            <?php include( __DIR__ . "../components/productCard.php"); ?>
    
        <?php endforeach; ?>
    
    </div>
</div>








<?php 
require_once( __DIR__ . "../components/footer.php");
?>