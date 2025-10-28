/**
 * Album List Block JavaScript
 * Handles click tracking for Spotify links
 */

document.addEventListener('DOMContentLoaded', () => {
	const spotifyLinks = document.querySelectorAll('.album-list__spotify-link');

	spotifyLinks.forEach(link => {
		link.addEventListener('click', (event) => {
			const songItem = event.target.closest('.album-list__song-item');
			const songName = songItem.querySelector('.album-list__song-name')?.textContent?.trim();
			const songNumber = songItem.querySelector('.album-list__song-number')?.textContent?.trim();

			// Track click event (optional - for analytics)
			if (typeof gtag !== 'undefined') {
				gtag('event', 'spotify_link_click', {
					'song_name': songName,
					'song_number': songNumber,
					'event_category': 'engagement'
				});
			}

			// Add visual feedback
			const originalText = link.querySelector('.album-list__spotify-text').textContent;
			link.querySelector('.album-list__spotify-text').textContent = 'Opening...';
			
			setTimeout(() => {
				if (link.querySelector('.album-list__spotify-text')) {
					link.querySelector('.album-list__spotify-text').textContent = originalText;
				}
			}, 2000);
		});
	});
});
