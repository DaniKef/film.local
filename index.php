<?php
// Checking if 'page' parameter is set, if not set to main page
if (!isset($_GET['page'])) {
    header("Location: index.php?page=main");
    exit; 
}
?>
<?php include "includes/db.php"; ?>

<?php include "includes/header.php"; ?>

<?php 
if (isset($_GET['page']) && $_GET['page'] === 'main') {
    include 'includes/main.php';
} 
else if (isset($_GET['page']) && $_GET['page'] === 'movies') {
    include 'includes/movies.php';
}
else if (isset($_GET['page']) && $_GET['page'] === 'serials') {
    include 'includes/serials.php';
}
else if (isset($_GET['page']) && $_GET['page'] === 'serial_view') {
    include 'includes/serial_view.php';
}
?>

<?php include "includes/footer.php"; ?>