document.addEventListener('DOMContentLoaded', function() {
	initEpisodeTracker();
			});

function initEpisodeTracker() { 
	const params = new URLSearchParams(window.location.search);
	let serialId = params.get('id');
	let seasonId;
	try {
			seasonId = params.get('s');
	} catch (e) {
			console.log(e);
			seasonId = 1; 
	}
	const storageKey = 'watched_serial_' + serialId + 'x' + seasonId;

	try {
			let watched = JSON.parse(localStorage.getItem(storageKey));
			if (!watched) {
					watched = [];
					watched.push('1');
					localStorage.setItem(storageKey, JSON.stringify(watched));
			}
			document.querySelectorAll('.ep-btn').forEach(button => {
					const epNumber = button.getAttribute('data-number');
					if (watched && watched.includes(epNumber)) {
							button.classList.add('watched');
					}
			});
	}
	catch (e) {
			console.log(e);
	}
}

function changeEpisode(button) {
	const player = document.getElementById('video-player');
	const title = document.getElementById('episode-title');
	const newVideoSrc = button.getAttribute('data-video');
	const epNumber = button.getAttribute('data-number');

	player.src = newVideoSrc;

	document.querySelectorAll('.ep-btn').forEach(btn => {
			btn.classList.remove('active');
	});
	button.classList.add('active');

	const params = new URLSearchParams(window.location.search);
	let serialId = params.get('id');
	let seasonId;
	try {
			seasonId = params.get('s');
	} catch (e) {
			console.log(e);
			seasonId = 1; 
	}
	const storageKey = 'watched_serial_' + serialId + 'x' + seasonId;

	button.classList.add('watched');
	let watched = JSON.parse(localStorage.getItem(storageKey)) || [];
	if (!watched.includes(epNumber)) {
			watched.push(epNumber);
	}
	localStorage.setItem(storageKey, JSON.stringify(watched));
}