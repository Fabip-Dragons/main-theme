<?php

if ( ! function_exists('theme_setup')) {
    function theme_setup() {
        // Add theme support for various features
        add_theme_support('post-thumbnails');
        add_theme_support('title-tag');
        add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption']);
        add_theme_support('custom-logo');
        add_theme_support('responsive-embeds');
        add_theme_support('wp-block-styles');
        add_theme_support('align-wide');
        add_theme_support('editor-styles');
        
        // Register navigation menus
        register_nav_menus([
            'primary' => __('Primary Menu', 'main-theme'),
        ]);
    }
    add_action('after_setup_theme', 'theme_setup');
}

add_action('wp_enqueue_scripts', 'main_styles');

function main_scripts() {
    wp_enqueue_script( 
        'album-list', // ID, NOME UNIVOCO, HANDLE
        get_stylesheet_directory_uri() . '/blocks/album-list/album-list.js', 
        array('jquery'), // Dipendenze
        '1.8.1', // versione
        true // true = nel footer, false = nell'header
    );
}
add_action('wp_enqueue_scripts', 'main_scripts');

/**
 * Register ACF blocks
 */
if (!function_exists('registerAcfBlocks')) {
	function registerAcfBlocks(): void {
		// Check if ACF is active
		if (!function_exists('acf_register_block_type')) {
			return;
		}

		// Register Album List block
		acf_register_block_type([
			'name'              => 'album-list',
			'title'             => __('Album List', 'main-theme'),
			'description'       => __('List that contains all the songs of an album with Spotify links', 'main-theme'),
			'render_template'   => get_template_directory() . '/blocks/album-list/album-list.php',
			'render_callback'   => 'renderAlbumListBlock',
			'category'          => 'widgets',
			'icon'              => 'playlist-audio',
			'keywords'          => ['Lista', 'Album', 'Canzoni', 'Songs', 'Spotify', 'Music'],
			'supports'          => [
				'anchor' => true,
				'align'  => false,
			],
			'enqueue_style'     => get_template_directory_uri() . '/blocks/album-list/album-list.css',
			'enqueue_script'    => get_template_directory_uri() . '/blocks/album-list/album-list.js',
		]);

		// Register Album Content block
		acf_register_block_type([
			'name'              => 'album-content',
			'title'             => __('Album Content', 'main-theme'),
			'description'       => __('Block that displays the content of an album with Spotify links', 'main-theme'),
			'render_template'   => get_template_directory() . '/blocks/album-content/album-content.php',
			'category'          => 'widgets',
			'icon'              => 'format-audio',
			'keywords'          => ['Album', 'Music', 'Spotify', 'Apple Music', 'Cover'],
			'supports'          => [
				'anchor' => true,
				'align'  => false,
			],
			'enqueue_style'     => get_template_directory_uri() . '/blocks/album-content/album-content.css',
			'enqueue_script'    => get_template_directory_uri() . '/blocks/album-content/album-content.js',
		]);
	}
	add_action('acf/init', 'registerAcfBlocks');
}

/**
 * Render callback for Album List block
 */
if (!function_exists('renderAlbumListBlock')) {
	function renderAlbumListBlock(array $block, string $content = '', bool $isPreview = false, int $postId = 0): void {
		// Include the template file
		$template = get_template_directory() . '/blocks/album-list/album-list.php';
		if (file_exists($template)) {
			include $template;
		}
	}
}

/**
 * Add ACF field groups programmatically for Album List
 */
if (!function_exists('addAlbumListFields')) {
	function addAlbumListFields(): void {
		if (!function_exists('acf_add_local_field_group')) {
			return;
		}

		acf_add_local_field_group([
			'key' => 'group_album_list_block',
			'title' => 'Album List Block Fields',
			'fields' => [
				[
					'key' => 'field_album_songs',
					'label' => 'Songs',
					'name' => 'songs',
					'type' => 'repeater',
					'instructions' => 'Add songs to your album list. Each song can have a name and optional Spotify link.',
					'required' => 0,
					'conditional_logic' => 0,
					'sub_fields' => [
						[
							'key' => 'field_song_name',
							'label' => 'Song Name',
							'name' => 'song_name',
							'type' => 'text',
							'instructions' => 'Enter the title of the song',
							'required' => 1,
							'placeholder' => 'Enter song title...',
							'maxlength' => 200,
						],
						[
							'key' => 'field_spotify_link',
							'label' => 'Spotify Link',
							'name' => 'spotify_link',
							'type' => 'url',
							'instructions' => 'Enter the full Spotify URL for this song (optional)',
							'required' => 0,
							'placeholder' => 'https://open.spotify.com/track/...',
						],
					],
					'min' => 0,
					'max' => 50,
					'layout' => 'table',
					'button_label' => 'Add Song',
					'collapsed' => 'field_song_name',
				],
			],
			'location' => [
				[
					[
						'param' => 'block',
						'operator' => '==',
						'value' => 'acf/album-list',
					],
				],
			],
			'menu_order' => 0,
			'position' => 'normal',
			'style' => 'default',
			'label_placement' => 'top',
			'instruction_placement' => 'label',
			'hide_on_screen' => '',
			'active' => true,
			'description' => 'Fields for the Album List block',
		]);
	}
	add_action('acf/init', 'addAlbumListFields');
}

/**
 * Add ACF field groups programmatically for Album Content
 */
if (!function_exists('addAlbumContentFields')) {
	function addAlbumContentFields(): void {
		if (!function_exists('acf_add_local_field_group')) {
			return;
		}

		acf_add_local_field_group([
			'key' => 'group_album_content_block',
			'title' => 'Album Content Block Fields',
			'fields' => [
				[
					'key' => 'field_album_name',
					'label' => 'Album Name',
					'name' => 'album_name',
					'type' => 'text',
					'instructions' => 'Enter the name of the album (will be used as H1 title)',
					'required' => 1,
					'placeholder' => 'Album title...',
					'maxlength' => 200,
				],
				[
					'key' => 'field_artist_name',
					'label' => 'Artist Name',
					'name' => 'artist',
					'type' => 'text',
					'instructions' => 'Enter the name of the artist or band',
					'required' => 1,
					'placeholder' => 'Artist name...',
					'maxlength' => 200,
				],
				[
					'key' => 'field_explicit_content',
					'label' => 'Explicit Content',
					'name' => 'explicit',
					'type' => 'true_false',
					'instructions' => 'Check if this album contains explicit content',
					'required' => 0,
					'message' => 'This album contains explicit content',
					'default_value' => 0,
					'ui' => 1,
				],
				[
					'key' => 'field_spotify_link',
					'label' => 'Spotify Link',
					'name' => 'spotify_link',
					'type' => 'text',
					'instructions' => 'Enter the Spotify URL for this album',
					'required' => 0,
					'placeholder' => 'https://open.spotify.com/album/...',
				],
				[
					'key' => 'field_apple_music_link',
					'label' => 'Apple Music Link',
					'name' => 'apple_music_link',
					'type' => 'text',
					'instructions' => 'Enter the Apple Music URL for this album',
					'required' => 0,
					'placeholder' => 'https://music.apple.com/album/...',
				],
			],
			'location' => [
				[
					[
						'param' => 'block',
						'operator' => '==',
						'value' => 'acf/album-content',
					],
				],
			],
			'menu_order' => 0,
			'position' => 'normal',
			'style' => 'default',
			'label_placement' => 'top',
			'instruction_placement' => 'label',
			'hide_on_screen' => '',
			'active' => true,
			'description' => 'Fields for the Album Content block',
		]);
	}
	add_action('acf/init', 'addAlbumContentFields');
}

if ( ! function_exists('main_styles')) {
    function main_styles() {
        wp_enqueue_style(
            'main-theme-style',
            get_stylesheet_uri(),
            [],
            wp_get_theme()->get('Version')
        );
        
        // Enqueue Google Fonts
        wp_enqueue_style(
            'lexend-font',
            'https://fonts.googleapis.com/css2?family=Lexend:wght@400;700&display=swap',
            [],
            null
        );
    }
    add_action('wp_enqueue_scripts', 'main_styles');
}
