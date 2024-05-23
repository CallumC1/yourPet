
<!-- A page title can be set here or leave blank for default. -->
<?php $pageTitle = "About";
require_once( __DIR__ . "/components/header.php");
require_once( __DIR__ . "/components/navbar.php");

?>

Home Page. <br>

<?php
out("<script>alert('Hello, World!');</script>");
?>


<?php 
require_once( __DIR__ . "/components/footer.php");
?>
