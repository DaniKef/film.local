<?php
include_once "db.php";
include_once "SQL_requests.php";
$result = mysqli_query($conn, $SQL_GET_MOVIES);
?>

<main id="movies">
    <div class="movie-container">
    <?php
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <div class="movie-card">
              <div class="movie-card_image">
                <a href="index.php?page=movie_view&id=<?php echo $row['id']; ?>">
                  <img src="<?php echo $row['picture']; ?>" alt="<?php echo $row['title']; ?>">
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
        echo "<p>Фильмы пока не добавлены.</p>";
    }
    ?>
    </div>
</main>