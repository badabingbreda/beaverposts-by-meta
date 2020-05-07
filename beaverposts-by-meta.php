<?php
/**
 * Beaver Posts By Meta
 *
 * @package     Package
 * @author      Badabingbreda
 * @license     GPL-2.0+
 *
 * @wordpress-plugin
 * Plugin Name: Beaver Posts By Meta
 * Plugin URI:  https://www.badabing.nl
 * Description: Add options to the Beaver Posts Module to only show posts that have a certain meta_key value
 * Version:     1.0.0
 * Author:      Badabingbreda
 * Author URI:  https://www.badabing.nl
 * Text Domain: beaverposts-by-meta
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

define( 'BEAVERPOSTSBYMETA_VERSION' 	, '1.0.0' );
define( 'BEAVERPOSTSBYMETA_DIR'			, plugin_dir_path( __FILE__ ) );
define( 'BEAVERPOSTSBYMETA_FILE'		, __FILE__ );
define( 'BEAVERPOSTSBYMETA_URL' 		, plugins_url( '/', __FILE__ ) );

require_once( 'inc/insert-between.php' );
require_once( 'inc/class-beaverposts-by-meta.php' );
