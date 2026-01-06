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

<div class="seasons-nav">
    <?php 
    $seasons_array = mysqli_fetch_all($seasons_list, MYSQLI_ASSOC);
    $count = count($seasons_array);
    for ($i = 0; $i < $count; $i++) { 
        $s = $seasons_array[$i]['season_number'];
        $season_url = "index.php?page=serial_view&id=" . $serial_id . "&s=" . $s;
        $is_active = ($s === $season_num) ? 'active' : '';
        ?>
        <button 
        class="season-btn <?php echo $is_active; ?>"
        data-season-url="<?php echo $season_url; ?>"
        onclick="changeSeason(this)"
        >
            Сезон <?php echo $s; ?>
        </button>
        <?php 
    } 
    ?>
</div>

<div class="player-container">
    <?php if ($first_episode): ?>
        <div class="main-video">
            <video id="video-player" src="<?php echo $first_episode['file_path']; ?>" type="video/webm" controls>
                Ваш браузер не поддерживает видео.
            </video>
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

<script src="includes/js_serial_view.js"></script>
</main>