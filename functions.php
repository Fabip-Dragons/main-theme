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
