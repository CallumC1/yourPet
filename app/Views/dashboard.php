
<!-- A page title can be set here or leave blank for default. -->
<?php $pageTitle = "User Dashboard";
require_once( __DIR__ . "../components/header.php");
?>

<h1>User Dashboard</h1>
<p>Welcome, <?php out($_SESSION["user_data"]["name"]) ?> </p>

<?php 
require_once( __DIR__ . "../components/footer.php");
?>
