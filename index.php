<?php
// Checking if 'page' parameter is set, if not set to main page
if (!isset($_GET['page'])) {
    header("Location: index.php?page=main");
    exit; 
}
?>

<?php include "includes/header.php"; ?>

<?php 
if (isset($_GET['page']) && $_GET['page'] === 'main') {
    include 'includes/main.php';
} else if(isset($_GET['page']) && $_GET['page'] === 'movies') {
    include 'includes/movies.php';
}
?>

<?php include "includes/footer.php"; ?>