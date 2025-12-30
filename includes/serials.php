<?php
include_once "db.php";
include_once "SQL_requests.php";
$result = mysqli_query($conn, $SQL_GET_SERIALS);
?>

<main id="serials">
<div class="movie-container">

<?php
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        ?>
        <div class="movie-card">
          <div class="movie-card_image">
            <a href="index.php?page=serial_view&id=<?php echo $row['id']; ?>&s=1">
              <img src="<?php echo $row['picture']; ?>" alt="Название фильма">
            </a>
          </div>
          <div class="movie_info">
            <h2 class="movie_name"><?php echo $row['title']; ?></h2>
            <p class="movie_year"><?php echo $row['release_year']; ?></p>
          </div>
        </div>
        <?php
    }
} else {
    echo "<p>Сериалы пока не добавлены.</p>";
}
?>

  </div>
</main>