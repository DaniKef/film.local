<main class="serial-view">
<?php
include_once "db.php";
include_once "SQL_requests.php";
if (isset($_GET['id'])) {
	$film_id = (int)$_GET['id'];
	$movie = getMovieByID($conn, $film_id);
	$movie_data = mysqli_fetch_assoc($movie);
}
?>
<div class="player-container">
		<?php if ($movie_data): ?>
				<div class="main-video">
						<video id="video-player" controls>
							<source src="<?php echo $movie_data['video_path']; ?>"
								type="video/mp4">
								<source src="<?php echo $movie_data['video_path']; ?>"
								type="video/ogg">
								<source src="<?php echo $movie_data['video_path']; ?>"
								type="video/webm">
								<source src="<?php echo $movie_data['video_path']; ?>"
								type="video/x-matroska">
								Ваш браузер не поддерживает видео.
						</video>
				</div>
		<?php else: ?>
				<p>Фильм не найден.</p>
		<?php endif; ?>
</div>
</main>