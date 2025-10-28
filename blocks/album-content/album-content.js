/**
 * Album Content Block JavaScript
 * Handles click tracking and enhanced functionality
 */

document.addEventListener('DOMContentLoaded', () => {
	const albumButtons = document.querySelectorAll('.album-content__button');

	albumButtons.forEach(button => {
		button.addEventListener('click', (event) => {
			const albumTitle = document.querySelector('.album-content__title')?.textContent?.trim();
			const artist = document.querySelector('.album-content__artist')?.textContent?.trim();
			const buttonType = button.classList.contains('album-content__button--spotify') ? 'spotify' : 'apple_music';

			// Track click event for analytics
			if (typeof gtag !== 'undefined') {
				gtag('event', 'streaming_link_click', {
					'album_title': albumTitle,
					'artist': artist,
					'platform': buttonType,
					'event_category': 'engagement'
				});
			}

			// Add visual feedback
			const originalText = button.querySelector('.album-content__button-text').textContent;
			const buttonText = button.querySelector('.album-content__button-text');
			
			buttonText.textContent = 'Opening...';
			button.style.opacity = '0.7';
			
			setTimeout(() => {
				if (buttonText) {
					buttonText.textContent = originalText;
					button.style.opacity = '1';
				}
			}, 2000);
		});
	});

	// Add keyboard navigation support
	albumButtons.forEach(button => {
		button.addEventListener('keydown', (event) => {
			if (event.key === 'Enter' || event.key === ' ') {
				event.preventDefault();
				button.click();
			}
		});
	});
});
