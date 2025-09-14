<?php
/**
 * Edba Theme Block Registration
 * 
 * This file handles the registration of all custom ACF Gutenberg blocks
 * for the edba theme, organized by different sections.
 */

/**
 * Main block registration function - runs once on init
 */
add_action('init', 'edba_register_all_blocks');

function edba_register_all_blocks() {
    // Check if ACF is active
    if (!function_exists('acf_register_block_type')) {
        return;
    }
    
    // Define block directories to register
    $block_directories = [
        '/blocks'
    ];
    
    // Register blocks from each directory
    foreach ($block_directories as $directory) {
        edba_register_blocks_from_directory($directory);
    }
}

/**
 * Helper function to register blocks from a specific directory
 *
 * @param string $relative_path The relative path to the blocks directory
 */
function edba_register_blocks_from_directory($relative_path) {
    $absolute_path = get_template_directory() . $relative_path;
    
    // Skip if directory doesn't exist
    if (!file_exists($absolute_path) || !is_dir($absolute_path)) {
        return;
    }
    
    // Get all subdirectories in the directory
    $block_directories = array_filter(glob($absolute_path . '/*'), 'is_dir');
    
    // Register each block
    foreach ($block_directories as $block_path) {
        register_block_type($block_path);
    }
}

/**
 * Add custom block category
 */
add_filter('block_categories_all', 'edba_add_block_categories', 10, 2);

function edba_add_block_categories($categories, $post) {
    return array_merge(
        $categories,
        [
            [
                'slug'  => 'edba-blocks',
                'title' => __('Bloki Edba', 'edba'),
            ],
        ]
    );
}