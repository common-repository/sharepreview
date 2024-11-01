<?php
/*
 * Plugin Name: SharePreview
 * Description: Preview tool for Social media sharing links.
 * Ccopyright; Cloudamite (C) 2023 
 * Version: 1.0
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

 if ( ! defined( 'ABSPATH' ) ) exit; 

function sharepreview_load_assets() {
	
    $sharepreview_css_app_js  = plugin_dir_url( __FILE__ ) . 'src/pages/content/index.js';

    $plugin_data = get_plugin_data( __FILE__ );
    $version = $plugin_data['Version'];

    // for DEBUG only
    //$version = time();

    wp_register_script( 'sharepreview', $sharepreview_css_app_js, array(), $version, true );         
}

add_action( 'wp_enqueue_scripts', 'sharepreview_load_assets' );

function sharepreview_somePreviewButton() {
    if (!is_preview()){
        return;
    }
    //we're only reading boolean here. Using boolval to "escape" the sting. This can only be true/false
	$preview = boolval($_GET['sharepreview']);
	if($preview == true){
   		wp_enqueue_style( 'sharepreview' );
    	wp_enqueue_script( 'sharepreview' );
    }
}

add_action( 'wp_head', 'sharepreview_somePreviewButton', 1 );


function sharepreview_button($post){
    wp_enqueue_style( 'sharepreview_meta' );

    echo '<div class="misc-pub-section" style="display:grid;align-items:center;grid-template-columns:25px 200px;column-gap: 1px;"><img src="' .  plugin_dir_url( __FILE__ ) .'share-preview.svg" width="18" height="18" />
          <div class="sp-link"><a href=' . get_permalink($post) .'?preview=true&sharepreview=true>SharePreview</a></div></div>';
}

add_action( 'post_submitbox_misc_actions', 'sharepreview_button' );

?>