<!-- A page title can be set here or leave blank for default. -->
<?php $pageTitle = "YourPet - Products";
require_once( __DIR__ . "../components/header.php");
require_once( __DIR__ . "../components/navbar.php");

?>

<div class="flex flex-col mx-auto max-w-screen-xl">
    
    <h2 class="text-2xl font-semibold mt-5 mb-3 underline">Products</h2>

    <div class="grid grid-cols-4 gap-3">
        <?php
        // Loop through the products and include the productCard component
        if (isset($products)) {
            foreach ($products as $product){
                $product_type = $product['product_type'];
                $product_name = $product['product_name'];
                $product_stock = $product['product_stock'];
    
                include( __DIR__ . "../components/productCard.php"); 
            }
        } 
        ?>
    </div>
</div>



<?php 
require_once( __DIR__ . "../components/footer.php");
?>