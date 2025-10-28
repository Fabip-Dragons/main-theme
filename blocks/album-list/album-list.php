<?php

/**
 * Album List Block Template
 * 
 * @param array $block The block settings and attributes.
 */

// Debug: Check if we're getting the block data
$songs = get_field('songs');

$anchor = '';
if (!empty($block['anchor'])) {
	$anchor = esc_attr($block['anchor']);
}

$className = 'album-list';
if (!empty($block['className'])) {
	$className .= ' ' . $block['className'];
}

// Debug output for development
if (WP_DEBUG && current_user_can('administrator')) {
	echo '<!-- Debug: Songs data: ' . print_r($songs, true) . ' -->';
	echo '<!-- Debug: Block data: ' . print_r($block, true) . ' -->';
}

if (empty($songs) || !is_array($songs)) {
	echo '<div class="album-list-placeholder">';
	echo '<p style="padding: 20px; background: #f0f0f0; border: 2px dashed #ccc; text-align: center;">No songs added yet. Please add songs using the block fields panel on the right.</p>';
	echo '</div>';
	return;
}
?>

<div id="<?= $anchor ?>" class="<?= $className ?>">
	<ol class="album-list__songs">
		<?php foreach ($songs as $index => $song): ?>
			<?php 
			$songName = isset($song['song_name']) ? $song['song_name'] : '';
			$spotifyLink = isset($song['spotify_link']) ? $song['spotify_link'] : '';
			$songNumber = $index + 1;
			
			// Skip empty songs
			if (empty($songName)) {
				continue;
			}
			?>
			<li class="album-list__song-item">
				<div class="album-list__song-content">
					<span class="album-list__song-number"><?= $songNumber ?></span>
					<p class="album-list__song-name"><?= esc_html($songName) ?></p>
					<?php if (!empty($spotifyLink)): ?>
						<a 
							href="<?= esc_url($spotifyLink) ?>" 
							class="album-list__spotify-link"
							target="_blank"
							rel="noopener noreferrer"
							aria-label="Listen to <?= esc_attr($songName) ?> on Spotify"
						>
							<span class="album-list__spotify-icon">
								<svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
									<path d="M12 0C5.4 0 0 5.4 0 12s5.4 12 12 12 12-5.4 12-12S18.66 0 12 0zm5.521 17.34c-.24.359-.66.48-1.021.24-2.82-1.74-6.36-2.101-10.561-1.141-.418.122-.779-.179-.899-.539-.12-.421.18-.78.54-.9 4.56-1.021 8.52-.6 11.64 1.32.42.18.479.659.301 1.02zm1.44-3.3c-.301.42-.841.6-1.262.3-3.239-1.98-8.159-2.58-11.939-1.38-.479.12-1.02-.12-1.14-.6-.12-.48.12-1.021.6-1.141C9.6 9.9 15 10.561 18.72 12.84c.361.181.54.78.241 1.2zm.12-3.36C15.24 8.4 8.82 8.16 5.16 9.301c-.6.179-1.2-.181-1.38-.721-.18-.601.18-1.2.72-1.381 4.26-1.26 11.28-1.02 15.721 1.621.539.3.719 1.02.42 1.56-.299.421-1.02.599-1.559.3z"/>
								</svg>
							</span>
							<span class="album-list__spotify-text">Listen on Spotify</span>
						</a>
					<?php else: ?>
						<span class="album-list__no-link">No Spotify link</span>
					<?php endif; ?>
				</div>
			</li>
		<?php endforeach; ?>
	</ol>
</div>