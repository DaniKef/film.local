<main id="serial-view">
<?php
include_once "db.php";
include_once "SQL_requests.php";
if (isset($_GET['id'])) {
	$serial_id = (int)$_GET['id'];
	$season_num = (int)$_GET['s'];
	$seasons_list = getSeasonsCount($conn, $serial_id);
	$episodes = getEpisodesBySerialIdAndSeasonNum($conn, $serial_id, $season_num);
	$all_episodes = mysqli_fetch_all($episodes, MYSQLI_ASSOC);
	$first_episode = $all_episodes[0] ?? null;
}
?>

<div class="player-container">
    <?php if ($first_episode): ?>
        <div class="main-video">
            <video id="video-player" controls>
                <source src="<?php echo $first_episode['file_path']; ?>" type="video/mp4">
                Ваш браузер не поддерживает видео.
            </video>
            <h2 id="episode-title">Серия <?php echo $first_episode['episode_number']; ?></h2>
        </div>

        <div class="episodes-nav">
            <?php foreach ($all_episodes as $index => $ep): ?>
                <button 
                    class="ep-btn <?php echo ($index === 0) ? 'active' : ''; ?>" 
                    data-video="<?php echo $ep['file_path']; ?>" 
                    data-number="<?php echo $ep['episode_number']; ?>"
                    onclick="changeEpisode(this)"
                >
                    <?php echo $ep['episode_number']; ?>
                </button>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p>Серии не найдены.</p>
    <?php endif; ?>
</div>

<script>
	function changeEpisode(button) {
    const player = document.getElementById('video-player');
    const title = document.getElementById('episode-title');
    const newVideoSrc = button.getAttribute('data-video');
    const epNumber = button.getAttribute('data-number');

    player.src = newVideoSrc;

    title.innerText = "Серия " + epNumber;

    document.querySelectorAll('.ep-btn').forEach(btn => {
        btn.classList.remove('active');
    });
    button.classList.add('active');
}
</script>

</main>