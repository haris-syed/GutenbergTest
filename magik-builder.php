<?php
/** @package MagikBuilder
 */

/*
Plugin Name: Magik Builder
Plugin URI: https://www.pookidevs.com
Description: Creative Gutenberg blocks
Version: 1.0.0
Author: PookiDevs
Author URI: https://www.pookidevs.com
License: GPLv2 or later
text-domain: magik-builder
 */

/*
 *
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 */

if (! defined('ABSPATH')){
    die;
}
if(! function_exists('add_action')){
    exit;
}

class MagikBuilder {
    function __construct(){
        add_action( 'init', array( $this, 'create_custom_category' ) );
    }

    function activate(){
        require_once plugin_dir_path( __FILE__ ) . 'inc/activate.php';
        MagikPluginActivate::activate();
    }

    function deactivate(){
        require_once plugin_dir_path( __FILE__ ) . 'inc/deactivate.php';
        MagikPluginDeactivate::deactivate();
    }

    function register_scripts(){
        //add_action('admin_enqueue_scripts', array($this,'enqueue_scripts'));
        add_action('enqueue_block_editor_assets', array($this,'enqueue_scripts'));
    }

    function enqueue_scripts(){
        wp_enqueue_script( 'testblock', plugins_url( '/assets/test_block.js', __FILE__ ), array('wp-blocks','wp-editor'),
            true );
        wp_enqueue_script( 'timerblock', plugins_url( '/assets/timer_block.js', __FILE__ ), array('wp-blocks','wp-editor'),
            true );
        wp_enqueue_style('timerstyle',plugins_url( '/assets/timer_block_style.css', __FILE__ ), array('wp-edit-blocks'),
            true );
    }

    function custom_category($categories, $post){
        return array_merge(
            $categories,
            array(
                array(
                    'slug' => 'magik-blocks',
                    'title' => __('Magik Blocks', 'magik-blocks'),
                ),
            )
        );
    }

    function create_custom_category(){
        add_filter('block_categories', array($this,'custom_category'), 10, 2);
    }

    function uninstall(){

    }
}

if (class_exists('MagikBuilder')) {
    $magikBuilder = new MagikBuilder();
    $magikBuilder -> register_scripts();
}

//register activation, deactivation, uninstall hooks
register_activation_hook(__FILE__, array($magikBuilder,'activate'));
register_deactivation_hook(__FILE__, array($magikBuilder,'deactivate'));
//TODO: hook the uninstall method at end of development

