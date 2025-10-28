<?php

/**
 * Album Content Block Template
 * 
 * @param array $block The block settings and attributes.
 */

// Get custom fields
$albumName = get_field('album_name');
$artistName = get_field('artist');
$isExplicit = get_field('explicit');
$spotifyLink = get_field('spotify_link');
$appleMusicLink = get_field('apple_music_link');

$anchor = '';
if (!empty($block['anchor'])) {
	$anchor = esc_attr($block['anchor']);
}

$className = 'album-content';
if (!empty($block['className'])) {
	$className .= ' ' . $block['className'];
}

// Debug output for development
if (WP_DEBUG && current_user_can('administrator')) {
	echo '<!-- Debug: Album data: ' . print_r([
		'album_name' => $albumName,
		'artist' => $artistName,
		'explicit' => $isExplicit,
		'spotify_link' => $spotifyLink,
		'apple_music_link' => $appleMusicLink
	], true) . ' -->';
}
?>

<div id="<?= $anchor ?>" class="<?= $className ?>">
	<!-- Album Header Section -->
	<div class="album-content__header">
		<!-- Album Cover -->
		<div class="album-content__cover">
			<?php if (has_post_thumbnail()): ?>
				<?php the_post_thumbnail('large', [
					'class' => 'album-content__cover-image',
					'alt' => esc_attr($albumName ? $albumName . ' album cover' : 'Album cover')
				]); ?>
			<?php else: ?>
				<div class="album-content__cover-placeholder">
					<span class="album-content__cover-icon">🎵</span>
					<p>No cover image</p>
				</div>
			<?php endif; ?>
		</div>

		<!-- Album Info -->
		<div class="album-content__info">
			<?php if (!empty($albumName)): ?>
				<h1 class="album-content__title"><?= esc_html($albumName) ?></h1>
			<?php else: ?>
				<h1 class="album-content__title"><?= get_the_title() ?></h1>
			<?php endif; ?>

			<div class="album-content__meta">
				<?php if (!empty($artistName)): ?>
					<p class="album-content__artist"><?= esc_html($artistName) ?></p>
				<?php endif; ?>

				<?php if ($isExplicit): ?>
					<span class="album-content__explicit">Explicit</span>
				<?php endif; ?>
			</div>
		</div>
	</div>

	<!-- Streaming Links Section -->
	<div class="album-content__actions">
		<?php if (!empty($spotifyLink)): ?>
			<a 
				href="<?= esc_url($spotifyLink) ?>" 
				class="album-content__button album-content__button--spotify"
				target="_blank"
				rel="noopener noreferrer"
				aria-label="Listen to <?= esc_attr($albumName ?: get_the_title()) ?> on Spotify"
			>
				<span class="album-content__button-icon">
					<svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
						<path d="M12 0C5.4 0 0 5.4 0 12s5.4 12 12 12 12-5.4 12-12S18.66 0 12 0zm5.521 17.34c-.24.359-.66.48-1.021.24-2.82-1.74-6.36-2.101-10.561-1.141-.418.122-.779-.179-.899-.539-.12-.421.18-.78.54-.9 4.56-1.021 8.52-.6 11.64 1.32.42.18.479.659.301 1.02zm1.44-3.3c-.301.42-.841.6-1.262.3-3.239-1.98-8.159-2.58-11.939-1.38-.479.12-1.02-.12-1.14-.6-.12-.48.12-1.021.6-1.141C9.6 9.9 15 10.561 18.72 12.84c.361.181.54.78.241 1.2zm.12-3.36C15.24 8.4 8.82 8.16 5.16 9.301c-.6.179-1.2-.181-1.38-.721-.18-.601.18-1.2.72-1.381 4.26-1.26 11.28-1.02 15.721 1.621.539.3.719 1.02.42 1.56-.299.421-1.02.599-1.559.3z"/>
					</svg>
				</span>
				<span class="album-content__button-text">Listen on Spotify</span>
			</a>
		<?php endif; ?>

		<?php if (!empty($appleMusicLink)): ?>
			<a 
				href="<?= esc_url($appleMusicLink) ?>" 
				class="album-content__button album-content__button--apple"
				target="_blank"
				rel="noopener noreferrer"
				aria-label="Listen to <?= esc_attr($albumName ?: get_the_title()) ?> on Apple Music"
			>
				<span class="album-content__button-icon">
					<svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
						<path d="M23.997 6.124c0-.738-.065-1.47-.24-2.19-.317-1.31-1.062-2.31-2.18-3.043C21.003.517 20.373.285 19.7.164c-.517-.093-1.038-.135-1.564-.135-.693 0-1.336.054-1.965.144-.46.066-.915.156-1.37.286-.296.085-.592.184-.875.306-.43.185-.822.429-1.209.673-.157.1-.313.2-.478.288a6.824 6.824 0 0 0-.26.167c-.093.063-.186.129-.273.2-.348.281-.666.598-.954.947-.149.181-.287.372-.415.571-.064.1-.124.202-.181.306-.114.208-.216.424-.308.647-.184.445-.316.907-.401 1.38-.043.238-.07.478-.086.72-.014.207-.021.415-.021.623 0 .2.007.4.021.598.016.24.043.478.086.714.085.472.217.933.401 1.378.092.223.194.439.308.647.057.104.117.206.181.306.128.199.266.39.415.571.288.349.606.666.954.947.087.071.18.137.273.2.087.056.174.11.26.167.165.088.321.188.478.288.387.244.779.488 1.209.673.283.122.579.221.875.306.455.13.91.22 1.37.286.629.09 1.272.144 1.965.144.526 0 1.047-.042 1.564-.135.673-.121 1.303-.353 1.877-.727 1.118-.733 1.863-1.732 2.18-3.043.175-.72.24-1.452.24-2.19V6.124zM22.027 18.65c-.141.539-.398 1.026-.778 1.414-.297.305-.662.538-1.07.69-.264.098-.54.164-.822.196-.191.022-.384.032-.577.032-.5 0-.99-.04-1.467-.12-.31-.052-.616-.122-.914-.214-.193-.06-.381-.131-.564-.214-.265-.121-.513-.266-.747-.428-.117-.081-.23-.167-.338-.258-.054-.046-.107-.093-.158-.142-.102-.098-.196-.204-.284-.316-.176-.224-.33-.464-.463-.719-.066-.128-.126-.26-.179-.395-.106-.27-.19-.55-.25-.836-.031-.148-.054-.298-.07-.45-.015-.14-.022-.282-.022-.424 0-.142.007-.284.022-.424.016-.152.039-.302.07-.45.06-.286.144-.566.25-.836.053-.135.113-.267.179-.395.133-.255.287-.495.463-.719.088-.112.182-.218.284-.316.051-.049.104-.096.158-.142.108-.091.221-.177.338-.258.234-.162.482-.307.747-.428.183-.083.371-.154.564-.214.298-.092.604-.162.914-.214.477-.08.967-.12 1.467-.12.193 0 .386.01.577.032.282.032.558.098.822.196.408.152.773.385 1.07.69.38.388.637.875.778 1.414.07.268.103.543.103.819v11.85c0 .276-.033.551-.103.819z"/>
					</svg>
				</span>
				<span class="album-content__button-text">Listen on Apple Music</span>
			</a>
		<?php endif; ?>

		<?php if (empty($spotifyLink) && empty($appleMusicLink)): ?>
			<p class="album-content__no-links">No streaming links available</p>
		<?php endif; ?>
	</div>
</div>
