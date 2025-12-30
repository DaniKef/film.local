<?php
$SQL_GET_SERIALS = "SELECT id, title, release_year, picture FROM serials";
$SQL_GET_SERIAL_BY_ID = "SELECT * FROM episodes WHERE serial_id = ?";

function getSeasonsCount($conn, $serial_id) {
    $sql = "SELECT DISTINCT season_number FROM episodes WHERE serial_id = ? ORDER BY season_number";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $serial_id);
    mysqli_stmt_execute($stmt);
    return mysqli_stmt_get_result($stmt);
}
function getEpisodesBySerialIdAndSeasonNum($conn, $serial_id, $season_num = 1) {
    /*$sql = "SELECT * FROM episodes WHERE serial_id = ? ORDER BY season_number, episode_number";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $serial_id);
    mysqli_stmt_execute($stmt);
    return mysqli_stmt_get_result($stmt);*/
		$sql = "SELECT * FROM episodes 
            WHERE serial_id = ? AND season_number = ? 
            ORDER BY episode_number ASC";
    $stmt = mysqli_prepare($conn, $sql);
		mysqli_stmt_bind_param($stmt, "ii", $serial_id, $season_num);
    mysqli_stmt_execute($stmt);
    return mysqli_stmt_get_result($stmt);
}
?>